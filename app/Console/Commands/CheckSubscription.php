<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user subscription date will expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('users')
            ->where('subscription_validity_date', '<', date('Y-m-d'))
            ->update(['subscription_validity_date' => null]);

//        DB::table('course_enrolleds')
//            ->where('subscription_validity_date', '<', date('Y-m-d'))
//            ->update(['subscription_validity_date' => null]);

        return 0;
    }
}
