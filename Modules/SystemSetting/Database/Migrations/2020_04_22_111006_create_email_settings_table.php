<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email_engine_type')->nullable();
            $table->string('from_name')->nullable();
            $table->string('from_email')->nullable();
            $table->string('mail_driver')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->text('api_key')->nullable();
            $table->timestamps();

        });


        DB::table('email_settings')->insert([
            [
                'email_engine_type' => 'php',
                'from_name' => 'System Admin',
                'from_email' => 'admin@lms.com',
                'mail_driver' => 'php',
                'active_status' => '1',
            ]
        ]);


        DB::table('email_settings')->insert([
            [
                'email_engine_type' => 'smtp',
                'from_name' => 'System Admin',
                'from_email' => 'admin@lms.com',
                'mail_driver' => 'smtp',
                'mail_host' => 'smtp.mailtrap.io',
                'mail_port' => '2525',
                'mail_username' => '7afbe3a03cb8ec',
                'mail_password' => '5456df993a535c',
                'mail_encryption' => 'tls',
                'active_status' => '0',
            ]
        ]);


        DB::table('email_settings')->insert([
            [
                'email_engine_type' => 'sendgrid',
                'from_name' => 'Admin',
                'from_email' => 'info@pangea-technology.com',
                'api_key' => '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',
                'active_status' => '0',
            ]
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_settings');
    }
}
