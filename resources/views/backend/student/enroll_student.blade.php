@extends('backend.master')
@php
    $table_name='course_enrolleds';
@endphp
@section('table'){{$table_name}}@stop

@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>{{__('student.Enrolled Student')}}</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                <a href="#">{{__('student.Students')}}</a>
                <a href="#">{{__('student.Enrolled Student')}}</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center mt-50">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="white_box_tittle list_header">
                        <h4>{{__('student.Filter Enroll History')}}</h4>
                    </div>
                    <form action="{{route('admin.enrollFilter')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-3 col-md-3 col-lg-3">
                                <div class="primary_input ">
                                    <label class="primary_input_label"
                                           for="courseSelect">{{__('common.Select')}} {{__('courses.Course')}}</label>
                                </div>
                                <select class="primary_select" name="course" id="courseSelect">
                                    <option data-display="{{__('common.Select')}} {{__('courses.Course')}}"
                                            value="">{{__('common.Select')}} {{__('courses.Course')}}</option>
                                    @foreach($courses as $course)
                                        <option
                                            value="{{$course->id}}" {{isset($courseId)?$courseId==$course->id?'selected':'':''}}>{{@$course->title}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xl-3 col-md-3 col-lg-3">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label"
                                           for="startDate">{{__('common.Select')}} {{__('common.Start Date')}}</label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="{{__('common.Date')}}"
                                                           class="primary_input_field primary-input date form-control"
                                                           id="startDate" type="text" name="start_date"
                                                           value="{{isset($start)?!empty($start)?date('m/d/Y', strtotime($start)):'':''}}"
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

                            <div class="col-xl-3 col-lg-3">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label"
                                           for="admissionDate">{{__('common.Select')}} {{__('common.End Date')}}</label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="{{__('common.Date')}}"
                                                           class="primary_input_field primary-input date form-control"
                                                           id="admissionDate" type="text" name="end_date"
                                                           value="{{isset($end)?!empty($end)?date('m/d/Y', strtotime($end)):'':''}}"
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
                            <div class="col-md-3 col-xl-3 mt-30">
                                <div class="search_course_btn text-center">
                                    <button type="submit"
                                            class="primary-btn radius_30px mr-10 fix-gr-bg">{{__('common.Filter History')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12">
                <div class="box_header common_table_header">
                    <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('student.Enrolled Student')}} {{__('common.List')}}</h3>

                    </div>

                </div>
            </div>
            <div class="col-lg-12">
                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">

                        <div class="">
                            <table id="lms_table" class="table Crm_table_active3">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('common.SL')}} </th>
                                    <th scope="col">{{__('common.Image')}} </th>
                                    <th scope="col">{{__('common.Name')}} </th>
                                    <th scope="col">{{__('common.Email Address')}} </th>
                                    <th scope="col">{{__('courses.Courses')}} {{__('courses.Enrolled')}}</th>
                                    <th scope="col">{{__('courses.Enrollment')}} {{__('common.Date')}} </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($enrolls as $key => $enroll)

                                    <tr>

                                        <th>{{$key+1}}</th>

                                        <td>
                                            <div class="profile_info">
                                                <img src="{{asset($enroll->user->image)}}"
                                                     alt="{{@$enroll->user->name}}'s image">
                                            </div>
                                        </td>
                                        <td>{{@$enroll->user->name}}</td>
                                        <td>{{@$enroll->user->email}}</td>
                                        <td>{{@$enroll->course->title}}</td>
                                        <td>{{@$enroll->course->dateFormat}}</td>


                                    </tr>

                                    <div class="modal fade admin-query" id="rejectEnroll{{@$enroll->id}}">
                                        <div class="modal-dialog modal_1000px modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('common.Reject')}} {{__('courses.Enrollment')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"><i
                                                            class="ti-close "></i></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="{{route('rejectEnroll')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{@$enroll->id}}">
                                                        <input type="hidden" name="user_id"
                                                               value="{{@$enroll->user_id}}">
                                                        <div class="form-group">
                                                            <label
                                                                for="">{{__('common.Reject')}} {{__('common.Reason')}}
                                                                *</label>
                                                            <textarea name="reason" class="lms_summernote" id=""
                                                                      placeholder="{{__('student.Reject Reason')}}"
                                                                      cols="30" rows="10"></textarea>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                            <button class="primary-btn fix-gr-bg"
                                                                    type="submit">{{__('common.Reject')}}</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade admin-query" id="enableEnroll{{@$enroll->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('common.Enable')}} {{__('courses.Enrollment')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"><i
                                                            class="ti-close "></i></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="{{route('enableEnroll')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{@$enroll->id}}">
                                                        <input type="hidden" name="user_id"
                                                               value="{{@$enroll->user_id}}">
                                                        <div class="text-center">
                                                            <h4>{{__('common.Are you sure to enable this ?')}}</h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                            <button class="primary-btn fix-gr-bg"
                                                                    type="submit">{{__('common.Enable')}}</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Modal Item_Details -->
        </div>
    </div>
</section>

@endsection
