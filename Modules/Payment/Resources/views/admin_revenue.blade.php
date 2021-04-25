@extends('backend.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('payment.Admin Course Revenue List')}}</h1>
                <div class="bc-pages">
                    <a href="{{url('/dashboard')}}">{{__('common.Dashboard')}} </a>
                    <a href="#">{{__('quiz.Report')}} </a>
                    <a href="#">{{__('common.Dashboard')}}</a>
                </div>
            </div>
        </div>
    </section>
    @php
        $currency = getSetting()->currency;
    @endphp
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="col-lg-12 mt-60">
                <div class="box_header">
                    <div class="main-title d-md-flex mb-0">
                        <h3 class="mb-0">{{__('payment.Admin Course Revenue List')}}</h3>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <div class="QA_section QA_section_heading_custom check_box_table">
                <div class="QA_table ">
                    <!-- table-responsive -->
                    <div class="">
                        <table id="lms_table" class="table Crm_table_active3">
                            <thead>
                            <tr>
                                <th scope="col">{{__('courses.Course Title')}}</th>
                                <th scope="col">{{__('courses.Instructor')}}</th>
                                <th scope="col">{{__('courses.Price')}}</th>
                                <th scope="col">{{__('courses.Publish')}}</th>
                                <th scope="col">{{__('payment.Total')}} {{__('courses.Enrolled')}}</th>
                                <th scope="col">{{__('courses.Revenue')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td scope="row">
                                        {{@$course->title}}
                                    </td>
                                    <td>{{@$course->user->name}}</td>

                                    <td>

                                        {{getPriceFormat($course->purchasePrice)}}
                                    </td>
                                    <td>

                                        {{ date(getSetting()->date_format->format, strtotime(@$course->created_at??now())) }}
                                       </td>
                                    <td>{{@$course->enrolls_count}} </td>


                                    <td>
                                        <a href="{{route('admin.enrollLog',[@$course->id])}}" class="btn_1 light">

                                            {{$currency->symbol}} {{@$course->reveune ?  (@$course->purchasePrice - @$course->sumRev) * $currency->conversion_rate : 0}}
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
