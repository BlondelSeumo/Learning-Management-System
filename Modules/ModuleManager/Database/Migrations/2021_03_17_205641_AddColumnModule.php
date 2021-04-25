<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddColumnModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modules', function ($table) {
            if (!Schema::hasColumn('modules', 'details')) {
                $table->string('details')->nullable();
            }
        });

        $aws = \Modules\ModuleManager\Entities\Module::whereName('AmazonS3')->first();
        if ($aws) {
            $aws->details = "Amazon S3 is a service offered by Amazon Web Services that provides object storage through a web service interface. Amazon S3 uses the same scalable storage infrastructure that Amazon.com uses to run its global e-commerce network";
            $aws->save();
        }

        $bbb = \Modules\ModuleManager\Entities\Module::whereName('BBB')->first();
        if ($bbb) {
            $bbb->details = "BigBlueButton (BBB) is a free software web conferencing system for Linux servers designed for online learning. It has integrations for many of the major learning and content management systems.";
            $bbb->save();
        }


        $jitsi = \Modules\ModuleManager\Entities\Module::whereName('Jitsi')->first();
        if ($jitsi) {
            $jitsi->details = "Jitsi is a collection of free and open-source multiplatform voice, video conferencing and instant messaging applications for the web platform, Windows, Linux, macOS, iOS and Android. The Jitsi project began with the Jitsi Desktop.";
            $jitsi->save();
        }


        $ssl = \Modules\ModuleManager\Entities\Module::whereName('Sslcommerz')->first();
        if ($ssl) {
            $ssl->details = "SSLCOMMERZ is the first payment gateway in Bangladesh opening doors for local businesses and entrepreneurs to receive payments over the Internet via their online stores, websites or apps.";
            $ssl->save();
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
}
