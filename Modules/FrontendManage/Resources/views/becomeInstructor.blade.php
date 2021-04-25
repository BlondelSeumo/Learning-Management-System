@extends('backend.master')
@section('table'){{__('testimonials')}}@endsection
@section('mainContent')
    @include("backend.partials.alertMessage")
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
            <div class="row justify-content-center">

                <div class="col-lg-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex mb-0">
                            <h3 class="mb-0">{{__('frontendmanage.Become Instructor')}} </h3>
                        </div>
                    </div>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.ID') }}</th>
                                        <th scope="col">{{__('common.Title')}}</th>
                                        <th scope="col">{{__('common.Description')}}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach($settings as $key => $setting)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$setting->section}}</td>
                                            <td>{{$setting->title}}</td>
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
                                                           data-target="#editSetting{{@$setting->id}}"
                                                           class="dropdown-item" type="button">{{__('common.Edit')}}</a>
                                                        @if($setting->id==6)
                                                            <a href="{{route('frontend.workProcess')}}"
                                                               class="dropdown-item"
                                                               type="button">{{__('setting.Manage')}}</a>
                                                        @endif

                                                    </div>
                                                </div>

                                            </td>
                                        </tr>

                                        <div class="modal fade admin-query" id="editSetting{{@$setting->id}}">
                                            <div class="modal-dialog modal_1000px modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{__('common.Edit')}}  </h4>
                                                        <button type="button" class="close " data-dismiss="modal">
                                                            <i class="ti-close "></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('frontend.becomeInstructorUpdate')}}"
                                                              method="POST"
                                                              enctype="multipart/form-data">

                                                            @csrf
                                                            <input name="id"
                                                                   value="{{@$setting->id}}"

                                                                   type="hidden">
                                                            <div class="row">

                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for=""> {{__('common.Title')}} </label>
                                                                        <input class="primary_input_field" name="title"
                                                                               value="{{@$setting->title}}"
                                                                               placeholder="-"
                                                                               type="text">
                                                                    </div>
                                                                </div>
                                                                @if($setting->id!=6)
                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for=""> {{__('common.Details')}} </label>
                                                                            <input class="primary_input_field"
                                                                                   name="description"
                                                                                   value="{{@$setting->description}}"
                                                                                   placeholder="-"
                                                                                   type="text">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if($setting->id==1 || $setting->id==2 ||$setting->id==3)
                                                                    <div class="col-xl-12">

                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for=""> {{__('frontendmanage.Icon')}} </label>
                                                                            <select name="icon" id="icon"
                                                                                    class="primary_select">
                                                                                <option value="{{$setting->icon}}"><i
                                                                                        class="{{$setting->icon}}"></i> {{$setting->icon}}
                                                                                </option>

                                                                                {!! returnList() !!}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                @if($setting->id==6)
                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for=""> {{__('courses.Image')}} </label>
                                                                            <div class="primary_file_uploader">
                                                                                <input class="primary-input" type="text"
                                                                                       id="placeholderFileOneName"
                                                                                       placeholder="{{__('frontendmanage.Browse Image')}}"
                                                                                       readonly="">
                                                                                <button class="" type="button">
                                                                                    <label
                                                                                        class="primary-btn small fix-gr-bg"
                                                                                        for="document_file_3_edit_{{@$setting->id}}">{{__('common.Browse') }}</label>
                                                                                    <input type="file" class="d-none"
                                                                                           name="image"
                                                                                           id="document_file_3_edit_{{@$setting->id}}">
                                                                                </button>


                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for=""> {{__('courses.Video URL')}} </label>
                                                                            <input class="primary_input_field"
                                                                                   name="video"
                                                                                   value="{{@$setting->video}}"
                                                                                   placeholder="{{__('frontendmanage.Youtube Video Link')}}"
                                                                                   type="text">
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                @if($setting->id==4 || $setting->id==5)
                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for=""> {{__('frontendmanage.Button Name')}} </label>
                                                                            <input class="primary_input_field"
                                                                                   name="btn_name"
                                                                                   value="{{@$setting->btn_name}}"
                                                                                   placeholder="Become instructor"
                                                                                   type="text">
                                                                        </div>
                                                                    </div>
                                                                @endif
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
            </div>
        </div>
    </section>

@endsection
@push('scripts')

@endpush
