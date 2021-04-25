<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class  GeneralSettingAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_settings', function ($table) {
            if (!Schema::hasColumn('general_settings', 'system_domain')) {
                $table->string('system_domain')->nullable();
            }
            if (!Schema::hasColumn('general_settings', 'system_activated_date')) {
                $table->string('system_activated_date')->nullable();
            }
            if (!Schema::hasColumn('general_settings', 'last_updated_date')) {
                $table->string('last_updated_date')->nullable();
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
        Schema::table('general_settings', function ($table) {
            $table->dropColumn('system_domain');
            $table->dropColumn('system_activated_date');
            $table->dropColumn('last_updated_date');
        });
    }
}
