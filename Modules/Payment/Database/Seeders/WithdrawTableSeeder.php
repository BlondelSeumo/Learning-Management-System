<?php

namespace Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Payment\Entities\Withdraw;

class WithdrawTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        for ($i = 1;$i<=12;$i++){
            Withdraw::insert([
                'instructor_id' => 2,
                'amount' => 10,
                'status' => 1,
                'method' => 'Stripe',
                'issueDate' => date('Y-m-d H:i:s', mktime(0, 0, 0, $i, 1)),
                'created_at' => date('Y-m-d H:i:s', mktime(0, 0, 0, $i, 1)),
                'updated_at' => date('Y-m-d H:i:s', mktime(0, 0, 0, $i, 1))
            ]);
        }
    }
}
