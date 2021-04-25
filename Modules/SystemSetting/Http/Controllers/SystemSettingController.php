<?php

namespace Modules\SystemSetting\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\Setting\Model\GeneralSetting;
use Modules\SystemSetting\Entities\EmailSetting;
use Modules\SystemSetting\Entities\EmailTemplate;
use Modules\SystemSetting\Entities\GeneralSettings;


class SystemSettingController extends Controller
{
    public function sendTestMail(Request $request)

    {
        $request->validate([
            'type' => "required",
            'testMailAddress' => "required",
        ]);
        try {

            $email = $request->get('testMailAddress');
            $type = $request->get('type');
            $config = EmailSetting::findOrFail($type);
            if ($config->id == 1) {
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=utf-8\r\n";
                $headers .= "From: <" . $config->from_name . "> \r\n";
                $headers .= "Reply-To: $email <$email> \r\n";


                $status = mail($email, "Test Mail", "Test Mail", $headers);
                if ($status) {
                    Toastr::success('Email Sent Successfully', 'Success');
                } else {
                    Toastr::error('Something Went Wrong', "Error");
                }
                return redirect()->back();

            } elseif ($config->id == 2) {

                $f = fsockopen($config->mail_host, $config->mail_port);

                if ($f !== false) {

                    $res = fread($f, 1024);
                    if (strlen($res) > 0 && strpos($res, '220') === 0) {
                        $mail_val = [
                            'send_to_name' => 'Tester',
                            'send_to' => $email,
                            'email_from' => $config->from_email,
                            'email_from_name' => $config->from_name,
                            'subject' => 'Test Mail',
                        ];

                        Config::set('mail.driver', $config->mail_driver);
                        Config::set('mail.from', $config->from_email);
                        Config::set('mail.name', $config->from_email);
                        Config::set('mail.host', $config->mail_host);
                        Config::set('mail.port', $config->mail_port);
                        Config::set('mail.username', $config->mail_username);
                        Config::set('mail.password', $config->mail_password);
                        Config::set('mail.encryption', $config->mail_encryption);

                        Mail::send('partials.email', ['body' => "Test Mail"], function ($send) use ($mail_val) {
                            $send->from($mail_val['email_from'], $mail_val['email_from_name']);
                            $send->replyto($mail_val['email_from'], $mail_val['email_from_name']);
                            $send->to($mail_val['send_to'], $mail_val['send_to_name'])->subject($mail_val['subject']);
                        });
                        Toastr::success('Email Sent Successfully', 'Success');
                        return redirect()->back();
                    }
                } else {
                    Toastr::error('Something Went Wrong', "Error");
                    return redirect()->back();
                }

            } elseif ($config->id == 3) {
                $data['body'] = "Test Mail";
                $emailSendGrid = new \SendGrid\Mail\Mail();
                $emailSendGrid->setFrom($config->from_email, $config->from_name);
                $emailSendGrid->setSubject("Test mail");
                $emailSendGrid->addTo($email, $email);
                $emailSendGrid->addContent(
                    "text/html", (string)view('partials.email', $data)
                );
                $sendgrid = new \SendGrid($config->api_key);
                $response = $sendgrid->send($emailSendGrid);

                if ($response->statusCode() == 202) {
                    Toastr::success('Email Sent successful', 'Success');
                    return redirect()->back();
                } else {
                    $area = json_decode($response->body(), true);
                    $msg = str_replace("'", " ", $area['errors'][0]['message']);

                    Toastr::error($msg, 'Failed');
                    return redirect()->back();
                }
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }


    }

    public function updateEmailSetting(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        // return $request;
        $request->validate([
            'id' => "required",
            'api_key' => "required_if:id,3|required_if:id,4",
            'from_name' => "required",
            'from_email' => "required|email",
            'mail_driver' => "required_if:id,2",
            'mail_host' => "required_if:id,2",
            'mail_port' => "required_if:id,2|nullable|numeric",
            'mail_username' => "required_if:id,2",
            'mail_password' => "required_if:id,2",
            'mail_encryption' => "required_if:id,2",
            'active_status' => "required",
        ]);

        DB::beginTransaction();

        try {
            if (Config::get('app.app_sync')) {
                Toastr::error('For demo version you can not change this !', 'Failed');
                return redirect()->back();
            } else {

                switch ($request->id) {
                    case 1:
                        EmailSetting::find($request->id)->update([
                            'from_name' => $request->from_name,
                            'from_email' => $request->from_email
                        ]);
                        break;
                    case 3:
                        EmailSetting::find($request->id)->update([ //sendGrid
                            'from_name' => $request->from_name,
                            'from_email' => $request->from_email,
                            'api_key' => $request->api_key

                        ]);
                        break;
                    case 4:
                        EmailSetting::find($request->id)->update([  //sendinblue
                            'from_name' => $request->from_name,
                            'from_email' => $request->from_email,
                            'api_key' => $request->api_key
                        ]);
                        break;
                    case 2:

                        $key1 = 'MAIL_USERNAME';
                        $key2 = 'MAIL_PASSWORD';
                        $key3 = 'MAIL_ENCRYPTION';
                        $key4 = 'MAIL_PORT';
                        $key5 = 'MAIL_HOST';
                        $key6 = 'MAIL_DRIVER';
                        $key7 = 'MAIL_FROM_ADDRESS';

                        $value1 = $request->mail_username;
                        $value2 = $request->mail_password;
                        $value3 = $request->mail_encryption;
                        $value4 = $request->mail_port;
                        $value5 = $request->mail_host;
                        $value6 = $request->mail_driver;
                        $value7 = $request->from_email;

                        $path = base_path() . "/.env";
                        $MAIL_USERNAME = env($key1);
                        $MAIL_PASSWORD = env($key2);
                        $MAIL_ENCRYPTION = env($key3);
                        $MAIL_PORT = env($key4);
                        $MAIL_HOST = env($key5);
                        $MAIL_DRIVER = env($key6);
                        $MAIL_FROM_ADDRESS = env($key7);

                        if (file_exists($path)) {
                            file_put_contents($path, str_replace(
                                "$key1=" . $MAIL_USERNAME,
                                "$key1=" . $value1,
                                file_get_contents($path)
                            ));
                            file_put_contents($path, str_replace(
                                "$key2=" . $MAIL_PASSWORD,
                                "$key2=" . $value2,
                                file_get_contents($path)
                            ));
                            file_put_contents($path, str_replace(
                                "$key3=" . $MAIL_ENCRYPTION,
                                "$key3=" . $value3,
                                file_get_contents($path)
                            ));
                            file_put_contents($path, str_replace(
                                "$key4=" . $MAIL_PORT,
                                "$key4=" . $value4,
                                file_get_contents($path)
                            ));
                            file_put_contents($path, str_replace(
                                "$key5=" . $MAIL_HOST,
                                "$key5=" . $value5,
                                file_get_contents($path)
                            ));
                            file_put_contents($path, str_replace(
                                "$key6=" . $MAIL_DRIVER,
                                "$key6=" . $value6,
                                file_get_contents($path)
                            ));

                            file_put_contents($path, str_replace(
                                "$key7=" . $MAIL_FROM_ADDRESS,
                                "$key7=" . $value7,
                                file_get_contents($path)
                            ));
                        }

                        $emailSettingsData = EmailSetting::select('id')->where('active_status', 1)->first();

                        if (!empty($emailSettingsData)) {

                            $emailSettData = EmailSetting::find($request->id);
                            $emailSettData->from_name = $request->from_name;
                            $emailSettData->from_email = $request->from_email;

                            $emailSettData->mail_driver = $request->mail_driver;
                            $emailSettData->mail_host = $request->mail_host;
                            $emailSettData->mail_port = $request->mail_port;
                            $emailSettData->mail_username = $request->mail_username;
                            $emailSettData->mail_password = $request->mail_password;
                            $emailSettData->mail_encryption = $request->mail_encryption;

                            $results = $emailSettData->update();
                        }
                        break;
                    default:
                        return response()->json(['error' => "Operation Failed"]);
                        break;
                }

                putEnvConfigration('MAIL_FROM_NAME', $request->from_name ?? 'infixLMS');
                putEnvConfigration('MAIL_FROM_ADDRESS', $request->from_email ?? 'admin@infixlms.com');

                if ($request->active_status == 1) {
                    EmailSetting::where('active_status', 1)->update(['active_status' => 0]);
                    EmailSetting::where('id', $request->id)->update(['active_status' => 1]);
                }

                DB::commit();

                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();

            }
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function footerTemplateUpdate(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'email_template' => "required"
        ]);


        try {
            if (Config::get('app.app_sync')) {
                Toastr::error('For demo version you can not change this !', 'Failed');
                return redirect()->back();
            } else {

                $eTemplate = GeneralSettings::first();
                $eTemplate->email_template = $request->email_template;
                $eTemplate->save();
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            }

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }

    public function updateEmailTemp(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'id' => "required",
            'subj' => "required",
            'email_body' => "required"
        ]);
        try {

            if (Config::get('app.app_sync')) {
                Toastr::error('For demo version you can not change this !', 'Failed');
                return redirect()->back();
            } else {
                // $success = trans('lang.Email Template').' '.trans('lang.Updated').' '.trans('lang.Successfully');

                $template = EmailTemplate::find($request->id);
                $template->subj = $request->subj;
                $template->email_body = $request->email_body;
                $template->save();

            }
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }

    public function allApi()
    {
        $setting = getSetting();
        return view('systemsetting::api.index', compact('setting'));
    }

    public function saveApi(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'gmap_key' => 'required_without_all:lat,lng,fixer_key',
            'lat' => 'required_without_all:gmap_key,lng,fixer_key',
            'lng' => 'required_without_all:gmap_key,lat,fixer_key',
        ]);

        $setting = GeneralSetting::first();
        if ($request->gmap_key)
            $setting->gmap_key = $request->gmap_key;
        if ($request->lat)
            $setting->lat = $request->lat;
        if ($request->lng)
            $setting->lng = $request->lng;
        if ($request->fixer_key)
            $setting->fixer_key = $request->fixer_key;
        if ($request->zoom_level)
            $setting->zoom_level = $request->zoom_level;
        $setting->save();

        Toastr::success(trans('setting.Api Settings Saved Successfully'));
        return back();
    }
}

