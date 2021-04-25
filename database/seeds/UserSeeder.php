<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->role_id = 2;
        $user->name = 'Teacher';
        $user->image = 'public/demo/user/' . 'instructor.jpg';
        $user->email = 'teacher@infixedu.com';
        $user->username = 'teacher@infixedu.com';
        $user->headline = 'IT Specialist';
        $user->phone = '01711223345';
        $user->about = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
        $user->short_details = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";

        $user->email_verified_at = now();
        $user->password = Hash::make('12345678');
        $user->created_at = date('Y-m-d h:i:s');
        $user->referral = Str::random(10);
        $user->about = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
        $user->save();

        $user = new User();
        $user->role_id = 3;
        $user->name = 'Student';
        $user->email = 'student@infixedu.com';
        $user->username = 'student@infixedu.com';
        $user->headline = 'Student';
        $user->phone = '01711223346';
        $user->balance = 500;
        $user->about = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
        $user->short_details = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";

        $user->email_verified_at = now();
        $user->password = Hash::make('12345678');
        $user->created_at = date('Y-m-d h:i:s');
        $user->referral = Str::random(10);
        $user->save();


        \App\User::insert(
            ['name' => 'Robert Pattinson',
                'username' => 'instructor2',
                'role_id' => '2',
                'email' => 'instructor2@infixedu.com',
                'password' => bcrypt('12345678'),
                'email_verify' => 1,
                'email_verified_at' => now(),

                'currency_id' => 1,
                'headline' => 'Founder & CEO',
                'referral' => Str::random(10),
                'image' => 'public/demo/user/' . 'instructor1.jpg',
                'about' => 'Hi! This is Deniel. When you sign up, you’ll immediately have unlimited viewing of thousands of expert courses, paths to guide your learning, tools to measure your skills and hands-on resources like exercise files. There’s no limit on what you can learn and you can cancel at any time components, and storage devices. Finally, you’ll examine which printing technology addresses various needs and you’ll learn how to configure a multi-function printing device.',
            ]
        );

        \App\User::insert(

            ['name' => 'Johnny Depp',
                'username' => 'instructor3',
                'role_id' => '2',
                'email_verified_at' => now(),
                'email' => 'instructor3@infixedu.com',
                'password' => bcrypt('12345678'),
                'email_verify' => 1,
                'currency_id' => 1,
                'headline' => 'Account Officer',
                'referral' => Str::random(10),
                'image' => 'public/demo/user/' . 'instructor3.jpg',
                'about' => 'Hi! This is Deniel. When you sign up, you’ll immediately have unlimited viewing of thousands of expert courses, paths to guide your learning, tools to measure your skills and hands-on resources like exercise files. There’s no limit on what you can learn and you can cancel at any time components, and storage devices. Finally, you’ll examine which printing technology addresses various needs and you’ll learn how to configure a multi-function printing device.',
            ],

        );


        \App\User::insert(
            ['name' => 'Bradley Cooper',
                'username' => 'instructor4',
                'role_id' => '2',
                'email_verified_at' => now(),
                'email' => 'instructor4@infixedu.com',
                'password' => bcrypt('12345678'),
                'email_verify' => 1,
                'currency_id' => 1,
                'headline' => 'Creative Director',
                'referral' => Str::random(10),
                'image' => 'public/demo/user/' . 'instructor4.jpg',
                'about' => 'Hi! This is Deniel. When you sign up, you’ll immediately have unlimited viewing of thousands of expert courses, paths to guide your learning, tools to measure your skills and hands-on resources like exercise files. There’s no limit on what you can learn and you can cancel at any time components, and storage devices. Finally, you’ll examine which printing technology addresses various needs and you’ll learn how to configure a multi-function printing device.',
            ],
        );


        \App\User::insert(['name' => 'Carlie Jhovis',
            'username' => 'student2',
            'role_id' => '3',
            'email_verified_at' => now(),
            'email' => 'student2@infixedu.com',
            'password' => bcrypt('12345678'),
            'email_verify' => 1,
            'currency_id' => 1,
            'referral' => Str::random(10),
            'image' => 'public/demo/user/' . 'user.jpg',
            'about' => 'Hi! This is Deniel. When you sign up, you’ll immediately have unlimited viewing of thousands of expert courses, paths to guide your learning, tools to measure your skills and hands-on resources like exercise files. There’s no limit on what you can learn and you can cancel at any time components, and storage devices. Finally, you’ll examine which printing technology addresses various needs and you’ll learn how to configure a multi-function printing device.',
        ]);
    }
}
