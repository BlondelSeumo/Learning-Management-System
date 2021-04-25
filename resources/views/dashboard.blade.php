@extends('backend.master')

@section('mainContent')
    @include("backend.partials.alertMessage")
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include("backend.partials.alertMessage")

    @php
        $currency = getSetting()->currency;
    @endphp
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-0">@lang('common.Welcome') @lang('common.To') - {{getSetting()->site_title}}
                        | {{@Auth::user()->role->name}}</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

            @if (permissionCheck('dashboard.number_of_student'))
                <div class="col-md-3">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>{{__('student.Students')}}</h3>
                                    <p class="mb-0">{{__('student.Number of Students')}}</p>
                                </div>
                                <h1 class="gradient-color2"> {{@$info['student']}}
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif


            @if (permissionCheck('dashboard.number_of_instructor'))
                <div class="col-md-3">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>{{__('quiz.Instructor')}}</h3>
                                    <p class="mb-0">{{__('quiz.Number of Instructor')}}</p>
                                </div>
                                <h1 class="gradient-color2"> {{@$info['instructor']}}
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if (permissionCheck('dashboard.number_of_subject'))
                <div class="col-md-3">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>{{__('dashboard.Subjects')}}</h3>
                                    <p class="mb-0">{{__('dashboard.Number of Subjects')}}</p>
                                </div>
                                <h1 class="gradient-color2"> {{@$info['allCourse']}}
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            @if (permissionCheck('dashboard.number_of_enrolled'))
                <div class="col-md-3">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>{{__('dashboard.Enrolled')}}</h3>
                                    <p class="mb-0">{{__('dashboard.Number of Enrolled')}}</p>
                                </div>
                                <h1 class="gradient-color2"> {{@$info['totalEnroll']}}
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            @if (permissionCheck('dashboard.total_amount_from_enrolled'))
                <div class="col-md-3">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>{{__('dashboard.Enrolled Amount')}}</h3>
                                    <p class="mb-0">{{__('dashboard.Total Enrolled Amount')}}</p>
                                </div>
                                <h1 class="gradient-color2"> {{$currency->symbol. getPriceWithConversion($info['totalSell']??0)}}
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            @if (permissionCheck('dashboard.total_revenue'))
                <div class="col-md-3">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>{{__('courses.Revenue')}}</h3>
                                    <p class="mb-0">{{__('courses.Total Revenue')}}</p>
                                </div>
                                <h1 class="gradient-color2">{{$currency->symbol.getPriceWithConversion($info['adminRev']??0)}}
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if (permissionCheck('dashboard.total_enrolled_today'))
                <div class="col-md-3">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>{{__('dashboard.Enrolled Today')}}</h3>
                                    <p class="mb-0">{{__('dashboard.Total Enrolled Today')}}</p>
                                </div>
                                <h1 class="gradient-color2">{{$currency->symbol.getPriceWithConversion($info['today']??0)}}
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if (permissionCheck('dashboard.total_enrolled_this_month'))
                <div class="col-md-3">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>{{__('dashboard.This Month')}}</h3>
                                    <p class="mb-0">{{__('dashboard.Total Enrolled This Month')}}</p>
                                </div>
                                <h1 class="gradient-color2">{{$currency->symbol.getPriceWithConversion(@$info['thisMonthEnroll']??0)}}
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <div class="container-fluid">
                <div class="row justify-content-center">
                    @if (permissionCheck('dashboard.monthly_income'))
                        <div class="col-lg-6">
                            <div class="white_box chart_box mt_30">
                                <h4>{{__('dashboard.Monthly Income Stats for')}} {{date('Y')}}</h4>
                                <div class="">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <canvas id="myChart" width="400" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (permissionCheck('dashboard.payment_statistic'))
                        <div class="col-lg-6">
                            <div class="white_box chart_box mt_30">
                                <h4>{{__('dashboard.Payment Statistics for')}} {{\Carbon\Carbon::now()->format('F')}}</h4>
                                <div class="">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="payment_statistics" width="400" height="400"></canvas>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @if (permissionCheck('dashboard.recent_enrolls'))
                <div class="col-lg-8">
                    <div class="white_box QA_section mt_30">
                        <div class="white_box_tittle list_header">
                            <h4>{{__('dashboard.Recent Enrolls')}}</h4>
                        </div>
                        <div class="table-responsive QA_table">
                            <table class="table lms_table_active">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('courses.Course Title')}}</th>
                                    <th scope="col">{{__('courses.Instructor')}}</th>
                                    <th scope="col">{{__('common.Email Address')}}</th>
                                    <th scope="col">{{__('courses.Recent Enrolls')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($info['recentEnroll'] as $key =>$enroll)

                                    <tr>
                                        <th scope="row"><a target="_blank"
                                                           href="{{route('courseDetailsView',[@$enroll->course->id,@$enroll->course->slug])}}"
                                                           class="question_content">{{@$enroll->course->title}}
                                            </a>
                                        </th>
                                        <td>{{@$enroll->course->user->name}}</td>
                                        <td>{{@$enroll->user->email}}</td>
                                        <td>
                                            @if (getPriceWithConversion($enroll->reveune??0))
                                                {{$currency->symbol}} {{getPriceWithConversion((@$enroll->purchase_price - @$enroll->reveune)??0)}}
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            @if (permissionCheck('dashboard.overview_of_courses'))
                <div class="col-lg-4">
                    <div class="white_box chart_box mt_30">
                        <h4>{{__('dashboard.Status Overview of Topics')}}</h4>
                        <div class="">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <canvas id="course_overview" width="400" height="400"></canvas>
                    </div>

                    <div class="white_box chart_box mt_30">
                        <h4>{{__('dashboard.Overview of Topics')}}</h4>
                        <div class="">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                        </div>
                        <canvas id="course_overview2" width="400" height="400"></canvas>
                    </div>
                </div>
            @endif
        </div>
        @if (permissionCheck('dashboard.daily_wise_enroll'))
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_box chart_box mt_30">
                        <h4>{{__('dashboard.Daily Wise Enroll Status for')}} {{\Carbon\Carbon::now()->format('F')}}</h4>
                        <div class="">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="enroll_overview" width="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@push('scripts')
    <script src="{{asset('public/backend/vendors/chartlist/Chart.min.js')}}"></script>
    <script>
        var ctx = document.getElementById('course_overview').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['{{__('dashboard.Active')}}', '{{__('dashboard.Pending')}}'],
                datasets: [{
                    label: '{{__('Status Overview of Topics')}}',
                    data: [{{$course_overview['active']}}, {{$course_overview['pending']}}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'

                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


        var ctx = document.getElementById('course_overview2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['{{__('dashboard.Courses')}}', '{{__('dashboard.Quizzes')}}','{{__('dashboard.Classes')}}'],
                datasets: [{
                    label: '{{__('Overview of Topics')}}',
                    data: [{{$course_overview['courses']}}, {{$course_overview['quizzes']}}, {{$course_overview['classes']}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 159, 64, 0.2)'

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


        var ctx = document.getElementById('payment_statistics').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['{{__('dashboard.Completed')}}', '{{__('dashboard.Pending')}}'],
                datasets: [{
                    label: '{{__('dashboard.Payment Statistics for')}} {{@$payment_statistics['month']}}',
                    data: [{{$payment_statistics['paid']->count()}}, {{$payment_statistics['unpaid']->count()}}],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var enroll_day = [];
        <?php foreach($enroll_day as $key => $val){ ?>
        enroll_day.push('<?php echo $val; ?>');
        <?php } ?>

        var enroll_count = [];
        <?php foreach($enroll_count as $key => $val){ ?>
        enroll_count.push('<?php echo $val; ?>');
        <?php } ?>

        var ctx = document.getElementById('enroll_overview').getContext('2d');
        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {

                labels: enroll_day,
                datasets: [{
                    label: '{{__('dashboard.Daily Wise Enroll Status for')}} {{\Carbon\Carbon::now()->format('F')}}',
                    data: enroll_count,
                    backgroundColor: 'rgba(124, 50, 255, 0.5)',
                    borderColor: 'rgba(124, 50, 255, 0.5)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var month_name = [];
        <?php foreach($courshEarningM_onth_name as $key => $val){ ?>
        month_name.push('<?php echo $val; ?>');
        <?php } ?>

        var monthly_earn = [];
        <?php foreach($courshEarningMonthly as $key => $val){ ?>
        monthly_earn.push('<?php echo $val; ?>');
        <?php } ?>

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {

                labels: month_name,
                datasets: [{
                    label: '{{__('dashboard.Monthly Income Stats for')}} {{@$payment_statistics['month']}}' + new Date().getFullYear(),
                    data: monthly_earn,
                    backgroundColor: 'rgba(124, 50, 255, 0.5)',
                    borderColor: 'rgba(124, 50, 255, 0.5)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endpush
