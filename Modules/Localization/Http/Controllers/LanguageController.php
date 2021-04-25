<?php

namespace Modules\Localization\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Artisan;
use Lang;
use Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Model\GeneralSetting;
use Modules\Localization\Entities\Language;
use Modules\Localization\Repositories\LanguageRepositoryInterface;

class LanguageController extends Controller
{
    protected $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {

        $this->languageRepository = $languageRepository;
    }

    public function index()
    {
        $languages = $this->languageRepository->all();
        return view('localization::languages.index', [
            "languages" => $languages
        ]);
    }

    public function update_rtl_status(Request $request)
    {
        $language = Language::findOrFail($request->id);
        $language->rtl = $request->status;
        if ($language->save()) {
            return 1;
        }
        return 0;
    }

    public function update_active_status(Request $request)
    {
        $language = Language::findOrFail($request->id);
        $language->status = $request->status;
        if ($language->save()) {
            return 1;
        }
        return 0;
    }

    public function store(Request $request)
    {
        try {
            $this->languageRepository->create($request->except("_token"));
            return back()->with('message-success', __('setting.Language Added Successfully'));
        } catch (\Exception $e) {
            return back()->with('message-danger', __('common.Something Went Wrong'));
        }
    }

    public function edit(Request $request)
    {
        try {
            $language = $this->languageRepository->find($request->id);
            return view('localization::languages.edit_modal', [
                "language" => $language
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $language = $this->languageRepository->find($id);
            Session::put('locale', $language->code);
            return view('localization::languages.translate_view', [
                "language" => $language
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $language = $this->languageRepository->update($request->except("_token"), $id);
            return back()->with('message-success', __('setting.Language Updated Successfully'));
        } catch (\Exception $e) {
            return back()->with('message-danger', __('common.Something Went Wrong'));
        }
    }

/*    public function key_value_store(Request $request)
    {
        try {
            $language = Language::findOrFail($request->id);

            if (!file_exists(base_path('resources/lang/' . $language->code))) {
                mkdir(base_path('resources/lang/' . $language->code));
            }
            if (file_exists(base_path('resources/lang/' . $language->code . '/' . $request->translatable_file_name))) {
                $fp = fopen(base_path('resources/lang/' . $language->code . '/' . $request->translatable_file_name), "r+");
                ftruncate($fp, 0);
                fclose($fp);
            }

            $fp = fopen(base_path('resources/lang/' . $language->code . '/' . $request->translatable_file_name), 'a');//opens file in append mode
            fwrite($fp, '<?php return [');

            foreach ($request->key as $key => $key) {
                $a = $request->key[$key];
                $b = $key;
                $c = "\n\t'" . $b . "' => '" . $a . "',";
                fwrite($fp, $c);
            }
            fwrite($fp, "\n");
            fwrite($fp, '];');
            fclose($fp);
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));

            return back();
        }catch (\Exception $e){
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));

            return back();

        }
    }*/
    public function key_value_store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'id' => 'required',
            'translatable_file_name' => 'required',
            'key' => 'required',
        ]);


        try{
            $language = Language::findOrFail($request->id);

            if (!file_exists(base_path('resources/lang/'.$language->code))) {
                mkdir(base_path('resources/lang/'.$language->code));
            }
            if (file_exists(base_path('resources/lang/'.$language->code.'/'.$request->translatable_file_name))) {
                file_put_contents(base_path('resources/lang/'.$language->code.'/'.$request->translatable_file_name), '');
            }
            $str = <<<EOT
            <?php
                return [
            EOT;
            foreach ($request->key as $key => $val) {
                $key =addslashes($key);
                $val=addslashes($val);
                $line = <<<EOT
                '{$key}' => '{$val}',\n
            EOT;
                $str .= $line;
            }

            $end = <<<EOT
                    ]
            ?>
            EOT;
            $str .= $end;

            file_put_contents(base_path('resources/lang/'.$language->code.'/'.$request->translatable_file_name),  $str);
            Artisan::call('cache:clear');
            Toastr::success('Operation Successfully done');
            return back();

        }catch (\Exception $e) {
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }
    public function changeLanguage(Request $request)
    {
        Session::put('locale', $request->code);
        $settings = GeneralSetting::find(1);
        $settings->language_name = $request->code;
        $settings->save();
        return 1;
    }

    public function get_translate_file(Request $request)
    {
        try{
            $language = $this->languageRepository->find($request->id);
            // Specify the file

            $file_name = explode('.', $request->file_name);
            $languages = Lang::get($file_name[0]);
            $translatable_file_name = $request->file_name;

            if(file_exists(base_path('resources/lang/'.$language->code.'/'.$request->file_name)))
            {
                $url = base_path('resources/lang/'.$language->code.'/'.$request->file_name);
                $languages = include  "{$url}";
                return view('localization::modals.translate_modal', [
                    "languages" => $languages,
                    "language" => $language,
                    "translatable_file_name" => $translatable_file_name
                ]);
            }


            $file1 = base_path('resources/lang/default/'.$request->file_name);
            if (!file_exists(base_path('resources/lang/'.$language->code))) {
                mkdir(base_path('resources/lang/'.$language->code));
            }
            if (!file_exists(base_path('resources/lang/'.$language->code.'/'.$request->file_name))) {
                copy($file1,base_path('resources/lang/'.$language->code.'/'.$request->file_name));
            }



            $file2 = base_path('resources/lang/'.$language->code.'/'.$request->file_name);
            // Count the number of lines on file
            $no_of_lines_file_1 = count(file($file1));
            $no_of_lines_file_2 = count(file($file2));

            if ($no_of_lines_file_1 > $no_of_lines_file_2) {
                $file_contents = file_get_contents($file2);
                $file_contents = str_replace("\n];"," ",$file_contents);
                file_put_contents($file2,$file_contents);
                $i = $no_of_lines_file_2 - 1;
                $lines = file($file1);
                foreach ($lines as $line) {
                    $fp = fopen($file2, 'a');
                    if ($i < $no_of_lines_file_1) {
                        fwrite($fp, $lines[$i]);
                        $i++;
                    }
                    fclose($fp);
                }
            }

            return view('localization::modals.translate_modal', [
                "languages" => $languages,
                "language" => $language,
                "translatable_file_name" => $translatable_file_name
            ]);
        }catch (\Exception $e) {
            // \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $language = $this->languageRepository->delete($id);
            return back()->with('message-success', __('setting.Language has been deleted Successfully'));
        } catch (\Exception $e) {
            return back()->with('message-danger', __('common.Something Went Wrong'));
        }
    }
}
