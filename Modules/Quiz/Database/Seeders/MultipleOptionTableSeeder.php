<?php

namespace Modules\Quiz\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Quiz\Entities\QuestionBankMuOption;

class MultipleOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionBankMuOption::truncate();

        QuestionBankMuOption::insert([
            'title' => 'Personal Home Page',
            'status' => 0,
            'question_bank_id' => 1,
        ]);

        QuestionBankMuOption::insert([
            'title' => 'Hypertext Preprocessor',
            'status' => 1,
            'question_bank_id' => 1,
        ]);

        QuestionBankMuOption::insert([
            'title' => 'Pretext Hypertext Processor',
            'status' => 0,
            'question_bank_id' => 1,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'Preprocessor Home Page',
            'status' => 0,
            'question_bank_id' => 1,
        ]);


        QuestionBankMuOption::insert([
            'title' => 'Rasmus Lerdorf',
            'status' => 1,
            'question_bank_id' => 2,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'Willam Makepiece',
            'status' => 0,
            'question_bank_id' => 2,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'Drek Kolkevi',
            'status' => 0,
            'question_bank_id' => 2,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'List Barely',
            'status' => 0,
            'question_bank_id' => 2,
        ]);

        QuestionBankMuOption::insert([
            'title' => 'html',
            'status' => 0,
            'question_bank_id' => 3,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'xml',
            'status' => 0,
            'question_bank_id' => 3,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'php',
            'status' => 1,
            'question_bank_id' => 3,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'ph',
            'status' => 0,
            'question_bank_id' => 3,
        ]);

        QuestionBankMuOption::insert([
            'title' => '< php >',
            'status' => 0,
            'question_bank_id' => 4,
        ]);
        QuestionBankMuOption::insert([
            'title' => '< ? php ?>',
            'status' => 0,
            'question_bank_id' => 4,
        ]);
        QuestionBankMuOption::insert([
            'title' => '< ? ? >',
            'status' => 0,
            'question_bank_id' => 4,
        ]);
        QuestionBankMuOption::insert([
            'title' => '< ?php ? >',
            'status' => 1,
            'question_bank_id' => 4,
        ]);


        QuestionBankMuOption::insert([
            'title' => 'for loop',
            'status' => 0,
            'question_bank_id' => 5,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'while loop',
            'status' => 0,
            'question_bank_id' => 5,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'do-while loop',
            'status' => 0,
            'question_bank_id' => 5,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'All of the mentioned above',
            'status' => 1,
            'question_bank_id' => 5,
        ]);


        QuestionBankMuOption::insert([
            'title' => 'for loopList is a built-in data structure in Python',
            'status' => 0,
            'question_bank_id' => 6,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'List can only have elements of same data type.',
            'status' => 1,
            'question_bank_id' => 6,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'List is mutable.',
            'status' => 0,
            'question_bank_id' => 6,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'Index of lists can be positive as well as negative.',
            'status' => 0,
            'question_bank_id' => 6,
        ]);

        QuestionBankMuOption::insert([
            'title' => 'str1+="Learning made easy"',
            'status' => 0,
            'question_bank_id' => 7,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'str1[1]="a"',
            'status' => 1,
            'question_bank_id' => 7,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'print(str1[1])',
            'status' => 0,
            'question_bank_id' => 7,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'str1[0:4]',
            'status' => 0,
            'question_bank_id' => 7,
        ]);

        QuestionBankMuOption::insert([
            'title' => 'str1[4:9]',
            'status' => 0,
            'question_bank_id' => 8,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'str1[5:10]',
            'status' => 1,
            'question_bank_id' => 8,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'str1[4:10]',
            'status' => 0,
            'question_bank_id' => 8,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'str1[5:9]',
            'status' => 0,
            'question_bank_id' => 8,
        ]);

        QuestionBankMuOption::insert([
            'title' => 'variable_1',
            'status' => 0,
            'question_bank_id' => 9,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'variable1',
            'status' => 1,
            'question_bank_id' => 9,
        ]);
        QuestionBankMuOption::insert([
            'title' => '1variable',
            'status' => 0,
            'question_bank_id' => 9,
        ]);
        QuestionBankMuOption::insert([
            'title' => '_variable',
            'status' => 0,
            'question_bank_id' => 9,
        ]);

        QuestionBankMuOption::insert([
            'title' => '>=',
            'status' => 0,
            'question_bank_id' => 10,
        ]);
        QuestionBankMuOption::insert([
            'title' => '<=',
            'status' => 0,
            'question_bank_id' => 10,
        ]);
        QuestionBankMuOption::insert([
            'title' => '=',
            'status' => 1,
            'question_bank_id' => 10,
        ]);
        QuestionBankMuOption::insert([
            'title' => '!=',
            'status' => 0,
            'question_bank_id' => 10,
        ]);


        QuestionBankMuOption::insert([
            'title' => 'Obj',
            'status' => 0,
            'question_bank_id' => 11,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'Source Code',
            'status' => 0,
            'question_bank_id' => 11,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'Bytecode',
            'status' => 1,
            'question_bank_id' => 11,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'Exe',
            'status' => 0,
            'question_bank_id' => 11,
        ]);


        QuestionBankMuOption::insert([
            'title' => 'Java 4.0',
            'status' => 0,
            'question_bank_id' => 12,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'Java 8.0',
            'status' => 0,
            'question_bank_id' => 12,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'Java 5.0',
            'status' => 1,
            'question_bank_id' => 12,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'Java 6.0',
            'status' => 0,
            'question_bank_id' => 12,
        ]);

        QuestionBankMuOption::insert([
            'title' => 'appletviewer',
            'status' => 1,
            'question_bank_id' => 13,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'appletwatcher',
            'status' => 0,
            'question_bank_id' => 13,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'appletshow',
            'status' => 00,
            'question_bank_id' => 13,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'appletscreen',
            'status' => 0,
            'question_bank_id' => 13,
        ]);

        QuestionBankMuOption::insert([
            'title' => 'javahelp',
            'status' => 0,
            'question_bank_id' => 14,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'javamanual',
            'status' => 0,
            'question_bank_id' => 14,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'javadoc',
            'status' => 1,
            'question_bank_id' => 14,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'None of these',
            'status' => 0,
            'question_bank_id' => 14,
        ]);

        QuestionBankMuOption::insert([
            'title' => '/**',
            'status' => 0,
            'question_bank_id' => 15,
        ]);
        QuestionBankMuOption::insert([
            'title' => '//',
            'status' => 0,
            'question_bank_id' => 15,
        ]);
        QuestionBankMuOption::insert([
            'title' => '/*',
            'status' => 1,
            'question_bank_id' => 15,
        ]);
        QuestionBankMuOption::insert([
            'title' => 'None of these',
            'status' => 0,
            'question_bank_id' => 15,
        ]);

    }
}
