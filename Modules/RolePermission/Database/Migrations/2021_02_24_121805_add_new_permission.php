<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddNewPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('', function (Blueprint $table) {
//
//        });


        if (!\Modules\RolePermission\Entities\Permission::find(291)) {
            $sql = [
                ['id' => 291, 'module_id' => 12, 'parent_id' => 12, 'name' => 'About System', 'route' => 'setting.aboutSystem', 'type' => 2],

            ];
            DB::table('permissions')->insert($sql);
        }

        if (!\Modules\RolePermission\Entities\Permission::find(292)) {
            $sql = [
                ['id' => 292, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Update System', 'route' => 'setting.updateSystem', 'type' => 2],

            ];
            DB::table('permissions')->insert($sql);
        }


        if (!\Modules\RolePermission\Entities\Permission::find(293)) {
            $sql = [
                ['id' => 293, 'module_id' => 12, 'parent_id' => 292, 'name' => 'Update System Submit', 'route' => 'setting.updateSystem.submit', 'type' => 3],
                //last  286
            ];
            DB::table('permissions')->insert($sql);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function (Blueprint $table) {

        });
    }
}
