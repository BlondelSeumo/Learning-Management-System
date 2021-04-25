<?php

use Illuminate\Database\Seeder;
use Modules\FrontendManage\Database\Seeders\FrontendManageDatabaseSeeder;
use Modules\ImageGallery\Database\Seeders\SeedImageGalleriesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            $this->call(UserSeeder::class);
            // $this->call(GeneralSettingSeeder::class);
            $this->call(\Modules\CourseSetting\Database\Seeders\CourseSettingDatabaseSeeder::class);
            $this->call(\Modules\SystemSetting\Database\Seeders\SystemSettingDatabaseSeeder::class);
            $this->call(\Modules\Payment\Database\Seeders\PaymentDatabaseSeeder::class);
            $this->call(SeedImageGalleriesTableSeeder::class);
            $this->call(FrontendManageDatabaseSeeder::class);
            $this->call(\Modules\Quiz\Database\Seeders\QuizDatabaseSeeder::class);
            $this->call(\Modules\Blog\Database\Seeders\BlogDatabaseSeeder::class);
            $this->call(\Modules\VirtualClass\Database\Seeders\VirtualClassDatabaseSeeder::class);
            $this->call(\Modules\Certificate\Database\Seeders\CertificateDatabaseSeeder::class);
    }
}
