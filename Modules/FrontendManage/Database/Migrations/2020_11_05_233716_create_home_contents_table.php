<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\FrontendManage\Entities\HomeContent;

class CreateHomeContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();
            $table->string('slider_title')->nullable();
            $table->string('slider_text')->nullable();
            $table->string('testimonial_title')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        $home_content = new HomeContent();
        $home_content->slider_title = "For every student, every classroom. Real results.";
        $home_content->slider_text = "Build skills with courses, certificates, and degrees online from world-class universities and companies";
        $home_content->testimonial_title = "What Our Student Have To Say";
        $home_content->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_contents');
    }
}
