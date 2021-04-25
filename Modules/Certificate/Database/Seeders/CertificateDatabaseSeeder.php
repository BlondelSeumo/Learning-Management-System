<?php

namespace Modules\Certificate\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Certificate\Entities\Certificate;

class CertificateDatabaseSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();
        Certificate::truncate();

        $certificate = new Certificate();
        $certificate->image = 'public/demo/certificate/certificate.png';

        $certificate->title = 'Certificate for Completing a Course';
        $certificate->title_position_x = 0;
        $certificate->title_position_y = 0;
        $certificate->title_font_family = 'nunito';
        $certificate->title_font_size = 30;
        $certificate->title_font_color = '#000';

        $certificate->body = 'This Certificate is awarded to [name]. For successfully completed [course]';
        $certificate->body_position_x = 0;
        $certificate->body_position_y = 0;
        $certificate->body_font_family = 'nunito';
        $certificate->body_font_size = 25;
        $certificate->body_font_color = '#000';
        $certificate->body_max_len = 75;

        $certificate->profile = 1;
        $certificate->profile_x = 0;
        $certificate->profile_y = 0;
        $certificate->profile_height = 120;
        $certificate->profile_weight = 120;

        $certificate->date = 1;
        $certificate->date_position_x = 0;
        $certificate->date_position_y = 0;
        $certificate->date_font_family = 'nunito';
        $certificate->date_font_size = 25;
        $certificate->date_font_color = '#000';
        $certificate->date_format = 1;

        $certificate->signature = 'public/demo/certificate/sign.png';
        $certificate->signature_position_x = 0;
        $certificate->signature_position_y = 0;
        $certificate->signature_height = 100;
        $certificate->signature_weight = 200;

        $certificate->signature_text = 'Administrator';
        $certificate->signature_text_position_x = 0;
        $certificate->signature_text_position_y = 0;
        $certificate->signature_text_font_family = 'nunito';
        $certificate->signature_text_font_size = 30;
        $certificate->signature_text_font_color = '#383CC1';

        $certificate->for_quiz = 0;
        $certificate->for_course = 1;
        $certificate->created_at = Carbon::now();
        $certificate->updated_at = Carbon::now();

        $certificate->save();

        $certificate = new Certificate();
        $certificate->image = 'public/demo/certificate/certificate1.png';

        $certificate->title = 'Certificate For Passed  The Quiz';
        $certificate->title_position_x = 0;
        $certificate->title_position_y = 0;
        $certificate->title_font_family = 'nunito';
        $certificate->title_font_size = 30;
        $certificate->title_font_color = '#000';

        $certificate->body = 'This Certificate is awarded to [name]. For successfully passed [course] quiz';
        $certificate->body_position_x = 0;
        $certificate->body_position_y = 0;
        $certificate->body_font_family = 'nunito';
        $certificate->body_font_size = 25;
        $certificate->body_font_color = '#000';
        $certificate->body_max_len = 75;

        $certificate->profile = 1;
        $certificate->profile_x = 0;
        $certificate->profile_y = 0;
        $certificate->profile_height = 120;
        $certificate->profile_weight = 120;

        $certificate->date = 1;
        $certificate->date_position_x = 0;
        $certificate->date_position_y = 0;
        $certificate->date_font_family = 'nunito';
        $certificate->date_font_size = 25;
        $certificate->date_font_color = '#000';
        $certificate->date_format = 1;

        $certificate->signature = 'public/demo/certificate/sign.png';
        $certificate->signature_position_x = 0;
        $certificate->signature_position_y = 0;
        $certificate->signature_height = 100;
        $certificate->signature_weight = 200;

        $certificate->signature_text = 'Administrator';
        $certificate->signature_text_position_x = 0;
        $certificate->signature_text_position_y = 0;
        $certificate->signature_text_font_family = 'nunito';
        $certificate->signature_text_font_size = 30;
        $certificate->signature_text_font_color = '#383CC1';

        $certificate->for_quiz = 1;
        $certificate->for_course = 0;
        $certificate->created_at = Carbon::now();
        $certificate->updated_at = Carbon::now();

        $certificate->save();
    }
}
