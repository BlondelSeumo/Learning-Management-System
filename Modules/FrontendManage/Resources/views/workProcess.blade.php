@extends('backend.master')
@section('table')
    @php
        $table_name='work_processes'
    @endphp
    {{$table_name}}
@stop
@section('mainContent')


    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('frontendmanage.Become Instructor')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('frontendmanage.Frontend CMS')}}</a>
                    <a class="active"
                       href="{{url('frontend/becomeInstructor')}}">{{__('frontendmanage.Become Instructor')}}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center mt-50">

                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">  {{__('quiz.Topic')}} {{__('courses.List')}}</h3>

                            <ul class="d-flex">
                                <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" data-toggle="modal"
                                       data-target="#add_customer" href="#"><i
                                            class="ti-plus"></i>{{__('common.Add')}} {{__('quiz.Topic')}}</a></li>
                            </ul>

                        </div>

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.ID') }}</th>
                                        <th scope="col">{{__('common.Title')}}</th>
                                        <th scope="col">{{__('common.Description')}}</th>
                                        <th scope="col">{{ __('common.Status') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($works as $key => $work)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$work->title}}</td>
                                            <td>{!! $work->description !!}</td>
                                            <td>
                                                <label class="switch_toggle" for="active_checkbox{{@$work->id }}">
                                                    <input type="checkbox" class="status_enable_disable"
                                                           id="active_checkbox{{@$work->id }}"
                                                           @if (@$work->status == 1) checked
                                                           @endif value="{{@$work->id }}">
                                                    <i class="slider round"></i>
                                                </label>

                                            </td>
                                            <td>
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{__('common.Action')}}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2">
                                                        <a href="#" data-toggle="modal"
                                                           data-target="#editSetting{{@$work->id}}"
                                                           class="dropdown-item" type="button">{{__('common.Edit')}}</a>


                                                    </div>
                                                </div>

                                            </td>
                                        </tr>

                                        <div class="modal fade admin-query" id="editSetting{{@$work->id}}">
                                            <div class="modal-dialog modal_1000px modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{__('common.Edit')}}  </h4>
                                                        <button type="button" class="close " data-dismiss="modal">
                                                            <i class="ti-close "></i>
                                                        </button>
                                                    </div>
                                                    {{-- <input type="hidden" id="url" value="{{url('/')}}"> --}}
                                                    <div class="modal-body">
                                                        <form action="{{route('frontend.workProcessUpdate')}}"
                                                              method="POST"
                                                              enctype="multipart/form-data">

                                                            @csrf
                                                            <input name="id"
                                                                   value="{{@$work->id}}"

                                                                   type="hidden">
                                                            <div class="row">

                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for=""> {{__('common.Title')}} </label>
                                                                        <input class="primary_input_field" name="title"
                                                                               value="{{@$work->title}}"
                                                                               placeholder="-"
                                                                               type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for=""> {{__('common.Details')}} </label>
                                                                        <input class="primary_input_field"
                                                                               name="description"
                                                                               value="{{@$work->description}}"
                                                                               placeholder="-"
                                                                               type="text">
                                                                    </div>
                                                                </div>


                                                            </div>


                                                            <div class="col-lg-12 text-center pt_15">
                                                                <div class="d-flex justify-content-center">
                                                                    <button class="primary-btn semi_large2  fix-gr-bg"
                                                                            id="save_button_parent" type="submit"><i
                                                                            class="ti-check"></i> {{__('common.Update')}}
                                                                    </button>
                                                                </div>
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
                {{-- @dd(Auth::user()) --}}
                <div class="modal fade admin-query" id="add_customer">
                    <div class="modal-dialog modal_1000px modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{__('common.Add New')}} {{__('quiz.Topic')}}</h4>
                                <button type="button" class="close " data-dismiss="modal">
                                    <i class="ti-close "></i>
                                </button>
                            </div>
                            <input type="hidden" id="url" value="{{url('/')}}">
                            <div class="modal-body">
                                <form action="{{route('frontend.workProcessStore')}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{__('quiz.Topic')}} {{__('common.Title')}}</label>
                                                <input class="primary_input_field" name="title" placeholder="-"
                                                       type="text"
                                                       value="{{old('title')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">

                                            <input class="primary_input_field"
                                                   name="description"
                                                   value=""
                                                   placeholder="-"
                                                   type="text">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 text-center pt_15">
                                        <div class="d-flex justify-content-center">
                                            <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent"
                                                    type="submit"><i
                                                    class="ti-check"></i> {{__('common.Add') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

@endsection

