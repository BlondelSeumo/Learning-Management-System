<?php

namespace App\Traits;
use Mail;
use Modules\Setting\Mail\MailManager;
use Modules\Setting\Model\BusinessSetting;


trait SendMail
{
    //for real using purpose
    function sendMail($request)
    {
        $view = 'setting::emails.mail';
        $data = array('name'=>env('MAIL_USERNAME'),'subject'=>"Virat Gandhi", 'content'=>$request->content);
        if (getSetting()->mail_protocol  == "smtp") {
            try {
                Mail::send($view, $data, function ($message) {
                    $message->from(env('MAIL_USERNAME'), 'John Doe');
                    $message->sender(env('MAIL_USERNAME'), 'John Doe');
                    $message->to('naimcse56@gmail.com', 'John Doe');
                    $message->cc(env('MAIL_USERNAME'), 'John Doe');
                    $message->bcc(env('MAIL_USERNAME'), 'John Doe');
                    $message->replyto(env('MAIL_USERNAME'), 'John Doe');
                    $message->subject('Subject');
                });
            } catch (\Exception $e) {

            }
        }
    }

    //for testing purpose from backend admin panel
    function sendMailTest($request)
    {


        $view = 'setting::emails.mail';
        $data = array('name'=>env('MAIL_USERNAME'),'subject'=>"Contact Message", 'content'=>$request->content);
        if (getSetting()->mail_protocol  == "smtp") {
            try {
                Mail::send($view, $data, function ($message) {
                    $message->from(env('MAIL_USERNAME'), 'John Doe');
                    $message->sender(env('MAIL_USERNAME'), 'John Doe');
                    $message->to('naimcse56@gmail.com', 'John Doe');
                    $message->cc(env('MAIL_USERNAME'), 'John Doe');
                    $message->bcc(env('MAIL_USERNAME'), 'John Doe');
                    $message->replyto(env('MAIL_USERNAME'), 'John Doe');
                    $message->subject('Subject');
                });
            } catch (\Exception $e) {
               dd($e);
            }
        }

    }

}
