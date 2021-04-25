<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AssignNewPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $check = DB::table('role_permission')->where('permission_id', 135)->where('role_id', 2)->first();
        if (!$check) {
            $values = array('permission_id' => 135, 'role_id' => 2);
            DB::table('role_permission')->insert($values);
        }

        $check2 = DB::table('role_permission')->where('permission_id', 136)->where('role_id', 2)->first();
        if (!$check2) {
            $values = array('permission_id' => 136, 'role_id' => 2);
            DB::table('role_permission')->insert($values);
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
