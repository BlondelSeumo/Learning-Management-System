<?php

use Illuminate\Database\Migrations\Migration;
use Modules\SystemSetting\Entities\EmailTemplate;

class EmailTemplateUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $subject = 'Verify Email Address';
        $body = 'Please click the button below to verify your email address. <a href="{{link}}">{{link}}</a>. <br> <br>
             If you did not create an account, no further action is required.
             <br>
             <br>
             <br>
             <br>
Regards,
             From {{app_name}}';

        $verify_body = $this->htmlPart($subject, $body);


        $subject1 = 'Reset Password Notification';
        $body1 = 'You are receiving this email because we received a password reset request for your account. <a href="{{reset_link}}">{{reset_link}}</a>. <br> <br>
             If you did not request a password reset, no further action is required..
             <br>
             <br>
             <br>
             <br>
Regards,
             From {{app_name}}';

        $verify_body1 = $this->htmlPart($subject1, $body1);


        $resetTemp = EmailTemplate::where('act', 'Reset_Password')->first();
        if (empty($resetTemp)) {
            EmailTemplate::insert([
                'act' => 'Reset_Password',
                'name' => 'Reset Password Notification',
                'subj' => 'Reset Password Notification',
                'email_body' => $verify_body1,
                'shortcodes' => '{"reset_link":"Reset Link","app_name":"App Name"}',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        } else {
            $resetTemp->email_body = $verify_body1;
            $resetTemp->save();
        }


        $offline_payment = EmailTemplate::where('act', 'OffLine_Payment')->first();
        if ($offline_payment) {
            $subject = 'Offline Payment';
            $body = '{{amount}} {{currency}} added to your balance by offline payment method at {{time}}';
            $offline_payment->email_body = $this->htmlPart($subject, $body);
            $offline_payment->save();
        }


        $Course_Enroll_Payment = EmailTemplate::where('act', 'Course_Enroll_Payment')->first();
        if ($Course_Enroll_Payment) {
            $subject = 'Course Enroll Successfully';
            $body = 'You have enroll  {{course}}  . Your enrolled have been successfully .  Course Price :  {{price}} {{currency}}. You are already paid {{price}}  {{currency}} via {{gateway}} on {{time}} . Your course instructor {{instructor}}. ';
            $Course_Enroll_Payment->email_body = $this->htmlPart($subject, $body);
            $Course_Enroll_Payment->save();
        }


        $Course_Publish_Successfully = EmailTemplate::where('act', 'Course_Publish_Successfully')->first();
        if ($Course_Publish_Successfully) {
            $subject = 'Course Publish Successfully';
            $body = '{{course}} publish successfully at {{time}}.';
            $Course_Publish_Successfully->email_body = $this->htmlPart($subject, $body);
            $Course_Publish_Successfully->save();
        }


        $Course_Chapter_Added = EmailTemplate::where('act', 'Course_Chapter_Added')->first();
        if ($Course_Chapter_Added) {
            $subject = 'Course Chapter Added';
            $body = '{{chapter}} new chapter added under this {{course}}  publish successfully at {{time}}.';
            $Course_Chapter_Added->email_body = $this->htmlPart($subject, $body);
            $Course_Chapter_Added->save();
        }


        $Course_Lesson_Added = EmailTemplate::where('act', 'Course_Lesson_Added')->first();
        if ($Course_Lesson_Added) {
            $subject = 'Course Lesson Added';
            $body = ' {{lesson}} lesson added under {{chapter}}
            chapter of  {{course}} at  {{time}}.';
            $Course_Lesson_Added->email_body = $this->htmlPart($subject, $body);
            $Course_Lesson_Added->save();
        }


        $Course_Quiz_Added = EmailTemplate::where('act', 'Course_Quiz_Added')->first();
        if ($Course_Quiz_Added) {
            $subject = 'Course Quiz Added';
            $body = ' {{quiz}} Quiz added under {{chapter}}
            chapter of  {{course}} at  {{time}}.';
            $Course_Quiz_Added->email_body = $this->htmlPart($subject, $body);
            $Course_Quiz_Added->save();
        }


        $Course_ExerciseFile_Added = EmailTemplate::where('act', 'Course_ExerciseFile_Added')->first();
        if ($Course_ExerciseFile_Added) {
            $subject = 'Course ExerciseFile Added';
            $body = 'New exercise file {{filename}} added under  {{course}}  at  {{time}}. {{footer}} ';
            $Course_ExerciseFile_Added->email_body = $this->htmlPart($subject, $body);
            $Course_ExerciseFile_Added->save();
        }


        $Course_Unpublished = EmailTemplate::where('act', 'Course_Unpublished')->first();
        if ($Course_Unpublished) {
            $subject = 'Course Unpublished';
            $body = '{{course}} Unpublished at {{time}}.';
            $Course_Unpublished->email_body = $this->htmlPart($subject, $body);
            $Course_Unpublished->save();
        }


        $Enroll_notify_Instructor = EmailTemplate::where('act', 'Enroll_notify_Instructor')->first();
        if ($Enroll_notify_Instructor) {
            $subject = 'New Enroll Notification';
            $body = '{{course}} have new enrolled at  {{time}}  Purchase price {{price}} {{currency}} & Your Revenue is {{rev}} {{currency}}.';
            $Enroll_notify_Instructor->email_body = $this->htmlPart($subject, $body);
            $Enroll_notify_Instructor->save();
        }


        /*   $Monthend_Payout_Info = EmailTemplate::where('act', 'Monthend_Payout_Info')->first();
           if ($Monthend_Payout_Info) {
               $subject = 'Instructor Payout Month end';
               $body = 'You have sold  {{sell}} {{cur}} in {{date}}. Your Revenue & Payout Amount is {{revenue}} {{cur}} . Your payout is processing by {{gateway}}.';
               $Monthend_Payout_Info->email_body = $this->htmlPart($subject, $body);
               $Monthend_Payout_Info->save();
           }


           $Monthend_Payout_Successfully = EmailTemplate::where('act', 'Monthend_Payout_Successfully')->first();
           if ($Monthend_Payout_Info) {
               $subject = 'Instructor Payout Successfully';
               $body = 'You have sold  {{sell}} {{cur}} in {{date}}. Your Revenue & Payout Amount is {{revenue}} {{cur}} . Your payout is processing by {{gateway}}  & it was successes.';
               $Monthend_Payout_Successfully->email_body = $this->htmlPart($subject, $body);
               $Monthend_Payout_Successfully->save();
           }


           $Monthend_Payout_Decline = EmailTemplate::where('act', 'Monthend_Payout_Decline')->first();
           if ($Monthend_Payout_Info) {
               $subject = 'Instructor Payout Decline';
               $body = 'You have sold  {{sell}} {{cur}} in {{date}}. Your Revenue & Payout Amount is {{revenue}} {{cur}} . Your payout is processing by {{gateway}}  & it was declined.';
               $Monthend_Payout_Decline->email_body = $this->htmlPart($subject, $body);
               $Monthend_Payout_Decline->save();
           }*/


        $Course_comment = EmailTemplate::where('act', 'Course_comment')->first();
        if ($Course_comment) {
            $subject = 'New comment on course';
            $body = '{{course}} have new comment at {{time}}. Comment is: {{comment}}.';
            $Course_comment->email_body = $this->htmlPart($subject, $body);
            $Course_comment->save();
        }


        $Course_comment_Reply = EmailTemplate::where('act', 'Course_comment_Reply')->first();
        if ($Course_comment_Reply) {
            $subject = 'New Reply on Comment';
            $body = '{{course}} have new reply at {{time}}. Comment is: {{comment}}.  Reply is: {{reply}}. ';
            $Course_comment_Reply->email_body = $this->htmlPart($subject, $body);
            $Course_comment_Reply->save();
        }


        $Course_Review = EmailTemplate::where('act', 'Course_Review')->first();
        if ($Course_Review) {
            $subject = 'New Review on course';
            $body = '{{course}} have new review at {{time}} & review is {{review}} & {{star}}. ';
            $Course_Review->email_body = $this->htmlPart($subject, $body);
            $Course_Review->save();
        }


        $PASS_UPDATE = EmailTemplate::where('act', 'PASS_UPDATE')->first();
        if ($PASS_UPDATE) {
            $subject = 'Password update Successfully';
            $body = 'Your password has been changed successfully done at {{time}}.';
            $PASS_UPDATE->email_body = $this->htmlPart($subject, $body);
            $PASS_UPDATE->save();
        }


        $Email_Verification = EmailTemplate::where('act', 'Email_Verification')->first();
        if ($Email_Verification) {
            $Email_Verification->email_body = $verify_body;
            $Email_Verification->save();
        }


        $Enroll_Rejected = EmailTemplate::where('act', 'Enroll_Rejected')->first();
        if ($Enroll_Rejected) {
            $subject = 'Course Enroll Rejected By Admin';
            $body = 'You have enrolled {{course}} on this course . Admin rejected your enrollment because of {{reason}}  at {{time}}.';
            $Enroll_Rejected->email_body = $this->htmlPart($subject, $body);
            $Enroll_Rejected->save();
        }


        $Enroll_Enabled = EmailTemplate::where('act', 'Enroll_Enabled')->first();
        if ($Enroll_Enabled) {
            $subject = 'Course Enroll Enabled By Admin';
            $body = 'You have enrolled {{course}} on this course . Admin rejected your enrollment because of {{reason}}  at {{time}}.';
            $Enroll_Enabled->email_body = $this->htmlPart($subject, $body);
            $Enroll_Enabled->save();
        }


        $Enroll_Enabled = EmailTemplate::where('act', 'Bank_Payment')->first();
        if ($Enroll_Enabled) {
            $subject = 'Bank Payment';
            $body = '{{amount}} {{currency}} added to your balance by bank payment method at {{time}}';
            $Enroll_Enabled->email_body = $this->htmlPart($subject, $body);
            $Enroll_Enabled->save();
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    public function htmlPart($subject, $body)
    {
        $html = '
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<style>

     .social_links {
        background: #F4F4F8;
        padding: 15px;
        margin: 30px 0 30px 0;
    }

    .social_links a {
        display: inline-block;
        font-size: 15px;
        color: #252B33;
        padding: 5px;
    }


</style>

<div class="">
<div style="color: rgb(255, 255, 255); font-family: &quot;Open Sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: center; background-color: rgb(65, 80, 148); padding: 30px; border-top-left-radius: 3px; border-top-right-radius: 3px; margin: 0px;"><h1 style="margin: 20px 0px 10px; font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-weight: 500; line-height: 1.1; color: inherit; font-size: 36px;">
' . $subject . '

</h1></div><div style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; padding: 20px;">
<p style="color: rgb(85, 85, 85);"><br></p>
<p style="color: rgb(85, 85, 85);">' . $body . '</p></div>
</div>

<div class="email_invite_wrapper" style="text-align: center">


    <div class="social_links">
        <a href="https://twitter.com/codetheme"> <i class="fab fa-facebook-f"></i> </a>
        <a href="https://codecanyon.net/user/codethemes/portfolio"><i class="fas fa-code"></i> </a>
        <a href="https://twitter.com/codetheme" target="_blank"> <i class="fab fa-twitter"></i> </a>
        <a href="https://dribbble.com/codethemes"> <i class="fab fa-dribbble"></i></a>
    </div>
</div>

';
        return $html;
    }
}
