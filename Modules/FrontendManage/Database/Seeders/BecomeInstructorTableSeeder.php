<?php

namespace Modules\FrontendManage\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\FrontendManage\Entities\BecomeInstructor;

class BecomeInstructorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

     /*   BecomeInstructor::truncate();

        $data = [
            [1, 'icon_left', 'Join our Community', 'When you sign up, you’ll immediately have unlimited viewing of thousands of expert courses.'],
            [2, 'icon_mid', 'Share your Knowledge', 'If you sign up, you’ll immediately have unlimited viewing of thousands of expert courses.'],
            [3, 'icon_right', 'Earn Money', 'Let you sign up, you’ll immediately have unlimited viewing of thousands of expert courses.'],
            [4, 'joining_part', 'We are now 5983+ Community around the world and growing up', 'Operating system, and statistical information about how you use our products and services. We only collect, track and analyze such information in an aggregate manner that does not personally identify you. Read the section on Use on Cookies to know how we collect aggregate data.'],
            [5, 'cta_part', 'Ready to become an instructor?', 'Top instructors from around the world teach millions of students on Infix about peripherals that add functionality to a system.'],
            [5, 'How it Works', 'When you sign up, you’ll immediately have unlimited viewing of thousands of expert courses.', ''],
        ];

        foreach ($data as $key => $row) {
            $setting = new BecomeInstructor();

            if ($key == 0)
                $setting->icon = 'fas fa-handshake';
            if ($key == 1)
                $setting->icon = 'fas fa-chalkboard-teacher';
            if ($key == 2)
                $setting->icon = 'fas fa-money-bill-alt';

            if ($key == 5)
                $setting->image = 'public/demo/become_instructor/1.png';

            $setting->section = $row[1];
            $setting->title = $row[2];
            $setting->description = $row[3];

            $setting->save();
        }*/
    }
}
