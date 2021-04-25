<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInCourseEnroll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('course_enrolleds', function (Blueprint $table) {
            if (!Schema::hasColumn('course_enrolleds', 'subscription')) {
                $table->string('subscription')->default(0);
            }

            if (!Schema::hasColumn('course_enrolleds', 'subscription_validity_date')) {
                $table->date('subscription_validity_date')->nullable();
            }
        });

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
