<?php

namespace Modules\Quiz\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Quiz\Entities\QuestionGroup;

class QuestionGroupSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        QuestionGroup::truncate();

        QuestionGroup::insert([
           'title' => "PHP"
        ]);

        QuestionGroup::insert([
           'title' => "Python"
        ]);

        QuestionGroup::insert([
           'title' => "Java"
        ]);
    }
}
