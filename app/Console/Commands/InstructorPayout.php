<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Modules\CourseSetting\Entities\CourseEnrolled;
use Modules\Payment\Entities\Withdraw;

class InstructorPayout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payout:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instructor Payout on Monthly Basis';

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
      /*  $oldMonth = Carbon::now(env('TIME_ZONE'))->subMonths(1) ;
        $monthlyData =  $monthlyData =  CourseEnrolled::leftJoin('courses','courses.id','course_enrolleds.course_id')
            ->whereMonth('course_enrolleds.created_at',  Carbon::now(env('TIME_ZONE'))->subMonths(1))->groupBy('courses.user_id')
            ->selectRaw('sum(course_enrolleds.reveune) as revSum,course_enrolleds.course_id, courses.user_id as instructor_id')
            ->get();
//        $users = User::all();

        if( $monthlyData){
            foreach($monthlyData as $data){
                Withdraw::updateOrCreate(
                    [
                        'instructor_id' => $data->instructor_id,
                        'amount' => (number_format($data->revSum,2)),
                        'status' => 0 ,
                        'method' => User::find($data->instructor_id)->payout ?? 'Paypal',
                        'issueDate' => Carbon::now()->format('Y-m-d')
                    ]
                );
            }
        }
        $this->info('Successfully sent daily quote to everyone.');*/
    }
}
