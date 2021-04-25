<?php

namespace Modules\CourseSetting\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\CourseSetting\Entities\Course;

class CourseSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

//        1
        Course::insert([
            'title' => 'Managerial Accounting Advance Course',
            'slug' => Str::slug('Managerial Accounting'),
            'duration' => '5H',
            'publish' => 1,
            'level' => 2,
            'trailer_link' => 'https://www.youtube.com/watch?v=mlqWUqVZrHA',
            'host' => 'Youtube',
            'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'status' => 1,
            'category_id' => 1,
            'subcategory_id' => 1,
            'user_id' => 1,
            'price' => 20,
            'discount_price' => 10,
            'lang_id' => 19,
            'reveiw' => 0,
            'total_enrolled' => 1,
            'reveune' => '50',
            'image' => 'public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg',
        ]);
//Course 2
        Course::insert([
            'title' => 'An Entire MBA in 1 Course:Award Winning Course',
            'slug' => Str::slug('An Entire MBA in 1 Course:Award Winning Business School Prof'),
            'duration' => '5H',
            'publish' => 1,
            'level' => 2,
            'trailer_link' => 'https://www.youtube.com/watch?v=mlqWUqVZrHA',
            'host' => 'Youtube',
            'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'status' => 1,
            'category_id' => 1,
            'subcategory_id' => 2,
            'user_id' => 2,
            'price' => 20,
            'discount_price' => 10,
            'lang_id' => 19,
            'reveiw' => 0,
            'total_enrolled' => 1,
            'reveune' => '50',
            'image' => 'public/frontend/infixlmstheme/img/course/' . '2.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '2.' . 'jpg',
        ]);
//Course 3
        Course::insert([
            'title' => 'Complete Blender Creator:3D Modelling for Beginners',
            'slug' => Str::slug('Complete Blender Creator: Learn 3D Modelling for Beginners'),
            'duration' => '5H',
            'publish' => 1,
            'level' => 2,
            'trailer_link' => 'https://www.youtube.com/watch?v=mlqWUqVZrHA',
            'host' => 'Youtube',
            'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'status' => 1,
            'category_id' => 2,
            'subcategory_id' => 3,
            'user_id' => 2,
            'price' => 20,
            'discount_price' => 10,
            'lang_id' => 19,
            'reveiw' => 0,
            'total_enrolled' => 1,
            'reveune' => '50',
            'image' => 'public/frontend/infixlmstheme/img/course/' . '3.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '3.' . 'jpg',
        ]);

//        Course 4
        Course::insert([
            'title' => 'Creating 3D environments in Blender',
            'slug' => Str::slug('Creating 3D environments in Blender'),
            'duration' => '5H',
            'publish' => 1,
            'level' => 2,
            'trailer_link' => 'https://www.youtube.com/watch?v=mlqWUqVZrHA',
            'host' => 'Youtube',
            'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'status' => 1,
            'category_id' => 2,
            'subcategory_id' => 4,
            'user_id' => 2,
            'price' => 20,
            'discount_price' => 10,
            'lang_id' => 19,
            'reveiw' => 0,
            'total_enrolled' => 1,
            'reveune' => '50',
            'image' => 'public/frontend/infixlmstheme/img/course/' . '4.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '4.' . 'jpg',
        ]);
//Course 5
        Course::insert([
            'title' => 'Adobe XD Design Essentials - UI UX Design',
            'slug' => Str::slug('Creating 3D environments in Blender'),
            'duration' => '5H',
            'publish' => 1,
            'level' => 2,
            'trailer_link' => 'https://www.youtube.com/watch?v=mlqWUqVZrHA',
            'host' => 'Youtube',
            'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'status' => 1,
            'category_id' => 3,
            'subcategory_id' => 5,
            'user_id' => 2,
            'price' => 20,
            'discount_price' => 10,
            'lang_id' => 19,
            'reveiw' => 0,
            'total_enrolled' => 1,
            'reveune' => '50',
            'image' => 'public/frontend/infixlmstheme/img/course/' . '5.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '5.' . 'jpg',
        ]);
//        Course 6
        Course::insert([
            'title' => 'WEB Design: Using HTML & CSS',
            'slug' => Str::slug('DESIGN RULES: Principles Practices for Great UI Design'),
            'duration' => '5H',
            'publish' => 1,
            'level' => 2,
            'trailer_link' => 'https://www.youtube.com/watch?v=mlqWUqVZrHA',
            'host' => 'Youtube',
            'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'status' => 1,
            'category_id' => 3,
            'subcategory_id' => 6,
            'user_id' => 2,
            'price' => 20,
            'discount_price' => 10,
            'lang_id' => 19,
            'reveiw' => 0,
            'total_enrolled' => 1,
            'reveune' => '50',
            'image' => 'public/frontend/infixlmstheme/img/course/' . '6.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '6.' . 'jpg',
        ]);

        //        Course 7
        Course::insert([
            'title' => 'Introduction to Programming and App Development',
            'slug' => Str::slug('Introduction to Programming and App Development'),
            'duration' => '5H',
            'publish' => 1,
            'level' => 2,
            'trailer_link' => 'https://www.youtube.com/watch?v=mlqWUqVZrHA',
            'host' => 'Youtube',
            'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'status' => 1,
            'category_id' => 4,
            'subcategory_id' => 7,
            'user_id' => 2,
            'price' => 20,
            'discount_price' => 10,
            'lang_id' => 19,
            'reveiw' => 0,
            'total_enrolled' => 1,
            'reveune' => '50',
            'image' => 'public/frontend/infixlmstheme/img/course/' . '7.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '7.' . 'jpg',
        ]);

        //Course 8
        Course::insert([
            'title' => 'The Complete iOS 11 & Swift Developer Course',
            'slug' => Str::slug('The Complete iOS 11 & Swift Developer Course'),
            'duration' => '5H',
            'publish' => 1,
            'level' => 2,
            'trailer_link' => 'https://www.youtube.com/watch?v=mlqWUqVZrHA',
            'host' => 'Youtube',
            'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'status' => 1,
            'category_id' => 4,
            'subcategory_id' => 8,
            'user_id' => 1,
            'price' => 20,
            'discount_price' => 10,
            'lang_id' => 19,
            'reveiw' => 0,
            'total_enrolled' => 1,
            'reveune' => '50',
            'image' => 'public/frontend/infixlmstheme/img/course/' . '8.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '8.' . 'jpg',
        ]);

        //        Course 9
        Course::insert([
            'title' => 'Complete Python Developer in 2020: Zero to Mastery',
            'slug' => Str::slug('Complete Python Developer in 2020'),
            'duration' => '5H',
            'publish' => 1,
            'level' => 2,
            'trailer_link' => 'https://www.youtube.com/watch?v=mlqWUqVZrHA',
            'host' => 'Youtube',
            'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'status' => 1,
            'category_id' => 5,
            'subcategory_id' => 9,
            'user_id' => 1,
            'price' => 20,
            'discount_price' => 10,
            'lang_id' => 19,
            'reveiw' => 0,
            'total_enrolled' => 1,
            'reveune' => '50',
            'image' => 'public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg',
        ]);

        Course::insert([
            'title' => 'Master Laravel PHP with basic to advanced project',
            'slug' => Str::slug('Master Laravel PHP with basic to advanced project'),
            'duration' => '5H',
            'publish' => 1,
            'level' => 2,
            'trailer_link' => 'https://www.youtube.com/watch?v=mlqWUqVZrHA',
            'host' => 'Youtube',
            'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'status' => 1,
            'category_id' => 5,
            'subcategory_id' => 10,
            'user_id' => 1,
            'price' => 20,
            'discount_price' => 10,
            'lang_id' => 19,
            'reveiw' => 0,
            'total_enrolled' => 1,
            'reveune' => '50',
            'image' => 'public/frontend/infixlmstheme/img/course/' . '3.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '3.' . 'jpg',
        ]);
        Course::insert([
            'title' => 'Master On RectJS with basic to advanced project',
            'slug' => Str::slug('Master On RectJS with basic to advanced project'),
            'duration' => '5H',
            'publish' => 1,
            'level' => 2,
            'trailer_link' => 'https://www.youtube.com/watch?v=mlqWUqVZrHA',
            'host' => 'Youtube',
            'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',
            'status' => 0,
            'category_id' => 5,
            'subcategory_id' => 10,
            'user_id' => 1,
            'price' => 20,
            'discount_price' => 10,
            'lang_id' => 19,
            'reveiw' => 0,
            'total_enrolled' => 1,
            'reveune' => '50',
            'image' => 'public/frontend/infixlmstheme/img/course/' . '9.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '9.' . 'jpg',
        ]);

        Course::insert([
            'quiz_id' => 1,
            'user_id' => 1,
            'lang_id' => 19,
            'price' => 20,
            'title' => 'Quiz for Php',
            'slug' => Str::slug('Quiz for Php'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg',
            'type' => 2,
        ]);

        Course::insert([
            'quiz_id' => 2,
            'user_id' => 1,
            'lang_id' => 19,
            'price' => 20,
            'title' => 'Quiz for Python',
            'slug' => Str::slug('Quiz for Python'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '2.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '2.' . 'jpg',
            'type' => 2,
        ]);
        Course::insert([
            'quiz_id' => 3,
            'user_id' => 1,
            'lang_id' => 19,
            'title' => 'Quiz for HTML',
            'slug' => Str::slug('Quiz for HTML'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '3.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '3.' . 'jpg',
            'type' => 2,
        ]);


        Course::insert([
            'quiz_id' => 1,
            'user_id' => 1,
            'lang_id' => 19,
            'price' => 20,
            'title' => 'Quiz for CSS',
            'slug' => Str::slug('Quiz for CSS'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '4.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '4.' . 'jpg',
            'type' => 2,
        ]);

        Course::insert([
            'quiz_id' => 2,
            'user_id' => 1,
            'lang_id' => 19,
            'price' => 20,
            'title' => 'Quiz for JQuery',
            'slug' => Str::slug('Quiz for jQuery'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '5.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '5.' . 'jpg',
            'type' => 2,
        ]);
        Course::insert([
            'quiz_id' => 3,
            'user_id' => 1,
            'lang_id' => 19,
            'title' => 'Quiz for Laravel',
            'slug' => Str::slug('Quiz for Laravel'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '6.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '6.' . 'jpg',
            'type' => 2,
        ]);


        Course::insert([
            'quiz_id' => 1,
            'user_id' => 1,
            'lang_id' => 19,
            'price' => 20,
            'title' => 'Quiz for Asp.net',
            'slug' => Str::slug('Quiz for Asp.net'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '7.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '8.' . 'jpg',
            'type' => 2,
        ]);

        Course::insert([
            'quiz_id' => 2,
            'user_id' => 1,
            'lang_id' => 19,
            'price' => 20,
            'title' => 'Quiz for AutoCad',
            'slug' => Str::slug('Quiz for Autocad'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg',
            'type' => 2,
        ]);
        Course::insert([
            'quiz_id' => 3,
            'user_id' => 1,
            'lang_id' => 19,
            'title' => 'Quiz for MBA',
            'slug' => Str::slug('Quiz for Photoshop'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '2.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '2.' . 'jpg',
            'type' => 2,
        ]);


        Course::insert([
            'quiz_id' => 1,
            'user_id' => 1,
            'lang_id' => 19,
            'price' => 20,
            'title' => 'Quiz for Vue.JS',
            'slug' => Str::slug('Quiz for Vue.JS'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '3.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '3.' . 'jpg',
            'type' => 2,
        ]);

        Course::insert([
            'quiz_id' => 2,
            'user_id' => 1,
            'lang_id' => 19,
            'price' => 20,
            'title' => 'Quiz for React',
            'slug' => Str::slug('Quiz for React'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '4.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '4.' . 'jpg',
            'type' => 2,
        ]);
        Course::insert([
            'quiz_id' => 3,
            'user_id' => 1,
            'lang_id' => 19,
            'title' => 'Quiz for Bootstrap',
            'slug' => Str::slug('Quiz for Bootstrap'),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '5.' . 'jpg',
            'thumbnail' => 'public/frontend/infixlmstheme/img/course/' . '5.' . 'jpg',
            'type' => 2,
        ]);


        $course = new Course();
        $course->class_id = 1;
        $course->user_id = 1;
        $course->lang_id = 1;
        $course->price = 30;
        $course->title = "Online Class for Mastering in Laravel";
        $course->slug = Str::slug("Online Class for Mastering in Laravel");
        $course->image = 'public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg';
        $course->thumbnail = 'public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg';
        $course->type = 3;
        $course->save();

        $course = new Course();
        $course->class_id = 2;
        $course->user_id = 1;
        $course->lang_id = 1;
        $course->title = "Online Class for Mastering in Accounting";
        $course->slug = Str::slug("Online Class for Mastering in Accounting");
        $course->image ='public/frontend/infixlmstheme/img/course/' . '2.' . 'jpg';
        $course->thumbnail ='public/frontend/infixlmstheme/img/course/' . '2.' . 'jpg';
        $course->type = 3;
        $course->save();

        $course = new Course();
        $course->class_id = 1;
        $course->user_id = 1;
        $course->lang_id = 1;
        $course->price = 30;
        $course->title = "Online Class for Mastering in PHP";
        $course->slug = Str::slug("Online Class for Mastering in PHP");
        $course->image = 'public/frontend/infixlmstheme/img/course/' . '3.' . 'jpg';
        $course->thumbnail = 'public/frontend/infixlmstheme/img/course/' . '3.' . 'jpg';
        $course->type = 3;
        $course->save();

        $course = new Course();
        $course->class_id = 2;
        $course->user_id = 1;
        $course->lang_id = 1;
        $course->title = "Online Class for Mastering in jQuery";
        $course->slug = Str::slug("Online Class for Mastering in jQuery");
        $course->image = 'public/frontend/infixlmstheme/img/course/' . '4.' . 'jpg';
        $course->thumbnail ='public/frontend/infixlmstheme/img/course/' . '4.' . 'jpg';
        $course->type = 3;
        $course->save();


        $course = new Course();
        $course->class_id = 1;
        $course->user_id = 1;
        $course->lang_id = 1;
        $course->price = 30;
        $course->title = "Online Class for Mastering in HTML";
        $course->slug = Str::slug("Online Class for Mastering in HTML");
        $course->image ='public/frontend/infixlmstheme/img/course/' . '5.' . 'jpg';
        $course->thumbnail = 'public/frontend/infixlmstheme/img/course/' . '5.' . 'jpg';
        $course->type = 3;
        $course->save();

        $course = new Course();
        $course->class_id = 2;
        $course->user_id = 1;
        $course->lang_id = 1;
        $course->title = "Online Class for Mastering in CSS";
        $course->slug = Str::slug("Online Class for Mastering in CSS");
        $course->image = 'public/frontend/infixlmstheme/img/course/' . '6.' . 'jpg';
        $course->thumbnail = 'public/frontend/infixlmstheme/img/course/' . '6.' . 'jpg';
        $course->type = 3;
        $course->save();


        $course = new Course();
        $course->class_id = 1;
        $course->user_id = 1;
        $course->lang_id = 1;
        $course->price = 30;
        $course->title = "Online Class for Mastering in MYSQL";
        $course->slug = Str::slug("Online Class for Mastering in MYSQL");
        $course->image = 'public/frontend/infixlmstheme/img/course/' . '7.' . 'jpg';
        $course->thumbnail ='public/frontend/infixlmstheme/img/course/' . '7.' . 'jpg';
        $course->type = 3;
        $course->save();

        $course = new Course();
        $course->class_id = 2;
        $course->user_id = 1;
        $course->lang_id = 1;
        $course->title = "Online Class for Mastering in ASP.Net";
        $course->slug = Str::slug("Online Class for Mastering in ASP.Net");
        $course->image ='public/frontend/infixlmstheme/img/course/' . '8.' . 'jpg';
        $course->thumbnail = 'public/frontend/infixlmstheme/img/course/' . '8.' . 'jpg';
        $course->type = 3;
        $course->save();

        $course = new Course();
        $course->class_id = 1;
        $course->user_id = 1;
        $course->lang_id = 1;
        $course->price = 30;
        $course->title = "Online Class for Mastering in Python";
        $course->slug = Str::slug("Online Class for Mastering in Python");
        $course->image ='public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg';
        $course->thumbnail = 'public/demo/course/image/' . '1.' . 'png';
        $course->type = 3;
        $course->save();

        $course = new Course();
        $course->class_id = 2;
        $course->user_id = 1;
        $course->lang_id = 1;
        $course->title = "Online Class for Mastering in Photoshop";
        $course->slug = Str::slug("Online Class for Mastering in Photoshop");
        $course->image = 'public/frontend/infixlmstheme/img/course/' . '2.' . 'jpg';
        $course->thumbnail = 'public/frontend/infixlmstheme/img/course/' . '2.' . 'jpg';
        $course->type = 3;
        $course->save();

    }
}
