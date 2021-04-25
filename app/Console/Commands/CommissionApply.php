<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\CourseSetting\Entities\CourseEnrolled;
use Modules\Subscription\Entities\SubscriptionCourse;
use Modules\Subscription\Entities\SubscriptionSetting;

class CommissionApply extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apply:commission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'commission apply into instructors';

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
        $commission_rate = SubscriptionSetting::first()->commission_rate ?? 0;

        $checkouts = DB::table('subscription_checkouts')
            ->where('end_date', '<', date('Y-m-d'))
            ->get();

        foreach ($checkouts as $checkout) {
            $totalAmount = $checkout->price;

            $instructorAmount = ($commission_rate / 100) * $totalAmount;

            $enrolls = CourseEnrolled::where('user_id', $checkout->user_id)->where('subscription_validity_date', $checkout->end_date)->get();

            foreach ($enrolls as $enroll) {

                if ($enroll->course->user->role_id == 2) {
                    $course = new SubscriptionCourse();
                    $course->user_id = $enroll->user_id;
                    $course->instructor_id = $enroll->course->user_id;
                    $course->course_id = $enroll->course_id;
                    $course->revenue = ($instructorAmount / count($enrolls)) ?? 0;
                    $course->checkout_id = $checkout->id;
                    $course->date = date('Y-m-d');
                    $course->status = 0;
                    $course->save();
                }

                $enroll->subscription_validity_date = null;
                $enroll->save();
            }
        }

        return 0;
    }
}
