<?php

use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = \Modules\Setting\Model\GeneralSetting::find(1);
        if ($setting) {
            $setting->footer_copy_right = 'Copyright © 2020 Tutees Academy All rights reserved |This application is made by  <a href="https://spondonit.com" target="_blank"><font color="#D12053">SPONDONIT</font></a>';
            $setting->save();
        }
    }
}
