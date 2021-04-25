<?php

namespace Modules\Setting\Http\Controllers;

use App\Traits\UploadTheme;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Modules\Setting\Entities\VersionHistory;
use Modules\Setting\Model\GeneralSetting;
use ZipArchive;

class UpdateController extends Controller
{
    use UploadTheme;

    public function updateSystem()
    {
        return view('setting::updateSystem');
    }

    public function updateSystemSubmit(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $request->validate([
                'updateFile' => ['required', 'mimes:zip'],
            ]);

            $this->allClear();


            if ($request->hasFile('updateFile')) {
                $path = $request->updateFile->store('updateFile');
                $request->updateFile->getClientOriginalName();
                $zip = new ZipArchive;
                $res = $zip->open(storage_path('app/' . $path));
                if ($res === true) {
                    $zip->extractTo(storage_path('app/tempUpdate'));
                    $zip->close();
                } else {
                    abort(500, 'Error! Could not open File');
                }

                $str = @file_get_contents(storage_path('app/tempUpdate/config.json'), true);
                if ($str === false) {
                    abort(500, 'The update file is corrupt.');

                }

                $json = json_decode($str, true);

                if (!empty($json)) {
                    if (empty($json['version']) || empty($json['release_date'])) {
                        Toastr::error('Config File Missing', trans('common.Failed'));
                        return redirect()->back();
                    }


                } else {
                    Toastr::error('Config File Missing', trans('common.Failed'));
                    return redirect()->back();
                }

                $src = storage_path('app/tempUpdate');
                $dst = base_path('/');

                $this->recurse_copy($src, $dst);

                if (isset($json['migrations']) & !empty($json['migrations'])) {
                    foreach ($json['migrations'] as $migration) {
                        Artisan::call('migrate',
                            array(
                                '--path' => $migration,
                                '--force' => true));
                    }
                }

                $setting = GeneralSetting::first();
                $setting->last_updated_date = Carbon::now();
                $setting->system_version = $json['version'];
                $setting->save();
                $newVersion = VersionHistory::where('version', $json['version'])->first();
                if (!$newVersion) {
                    $newVersion = new VersionHistory();
                }
                $newVersion->version = $json['version'];
                $newVersion->release_date = $json['release_date'];
                $newVersion->url = $json['url'];
                $newVersion->notes = $json['notes'];
                $newVersion->save();
                Storage::put('.version', $json['version']);
            }


            if (storage_path('app/updateFile')) {
                $this->delete_directory(storage_path('app/updateFile'));
            }
            if (storage_path('app/tempUpdate')) {
                $this->delete_directory(storage_path('app/tempUpdate'));
            }

            $this->allClear();

            Toastr::success("Your system successfully updated", 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $this->allClear();

            if (storage_path('app/updateFile')) {
                $this->delete_directory(storage_path('app/updateFile'));
            }
            if (storage_path('app/tempUpdate')) {
                $this->delete_directory(storage_path('app/tempUpdate'));
            }
            Toastr::error($e->getMessage(), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function allClear()
    {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
    }
}
