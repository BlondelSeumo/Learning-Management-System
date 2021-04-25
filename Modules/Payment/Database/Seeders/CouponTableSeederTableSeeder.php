<?php

namespace Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Coupons\Entities\Coupon;
use Illuminate\Database\Eloquent\Model;

class CouponTableSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        for ($i = 1; $i <= 2; $i++) {
            Coupon::insert([
                'user_id' => $i,
                'title' => 'First Coupon',
                'code' => 'save10',
                'type' => 1,
                'status' => 1,
                'value' => 10,
                'min_purchase' => 9,
                'max_discount' => 2,
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d', strtotime(date('Y-m-d') . " +7 days")),
            ]);
        }
    }
}
