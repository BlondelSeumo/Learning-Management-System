@extends('backend.master')
@php
    $table_name='checkouts';
@endphp
@section('table'){{$table_name}}@stop
@section('mainContent')

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('payment.Admin Course Revenue List')}}</h1>
                <div class="bc-pages">
                    <a href="{{url('/dashboard')}}">{{__('common.Dashboard')}} </a>
                    <a href="#">{{__('report.Report')}} </a>
                    <a href="#">{{__('report.Admin Revenue')}}</a>
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
                        <form action="{{route('admin.sortByDiscount',[$course_id])}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{@$course_id}}">
                            <div class="row">
                                <div class="col-lg-4 mt-30">
                                    <select class="primary_select" name="discount" id="">
                                        <option data-display="{{__('common.Select')}} {{__('payment.Discount')}}"
                                                value="">{{__('common.Select')}} {{__('payment.Discount')}}</option>
                                        <option
                                            value="10" {{isset($_POST['discount'])?$_POST['discount']==10?'selected':'':''}}>
                                            {{__('report.With Discount')}}
                                        </option>
                                        <option
                                            value="11" {{isset($_POST['discount'])?$_POST['discount']==11?'selected':'':''}}>
                                            {{__('report.Without Discount')}}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-xl-4 col-md-4 col-lg-4">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="">{{__('report.Start Date')}}</label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                        <input placeholder="{{__('common.Date')}}"
                                                               class="primary_input_field primary-input date form-control"
                                                               id="startDate" type="text" name="start_date"
                                                               value="{{isset($_POST['start_date'])? $_POST['start_date']:''}}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="">{{__('report.End Date')}}</label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                        <input placeholder="{{__('common.Date')}}"
                                                               class="primary_input_field primary-input date form-control"
                                                               id="admissionDate" type="text" name="end_date"
                                                               value="{{isset($_POST['end_date'])? $_POST['end_date']:''}}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="admission-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-20">
                                    <div class="search_course_btn text-right">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="QA_section QA_section_heading_custom check_box_table mt-30">
                <div class="QA_table ">


                    <table id="lms_table" class="table Crm_table_active3">
                        <thead>
                        <tr>
                            <th scope="col">{{__('report.Purchase ID')}}</th>
                            <th scope="col">{{__('report.Enrolled Student')}}</th>
                            <th scope="col"> {{__('report.Price   ')}}</th>
                            <th scope="col">{{__('report.Revenue')}}</th>
                            <th scope="col">{{__('report.Discount')}}</th>
                            <th scope="col">{{__('report.Enrolled Date')}}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($logs as $log)

                            <tr>
                                <th scope="row">{{@$log->id+1000}}</th>

                                <th scope="row">{{@$log->user->name}}</th>

                                <td>
                                    {{getPriceFormat($log->purchase_price)}}
                                </td>
                                <td>   {{getPriceFormat(@$log->purchase_price - @$log->reveune)}} </td>
                                <td>
                                    @if($log->discount_amount!=0)
                                        {{getPriceFormat(@$log->discount_amount)}}
                                    @endif
                                </td>

                                <td>
                                    {{ date(getSetting()->date_format->format, strtotime(@$log->created_at??now())) }}
                                </td>
                            </tr>


                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>


@endsection
