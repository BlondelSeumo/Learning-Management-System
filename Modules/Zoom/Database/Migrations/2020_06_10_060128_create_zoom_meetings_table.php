<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('class_id')->nullable();
            $table->integer('created_by')->default(1);
            $table->integer('instructor_id')->default(1);
            $table->string('meeting_id')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();

            //basic
            $table->string('topic')->nullable();
            $table->text('description')->nullable();
            $table->string('attached_file')->nullable();
            $table->string('date_of_meeting')->nullable();
            $table->string('time_of_meeting')->nullable();
            $table->string('meeting_duration')->nullable();

            // setting
            $table->boolean('join_before_host')->nullable();
            $table->boolean('host_video')->nullable();
            $table->boolean('participant_video')->nullable();
            $table->boolean('mute_upon_entry')->nullable();
            $table->boolean('waiting_room')->nullable();
            $table->string('audio')->default('both')->comment('both, telephony & voip');
            $table->string('auto_recording')->default('none')->comment('local, cloud & none');
            $table->string('approval_type')->default(0)->comment('0 => Automatic, 1 => Manually & 2 No Registration');

            //recurring
            $table->boolean('is_recurring')->nullable();
            $table->tinyInteger('recurring_type')->nullable();
            $table->tinyInteger('recurring_repect_day')->nullable();
            $table->string('recurring_end_date')->nullable();

            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoom_meetings');
    }
}
