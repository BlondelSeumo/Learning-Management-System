<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\SystemSetting\Entities\EmailTemplate;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('act', 100)->unique();
            $table->string('name');
            $table->string('subj');
            $table->text('email_body');
            $table->text('shortcodes');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });


        EmailTemplate::insert([
            'act' => 'OffLine_Payment',
            'name' => 'OffLine Payment',
            'subj' => 'Offline Payment Request Approved',
            'email_body' => '{{amount}} {{currency}} added to your balance by offline payment method at {{time}}  {{footer}} ',
            'shortcodes' => '{"amount":"Request Amount","time":"Balance Added Time","currency":"User Currency","footer":"Email footer"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        EmailTemplate::insert([
            'act' => 'Bank_Payment',
            'name' => 'Bank Payment',
            'subj' => 'Bank Payment Request Approved',
            'email_body' => '{{amount}} {{currency}} added to your balance by bank payment method at {{time}}  {{footer}} ',
            'shortcodes' => '{"amount":"Request Amount","time":"Balance Added Time","currency":"User Currency","footer":"Email footer"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Course_Enroll_Payment',
            'name' => 'Course Enroll Payment ',
            'subj' => 'Course Enroll Successfully',
            'email_body' => 'You have enroll  {{course}}  . Your enrolled have been successfully .  Course Price :  {{price}} {{currency}}. You are already paid {{price}}  {{currency}} via {{gateway}} on {{time}} . Your course instructor {{instructor}}.  {{footer}} ',
            'shortcodes' => '{"time":"Enroll  Time","currency":"User Currency","course":"Course Title","price":"Course Purchase Price","instructor":"Course Instructor Name","gateway":"Payment Method"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Course_Publish_Successfully',
            'name' => 'Course Publish Successfully',
            'subj' => 'Course Publish Successfully ',
            'email_body' => '{{course}} publish successfully at {{time}}. {{footer}} ',
            'shortcodes' => '{"time":"Publish Time","course":"Course" }',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Course_Chapter_Added',
            'name' => 'Course Chapter Added',
            'subj' => 'New Course Chapter Added ',
            'email_body' => '{{chapter}} new chapter added under this {{course}}  publish successfully at {{time}}.',
            'shortcodes' => '{"time":"Publish Time","course":"Course","chapter":"Chapter Name"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Course_Lesson_Added',
            'name' => 'Course Lesson Added',
            'subj' => 'New Lesson Added ',
            'email_body' => ' {{lesson}} lesson added under {{chapter}}
            chapter of  {{course}} at  {{time}}. {{footer}} ',
            'shortcodes' => '{"time":"Publish Time","course":"Course","chapter":"Chapter Name","lesson":"Lesson Name"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Course_Quiz_Added',
            'name' => 'Course Quiz Added',
            'subj' => 'New Quiz Added ',
            'email_body' => ' {{quiz}} Quiz added under {{chapter}}
            chapter of  {{course}} at  {{time}}. {{footer}}  ',
            'shortcodes' => '{"time":"Publish Time","course":"Course","chapter":"Chapter Name","quiz":"Quiz Name"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Course_ExerciseFile_Added',
            'name' => 'Course ExerciseFile Added',
            'subj' => 'Course ExerciseFile Added',
            'email_body' => 'New exercise file {{filename}} added under  {{course}}  at  {{time}}. {{footer}} ',
            'shortcodes' => '{"time":"Publish Time","course":"Course","filename":"File Name"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Course_Unpublished',
            'name' => 'Course Unpublished',
            'subj' => 'Course Unpublished',
            'email_body' => '{{course}} Unpublished at {{time}}. {{footer}} ',
            'shortcodes' => '{"time":"Unpublished Time","course":"Course"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Enroll_notify_Instructor',
            'name' => 'New Enroll Notification',
            'subj' => 'New Enroll Notification',
            'email_body' => '{{course}} have new enrolled at  {{time}}  Purchase price {{price}} {{currency}} & Your Revenue is {{rev}} {{currency}}. {{footer}}  ',
            'shortcodes' => '{"time":"Enroll Time","course":"Course Title","price":"Purchase Price","rev":"Instructor Revenue","currency":"User Currency Symbol"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

     /*   EmailTemplate::insert([
            'act' => 'Monthend_Payout_Info',
            'name' => 'Instructor Payout Month end',
            'subj' => 'Instructor Payout Month end',
            'email_body' => 'You have sold  {{sell}} {{cur}} in {{date}}. Your Revenue & Payout Amount is {{revenue}} {{cur}} . Your payout is processing by {{gateway}}. {{footer}}  ',
            'shortcodes' => '{"date":"Payout Month & Year","cur":"Instructor Currency","sell":"Total Sell This Period","revenue":"Instructor Revenue This Period","gateway":"Payout Method"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
                'act' => 'Monthend_Payout_Successfully',
            'name' => 'Instructor Payout Successfully',
            'subj' => 'Instructor Payout Successfully',
            'email_body' => 'You have sold  {{sell}} {{cur}} in {{date}}. Your Revenue & Payout Amount is {{revenue}} {{cur}} . Your payout is processing by {{gateway}}  & it was successes. {{footer}}  ',
            'shortcodes' => '{"date":"Payout Month & Year","cur":"Instructor',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Monthend_Payout_Decline',
            'name' => 'Instructor Payout Decline',
            'subj' => 'Instructor Payout Decline',
            'email_body' => 'You have sold  {{sell}} {{cur}} in {{date}}. Your Revenue & Payout Amount is {{revenue}} {{cur}} . Your payout is processing by {{gateway}}  & it was declined. {{footer}} ',
            'shortcodes' => '{"date":"Payout Month & Year","cur":"Instructor Currency","sell":"Total Sell This Period","revenue":"Instructor Revenue This Period","gateway":"Payout Method"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);*/

        EmailTemplate::insert([
            'act' => 'Course_comment',
            'name' => 'New comment on course',
            'subj' => 'Your Course Have New Comment',
            'email_body' => '{{course}} have new comment at {{time}}. Comment is: {{comment}}. {{footer}}  ',
            'shortcodes' => '{"time":"Submit Time","course":"Course Title","comment":"Course Comment"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Course_comment_Reply',
            'name' => 'New Reply on Comment',
            'subj' => 'New Reply on Comment',
            'email_body' => '{{course}} have new reply at {{time}}. Comment is: {{comment}}.  Reply is: {{reply}}. {{footer}} ',
            'shortcodes' => '{"time":"Submit Time","course":"Course Title","comment":"Course Comment","reply":"Comment Reply"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Course_Review',
            'name' => 'New Review on course',
            'subj' => 'New Review on course',
            'email_body' => '{{course}} have new review at {{time}} & review is {{review}} & {{star}}. {{footer}} ',
            'shortcodes' => '{"time":"Submit Time","course":"Course Title","review":"Review","star":"Review Star"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        EmailTemplate::insert([
            'act' => 'PASS_UPDATE',
            'name' => 'Password update',
            'subj' => 'Password update Successfully ',
            'email_body' => 'Your password has been changed successfully done at {{time}}. {{footer}} ',
            'shortcodes' => '{"time":"Time"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Email_Verification',
            'name' => 'Email Verification Link',
            'subj' => 'Email Verification Link',
            'email_body' => 'Email Verification Link {{code}}. {{footer}} ',
            'shortcodes' => '{"code":"Verification code"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        EmailTemplate::insert([
            'act' => 'Enroll_Rejected',
            'name' => 'Course Enroll Rejected By Admin',
            'subj' => 'Course Enroll Rejected By Admin',
            'email_body' => 'You have enrolled {{course}} on this course . Admin rejected your enrollment because of {{reason}}  at {{time}}. {{footer}} ',
            'shortcodes' => '{"course":"Course Name","time":"Reject Time","reason":"Reason Of Enroll Rejection"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        EmailTemplate::insert([
            'act' => 'Enroll_Enabled',
            'name' => 'Course Enroll Enabled By Admin',
            'subj' => 'Course Enroll Enabled By Admin',
            'email_body' => 'You have enrolled {{course}} on this course . Admin re enable your enrollment because of at {{time}}. {{footer}}  ',
            'shortcodes' => '{"course":"Course Name","time":"Enable Time"}',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_templates');
    }
}
