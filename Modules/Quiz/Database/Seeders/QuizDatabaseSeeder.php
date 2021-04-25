<?php

namespace Modules\Quiz\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class QuizDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(QuestionGroupSeederTableSeeder::class);
         $this->call(QuestionBankSeederTableSeeder::class);
         $this->call(MultipleOptionTableSeeder::class);
         $this->call(OnlineQuizTableSeeder::class);
         $this->call(QuestionAssignTableSeeder::class);
    }
}
