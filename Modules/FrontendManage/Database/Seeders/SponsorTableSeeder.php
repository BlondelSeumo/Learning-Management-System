<?php

namespace Modules\FrontendManage\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\FrontendManage\Entities\Sponsor;

class SponsorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sponsor::truncate();

        $titles = ['Burgers', 'CitaDel', 'Eagle', 'Eye of Wood', 'Landscape', 'Originals'];

        foreach ($titles as $key => $title) {
            $name = $key + 1;
            $sponsor = new Sponsor();
            $sponsor->title = $title;
            $sponsor->image = 'public/demo/brand/' . $name . '.png';
            $sponsor->save();
        }
    }
}
