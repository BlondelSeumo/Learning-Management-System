<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Setting\Entities\CookieSetting;

class CreateCookieSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cookie_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('details')->nullable();
            $table->string('btn_text')->default('Accept');
            $table->string('text_color')->default('#fff');
            $table->string('bg_color')->default('#FB1159');
            $table->boolean('allow')->default(1);
            $table->timestamps();
        });

        $setting = new CookieSetting();
        $setting->title = 'Cookies';
        $setting->details = "We collect and use cookies to give you the best and most relevant website experience. Kindly accept the cookies.
        <a href='' >Privacy Policy</a>";
        $setting->btn_text = 'Accept';
        $setting->text_color = '#fff';
        $setting->bg_color = '#FB1159';
        $setting->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cookie_settings');
    }
}
