<?php

namespace Modules\FrontendManage\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class FrontendManageDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(BecomeInstructorTableSeeder::class);
        $this->call(SponsorTableSeeder::class);
        $this->call(WorkProcessTableSeeder::class);
    }
}
