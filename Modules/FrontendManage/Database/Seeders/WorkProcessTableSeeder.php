<?php

namespace Modules\FrontendManage\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\FrontendManage\Entities\WorkProcess;

class WorkProcessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

/*        WorkProcess::insert([
            'title' => 'Set your course plan',
            'description' => "When you sign up, you’ll immediately have unlimited viewing.",
            'status' => 1,
        ]);

        WorkProcess::insert([
            'title' => 'Make video course',
            'description' => "When you sign up, you’ll immediately have unlimited viewing.",
            'status' => 1,
        ]);

        WorkProcess::insert([
            'title' => 'Submit for audience',
            'description' => "When you sign up, you’ll immediately have unlimited viewing.",
            'status' => 1,
        ]);*/
    }
}
