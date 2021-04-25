<?php

namespace Modules\SystemSetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SystemSettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(FrontendSettingTableSeeder::class);
        $this->call(TestimonialTableSeeder::class);
        $this->call(PageSeederTableSeeder::class);
        $this->call(FooterSeederTableSeeder::class);
        $this->call(IconSeederTableSeeder::class);

    }
}
