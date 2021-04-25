<?php

namespace Modules\CourseSetting\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrolledTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

//        for ($i = 1; $i <= 7; $i++) {
//            CourseEnrolled::insert([
//                'user_id' => 3,
//                'course_id' => $i,
//                'purchase_price' => $i + 20,
//                'coupon' => 'Vel',
//                'discount_amount' => 10,
//                'status' => 1,
//                'reveune' => 2,
//                'created_at' => now(),
//                'updated_at' => now()
//            ]);
//        }

        DB::statement("INSERT INTO `checkouts` (`id`, `tracking`, `user_id`, `billing_detail_id`, `package_id`, `coupon_id`, `discount`, `purchase_price`, `price`, `status`, `payment_method`, `response`, `created_at`, `updated_at`) VALUES
(1, 'K3USKPJBC5U8', 3, 1, NULL, NULL, 0.00, 0.00, 0.00, 1, 'None', NULL, now(),now()),
(2, '765A3UJ7B4ZM', 3, 1, NULL, NULL, 0.00, 100.00, 100.00, 1, 'None', NULL, now(), now()),
(3, '765A3UJ7B11M', 3, 2, NULL, NULL, 0.00, 0.00, 0.00, 1, 'None', NULL, now(), now());
");

        DB::statement("INSERT INTO `course_enrolleds` ( `tracking`, `user_id`, `course_id`, `purchase_price`, `coupon`, `discount_amount`, `status`, `reveune`, `reason`, `created_at`, `updated_at`) VALUES
( 'K3USKPJBC5U8', 3, 1, 0.00, NULL, 0.00, 1, 0.00, NULL,now(), now()),
( '765A3UJ7B4ZM', 3, 2, 20.00, NULL, 10.00, 1, 2.00, NULL, now(),now()),
( '765A3UJ7B4ZM', 3, 3, 20.00, NULL, 10.00, 1, 2.00, NULL, now(),now()),
( '765A3UJ7B4ZM', 3, 4, 20.00, NULL, 10.00, 1, 2.00, NULL, now(),now()),
( '765A3UJ7B4ZM', 3, 5, 20.00, NULL, 10.00, 1, 2.00, NULL, now(),now()),
( '765A3UJ7B4ZM', 3, 6, 20.00, NULL, 10.00, 1, 2.00, NULL, now(),now()),
( '765A3UJ7B11M', 3, 12, 0.00, NULL, 0.00, 1, 0.00, NULL, now(),now()),
( '765A3UJ7B11M', 3, 13, 0.00, NULL, 0.00, 1, 0.00, NULL, now(),now()),
( '765A3UJ7B11M', 3, 14, 0.00, NULL, 0.00, 1, 0.00, NULL, now(),now())
;");

        DB::Statement("INSERT INTO `billing_details` (`id`, `tracking_id`, `user_id`, `first_name`, `last_name`, `company_name`, `country`, `address1`, `address2`, `city`, `zip_code`, `phone`, `email`, `details`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 'K3USKPJBC5U8', 3, 'Student', '', 'Spondon IT', '19', 'Dhaka', '', 'Dhaka', '1200', '01723442233', 'student@infixedu.com', 'add here additional info.', NULL,now(), now()),
(2, '765A3UJ7B11M', 3, 'Student', '', 'Spondon IT', '19', 'Dhaka', '', 'Dhaka', '1200', '01723442233', 'student@infixedu.com', 'add here additional info.', NULL,now(), now())
");
    }
}
