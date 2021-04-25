@extends('backend.master')
@php
    $table_name='course_enrolleds';
$currency = getSetting()->currency;

@endphp
@section('table'){{$table_name}}@stop
@section('mainContent')


    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('courses.Instructor')}} {{__('courses.Course')}} {{__('courses.Revenue')}} </h1>
                <div class="bc-pages">
                    <a href="{{url('/dashboard')}}">{{__('common.Dashboard')}} </a>
                    <a href="#">{{__('quiz.Report')}} </a>
                    <a href="#">{{__('courses.Instructor')}} {{__('courses.Course')}} {{__('courses.Revenue')}}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-lg-12">
                    <div class="white_box mb_30">
                        <div class="white_box_tittle list_header">
                            <h4>{{__('courses.Advanced Filter')}} </h4>
                        </div>
                        <form action="" method="GET">

                            <div class="row">
                                @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)

                                    <div class="col-lg-4 mt-30">

                                        <label class="primary_input_label"
                                               for="instructor">{{__('courses.Instructor')}}</label>
                                        <select class="primary_select" name="instructor" id="instructor">
                                            <option data-display="{{__('common.Select')}} {{__('courses.Instructor')}}"
                                                    value="">{{__('common.Select')}} {{__('courses.Instructor')}}</option>
                                            @foreach($instructors as $instructor)
                                                <option {{$search_instructor==$instructor->id?'selected':''}}
                                                        value="{{$instructor->id}}">{{@$instructor->name}} </option>
                                            @endforeach
                                        </select>

                                    </div>
                                @endif
                                <div class="col-lg-4 mt-30 ">
                                    <label class="primary_input_label" for="month">{{__('courses.Month')}}</label>
                                    <select class="primary_select" name="month" id="month">
                                        <option data-display="{{__('common.Select')}} {{__('courses.Month')}}"
                                                value="">{{__('common.Select')}} {{__('courses.Month')}}</option>
                                        @php
                                            $formattedMonthArray = array(
                              "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                              "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                              "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                          );
                                        @endphp
                                        @foreach($formattedMonthArray as $key=>$month)

                                            <option
                                                {{$search_month==$month?'selected':''}} value="{{$key}}">{{$month}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-lg-4 mt-30">

                                    <label class="primary_input_label" for="publish">{{__('courses.Year')}}</label>
                                    <select class="primary_select" name="publish" id="publish">

                                        @php
                                            $starting_year  =date('Y');
                                            $ending_year = date('Y', strtotime('-10 year'));
                                            $yearArray = range($starting_year,$ending_year);
                                            $current_year = date('Y');
                                            foreach ($yearArray as $year) {
                                            echo '<option value="'.$year.'"';
                                            if ($search_year==$year){
                                                    echo ' selected="selected"';
                                            }
                                            elseif( $year ==  $current_year ) {
                                            echo ' selected="selected"';
                                            }
                                            echo ' >'.$year.'</option>';
                                            }
                                        @endphp
                                    </select>

                                </div>

                                @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                                    <div class="col-12 mt-20">
                                        @else
                                            <div class="col-lg-4 float-right mt-30">
                                                <label class="primary_input_label pt-4"
                                                       style="    margin-top: 5px;"> </label>

                                                @endif


                                                <div
                                                    class="search_course_btn  @if(\Illuminate\Support\Facades\Auth::user()->role_id==1) text-right @endif">

                                                    <button type="submit"
                                                            class="primary-btn radius_30px mr-10 fix-gr-bg">{{__('courses.Filter')}} </button>
                                                </div>
                                            </div>
                                    </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-40 mb-25">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">{{__('courses.Instructor')}} {{__('courses.Course')}} {{__('courses.Revenue')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <div class="QA_section QA_section_heading_custom check_box_table mt-30">
                <div class="QA_table ">
                    <table id="lms_table" class="table Crm_table_active3">
                        <thead>
                        <tr>
                            <th scope="col">{{__('report.Purchase ID')}}</th>
                            <th scope="col"><span class="m-2">{{__('courses.Course Title')}}</span></th>
                            <th scope="col">{{__('courses.Enrollment')}} {{__('certificate.Date')}}</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                                <th scope="col">{{__('courses.Instructor')}} </th>
                            @endif
                            <th scope="col">{{__('courses.Purchase')}} {{__('courses.By')}} </th>
                            <th scope="col">{{__('courses.Purchase')}} {{__('courses.Price')}}</th>
                            <th scope="col">{{__('courses.Instructor')}} {{__('courses.Revenue')}}</th>

                        </tr>
                        </thead>

                        <tbody>
                        @if(moduleStatusCheck('Subscription'))
                            @foreach($subscriptions as $subscription)

                                <tr>
                                    <td>S-{{@$subscription['checkout_id']+1000}}</td>
                                    <td>
                                        <span class="m-2">
                                            <strong>Subscription - </strong>
                                            {{@$subscription['plan']}}</span>
                                    </td>
                                    <td>
                                        {{ date(getSetting()->date_format->format, strtotime(@$subscription['date'] )) }}
                                    </td>


                                    @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                                        <td>{{@$subscription->instructor}}</td>
                                    @endif

                                    <td></td>
                                    <td></td>
                                    <td>{{$currency->symbol}} {{$subscription['price']}}</td>


                                </tr>
                            @endforeach
                        @endif

                        @foreach($enrolls as $enroll)
                            <tr>
                                <td>C-{{@$enroll->id+1000}}</td>
                                <td>
                                    <span class="m-2"> {{@$enroll->course->title}}</span>
                                </td>
                                <td>
                                    {{ date(getSetting()->date_format->format, strtotime(@$enroll->created_at )) }}
                                </td>


                                @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                                    <td>{{@$enroll->course->user->name}}</td>
                                @endif

                                <td>{{@$enroll->user->name}}</td>
                                <td>{{$currency->symbol}} {{@$enroll->purchase_price}}</td>
                                <td>{{$currency->symbol}} {{@$enroll->reveune}}</td>
                                {{--                            <td>--}}
                                {{--                                @if ($enroll->status == 1)--}}

                                {{--                                    <span class="primary-btn small fix-gr-bg">{{__('withdraw.Approved')}}</span>--}}
                                {{--                                @else--}}
                                {{--                                    <span class="primary-btn small fix-gr-bg">{{__('withdraw.Rejected')}}</span>--}}
                                {{--                                @endif--}}
                                {{--                            </td>--}}


                            </tr>


                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>


@endsection
