<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\FrontendManage\Entities\FrontPage;
use Modules\FrontendManage\Entities\HeaderMenu;

class CreateHeaderMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('header_menus')) {
            Schema::create('header_menus', function (Blueprint $table) {
                $table->id();
                $table->string('type');
                $table->unsignedBigInteger('element_id')->nullable();
                $table->string('title')->nullable();
                $table->string('link')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->unsignedInteger('position')->default(0);
                $table->boolean('show')->default(0);
                $table->boolean('is_newtab')->default(0);
                $table->timestamps();
            });
        }


        $home = FrontPage::whereSlug('/')->first();
        if ($home) {
            $menu = new HeaderMenu();
            $menu->type = "Static Page";
            $menu->element_id = $home->id;
            $menu->title = $home->title;
            $menu->link = '/';
            $menu->position = 1;
            $menu->save();
        }

        $home = FrontPage::whereSlug('/courses')->first();
        if ($home) {
            $menu = new HeaderMenu();
            $menu->type = "Static Page";
            $menu->element_id = $home->id;
            $menu->title = $home->title;
            $menu->link = $home->slug;
            $menu->position = 2;
            $menu->save();

        }


        $classes = FrontPage::whereSlug('/classes')->first();
        if ($classes) {
            $menu = new HeaderMenu();
            $menu->type = "Static Page";
            $menu->element_id = $classes->id;
            $menu->title = $classes->title;
            $menu->link = $classes->slug;
            $menu->position = 4;
            $menu->save();

        }


        $quizzes = FrontPage::whereSlug('/quizzes')->first();
        if ($quizzes) {
            $menu = new HeaderMenu();
            $menu->type = "Static Page";
            $menu->element_id = $quizzes->id;
            $menu->title = $quizzes->title;
            $menu->link = $quizzes->slug;
            $menu->position = 5;
            $menu->save();

        }

        $instructors = FrontPage::whereSlug('/instructors')->first();
        if ($instructors) {
            $menu = new HeaderMenu();
            $menu->type = "Static Page";
            $menu->element_id = $instructors->id;
            $menu->title = $instructors->title;
            $menu->link = $instructors->slug;
            $menu->position = 6;
            $menu->save();

        }


        $contact = FrontPage::whereSlug('/contact-us')->first();
        if ($contact) {
            $menu = new HeaderMenu();
            $menu->type = "Static Page";
            $menu->element_id = $contact->id;
            $menu->title = $contact->title;
            $menu->link = $contact->slug;
            $menu->position = 7;
            $menu->save();

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('header_menus');
    }
}
