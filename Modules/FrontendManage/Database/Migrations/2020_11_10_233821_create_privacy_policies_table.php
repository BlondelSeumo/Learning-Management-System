<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\FrontendManage\Entities\PrivacyPolicy;

class CreatePrivacyPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privacy_policies', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->text('general')->nullable();
            $table->text('personal_data')->nullable();
            $table->text('voluntary_disclosure')->nullable();
            $table->text('children_privacy')->nullable();
            $table->text('information_about_cookies')->nullable();
            $table->text('thirt_party_adv')->nullable();
            $table->text('other_sites')->nullable();
            $table->text('teacher')->nullable();
            $table->text('student')->nullable();
            $table->text('business_transfer')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });
        $PrivacyPolicy = new PrivacyPolicy();
        $PrivacyPolicy->description = "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.";
        $PrivacyPolicy->general = "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.";
        $PrivacyPolicy->personal_data = "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.";
        $PrivacyPolicy->voluntary_disclosure = "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.";
        $PrivacyPolicy->children_privacy = "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.";
        $PrivacyPolicy->information_about_cookies = "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.";
        $PrivacyPolicy->thirt_party_adv = "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.";
        $PrivacyPolicy->other_sites = "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.";
        $PrivacyPolicy->teacher = "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.";
        $PrivacyPolicy->student = "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.";
        $PrivacyPolicy->business_transfer = "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.";
        $PrivacyPolicy->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privacy_policies');
    }
}
