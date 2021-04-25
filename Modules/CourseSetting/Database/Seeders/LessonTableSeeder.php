<?php

namespace Modules\CourseSetting\Database\Seeders;

use App\LessonComplete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\CourseSetting\Entities\Lesson;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //Course 1
        $lesson = new Lesson();

        $lesson->course_id = 1;
        $lesson->chapter_id = 1;
        $lesson->name = 'What is Accounting';
        $lesson->description = 'Full Detail Description for Accounting';
        $lesson->video_url = 'https://www.youtube.com/watch?v=ii91oi0OpXM';
        $lesson->duration = '5H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;
        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 1;
        $lesson->chapter_id = 1;
        $lesson->name = 'Basics on Accounting';
        $lesson->description = 'Full Detail Description for Basics on Accounting';
        $lesson->video_url = 'https://vimeo.com/472497842';
        $lesson->duration = '3H';
        $lesson->host = 'Vimeo';
        $lesson->is_lock = 1;
        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 1;
        $lesson->chapter_id = 2;
        $lesson->name = 'Basic Learning on Income Statement';
        $lesson->description = 'Full Detail Description for Basics on Accounting';
        $lesson->video_url = 'https://www.youtube.com/watch?v=pyc7KiQji20';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 1;
        $lesson->chapter_id = 2;
        $lesson->name = 'What is Credits and Debits';
        $lesson->description = 'Full Detail Description for Basics on Accounting';
        $lesson->video_url = 'https://www.youtube.com/watch?v=pyc7KiQji20';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 1;
        $lesson->chapter_id = 3;
        $lesson->name = 'Basic Learning on Deveidend Policy';
        $lesson->description = 'Full Detail Description for Basics on Accounting';
        $lesson->video_url = 'https://www.youtube.com/watch?v=pyc7KiQji20';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 1;
        $lesson->chapter_id = 3;
        $lesson->name = 'What is Bankruptcy';
        $lesson->description = 'Full Detail Description for Bankruptcy';
        $lesson->video_url = 'https://www.youtube.com/watch?v=bsO5EZ4j020';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 1;
        $lesson->chapter_id = 3;
        $lesson->quiz_id = 1;
        $lesson->is_lock = 1;
        $lesson->is_quiz = 1;
        $lesson->save();


        //Course 2
        $lesson = new Lesson();

        $lesson->course_id = 2;
        $lesson->chapter_id = 4;
        $lesson->name = 'What is MBA';
        $lesson->description = 'Full Detail Description for MBA';
        $lesson->video_url = 'https://www.youtube.com/watch?v=IWIiur61JIg';
        $lesson->duration = '5H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 2;
        $lesson->chapter_id = 4;
        $lesson->name = 'Basics on MBA';
        $lesson->description = 'Full Detail Description for Basics on MBA';
        $lesson->video_url = 'https://www.youtube.com/watch?v=EDn9uqEQOKI';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 2;
        $lesson->chapter_id = 5;
        $lesson->name = 'Princples of Management';
        $lesson->description = 'Full Detail Description for Management';
        $lesson->video_url = 'https://www.youtube.com/watch?v=3N418bEiR7k';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 2;
        $lesson->chapter_id = 5;
        $lesson->name = 'What is Case Discussion';
        $lesson->description = 'Full Detail Description for Case Descriptio';
        $lesson->video_url = 'https://www.youtube.com/watch?v=Vn3NbcTL1m4&list=PL_7peE4KG-wx-3MZTXjRwt7AoZF_eTkiP';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 2;
        $lesson->chapter_id = 6;
        $lesson->name = 'Basic Learning on Deveidend Policy';
        $lesson->description = 'Full Detail Description for Basics on Accounting';
        $lesson->video_url = 'https://www.youtube.com/watch?v=pyc7KiQji20';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 2;
        $lesson->chapter_id = 6;
        $lesson->name = 'What is Bankruptcy';
        $lesson->description = 'Full Detail Description for Bankruptcy';
        $lesson->video_url = 'https://www.youtube.com/watch?v=bsO5EZ4j020';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();


        $lesson = new Lesson();
        $lesson->course_id = 2;
        $lesson->chapter_id = 6;
        $lesson->quiz_id = 1;
        $lesson->is_lock = 1;
        $lesson->is_quiz = 1;
        $lesson->save();

        //Course 3
        $lesson = new Lesson();

        $lesson->course_id = 3;
        $lesson->chapter_id = 7;
        $lesson->name = 'What is Blendering';
        $lesson->description = 'Full Detail Description for Blender';
        $lesson->video_url = 'https://www.youtube.com/watch?v=ICBP-7x7Chc';
        $lesson->duration = '5H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 3;
        $lesson->chapter_id = 7;
        $lesson->name = 'What is Modeling';
        $lesson->description = 'Full Detail Description for Basics on Modeling require for Blender';
        $lesson->video_url = 'https://www.youtube.com/watch?v=xIxUZpRk4Ac';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 3;
        $lesson->chapter_id = 8;
        $lesson->name = 'Basic needs of Modeling in Blender';
        $lesson->description = 'Full Detail Description for Modeling';
        $lesson->video_url = 'https://www.youtube.com/watch?v=3N418bEiR7k';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 3;
        $lesson->chapter_id = 8;
        $lesson->name = 'How to Create Models';
        $lesson->description = 'Full Detail Description for Creatig Modeling for Blender';
        $lesson->video_url = 'https://www.youtube.com/watch?v=Xd-6G3g5HH4';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 3;
        $lesson->chapter_id = 9;
        $lesson->name = 'How to Organize Models';
        $lesson->description = 'Full Detail Description for Basics on Organizing Models';
        $lesson->video_url = 'https://www.youtube.com/watch?v=h_2EyKbcSjI';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 3;
        $lesson->chapter_id = 9;
        $lesson->name = 'How to Normalize Models';
        $lesson->description = 'Full Detail Description for Normalizing Models';
        $lesson->video_url = 'https://www.youtube.com/watch?v=wVuoKJRsJTY';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();


        $lesson = new Lesson();
        $lesson->course_id = 3;
        $lesson->chapter_id = 9;
        $lesson->quiz_id = 1;
        $lesson->is_lock = 1;
        $lesson->is_quiz = 1;
        $lesson->save();
        //Course 4
        $lesson = new Lesson();

        $lesson->course_id = 4;
        $lesson->chapter_id = 10;
        $lesson->name = 'What is Environments (in Blender)';
        $lesson->description = 'Full Detail Description for Environments';
        $lesson->video_url = 'https://www.youtube.com/watch?v=Vt-_Htl-R90';
        $lesson->duration = '5H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 4;
        $lesson->chapter_id = 10;
        $lesson->name = 'How to Setup Environments';
        $lesson->description = 'Full Detail Description for Basics on envirnmenting require for Blender';
        $lesson->video_url = 'https://www.youtube.com/watch?v=obkR1uDtBVc';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 4;
        $lesson->chapter_id = 11;
        $lesson->name = 'Basic needs of Environments in Blender';
        $lesson->description = 'Full Detail Description for Environment';
        $lesson->video_url = 'https://www.youtube.com/watch?v=FalqUemTOo0';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 4;
        $lesson->chapter_id = 11;
        $lesson->name = 'The Complete 3d Environments for Blender';
        $lesson->description = 'Full Detail Description for Creatig Modeling for Blender';
        $lesson->video_url = 'https://www.youtube.com/watch?v=Xd-6G3g5HH4';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 4;
        $lesson->chapter_id = 12;
        $lesson->name = 'Creating 3D Realistic Forest';
        $lesson->description = 'Full Detail Description for Realistic Forest';
        $lesson->video_url = 'https://www.youtube.com/watch?v=qj96n0Bg_sw';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 4;
        $lesson->chapter_id = 12;
        $lesson->name = 'Made 3d Scenes in Blender';
        $lesson->description = 'Full Detail Description for 3D Scenes';
        $lesson->video_url = 'https://www.youtube.com/watch?v=H5Fk1w_JEfU';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        //Course 5
        $lesson = new Lesson();

        $lesson->course_id = 5;
        $lesson->chapter_id = 13;
        $lesson->name = 'Learning about Adobe XD Design';
        $lesson->description = 'Full Detail Description for Adobe X DEsing';
        $lesson->video_url = 'https://www.youtube.com/watch?v=ZeO13s5eY-s';
        $lesson->duration = '5H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 5;
        $lesson->chapter_id = 13;
        $lesson->name = 'How to Setup Environments';
        $lesson->description = 'Full Detail Description for Basics on envirnmenting require for UI UX Design';
        $lesson->video_url = 'https://www.youtube.com/watch?v=V2aaotz72cE';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 5;
        $lesson->chapter_id = 14;
        $lesson->name = 'What is UI UX Design';
        $lesson->description = 'Full Detail Description about UI UX Design';
        $lesson->video_url = 'https://www.youtube.com/watch?v=pg9nLNonrTM';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 5;
        $lesson->chapter_id = 14;
        $lesson->name = 'How to design an UI for Single Screen';
        $lesson->description = 'Full Detail Description for Designing a Single Screen ';
        $lesson->video_url = 'https://www.youtube.com/watch?v=DClndenewoQ';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 5;
        $lesson->chapter_id = 15;
        $lesson->name = 'Designing a UI for Mobile App';
        $lesson->description = 'Full Detail Description for Designing Moble App';
        $lesson->video_url = 'https://www.youtube.com/watch?v=d6xn5uflUjg';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 5;
        $lesson->chapter_id = 15;
        $lesson->name = 'Digning a Website';
        $lesson->description = 'Full Detail Description for Dsigning a Website';
        $lesson->video_url = 'https://www.youtube.com/watch?v=7KLvP3r2eGU';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 5;
        $lesson->chapter_id = 15;
        $lesson->quiz_id = 1;
        $lesson->is_lock = 1;
        $lesson->is_quiz = 1;
        $lesson->save();
        //Course 6
        $lesson = new Lesson();

        $lesson->course_id = 6;
        $lesson->chapter_id = 16;
        $lesson->name = 'Learning the Principles of UI Design';
        $lesson->description = 'Full Detail Description for Adobe X DEsing';
        $lesson->video_url = 'https://www.youtube.com/watch?v=RFv53AxxQAo';
        $lesson->duration = '5H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 6;
        $lesson->chapter_id = 16;
        $lesson->name = 'How to Setup Environments';
        $lesson->description = 'Full Detail Description for Basics on envirnmenting require for UI UX Design';
        $lesson->video_url = 'https://www.youtube.com/watch?v=V2aaotz72cE';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 6;
        $lesson->chapter_id = 17;
        $lesson->name = 'What is UI Design';
        $lesson->description = 'Full Detail Description about UI UX Design';
        $lesson->video_url = 'https://www.youtube.com/watch?v=pg9nLNonrTM';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 6;
        $lesson->chapter_id = 17;
        $lesson->name = 'How to design an UI for Single Screen';
        $lesson->description = 'Full Detail Description for Designing a Single Screen ';
        $lesson->video_url = 'https://www.youtube.com/watch?v=DClndenewoQ';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 6;
        $lesson->chapter_id = 18;
        $lesson->name = 'Designing a UI for Mobile App';
        $lesson->description = 'Full Detail Description for Designing Moble App';
        $lesson->video_url = 'https://www.youtube.com/watch?v=d6xn5uflUjg';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 6;
        $lesson->chapter_id = 18;
        $lesson->name = 'Digning a Website';
        $lesson->description = 'Full Detail Description for Dsigning a Website';
        $lesson->video_url = 'https://www.youtube.com/watch?v=7KLvP3r2eGU';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 6;
        $lesson->chapter_id = 18;
        $lesson->quiz_id = 1;
        $lesson->is_lock = 1;
        $lesson->is_quiz = 1;
        $lesson->save();
        //Course 7
        $lesson = new Lesson();

        $lesson->course_id = 7;
        $lesson->chapter_id = 19;
        $lesson->name = 'What is App Development';
        $lesson->description = 'Full Detail Description for App Develpments';
        $lesson->video_url = 'https://www.youtube.com/watch?v=JG7NShfSSJ4';
        $lesson->duration = '5H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 7;
        $lesson->chapter_id = 19;
        $lesson->name = 'Setup Environments for Develping an App';
        $lesson->description = 'Full Detail Description for Setup enironments for develping an app';
        $lesson->video_url = 'https://www.youtube.com/watch?v=-Uy7vuV_qPA';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 7;
        $lesson->chapter_id = 20;
        $lesson->name = 'if-else in Java';
        $lesson->description = 'Full Detail Description for If-else';
        $lesson->video_url = 'https://www.youtube.com/watch?v=MddtJbNvxMQ';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 7;
        $lesson->chapter_id = 20;
        $lesson->name = 'Nesting if-else';
        $lesson->description = 'Full Detail Description for nested if-else Creatig Modeling for Blender';
        $lesson->video_url = 'https://www.youtube.com/watch?v=Y4xFGCyt1ww';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 7;
        $lesson->chapter_id = 21;
        $lesson->name = 'All about loops (for,while,do-while)';
        $lesson->description = 'Full Detail Description for Loops';
        $lesson->video_url = 'https://www.youtube.com/watch?v=6djggrlkHY8';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 7;
        $lesson->chapter_id = 21;
        $lesson->name = 'Deploying and Testing App';
        $lesson->description = 'Full Detail Description for Deploying and Testing App';
        $lesson->video_url = 'https://www.youtube.com/watch?v=AYoAEoOoYFE';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 7;
        $lesson->chapter_id = 21;
        $lesson->quiz_id = 1;
        $lesson->is_lock = 1;
        $lesson->is_quiz = 1;
        $lesson->save();
        //Course 8
        $lesson = new Lesson();

        $lesson->course_id = 8;
        $lesson->chapter_id = 22;
        $lesson->name = 'What is App Development in iOS';
        $lesson->description = 'Full Detail Description for App Develpments';
        $lesson->video_url = 'https://www.youtube.com/watch?v=JG7NShfSSJ4';
        $lesson->duration = '5H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 8;
        $lesson->chapter_id = 22;
        $lesson->name = 'Setup Environments for Develping an iOS App';
        $lesson->description = 'Full Detail Description for Setup enironments for develping an app';
        $lesson->video_url = 'https://www.youtube.com/watch?v=-Uy7vuV_qPA';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 8;
        $lesson->chapter_id = 23;
        $lesson->name = 'if-else for programming handling app Conditions';
        $lesson->description = 'Full Detail Description for If-else';
        $lesson->video_url = 'https://www.youtube.com/watch?v=MddtJbNvxMQ';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 8;
        $lesson->chapter_id = 23;
        $lesson->name = 'Nesting if-else';
        $lesson->description = 'Full Detail Description for nested if-else Creatig Modeling for Blender';
        $lesson->video_url = 'https://www.youtube.com/watch?v=Y4xFGCyt1ww';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 8;
        $lesson->chapter_id = 24;
        $lesson->name = 'All about loops (for,while,do-while)';
        $lesson->description = 'Full Detail Description for Loops';
        $lesson->video_url = 'https://www.youtube.com/watch?v=6djggrlkHY8';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 8;
        $lesson->chapter_id = 24;
        $lesson->name = 'Deploying and Testing App';
        $lesson->description = 'Full Detail Description for Deploying and Testing App';
        $lesson->video_url = 'https://www.youtube.com/watch?v=AYoAEoOoYFE';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 8;
        $lesson->chapter_id = 24;
        $lesson->quiz_id = 1;
        $lesson->is_lock = 1;
        $lesson->is_quiz = 1;
        $lesson->save();
        //Course 9
        $lesson = new Lesson();

        $lesson->course_id = 9;
        $lesson->chapter_id = 25;
        $lesson->name = 'What is Web Development';
        $lesson->description = 'Full Detail Description for App Develpments';
        $lesson->video_url = 'https://www.youtube.com/watch?v=dcts_IQr1lo';
        $lesson->duration = '5H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 9;
        $lesson->chapter_id = 25;
        $lesson->name = 'Introduction to pyhton and Setup Environments';
        $lesson->description = 'Full Detail Description for Setup enironments for develping an app';
        $lesson->video_url = 'https://www.youtube.com/watch?v=hEgO047GxaQ';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 9;
        $lesson->chapter_id = 26;
        $lesson->name = 'if-else for programming handling Conditions';
        $lesson->description = 'Full Detail Description for If-else';
        $lesson->video_url = 'https://www.youtube.com/watch?v=PqFKRqpHrjw';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 9;
        $lesson->chapter_id = 26;
        $lesson->name = 'Nesting if-else';
        $lesson->description = 'Full Detail Description for nested if-else Creatig Modeling for Blender';
        $lesson->video_url = 'https://www.youtube.com/watch?v=rh3YeatqC_4';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 9;
        $lesson->chapter_id = 27;
        $lesson->name = 'All about loops (for,while,do-while)';
        $lesson->description = 'Full Detail Description for Loops';
        $lesson->video_url = 'https://www.youtube.com/watch?v=OnDr4J2UXSA';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 9;
        $lesson->chapter_id = 27;
        $lesson->name = 'Deploying and Testing App';
        $lesson->description = 'Full Detail Description for Deploying and Testing App';
        $lesson->video_url = 'https://www.youtube.com/watch?v=Rz886HkV1j4';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();


        $lesson = new Lesson();
        $lesson->course_id = 9;
        $lesson->chapter_id = 27;
        $lesson->quiz_id = 1;
        $lesson->is_lock = 1;
        $lesson->is_quiz = 1;
        $lesson->save();
        //Course 10
        $lesson = new Lesson();

        $lesson->course_id = 10;
        $lesson->chapter_id = 28;
        $lesson->name = 'What is Web Development';
        $lesson->description = 'Full Detail Description for App Develpments';
        $lesson->video_url = 'https://www.youtube.com/watch?v=dcts_IQr1lo';
        $lesson->duration = '5H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 10;
        $lesson->chapter_id = 28;
        $lesson->name = 'What is Laravel Setup Environments for Develping';
        $lesson->description = 'Full Detail Description for Setup enironments for develping an app';
        $lesson->video_url = 'https://www.youtube.com/watch?v=hEgO047GxaQ';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 10;
        $lesson->chapter_id = 29;
        $lesson->name = 'if-else for programming handling Conditions';
        $lesson->description = 'Full Detail Description for If-else';
        $lesson->video_url = 'https://www.youtube.com/watch?v=9taxtnYSvEU';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 10;
        $lesson->chapter_id = 29;
        $lesson->name = 'Nesting if-else';
        $lesson->description = 'Full Detail Description for nested if-else Creatig Modeling for Blender';
        $lesson->video_url = 'https://www.youtube.com/watch?v=iwTTEu1uTA8';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 10;
        $lesson->chapter_id = 30;
        $lesson->name = 'All about loops (for,while,do-while)';
        $lesson->description = 'Full Detail Description for Loops';
        $lesson->video_url = 'https://www.youtube.com/watch?v=H7frvcAHXps';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 1;

        $lesson->save();

        $lesson = new Lesson();
        $lesson->course_id = 10;
        $lesson->chapter_id = 30;
        $lesson->name = 'Deploying and Testing App';
        $lesson->description = 'Full Detail Description for Deploying and Testing App';
        $lesson->video_url = 'https://www.youtube.com/watch?v=Rz886HkV1j4';
        $lesson->duration = '3H';
        $lesson->host = 'Youtube';
        $lesson->is_lock = 0;

        $lesson->save();


        $lesson = new Lesson();
        $lesson->course_id = 10;
        $lesson->chapter_id = 30;
        $lesson->quiz_id = 1;
        $lesson->is_lock = 1;
        $lesson->is_quiz = 1;
        $lesson->save();


        for ($i = 1; $i <= 6; $i++) {
            LessonComplete::create([
                "course_id" => 1,
                'chapter_id' => 0,
                'lesson_id' => $i,
                'user_id' => 3,
                'status' => 1
            ]);
        }

    }
}
