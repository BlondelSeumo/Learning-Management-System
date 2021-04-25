<?php

use Illuminate\Database\Migrations\Migration;
use Modules\FrontendManage\Entities\HeaderMenu;

class RemoveItemFromHeaderMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $courses = HeaderMenu::whereLink('courses')->first();
        if ($courses) {
            $courses->delete();
        }


        $classes = HeaderMenu::whereLink('classes')->first();
        if ($classes) {
            $classes->delete();
        }


        $quizzes = HeaderMenu::whereLink('quizzes')->first();
        if ($quizzes) {
            $quizzes->delete();

        }

        $instructors = HeaderMenu::whereLink('instructors')->first();
        if ($instructors) {
            $instructors->delete();

        }


        $contact = HeaderMenu::whereLink('contact-us')->first();
        if ($contact) {
            $contact->delete();

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
