<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Zoom\Entities\ZoomSetting;

class CreateZoomSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->default(1);
            $table->tinyInteger('package_id')->default(1);
            $table->boolean('host_video')->default(false);
            $table->boolean('participant_video')->default(false);
            $table->boolean('join_before_host')->default(false);
            $table->string('audio')->default('both')->comment('both, telephony & voip');
            $table->string('auto_recording')->default('none')->comment('local, cloud & none');
            $table->tinyInteger('approval_type')->default(0)->comment('0 => Automatic, 1 => Manually & 2 No Registration');
            $table->boolean('mute_upon_entry')->default(false);
            $table->boolean('waiting_room')->default(false);
            $table->timestamps();
        });

        $s = new ZoomSetting();
        $s->package_id = 1;
        $s->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoom_settings');
    }
}
