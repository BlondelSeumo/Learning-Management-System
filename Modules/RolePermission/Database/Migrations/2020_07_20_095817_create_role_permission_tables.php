<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->integer('permission_id')->nullable();
            $table->integer('role_id')->nullable()->unsigned();
            $table->boolean('status')->default(1);
            $table->integer('created_by')->default(1)->unsigned();
            $table->integer('updated_by')->default(1)->unsigned();
            $table->timestamps();

        });

        DB::statement("INSERT INTO `role_permission` (`id`, `permission_id`, `role_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
                        (1, 1, 2, 1, 1, 1, now(), now()),
                        (2, 273, 2, 1, 1, 1, now(), now()),
                        (3, 274, 2, 1, 1, 1,  now(),  now()),
                        (4, 275, 2, 1, 1, 1,  now(),  now()),
                        (5, 276, 2, 1, 1, 1,  now(),  now()),
                        (6, 277, 2, 1, 1, 1,  now(),  now()),
                        (7, 278, 2, 1, 1, 1,  now(),  now()),
                        (8, 279, 2, 1, 1, 1,  now(),  now()),
                        (9, 280, 2, 1, 1, 1,  now(),  now()),
                        (10, 281, 2, 1, 1, 1,  now(),  now()),
                        (11, 282, 2, 1, 1, 1,  now(),  now()),
                        (12, 283, 2, 1, 1, 1,  now(),  now()),
                        (13, 284, 2, 1, 1, 1,  now(),  now()),
                        (14, 285, 2, 1, 1, 1,  now(),  now()),
                        (15, 4, 2, 1, 1, 1,  now(),  now()),
                        (16, 49, 2, 1, 1, 1,  now(),  now()),
                        (17, 5, 2, 1, 1, 1,  now(),  now()),
                        (18, 49, 2, 1, 1, 1,  now(),  now()),
                        (19, 4, 2, 1, 1, 1,  now(),  now()),
                        (20, 62, 2, 1, 1, 1,  now(),  now()),
                        (21, 63, 2, 1, 1, 1,  now(),  now()),
                        (22, 64, 2, 1, 1, 1,  now(),  now()),
                        (23, 67, 2, 1, 1, 1,  now(),  now()),
                        (24, 68, 2, 1, 1, 1,  now(),  now()),
                        (25, 69, 2, 1, 1, 1,  now(),  now()),
                        (26, 70, 2, 1, 1, 1,  now(),  now()),
                        (27, 71, 2, 1, 1, 1,  now(),  now()),
                        (28, 72, 2, 1, 1, 1,  now(),  now()),
                        (29, 74, 2, 1, 1, 1,  now(),  now()),
                        (30, 61, 2, 1, 1, 1,  now(),  now()),
                        (31, 60, 2, 1, 1, 1,  now(),  now())
                        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permission');
    }
}
