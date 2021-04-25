<?php

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Modules\Appearance\Entities\Theme;
use Modules\CourseSetting\Entities\Category;
use Modules\CourseSetting\Entities\Lesson;
use Modules\ModuleManager\Entities\InfixModuleManager;
use Modules\ModuleManager\Entities\Module;
use Modules\Payment\Entities\Cart;
use Modules\Setting\Model\Currency;
use Modules\StudentSetting\Entities\BookmarkCourse;
use Modules\Subscription\Entities\SubscriptionCheckout;
use Modules\SystemSetting\Entities\EmailTemplate;


if (!function_exists('send_smtp_mail')) {
    function send_smtp_mail($config, $receiver_email, $receiver_name, $sender_email, $sender_name, $subject, $message)
    {
        $mail_val = [
            'send_to_name' => $receiver_name,
            'send_to' => $receiver_email,
            'email_from' => $config->from_email,
            'email_from_name' => $config->from_name,
            'subject' => $subject,
        ];

        Mail::send('partials.email', ['body' => $message], function ($send) use ($mail_val) {
            $send->from($mail_val['email_from'], $mail_val['email_from_name']);
            $send->replyto($mail_val['email_from'], $mail_val['email_from_name']);
            $send->to($mail_val['send_to'], $mail_val['send_to_name'])->subject($mail_val['subject']);
        });
    }

}

if (!function_exists('sendMailBySendGrid')) {
    function sendMailBySendGrid($config, $receiver_email, $receiver_name, $sender_email, $sender_name, $subject, $message)
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($config->from_email, $config->from_name);
        $email->setSubject($subject);
        $email->addTo($receiver_email, $receiver_email);
        $email->addContent(
            "text/html", (string)view('partials.email', ['body' => $message])
        );
        $sendgrid = new \SendGrid($config->api_key);
        try {
            $response = $sendgrid->send($email);
            if ($response->statusCode() == 202) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}


if (!function_exists('shortcode_replacer')) {

    function shortcode_replacer($shortcode, $replace_with, $template_string)
    {
        return str_replace($shortcode, $replace_with, $template_string);
    }
}

if (!function_exists('send_email')) {

    function send_email($user, $type, $shortcodes = [])
    {
        $status = EmailTemplate::where('act', $type)->first()->status;
        if ($status == 1) {
            $general = \Modules\SystemSetting\Entities\GeneralSettings::first();
            $email_template = \Modules\SystemSetting\Entities\EmailTemplate::where('act', $type)->where('status', 1)->first();


            $message = $email_template->email_body;
            foreach ($shortcodes as $code => $value) {
                $message = shortcode_replacer('{{' . $code . '}}', $value, $message);
            }
            $message = shortcode_replacer('{{footer}}', $general->email_template, $message);


            $config = \Modules\SystemSetting\Entities\EmailSetting::where('active_status', 1)->first();

            if ($config->id == 1) {
                send_php_mail($user->email, $user->username, $config->from_email, $email_template->subj, $message);
            } else if ($config->id == 2) {
                send_smtp_mail($config, $user->email, $user->username, $config->from_email, $general->site_title, $email_template->subj, $message);
            } else if ($config->id == 3) {
                sendMailBySendGrid($config, $user->email, $user->username, $config->from_email, $general->site_title, $email_template->subj, $message);
            }
        }

    }
}


if (!function_exists('getTrx')) {
    function getTrx($length = 12)
    {
        $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 12; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}


if (!function_exists('routeIs')) {
    function routeIs($route)
    {
        if (Route::currentRouteName() == $route) {
            return true;
        } else {
            return false;
        }
    }
}


if (!function_exists('appMode')) {
    function appMode()
    {
        return Config::get('app.app_sync');
    }
}

if (!function_exists('demoCheck')) {
    function demoCheck()
    {
        if (appMode()) {
            Toastr::error(trans('common.For the demo version, you cannot change this'), trans('common.Failed'));
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('userName')) {
    function userName($id)
    {
        if (User::find($id) != null) {
            return User::find($id)->name;
        }
        return null;
    }
}

if (!function_exists('showPicName')) {
    function showPicName($data)
    {
        $name = explode('/', $data);
        return $name[array_key_last($name)];
    }
}
if (!function_exists('vimeoVideoEmbed')) {
    function vimeoVideoEmbed($video_uri, $title, $height, $width)
    {
        // return '<iframe class="video_iframe" src="https://player.vimeo.com/video/'.showPicName($video_uri).'?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id='.env("VIMEO_APP_ID").'" width="'.$width.'" height="'.$height.'" frameborder="0" allow="autoplay; fullscreen" allowfullscreen title="LMS Basic"></iframe>';
        return '<iframe class="video_iframe" src="https://player.vimeo.com/video/' . showPicName($video_uri) . '?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=' . env("VIMEO_APP_ID") . '"  frameborder="0" allow="autoplay; fullscreen" allowfullscreen title="LMS Basic"></iframe>';
    }
}

if (!function_exists('getSetting')) {
    function getSetting()
    {
        try {
            return app('getSetting');

        } catch (Exception $exception) {
            return false;
        }
    }
}
if (!function_exists('getVideoId')) {
    function getVideoId($v_id)
    {
        $video_id = explode("=", $v_id);
        return $video_id[array_key_last($video_id)];
    }
}
if (!function_exists('youtubeVideo')) {
    function youtubeVideo($video_url)
    {
        if (Str::contains($video_url, 'youtu.be')) {

            $url = explode("/", $video_url);
            return 'https://www.youtube.com/watch?v=' . $url[3];
        }

        if (Str::contains($video_url, '&')) {
            return substr($video_url, 0, strpos($video_url, "&"));
        } else {
            return $video_url;
        }


    }
}
if (!function_exists('isEnrolled')) {
    function isEnrolled($course_id, $user_id)
    {

        $course = \Modules\CourseSetting\Entities\Course::find($course_id);


        if (Auth::check()) {
            if (Auth::user()->role_id == 1) {
                return true;
            }

            if ($course->user_id == Auth::user()->id) {
                return true;
            }
        }


        $enrolled = DB::table('course_enrolleds')->where('user_id', $user_id)->where('course_id', $course_id)->where('status', 1)->count();
        if ($enrolled == 0) {
            return false;
        } else {
            return true;
        }

    }
}


if (!function_exists('isCart')) {
    function isCart($course_id)
    {

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::user()->id)->where('course_id', $course_id)->first();
            if (empty($cart)) {
                return false;
            } else {
                return true;
            }
        } else if (!empty(session()->get('cart')) && count(session()->get('cart')) > 0) {
            foreach (session()->get('cart') as $item) {
                if ($item['course_id'] == $course_id) {
                    return true;
                }
            }
            return false;
        } else {
            return false;
        }


    }
}


if (!function_exists('isBookmarked')) {
    function isBookmarked($user_id, $course_id)
    {
        $bookmarked = BookmarkCourse::where('user_id', $user_id)->where('course_id', $course_id)->first();
        if ($bookmarked) {
            return true;
        } else {
            return false;
        }
    }
}



if (!function_exists('cartItem')) {
    function cartItem()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::user()->id)->count();
        } else if (session()->get('cart')) {
            return count(session()->get('cart'));
        } else {
            return 0;
        }
    }
}

if (!function_exists('totalWhiteList')) {
    function totalWhiteList()
    {
        if (Auth::check()) {
            $bookmarks = BookmarkCourse::where('user_id', Auth::id())->count();
            return $bookmarks;
        } else {
            return 0;
        }
    }
}
function shortcode_replacer($shortcode, $replace_with, $template_string)
{
    return str_replace($shortcode, $replace_with, $template_string);
}

function send_php_mail($receiver_email, $receiver_name, $sender_email, $subject, $message)
{
    $headers = "From: <$sender_email> \r\n";
    $headers .= "Reply-To: " . getSetting()->site_title . " <$sender_email> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    $status = mail($receiver_email, $subject, $message, $headers);

}

function send_general_email($email, $subject, $message, $receiver_name = '')
{
    $general = \Modules\SystemSetting\Entities\GeneralSettings::first();
    $message = shortcode_replacer("{{message}}", $message, $general->email_template);
    $message = shortcode_replacer("{{name}}", $receiver_name, $message);

    send_php_mail($email, $receiver_name, $general->sendEmail, $subject, $message);
}

if (!function_exists('checkCurrency')) {
    function checkCurrency($currency_code)
    {
        $currency = Currency::where('code', $currency_code)->first();
        if ($currency != null) {
            return true;
        }
        return null;
    }
}

if (!function_exists('account_type')) {
    function account_type($type)
    {
        if ($type == 1) {
            return 'Asset';
        } elseif ($type == 2) {
            return 'Liability';
        } elseif ($type == 3) {
            return 'Expense';
        } elseif ($type == 4) {
            return 'Income';
        }
    }
}


if (!function_exists('showStatus')) {
    function showStatus($status)
    {
        if ($status == 1) {
            return 'Active';
        }
        return 'Inactive';
    }
}


if (!function_exists('permissionCheck')) {
    function permissionCheck($route_name)
    {
        if (auth()->check()) {
            if (auth()->user()->role_id == 1) {
                return TRUE;
            } else {
                $roles = app('permission_list');
                $role = $roles->where('id', auth()->user()->role_id)->first();
                if ($role != null && $role->permissions->contains('route', $route_name)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
        return FALSE;
    }
}

//formats price to home default price with convertion
if (!function_exists('single_price')) {
    function single_price($price)
    {
        if (getSetting() != null) {
            return getSetting()->currency->symbol . ' ' . number_format($price, 2);
        }
    }
}


//Messages
if (!function_exists('getConversations')) {
    function getConversations($messages)
    {
        $output = '';
        if ($messages) {
            foreach ($messages as $key => $message) {
                if ($message->sender_id == Auth::id()) {
                    $output .= '
                            <div class="single_message_chat">
                                <div class="message_pre_left">
                                    <div class="message_preview_thumb">
                                        <img src="' . url(@$message->sender->image) . '" alt="">
                                    </div>
                                    <div class="messges_info">
                                        <h4>' . @$message->sender->name . '</h4>
                                        <p>' . @$message->created_at . '</p>
                                    </div>
                                </div>
                                <div class="message_content_view red_border">
                                    <p>' . @$message->message . '</p>
                                </div>
                            </div>';
                } else {
                    $output .= '
                        <div class="single_message_chat sender_message">
                            <div class="message_pre_left">
                                <div class="messges_info">
                                <h4>' . @$message->sender->name . '</h4>
                                <p>' . @$message->created_at . '</p>
                                </div>
                                <div class="message_preview_thumb">
                                <img src="' . url(@$message->sender->image) . '" alt="">
                                </div>
                            </div>
                            <div class="message_content_view">
                                <p>' . @$message->message . '</p>
                            </div>
                        </div>';
                }
            }
            return $output;
        } else {
            $message = trans("communication.Let's say Hi");
            $output = '<p class="NoMessageFound">' . $message . '!</p>';
        }
        return $output;

    }
}


// checking module enable/disable
if (!function_exists('checkModuleEnable')) {
    function checkModuleEnable($module = null, $name = null)
    {
        if ($name) {
            return true;
        } else {
            return false;
        }

    }
}


if (!function_exists('getHeaderCategories')) {
    function getHeaderCategories()
    {
        return Category::with('subcategories')->where('status', 1)->orderBy('position_order', 'ASC')->get();
    }
}


if (!function_exists('returnList')) {
    function returnList()
    {
        $list = [
            'fa-glass' => 'f000',
            'fa-music' => 'f001',
            'fa-search' => 'f002',
            'fa-envelope-o' => 'f003',
            'fa-heart' => 'f004',
            'fa-star' => 'f005',
            'fa-star-o' => 'f006',
            'fa-user' => 'f007',
            'fa-film' => 'f008',
            'fa-th-large' => 'f009',
            'fa-th' => 'f00a',
            'fa-th-list' => 'f00b',
            'fa-check' => 'f00c',
            'fa-times' => 'f00d',
            'fa-search-plus' => 'f00e',
            'fa-search-minus' => 'f010',
            'fa-power-off' => 'f011',
            'fa-signal' => 'f012',
            'fa-cog' => 'f013',
            'fa-trash-o' => 'f014',
            'fa-home' => 'f015',
            'fa-file-o' => 'f016',
            'fa-clock-o' => 'f017',
            'fa-road' => 'f018',
            'fa-download' => 'f019',
            'fa-arrow-circle-o-down' => 'f01a',
            'fa-arrow-circle-o-up' => 'f01b',
            'fa-inbox' => 'f01c',
            'fa-play-circle-o' => 'f01d',
            'fa-repeat' => 'f01e',
            'fa-refresh' => 'f021',
            'fa-list-alt' => 'f022',
            'fa-lock' => 'f023',
            'fa-flag' => 'f024',
            'fa-headphones' => 'f025',
            'fa-volume-off' => 'f026',
            'fa-volume-down' => 'f027',
            'fa-volume-up' => 'f028',
            'fa-qrcode' => 'f029',
            'fa-barcode' => 'f02a',
            'fa-tag' => 'f02b',
            'fa-tags' => 'f02c',
            'fa-book' => 'f02d',
            'fa-bookmark' => 'f02e',
            'fa-print' => 'f02f',
            'fa-camera' => 'f030',
            'fa-font' => 'f031',
            'fa-bold' => 'f032',
            'fa-italic' => 'f033',
            'fa-text-height' => 'f034',
            'fa-text-width' => 'f035',
            'fa-align-left' => 'f036',
            'fa-align-center' => 'f037',
            'fa-align-right' => 'f038',
            'fa-align-justify' => 'f039',
            'fa-list' => 'f03a',
            'fa-outdent' => 'f03b',
            'fa-indent' => 'f03c',
            'fa-video-camera' => 'f03d',
            'fa-picture-o' => 'f03e',
            'fa-pencil' => 'f040',
            'fa-map-marker' => 'f041',
            'fa-adjust' => 'f042',
            'fa-tint' => 'f043',
            'fa-pencil-square-o' => 'f044',
            'fa-share-square-o' => 'f045',
            'fa-check-square-o' => 'f046',
            'fa-arrows' => 'f047',
            'fa-step-backward' => 'f048',
            'fa-fast-backward' => 'f049',
            'fa-backward' => 'f04a',
            'fa-play' => 'f04b',
            'fa-pause' => 'f04c',
            'fa-stop' => 'f04d',
            'fa-forward' => 'f04e',
            'fa-fast-forward' => 'f050',
            'fa-step-forward' => 'f051',
            'fa-eject' => 'f052',
            'fa-chevron-left' => 'f053',
            'fa-chevron-right' => 'f054',
            'fa-plus-circle' => 'f055',
            'fa-minus-circle' => 'f056',
            'fa-times-circle' => 'f057',
            'fa-check-circle' => 'f058',
            'fa-question-circle' => 'f059',
            'fa-info-circle' => 'f05a',
            'fa-crosshairs' => 'f05b',
            'fa-times-circle-o' => 'f05c',
            'fa-check-circle-o' => 'f05d',
            'fa-ban' => 'f05e',
            'fa-arrow-left' => 'f060',
            'fa-arrow-right' => 'f061',
            'fa-arrow-up' => 'f062',
            'fa-arrow-down' => 'f063',
            'fa-share' => 'f064',
            'fa-expand' => 'f065',
            'fa-compress' => 'f066',
            'fa-plus' => 'f067',
            'fa-minus' => 'f068',
            'fa-asterisk' => 'f069',
            'fa-exclamation-circle' => 'f06a',
            'fa-gift' => 'f06b',
            'fa-leaf' => 'f06c',
            'fa-fire' => 'f06d',
            'fa-eye' => 'f06e',
            'fa-eye-slash' => 'f070',
            'fa-exclamation-triangle' => 'f071',
            'fa-plane' => 'f072',
            'fa-calendar' => 'f073',
            'fa-random' => 'f074',
            'fa-comment' => 'f075',
            'fa-magnet' => 'f076',
            'fa-chevron-up' => 'f077',
            'fa-chevron-down' => 'f078',
            'fa-retweet' => 'f079',
            'fa-shopping-cart' => 'f07a',
            'fa-folder' => 'f07b',
            'fa-folder-open' => 'f07c',
            'fa-arrows-v' => 'f07d',
            'fa-arrows-h' => 'f07e',
            'fa-bar-chart' => 'f080',
            'fa-twitter-square' => 'f081',
            'fa-facebook-square' => 'f082',
            'fa-camera-retro' => 'f083',
            'fa-key' => 'f084',
            'fa-cogs' => 'f085',
            'fa-comments' => 'f086',
            'fa-thumbs-o-up' => 'f087',
            'fa-thumbs-o-down' => 'f088',
            'fa-star-half' => 'f089',
            'fa-heart-o' => 'f08a',
            'fa-sign-out' => 'f08b',
            'fa-linkedin-square' => 'f08c',
            'fa-thumb-tack' => 'f08d',
            'fa-external-link' => 'f08e',
            'fa-sign-in' => 'f090',
            'fa-trophy' => 'f091',
            'fa-github-square' => 'f092',
            'fa-upload' => 'f093',
            'fa-lemon-o' => 'f094',
            'fa-phone' => 'f095',
            'fa-square-o' => 'f096',
            'fa-bookmark-o' => 'f097',
            'fa-phone-square' => 'f098',
            'fa-twitter' => 'f099',
            'fa-facebook' => 'f09a',
            'fa-github' => 'f09b',
            'fa-unlock' => 'f09c',
            'fa-credit-card' => 'f09d',
            'fa-rss' => 'f09e',
            'fa-hdd-o' => 'f0a0',
            'fa-bullhorn' => 'f0a1',
            'fa-bell' => 'f0f3',
            'fa-certificate' => 'f0a3',
            'fa-hand-o-right' => 'f0a4',
            'fa-hand-o-left' => 'f0a5',
            'fa-hand-o-up' => 'f0a6',
            'fa-hand-o-down' => 'f0a7',
            'fa-arrow-circle-left' => 'f0a8',
            'fa-arrow-circle-right' => 'f0a9',
            'fa-arrow-circle-up' => 'f0aa',
            'fa-arrow-circle-down' => 'f0ab',
            'fa-globe' => 'f0ac',
            'fa-wrench' => 'f0ad',
            'fa-tasks' => 'f0ae',
            'fa-filter' => 'f0b0',
            'fa-briefcase' => 'f0b1',
            'fa-arrows-alt' => 'f0b2',
            'fa-users' => 'f0c0',
            'fa-link' => 'f0c1',
            'fa-cloud' => 'f0c2',
            'fa-flask' => 'f0c3',
            'fa-scissors' => 'f0c4',
            'fa-files-o' => 'f0c5',
            'fa-paperclip' => 'f0c6',
            'fa-floppy-o' => 'f0c7',
            'fa-square' => 'f0c8',
            'fa-bars' => 'f0c9',
            'fa-list-ul' => 'f0ca',
            'fa-list-ol' => 'f0cb',
            'fa-strikethrough' => 'f0cc',
            'fa-underline' => 'f0cd',
            'fa-table' => 'f0ce',
            'fa-magic' => 'f0d0',
            'fa-truck' => 'f0d1',
            'fa-pinterest' => 'f0d2',
            'fa-pinterest-square' => 'f0d3',
            'fa-google-plus-square' => 'f0d4',
            'fa-google-plus' => 'f0d5',
            'fa-money' => 'f0d6',
            'fa-caret-down' => 'f0d7',
            'fa-caret-up' => 'f0d8',
            'fa-caret-left' => 'f0d9',
            'fa-caret-right' => 'f0da',
            'fa-columns' => 'f0db',
            'fa-sort' => 'f0dc',
            'fa-sort-desc' => 'f0dd',
            'fa-sort-asc' => 'f0de',
            'fa-envelope' => 'f0e0',
            'fa-linkedin' => 'f0e1',
            'fa-undo' => 'f0e2',
            'fa-gavel' => 'f0e3',
            'fa-tachometer' => 'f0e4',
            'fa-comment-o' => 'f0e5',
            'fa-comments-o' => 'f0e6',
            'fa-bolt' => 'f0e7',
            'fa-sitemap' => 'f0e8',
            'fa-umbrella' => 'f0e9',
            'fa-clipboard' => 'f0ea',
            'fa-lightbulb-o' => 'f0eb',
            'fa-exchange' => 'f0ec',
            'fa-cloud-download' => 'f0ed',
            'fa-cloud-upload' => 'f0ee',
            'fa-user-md' => 'f0f0',
            'fa-stethoscope' => 'f0f1',
            'fa-suitcase' => 'f0f2',
            'fa-bell-o' => 'f0a2',
            'fa-coffee' => 'f0f4',
            'fa-cutlery' => 'f0f5',
            'fa-file-text-o' => 'f0f6',
            'fa-building-o' => 'f0f7',
            'fa-hospital-o' => 'f0f8',
            'fa-ambulance' => 'f0f9',
            'fa-medkit' => 'f0fa',
            'fa-fighter-jet' => 'f0fb',
            'fa-beer' => 'f0fc',
            'fa-h-square' => 'f0fd',
            'fa-plus-square' => 'f0fe',
            'fa-angle-double-left' => 'f100',
            'fa-angle-double-right' => 'f101',
            'fa-angle-double-up' => 'f102',
            'fa-angle-double-down' => 'f103',
            'fa-angle-left' => 'f104',
            'fa-angle-right' => 'f105',
            'fa-angle-up' => 'f106',
            'fa-angle-down' => 'f107',
            'fa-desktop' => 'f108',
            'fa-laptop' => 'f109',
            'fa-tablet' => 'f10a',
            'fa-mobile' => 'f10b',
            'fa-circle-o' => 'f10c',
            'fa-quote-left' => 'f10d',
            'fa-quote-right' => 'f10e',
            'fa-spinner' => 'f110',
            'fa-circle' => 'f111',
            'fa-reply' => 'f112',
            'fa-github-alt' => 'f113',
            'fa-folder-o' => 'f114',
            'fa-folder-open-o' => 'f115',
            'fa-smile-o' => 'f118',
            'fa-frown-o' => 'f119',
            'fa-meh-o' => 'f11a',
            'fa-gamepad' => 'f11b',
            'fa-keyboard-o' => 'f11c',
            'fa-flag-o' => 'f11d',
            'fa-flag-checkered' => 'f11e',
            'fa-terminal' => 'f120',
            'fa-code' => 'f121',
            'fa-reply-all' => 'f122',
            'fa-star-half-o' => 'f123',
            'fa-location-arrow' => 'f124',
            'fa-crop' => 'f125',
            'fa-code-fork' => 'f126',
            'fa-chain-broken' => 'f127',
            'fa-question' => 'f128',
            'fa-info' => 'f129',
            'fa-exclamation' => 'f12a',
            'fa-superscript' => 'f12b',
            'fa-subscript' => 'f12c',
            'fa-eraser' => 'f12d',
            'fa-puzzle-piece' => 'f12e',
            'fa-microphone' => 'f130',
            'fa-microphone-slash' => 'f131',
            'fa-shield' => 'f132',
            'fa-calendar-o' => 'f133',
            'fa-fire-extinguisher' => 'f134',
            'fa-rocket' => 'f135',
            'fa-maxcdn' => 'f136',
            'fa-chevron-circle-left' => 'f137',
            'fa-chevron-circle-right' => 'f138',
            'fa-chevron-circle-up' => 'f139',
            'fa-chevron-circle-down' => 'f13a',
            'fa-html5' => 'f13b',
            'fa-css3' => 'f13c',
            'fa-anchor' => 'f13d',
            'fa-unlock-alt' => 'f13e',
            'fa-bullseye' => 'f140',
            'fa-ellipsis-h' => 'f141',
            'fa-ellipsis-v' => 'f142',
            'fa-rss-square' => 'f143',
            'fa-play-circle' => 'f144',
            'fa-ticket' => 'f145',
            'fa-minus-square' => 'f146',
            'fa-minus-square-o' => 'f147',
            'fa-level-up' => 'f148',
            'fa-level-down' => 'f149',
            'fa-check-square' => 'f14a',
            'fa-pencil-square' => 'f14b',
            'fa-external-link-square' => 'f14c',
            'fa-share-square' => 'f14d',
            'fa-compass' => 'f14e',
            'fa-caret-square-o-down' => 'f150',
            'fa-caret-square-o-up' => 'f151',
            'fa-caret-square-o-right' => 'f152',
            'fa-eur' => 'f153',
            'fa-gbp' => 'f154',
            'fa-usd' => 'f155',
            'fa-inr' => 'f156',
            'fa-jpy' => 'f157',
            'fa-rub' => 'f158',
            'fa-krw' => 'f159',
            'fa-btc' => 'f15a',
            'fa-file' => 'f15b',
            'fa-file-text' => 'f15c',
            'fa-sort-alpha-asc' => 'f15d',
            'fa-sort-alpha-desc' => 'f15e',
            'fa-sort-amount-asc' => 'f160',
            'fa-sort-amount-desc' => 'f161',
            'fa-sort-numeric-asc' => 'f162',
            'fa-sort-numeric-desc' => 'f163',
            'fa-thumbs-up' => 'f164',
            'fa-thumbs-down' => 'f165',
            'fa-youtube-square' => 'f166',
            'fa-youtube' => 'f167',
            'fa-xing' => 'f168',
            'fa-xing-square' => 'f169',
            'fa-youtube-play' => 'f16a',
            'fa-dropbox' => 'f16b',
            'fa-stack-overflow' => 'f16c',
            'fa-instagram' => 'f16d',
            'fa-flickr' => 'f16e',
            'fa-adn' => 'f170',
            'fa-bitbucket' => 'f171',
            'fa-bitbucket-square' => 'f172',
            'fa-tumblr' => 'f173',
            'fa-tumblr-square' => 'f174',
            'fa-long-arrow-down' => 'f175',
            'fa-long-arrow-up' => 'f176',
            'fa-long-arrow-left' => 'f177',
            'fa-long-arrow-right' => 'f178',
            'fa-apple' => 'f179',
            'fa-windows' => 'f17a',
            'fa-android' => 'f17b',
            'fa-linux' => 'f17c',
            'fa-dribbble' => 'f17d',
            'fa-skype' => 'f17e',
            'fa-foursquare' => 'f180',
            'fa-trello' => 'f181',
            'fa-female' => 'f182',
            'fa-male' => 'f183',
            'fa-gratipay' => 'f184',
            'fa-sun-o' => 'f185',
            'fa-moon-o' => 'f186',
            'fa-archive' => 'f187',
            'fa-bug' => 'f188',
            'fa-vk' => 'f189',
            'fa-weibo' => 'f18a',
            'fa-renren' => 'f18b',
            'fa-pagelines' => 'f18c',
            'fa-stack-exchange' => 'f18d',
            'fa-arrow-circle-o-right' => 'f18e',
            'fa-arrow-circle-o-left' => 'f190',
            'fa-caret-square-o-left' => 'f191',
            'fa-dot-circle-o' => 'f192',
            'fa-wheelchair' => 'f193',
            'fa-vimeo-square' => 'f194',
            'fa-try' => 'f195',
            'fa-plus-square-o' => 'f196',
            'fa-space-shuttle' => 'f197',
            'fa-slack' => 'f198',
            'fa-envelope-square' => 'f199',
            'fa-wordpress' => 'f19a',
            'fa-openid' => 'f19b',
            'fa-university' => 'f19c',
            'fa-graduation-cap' => 'f19d',
            'fa-yahoo' => 'f19e',
            'fa-google' => 'f1a0',
            'fa-reddit' => 'f1a1',
            'fa-reddit-square' => 'f1a2',
            'fa-stumbleupon-circle' => 'f1a3',
            'fa-stumbleupon' => 'f1a4',
            'fa-delicious' => 'f1a5',
            'fa-digg' => 'f1a6',
            'fa-pied-piper-pp' => 'f1a7',
            'fa-pied-piper-alt' => 'f1a8',
            'fa-drupal' => 'f1a9',
            'fa-joomla' => 'f1aa',
            'fa-language' => 'f1ab',
            'fa-fax' => 'f1ac',
            'fa-building' => 'f1ad',
            'fa-child' => 'f1ae',
            'fa-paw' => 'f1b0',
            'fa-spoon' => 'f1b1',
            'fa-cube' => 'f1b2',
            'fa-cubes' => 'f1b3',
            'fa-behance' => 'f1b4',
            'fa-behance-square' => 'f1b5',
            'fa-steam' => 'f1b6',
            'fa-steam-square' => 'f1b7',
            'fa-recycle' => 'f1b8',
            'fa-car' => 'f1b9',
            'fa-taxi' => 'f1ba',
            'fa-tree' => 'f1bb',
            'fa-spotify' => 'f1bc',
            'fa-deviantart' => 'f1bd',
            'fa-soundcloud' => 'f1be',
            'fa-database' => 'f1c0',
            'fa-file-pdf-o' => 'f1c1',
            'fa-file-word-o' => 'f1c2',
            'fa-file-excel-o' => 'f1c3',
            'fa-file-powerpoint-o' => 'f1c4',
            'fa-file-image-o' => 'f1c5',
            'fa-file-archive-o' => 'f1c6',
            'fa-file-audio-o' => 'f1c7',
            'fa-file-video-o' => 'f1c8',
            'fa-file-code-o' => 'f1c9',
            'fa-vine' => 'f1ca',
            'fa-codepen' => 'f1cb',
            'fa-jsfiddle' => 'f1cc',
            'fa-life-ring' => 'f1cd',
            'fa-circle-o-notch' => 'f1ce',
            'fa-rebel' => 'f1d0',
            'fa-empire' => 'f1d1',
            'fa-git-square' => 'f1d2',
            'fa-git' => 'f1d3',
            'fa-hacker-news' => 'f1d4',
            'fa-tencent-weibo' => 'f1d5',
            'fa-qq' => 'f1d6',
            'fa-weixin' => 'f1d7',
            'fa-paper-plane' => 'f1d8',
            'fa-paper-plane-o' => 'f1d9',
            'fa-history' => 'f1da',
            'fa-circle-thin' => 'f1db',
            'fa-header' => 'f1dc',
            'fa-paragraph' => 'f1dd',
            'fa-sliders' => 'f1de',
            'fa-share-alt' => 'f1e0',
            'fa-share-alt-square' => 'f1e1',
            'fa-bomb' => 'f1e2',
            'fa-futbol-o' => 'f1e3',
            'fa-tty' => 'f1e4',
            'fa-binoculars' => 'f1e5',
            'fa-plug' => 'f1e6',
            'fa-slideshare' => 'f1e7',
            'fa-twitch' => 'f1e8',
            'fa-yelp' => 'f1e9',
            'fa-newspaper-o' => 'f1ea',
            'fa-wifi' => 'f1eb',
            'fa-calculator' => 'f1ec',
            'fa-paypal' => 'f1ed',
            'fa-google-wallet' => 'f1ee',
            'fa-cc-visa' => 'f1f0',
            'fa-cc-mastercard' => 'f1f1',
            'fa-cc-discover' => 'f1f2',
            'fa-cc-amex' => 'f1f3',
            'fa-cc-paypal' => 'f1f4',
            'fa-cc-stripe' => 'f1f5',
            'fa-bell-slash' => 'f1f6',
            'fa-bell-slash-o' => 'f1f7',
            'fa-trash' => 'f1f8',
            'fa-copyright' => 'f1f9',
            'fa-at' => 'f1fa',
            'fa-eyedropper' => 'f1fb',
            'fa-paint-brush' => 'f1fc',
            'fa-birthday-cake' => 'f1fd',
            'fa-area-chart' => 'f1fe',
            'fa-pie-chart' => 'f200',
            'fa-line-chart' => 'f201',
            'fa-lastfm' => 'f202',
            'fa-lastfm-square' => 'f203',
            'fa-toggle-off' => 'f204',
            'fa-toggle-on' => 'f205',
            'fa-bicycle' => 'f206',
            'fa-bus' => 'f207',
            'fa-ioxhost' => 'f208',
            'fa-angellist' => 'f209',
            'fa-cc' => 'f20a',
            'fa-ils' => 'f20b',
            'fa-meanpath' => 'f20c',
            'fa-buysellads' => 'f20d',
            'fa-connectdevelop' => 'f20e',
            'fa-dashcube' => 'f210',
            'fa-forumbee' => 'f211',
            'fa-leanpub' => 'f212',
            'fa-sellsy' => 'f213',
            'fa-shirtsinbulk' => 'f214',
            'fa-simplybuilt' => 'f215',
            'fa-skyatlas' => 'f216',
            'fa-cart-plus' => 'f217',
            'fa-cart-arrow-down' => 'f218',
            'fa-diamond' => 'f219',
            'fa-ship' => 'f21a',
            'fa-user-secret' => 'f21b',
            'fa-motorcycle' => 'f21c',
            'fa-street-view' => 'f21d',
            'fa-heartbeat' => 'f21e',
            'fa-venus' => 'f221',
            'fa-mars' => 'f222',
            'fa-mercury' => 'f223',
            'fa-transgender' => 'f224',
            'fa-transgender-alt' => 'f225',
            'fa-venus-double' => 'f226',
            'fa-mars-double' => 'f227',
            'fa-venus-mars' => 'f228',
            'fa-mars-stroke' => 'f229',
            'fa-mars-stroke-v' => 'f22a',
            'fa-mars-stroke-h' => 'f22b',
            'fa-neuter' => 'f22c',
            'fa-genderless' => 'f22d',
            'fa-facebook-official' => 'f230',
            'fa-pinterest-p' => 'f231',
            'fa-whatsapp' => 'f232',
            'fa-server' => 'f233',
            'fa-user-plus' => 'f234',
            'fa-user-times' => 'f235',
            'fa-bed' => 'f236',
            'fa-viacoin' => 'f237',
            'fa-train' => 'f238',
            'fa-subway' => 'f239',
            'fa-medium' => 'f23a',
            'fa-y-combinator' => 'f23b',
            'fa-optin-monster' => 'f23c',
            'fa-opencart' => 'f23d',
            'fa-expeditedssl' => 'f23e',
            'fa-battery-full' => 'f240',
            'fa-battery-three-quarters' => 'f241',
            'fa-battery-half' => 'f242',
            'fa-battery-quarter' => 'f243',
            'fa-battery-empty' => 'f244',
            'fa-mouse-pointer' => 'f245',
            'fa-i-cursor' => 'f246',
            'fa-object-group' => 'f247',
            'fa-object-ungroup' => 'f248',
            'fa-sticky-note' => 'f249',
            'fa-sticky-note-o' => 'f24a',
            'fa-cc-jcb' => 'f24b',
            'fa-cc-diners-club' => 'f24c',
            'fa-clone' => 'f24d',
            'fa-balance-scale' => 'f24e',
            'fa-hourglass-o' => 'f250',
            'fa-hourglass-start' => 'f251',
            'fa-hourglass-half' => 'f252',
            'fa-hourglass-end' => 'f253',
            'fa-hourglass' => 'f254',
            'fa-hand-rock-o' => 'f255',
            'fa-hand-paper-o' => 'f256',
            'fa-hand-scissors-o' => 'f257',
            'fa-hand-lizard-o' => 'f258',
            'fa-hand-spock-o' => 'f259',
            'fa-hand-pointer-o' => 'f25a',
            'fa-hand-peace-o' => 'f25b',
            'fa-trademark' => 'f25c',
            'fa-registered' => 'f25d',
            'fa-creative-commons' => 'f25e',
            'fa-gg' => 'f260',
            'fa-gg-circle' => 'f261',
            'fa-tripadvisor' => 'f262',
            'fa-odnoklassniki' => 'f263',
            'fa-odnoklassniki-square' => 'f264',
            'fa-get-pocket' => 'f265',
            'fa-wikipedia-w' => 'f266',
            'fa-safari' => 'f267',
            'fa-chrome' => 'f268',
            'fa-firefox' => 'f269',
            'fa-opera' => 'f26a',
            'fa-internet-explorer' => 'f26b',
            'fa-television' => 'f26c',
            'fa-contao' => 'f26d',
            'fa-500px' => 'f26e',
            'fa-amazon' => 'f270',
            'fa-calendar-plus-o' => 'f271',
            'fa-calendar-minus-o' => 'f272',
            'fa-calendar-times-o' => 'f273',
            'fa-calendar-check-o' => 'f274',
            'fa-industry' => 'f275',
            'fa-map-pin' => 'f276',
            'fa-map-signs' => 'f277',
            'fa-map-o' => 'f278',
            'fa-map' => 'f279',
            'fa-commenting' => 'f27a',
            'fa-commenting-o' => 'f27b',
            'fa-houzz' => 'f27c',
            'fa-vimeo' => 'f27d',
            'fa-black-tie' => 'f27e',
            'fa-fonticons' => 'f280',
            'fa-reddit-alien' => 'f281',
            'fa-edge' => 'f282',
            'fa-credit-card-alt' => 'f283',
            'fa-codiepie' => 'f284',
            'fa-modx' => 'f285',
            'fa-fort-awesome' => 'f286',
            'fa-usb' => 'f287',
            'fa-product-hunt' => 'f288',
            'fa-mixcloud' => 'f289',
            'fa-scribd' => 'f28a',
            'fa-pause-circle' => 'f28b',
            'fa-pause-circle-o' => 'f28c',
            'fa-stop-circle' => 'f28d',
            'fa-stop-circle-o' => 'f28e',
            'fa-shopping-bag' => 'f290',
            'fa-shopping-basket' => 'f291',
            'fa-hashtag' => 'f292',
            'fa-bluetooth' => 'f293',
            'fa-bluetooth-b' => 'f294',
            'fa-percent' => 'f295',
            'fa-gitlab' => 'f296',
            'fa-wpbeginner' => 'f297',
            'fa-wpforms' => 'f298',
            'fa-envira' => 'f299',
            'fa-universal-access' => 'f29a',
            'fa-wheelchair-alt' => 'f29b',
            'fa-question-circle-o' => 'f29c',
            'fa-blind' => 'f29d',
            'fa-audio-description' => 'f29e',
            'fa-volume-control-phone' => 'f2a0',
            'fa-braille' => 'f2a1',
            'fa-assistive-listening-systems' => 'f2a2',
            'fa-american-sign-language-interpreting' => 'f2a3',
            'fa-deaf' => 'f2a4',
            'fa-glide' => 'f2a5',
            'fa-glide-g' => 'f2a6',
            'fa-sign-language' => 'f2a7',
            'fa-low-vision' => 'f2a8',
            'fa-viadeo' => 'f2a9',
            'fa-viadeo-square' => 'f2aa',
            'fa-snapchat' => 'f2ab',
            'fa-snapchat-ghost' => 'f2ac',
            'fa-snapchat-square' => 'f2ad',
            'fa-pied-piper' => 'f2ae',
            'fa-first-order' => 'f2b0',
            'fa-yoast' => 'f2b1',
            'fa-themeisle' => 'f2b2',
            'fa-google-plus-official' => 'f2b3',
            'fa-font-awesome' => 'f2b4'
        ];
        $str = '';
        foreach ($list as $class => $value) {
            $str .= '<option value="fa ' . $class . '"><i class="fa ' . $class . '"></i> ' . $class . ' </option>';
        }
        return $str;
    }
}


if (!function_exists('getProfileImage')) {
    function getProfileImage($path)
    {
        if (File::exists($path)) {
            return url($path);
        } else {
            return url('public/assets/profile/no_image_available.png');
        }
    }
}

if (!function_exists('getCourseImage')) {
    function getCourseImage($path)
    {
        if (File::exists($path)) {
            return url($path);
        } else {
            return url('public/assets/course/no_image.png');
        }
    }
}

if (!function_exists('getGealleryImage')) {
    function getGealleryImage($path)
    {
        if (File::exists($path)) {
            return url($path);
        } else {
            return url('public/assets/gallery/1.png');
        }
    }
}

if (!function_exists('getTestimonialImage')) {
    function getTestimonialImage($path)
    {
        if (File::exists($path)) {
            return url($path);
        } else {
            return url('public/demo/testimonial/thumb/img.png');
        }
    }
}
if (!function_exists('getInstructorImage')) {
    function getInstructorImage($path)
    {
        if (File::exists($path)) {
            return url($path);
        } else {
            return url('public/demo/user/instructor.jpg');
        }
    }
}

if (!function_exists('getStudentImage')) {
    function getStudentImage($path)
    {
        if (File::exists($path)) {
            return url($path);
        } else {
            return url('public/demo/user/student.png');
        }
    }
}
if (!function_exists('getBlogImage')) {
    function getBlogImage($path)
    {
        if (File::exists($path)) {
            return url($path);
        } else {
            return url('public/demo/blog/demo.png');
        }
    }
}
if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }
}

if (!function_exists('isInstructor')) {
    function isInstructor()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 2) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}


if (!function_exists('isStudent')) {
    function isStudent()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 3) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

if (!function_exists('isFree')) {
    function isFree($course_id)
    {
        $course = \Modules\CourseSetting\Entities\Course::find($course_id);
        if ($course) {
            if ($course->price == 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}


if (!function_exists('totalUnreadMessages')) {
    function totalUnreadMessages()
    {
        $messages = \Modules\SystemSetting\Entities\Message::where('seen', '=', 0)->where('reciever_id', '=', Auth::id())->count();
        return $messages;
    }
}


if (!function_exists('putEnvConfigration')) {
    function putEnvConfigration($envKey, $envValue)
    {


        $value = '"' . $envValue . '"';
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $str .= "\n";
        $keyPosition = strpos($str, "{$envKey}=");
        $endOfLinePosition = strpos($str, "\n", $keyPosition);
        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        $str = str_replace($oldLine, "{$envKey}={$value}", $str);

        $str = substr($str, 0, -1);

        if (!file_put_contents($envFile, $str)) {
            return false;
        } else {
            return true;
        }
    }
}


if (!function_exists('courseDetailsUrl')) {
    function courseDetailsUrl($id, $type, $slug)
    {
        if ($type == 1) {
            $details = 'courses-details';
        } elseif ($type == 2) {
            $details = 'quiz-details';
        } elseif ($type == 3) {
            $details = 'class-details';
        }
        $url = url($details . '/' . $id . '/' . $slug);
        return $url;
    }
}

if (!function_exists('getPriceFormat')) {
    function getPriceFormat($price)
    {
        $currency = getSetting()->currency;

        if (!empty(@$price) || $price != 0) {

            $result = $currency->symbol . ' ' . $price;
        } else {
            $result = trans('common.Free');
        }

        return $result;
    }
}


if (!function_exists('totalQuizQus')) {
    function totalQuizQus($quiz_id)
    {
        $total = \Modules\Quiz\Entities\OnlineExamQuestionAssign::where('online_exam_id', $quiz_id)->count();
        return $total;
    }
}

if (!function_exists('totalQuizMarks')) {
    function totalQuizMarks($quiz_id)
    {
        $totalMark = 0;
        $total = \Modules\Quiz\Entities\OnlineExamQuestionAssign::where('online_exam_id', $quiz_id)->get();

        foreach ($total as $question) {
            $totalMark = $totalMark + $question->questionBank->marks;
        }
        return $totalMark;
    }
}

if (!function_exists('theme')) {
    function theme($fileName)
    {
        $theme = Theme::where('is_active', 1)->firstOrFail();
        if (isset($theme)) {
            return 'frontend.' . $theme->folder_path . '.' . $fileName;
        }
    }
}


if (!function_exists('moduleStatusCheck')) {
    function moduleStatusCheck($module)
    {

        try {
            $haveModule = Module::where('name', $module)->first();
            if (empty($haveModule)) {
                return false;
            }
            $modulestatus = $haveModule->status;


            $is_module_available = 'Modules/' . $module . '/Providers/' . $module . 'ServiceProvider.php';

            if (file_exists($is_module_available)) {


                $moduleCheck = \Nwidart\Modules\Facades\Module::find($module)->isEnabled();

                if (!$moduleCheck) {
                    return false;
                }

                if ($modulestatus == 1) {
                    $is_verify = InfixModuleManager::where('name', $module)->first();

                    if (!empty($is_verify->purchase_code)) {
                        return true;
                    }
                }
            }

//            }
            return false;
        } catch (\Throwable $th) {

            return false;
        }

    }
}

if (!function_exists('getTotalLessons')) {
    function getTotalLessons($course_id)
    {
        $lessons = Lesson::where('course_id', $course_id)->count();
        return $lessons;
    }
}


if (!function_exists('getTotalQuestions')) {
    function getTotalQuestions($quiz_id)
    {
        $questions = \Modules\Quiz\Entities\OnlineExamQuestionAssign::where('online_exam_id', $quiz_id)->count();

        return $questions;
    }
}

if (!function_exists('getTotalClasses')) {
    function getTotalClasses($class_id)
    {
        $totalClasses = 0;
        $class = \Modules\VirtualClass\Entities\VirtualClass::find($class_id);
        if ($class) {
            if ($class->host == "Zoom") {
                $totalClasses = count($class->zoomMeetings);

            } elseif ($class->host == "BBB") {
                if (moduleStatusCheck("BBB")) {
                    $totalClasses = count($class->bbbMeetings);
                } else {
                    $totalClasses = 0;
                }
            } elseif ($class->host == "Jitsi") {
                if (moduleStatusCheck("Jitsi")) {
                    $totalClasses = count($class->jitsiMeetings);
                } else {
                    $totalClasses = 0;
                }
            }
        }


        return $totalClasses;
    }
}

if (!function_exists('getTotalRating')) {
    function getTotalRating($course_id)
    {
        $all = \Modules\CourseSetting\Entities\CourseReveiw::where('course_id', $course_id)->where('status', 1)->get();
        $ratings = 0;
        foreach ($all as $data) {
            $ratings = $data->star + $ratings;
        }
        if (count($all) != 0) {
            $avg = ($ratings / count($all));
        } else {
            $avg = 0;
        }


        if ($avg - floor($avg) > 0) {
            $rate = number_format($avg, 1);
        } else {
            $rate = number_format($avg, 0);
        }
        return $rate;
    }
}


if (!function_exists('getPercentageRating')) {
    function getPercentageRating($course_id, $value)
    {
        $total = 0;
        $per = 0;
        $all = \Modules\CourseSetting\Entities\CourseReveiw::where('course_id', $course_id)->where('status', 1)->get();
        if (count($all) != 0) {
            $rating = [];
            foreach ($all as $item) {
                if (round($item->star) == $value) {
                    $rating[] = $item;
                }

            }
            $total = count($all);
            $per = count($rating);
            $data['total'] = $total ?? 0;
            $data['per'] = (number_format(($per * 100) / $total, 2)) ?? 0;
        } else {
            $data['total'] = $total;
            $data['per'] = $per;
        }


        return $data['per'] ?? 0;
    }
}

if (!function_exists('buyOrEnroll')) {
    function buyOrEnroll($course_id, $price)
    {
        if ($price == 0 || empty($price)) {
            $url = route('enrollNow', $course_id);
        } else {
            $url = route('addToCart', $course_id);
        }
        return $url;
    }
}

if (!function_exists('getPriceWithConversion')) {
    function getPriceWithConversion($price)
    {
        $currency = getSetting();
        $price = $price * $currency->conversion_rate;
        return $price;
    }
}


function convertCurrency($from_currency, $to_currency, $amount)
{
    $setting = getSetting();
    $from = urlencode($from_currency);
    $to = urlencode($to_currency);
    $apikey = $setting->fixer_key ?? '0bd244e811264242d56e1759c93a3f1a';
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://data.fixer.io/api/latest?access_key=" . $apikey,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "content-type: application/json"
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {

        return number_format($amount, 2, '.', '');
    } else {

        $info = json_decode($response);
        $cur = (array)@$info->rates;
        $from_ = null;
        $to_ = null;
        foreach ($cur as $key => $value) {
            if ($key == $from) {
                $from_ = $value;
            }
            if ($key == $to) {
                $to_ = $value;
            }

        }
        if ($to_ > 0) {
            $total = ($to_ / $from_) * $amount;

        } else {
            $total = 0;
        }

        return number_format($total, 2, '.', '');
    }
}

if (!function_exists('isRtl')) {
    function isRtl()
    {
        if (Auth::check()) {
            $rtl = Auth::user()->userLanguage->rtl;
        } elseif (\Illuminate\Support\Facades\Session::get('locale')) {
            $rtl = \Illuminate\Support\Facades\Session::get('language_rtl');
        } else {
            $rtl = getSetting()->language->rtl;
        }

        if ($rtl == 1) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('getDomainName')) {
    function getDomainName($url)
    {
        $url_domain = preg_replace("(^https?://)", "", $url);
        $url_domain = preg_replace("(^http?://)", "", $url_domain);
        $url_domain = str_replace("/", "", $url_domain);
        return $url_domain;

    }
}

if (!function_exists('getMenuLink')) {
    function getMenuLink($menu_id)
    {
        $url = asset('/');

        $menu = \Modules\FrontendManage\Entities\HeaderMenu::find($menu_id);
        if ($menu) {
            if (!empty($menu->link)) {
                if (substr($menu->link, 0, 1) == '/') {
                    if ($menu->link == "/") {
                        return url($menu->link) . '/';

                    }
                    return url($menu->link);
                }
                return $menu->link;
            }
            $type = $menu->type;
            $element_id = $menu->element_id;
            if ($type == "Dynamic Page") {

                $page = \Modules\FrontendManage\Entities\FrontPage::find($element_id);
                if ($page) {
                    $url = \route('frontPage', [$page->id, $page->slug]);
                }
            } elseif ($type == "Static Page") {
                $page = \Modules\FrontendManage\Entities\FrontPage::find($element_id);
                if ($page) {
                    $url = url($page->slug);

                }
            } elseif ($type == "Category") {
                $url = route('courses') . "?category=" . $element_id;

            } elseif ($type == "Sub Category") {
                $sub = \Modules\CourseSetting\Entities\SubCategory::find($element_id);
                if ($sub) {
                    $url = route('courses') . "?category=" . $sub->category_id;
                }

            } elseif ($type == "Course") {
                $course = \Modules\CourseSetting\Entities\Course::find($element_id);
                if ($course) {
                    $url = route('courseDetailsView', [$course->id, $course->slug]);

                }
            } elseif ($type == "Quiz") {
                $course = \Modules\CourseSetting\Entities\Course::find($element_id);
                if ($course) {
                    $url = route('classDetails', [$course->id, $course->slug]);

                }
            } elseif ($type == "Class") {
                $course = \Modules\CourseSetting\Entities\Course::find($element_id);
                if ($course) {
                    $url = route('courseDetailsView', [$course->id, $course->slug]);

                }
            } elseif ($type == "Custom Link") {
                $url = '';
            }
        }


        return $url;

    }
}

if (!function_exists('isSubscribe')) {
    function isSubscribe()
    {
        if (moduleStatusCheck('Subscription')) {
            if (Auth::check()) {
                $user = Auth::user();
                $date_of_subscription = $user->subscription_validity_date;
                if (empty($date_of_subscription)) {
                    return false;
                }

                $expires_at = new DateTime($date_of_subscription);
                $today = new DateTime('now');


                if ($expires_at < $today)
                    return false;

                else {
                    return true;
                }


            }
        } else {
            return false;
        }

        return false;

    }
}


if (!function_exists('userCurrentPlan')) {
    function userCurrentPlan()
    {
        if (moduleStatusCheck('Subscription')) {
            if (Auth::check()) {
                $user = Auth::user();
                $date_of_subscription = $user->subscription_validity_date;
                if (empty($date_of_subscription)) {
                    return null;
                }

                $check = SubscriptionCheckout::select('plan_id')->where('end_date', '>=', date('Y-m-d'))->get();
                if (count($check) != 0) {
                    $plan = [];
                    foreach ($check as $p) {
                        $plan[] = $p->plan_id;
                    }
                    return $plan;
                }


            }
        } else {
            return null;
        }

        return null;

    }
}

?>
