<?php

namespace Modules\Quiz\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Quiz\Entities\QuestionBank;

class QuestionBankSeederTableSeeder extends Seeder
{
    public function run()
    {

        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'What does PHP stand for',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 1,
        ]);

        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'Who is the father of PHP?',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 1,
        ]);

        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'PHP files have a default file extension of.',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 1,
        ]);

        QuestionBank::insert([
            'type' => 'M',
            'Question' => ' A PHP script should start with ___ and end with ___:',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 1,
        ]);

        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'Which of the looping statements is/are supported by PHP?',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 1,
        ]);


        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'Which of the following is incorrect?',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 2,
            'category_id' => 2,
            'sub_category_id' => 2,
        ]);
        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'Which of the following operations cannot be done on string str1, where str1="LETSFINDCOURSE."?',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 2,
            'category_id' => 2,
            'sub_category_id' => 2,
        ]);
        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'Which of the following would give "Harry" as output? Given str1="Mary,Harry,John,Sam"',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 2,
            'category_id' => 2,
            'sub_category_id' => 2,
        ]);
        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'Which of the following is incorrect variable name in Python?',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 2,
            'category_id' => 2,
            'sub_category_id' => 2,
        ]);
        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'Which of the following is not a relational operator in Python?',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 2,
            'category_id' => 2,
            'sub_category_id' => 2,
        ]);

        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'Java Source Code is compiled into ______________.',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 3,
            'category_id' => 3,
            'sub_category_id' => 3,
        ]);
        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'Enums were introduced in?',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 3,
            'category_id' => 3,
            'sub_category_id' => 3,
        ]);
        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'Which of the following is used to interpret and execute Java Applet Classes hosted by HTML.',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 3,
            'category_id' => 3,
            'sub_category_id' => 3,
        ]);
        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'HTML based Java Documentary help can be accessed using ______________.',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 3,
            'category_id' => 3,
            'sub_category_id' => 3,
        ]);
        QuestionBank::insert([
            'type' => 'M',
            'Question' => 'Single line comment starts with _________ in Java.',
            'marks' => 2,
            'number_of_option' => 4,
            'q_group_id' => 3,
            'category_id' => 3,
            'sub_category_id' => 3,
        ]);
    }
}
