<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();

            $table->string('title')->nullable();
            $table->integer('title_position_x')->default(0);
            $table->integer('title_position_y')->default(0);
            $table->string('title_font_family')->nullable();
            $table->integer('title_font_size')->default(30);
            $table->string('title_font_color')->nullable();


            $table->text('body')->nullable();
            $table->integer('body_position_x')->default(0);
            $table->integer('body_position_y')->default(0);
            $table->string('body_font_family')->nullable();
            $table->integer('body_font_size')->default(10);
            $table->string('body_font_color')->nullable();
            $table->string('body_max_len')->nullable();


            $table->tinyInteger('profile')->default(1);
            $table->integer('profile_x')->default(0);
            $table->integer('profile_y')->default(0);
            $table->integer('profile_height')->nullable();
            $table->integer('profile_weight')->default(10);


            $table->integer('name')->default(1);
            $table->integer('name_position_x')->default(0);
            $table->integer('name_position_y')->default(0);
            $table->string('name_font_family')->nullable();
            $table->integer('name_font_size')->default(50);
            $table->string('name_font_color')->nullable();


            $table->tinyInteger('date')->default(1);
            $table->integer('date_position_x')->default(0);
            $table->integer('date_position_y')->default(0);
            $table->string('date_font_family')->nullable();
            $table->integer('date_font_size')->default(30);
            $table->string('date_font_color')->nullable();
            $table->integer('date_format')->default(1);

            $table->string('signature')->nullable();
            $table->integer('signature_position_x')->default(0);
            $table->integer('signature_position_y')->default(0);
            $table->integer('signature_height')->nullable();
            $table->integer('signature_weight')->default(10);

            $table->string('signature_text')->nullable();
            $table->integer('signature_text_position_x')->default(0);
            $table->integer('signature_text_position_y')->default(0);
            $table->string('signature_text_font_family')->nullable();
            $table->integer('signature_text_font_size')->default(30);
            $table->string('signature_text_font_color')->nullable();


            $table->tinyInteger('for_course')->default(0);
            $table->tinyInteger('for_quiz')->default(0);


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
        Schema::dropIfExists('certificates');
    }
}
