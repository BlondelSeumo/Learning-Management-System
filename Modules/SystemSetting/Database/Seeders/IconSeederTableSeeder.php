<?php

namespace Modules\SystemSetting\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\SystemSetting\Entities\SocialLink;

class IconSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        SocialLink::insert([
            'icon' => 'fab fa-gitlab',
            'name' => 'Gitlab',
            'link' => 'https://gitlab.com',
        ]);

        SocialLink::insert([
            'icon' => 'fab fa-facebook-square',
            'name' => 'Facebook',
            'link' => 'https://facebook.com',
        ]);

        SocialLink::insert([
            'icon' => 'fab fa-youtube',
            'name' => 'Youtube',
            'link' => 'https://youtube.com',
        ]);

        SocialLink::insert([
            'icon' => 'fab fa-twitter-square',
            'name' => 'Twitter',
            'link' => 'https://twitter.com',
        ]);

        SocialLink::insert([
            'icon' => 'fab fa-linkedin',
            'name' => 'Linkedin',
            'link' => 'https://linkedin.com',
        ]);
    }
}
