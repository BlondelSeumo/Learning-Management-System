<?php

namespace Modules\Localization\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Localization\Entities\Language;
use Modules\Localization\Entities\LanguagePhrase;
use Modules\Localization\Entities\SelectedLanguage;
use Modules\Module\Entities\Module;

class LocalizationController extends Controller
{
    public function index()
    {
        $languages = Language::get();
        return view('generalsetting::languageSetting.language',compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:languages,name',
            'code' => 'required | max:15',
            'native' => 'required | max:50',
        ]);


        try {
            $s = new Language();
            $s->name = $request->name;
            $s->code = $request->code;
            $s->native = $request->native;
            $s->rtl = 0;
            $s->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect('language-list');
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect('language-list');
        }
    }

    public function show($id)
    {

        try {
            $editData = Language::findOrfail($id);
            $languages = Language::get();
            return view('generalsetting::languageSetting.language',compact('languages','editData'));

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:languages,name,'. $request->id,
            'code' => 'required | max:15',
            'native' => 'required | max:50',
        ]);


        try {
            $s = Language::findOrfail($request->id);
            $s->name = $request->name;
            $s->code = $request->code;
            $s->native = $request->native;
            $s->update();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            if($id < 115){
                Toastr::warning('Can not delete system generate language ', 'Failed');
                return redirect()->back();
            }else{
                if(SelectedLanguage::where('lang_id',$id)->count() == 1 ){
                    if(SelectedLanguage::where('lang_id',$id)->where('status',0)->delete($id)){
                        Language::where('id',$id)->delete($id);
                        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                        return redirect()->back();
                    }else{
                        Toastr::error('Can not delete current system selected language!', 'Failed');
                        return redirect()->back();
                    }
                }else{
                    Language::where('id',$id)->delete($id);
                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function languageSetup($language_universal)
    {

        try {
            $data['LanguagePhraseList']     = LanguagePhrase::where('status', 1)->get();
            $data['modules']                = Module::all();
            $data['language_universal']     = $language_universal;
            return view('generalsetting::languageSetting.languageSetup', $data);
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function languageSettings()
    {

        try {
            $sms_languages = SelectedLanguage::get();
            $all_languages = Language::whereNotIn('id', $sms_languages->pluck('lang_id'))->orderBy('code', 'ASC')->get();
            return view('generalsetting::languageSetting.languageSettings', compact('sms_languages', 'all_languages'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function languageEdit($id)
    {

        try {
            $selected_languages = SelectedLanguage::find($id);
            $sms_languages      = SelectedLanguage::get();
            $all_languages      =Language::orderBy('code', 'ASC')->get();
            return view('generalsetting::languageSetting.languageSettings', compact('sms_languages', 'all_languages', 'selected_languages'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function languageUpdate(Request $request)
    {

        try {
            $id               = $request->id;
            $language_id      = $request->language_id;
            $language_details = Language::find($language_id);

            if (!empty($language_id)) {
                $sms_languages                     = SelectedLanguage::find($id);
                $sms_languages->language_name      = $language_details->name != null ? $language_details->name : '';
                $sms_languages->language_universal = $language_details->code;
                $sms_languages->native             = $language_details->native;
                $sms_languages->lang_id            = $language_details->id;

                $results = $sms_languages->save();
                if ($results) {
                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->back();
                } else {
                    Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function languageAdd(Request $request)
    {
        $request->validate([
            'lang_id' => 'required|max:255'
        ]);

        try {
            $lang_id          = $request->lang_id;
            $language_details = DB::table('languages')->where('id', $lang_id)->first();

            if (!empty($language_details)) {
                $sms_languages                     = new SelectedLanguage();
                $sms_languages->language_name      = $language_details->name;
                $sms_languages->language_universal = $language_details->code;
                $sms_languages->native             = $language_details->native;
                $sms_languages->lang_id            = $language_details->id;
                $sms_languages->status      = '0';
                $results = $sms_languages->save();
                if ($results) {

                    if (Schema::hasColumn('language_phrases', $language_details->code)) {
                        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                        return redirect('admin/language-settings');
                    } else {
                        if (DB::statement('ALTER TABLE language_phrases ADD ' . $language_details->code . ' text')) {
                            $column = $language_details->code;
                            $all_translation_terms = LanguagePhrase::all();
                            $jsonArr = [];
                            foreach ($all_translation_terms as $row) {
                                $lid          = $row->id;
                                $english_term = $row->en;
                                if (!empty($english_term)) {
                                    $update_translation_term                = LanguagePhrase::find($lid);
                                    $update_translation_term->$column       = $english_term;
                                    $update_translation_term->status = 1;
                                    $update_translation_term->save();
                                }
                            }
                            $path = base_path() . '/resources/lang/' . $language_details->code;
                            if (!file_exists($path)) {
                                File::makeDirectory($path, $mode = 0777, true, true);
                                $newPath      = $path . 'lang.php';
                                $page_content = "<?php
                                                    use Modules\Localization\Entities\SelectedLanguage;
                                                    \$getData = LanguagePhrase::where('status',1)->get();
                                                    \$LanguageArr=[];
                                                    foreach (\$getData as \$row) {
                                                        \$LanguageArr[\$row->default_phrases]=\$row->" . $language_details->code . ";
                                                    }
                                                    return \$LanguageArr;";
                                if (!file_exists($newPath)) {
                                    File::put($path . '/lang.php', $page_content);
                                }
                            }
                            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                            return redirect('admin/language-settings');
                        } else {
                            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                            return redirect()->back();
                        }
                    }
                } else {
                    Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                    return redirect()->back();
                }
            } //not empty language
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function languageDelete(Request $request)
    {

        $delete_directory = SelectedLanguage::find($request->id);

        DB::beginTransaction();

        try {

            if (DB::statement('ALTER TABLE language_phrases DROP COLUMN ' . $delete_directory->language_universal)) {
                if ($delete_directory) {
                    $path = base_path() . '/resources/lang/' . $delete_directory->language_universal;
                    if (file_exists($path)) {
                        File::delete($path . '/lang.php');
                        rmdir($path);
                    }
                    $result = SelectedLanguage::destroy($request->id);
                    if ($result) {
                        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                        return redirect()->back();
                    }
                } else {
                    Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                    return redirect()->back();
                }
            } //end drop table column

            DB::commit();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function getTranslationTerms(Request $request)
    {

        try {
            $terms = LanguagePhrase::where('modules', $request->id)->get();
            return response()->json($terms);
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function translationTermUpdate(Request $request)
    {

        $request->validate([
                'module_id' => 'required',
                'language_universal' => 'required'],
            ['module_id.required' => 'Please select at least one module']
        );

        try {
            $InputId            = $request->InputId;
            $language_universal = $request->language_universal;
            $LU                 = $request->LU;

            foreach ($InputId as $id) {
                $data                      = LanguagePhrase::find($id);
                $data->$language_universal = $LU[$id];
                $data->save();
            }
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function changeLocale($locale)
    {
        try {
            Session::put('locale', $locale);
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function changeLanguage($id)
    {

        try {
            SelectedLanguage::where('status', '=', 1)->update(['status' => 0]);
            $language           = SelectedLanguage::find($id);
            $language->status   = 1;
            $language->save();
            Session::flash('langChange', 'Successfully Language Changed');
            return redirect()->to('admin/locale/' . $language->language_universal);
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function setEnvironmentValue()
    {

        try {
            $values['APP_LOCALE'] = 'en';
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            if (count($values) > 0) {
                foreach ($values as $envKey => $envValue) {
                    $str .= "\n";
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$envValue}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }
                }
            }
            $str = substr($str, 0, -1);
            $res = file_put_contents($envFile, $str);
            return $res;
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }



    public function ajaxLanguageChange(Request $request)
    {

        try {
            $uni = $request->id;
            SelectedLanguage::where('status', 1)->update(['status' => 0]);

            $updateLang = SelectedLanguage::where('language_universal', $uni)->first();
            $updateLang->status = 1;
            $updateLang->update();

            $values['APP_LOCALE'] = $updateLang->language_universal;
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            if (count($values) > 0) {
                foreach ($values as $envKey => $envValue) {
                    $str .= "\n";
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$envValue}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }
                }
            }
            $str = substr($str, 0, -1);
            $res = file_put_contents($envFile, $str);

            return response()->json([$updateLang]);
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
}
