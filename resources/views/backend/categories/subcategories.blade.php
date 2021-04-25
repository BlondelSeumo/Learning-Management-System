@extends('backend.master')
@php
    $table_name='sub_categories';
@endphp
@section('table'){{$table_name}}@endsection
@section('mainContent')
    @include("backend.partials.alertMessage")

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('courses.Subcategory List')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('courses.Course')}}</a>
                    <a class="active" href="{{route('course.subcategory')}}">{{__('courses.Subcategory')}}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"> @if(!isset($edit)) {{__('courses.Add New Subcategory') }} @else {{__('courses.Update Subcategory')}} @endif</h3>
                        </div>
                    </div>
                    <div class="white-box mb_30">
                        @if (isset($edit))
                            <form action="{{route('course.subcategory.update')}}" method="POST" id="category-form"
                                  name="category-form" enctype="multipart/form-data">
                                <input type="hidden" name="id"
                                       value="{{@$edit->id}}">
                                @else
                                    @if (permissionCheck('course.subcategory.store'))
                                        <form action="{{route('course.subcategory.store') }}" method="POST"
                                              id="category-form" name="category-form" enctype="multipart/form-data">
                                            @endif
                                            @endif

                                            @csrf

                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="category_id">{{ __('courses.Category') }} <strong
                                                                class="text-danger">*</strong></label>
                                                        <select class="primary_select mb-25" name="category_id"
                                                                id="category_id">
                                                            @foreach ($categories as $key => $cat)
                                                                <option
                                                                    value="{{ @$cat->id }}" {{isset($edit)?(@$edit->category->id == @$cat->id?'selected':''):''}} >{{ @$cat->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="nameInput">{{ __('common.Name') }} <strong
                                                                class="text-danger">*</strong></label>
                                                        <input name="name" id="nameInput"
                                                               class="primary_input_field name {{ @$errors->has('name') ? ' is-invalid' : '' }}"
                                                               placeholder="{{ __('common.Name') }}" type="text"
                                                               value="{{isset($edit)?@$edit->name:old('name')}}">
                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('name') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 d-none">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="show_home">{{ __('course.Show on home page') }}</label>
                                                        <select class="primary_select mb-25" name="show_home"
                                                                id="show_home">
                                                            <option value="1"
                                                                    {{isset($edit)?(@$edit->show_home==1?'selected':''):''}} selected>{{__('Yes') }}</option>
                                                            <option
                                                                value="0" {{isset($edit)?(@$edit->show_home==0?'selected':''):''}}>{{__('No') }}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="position_order">{{ __('courses.Position Order') }}</label>
                                                        <select class="primary_select mb-25" name="position_order"
                                                                id="position_order">
                                                            @for($i=1; $i<=10; $i++)
                                                                <option
                                                                    value="{{ $i }}" {{isset($edit)?(@$edit->position_order==$i?'selected':old('position_order')):old('position_order')}} > {{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="status">{{ __('courses.Status') }}</label>
                                                        <select class="primary_select mb-25" name="status" id="status"
                                                        >
                                                            <option
                                                                value="1" {{isset($edit)?(@$edit->status==1?'selected':''):''}}>{{__('common.Active') }}</option>
                                                            <option
                                                                value="0" {{isset($edit)?(@$edit->status==0?'selected':''):''}}>{{__('common.Inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-lg-12 d-none">
                                                    <div class="primary_input mb-15">
                                                        <label class="primary_input_label"
                                                               for="placeholderFileOneName">{{ __('courses.Image') }}</label>
                                                        <div class="primary_file_uploader">
                                                            <input class="primary-input" type="text"
                                                                   id="placeholderFileOneName"
                                                                   placeholder="{{__('student.Browse Image file')}}"
                                                                   readonly="">
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="document_file_1">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none" name="photo"
                                                                       id="document_file_1">
                                                            </button>
                                                        </div>
                                                        @if ($errors->has('photo'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('photo') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                    <p class="image_size">{{__('courses.Recommended size 200px x 200px')}}</p>
                                                </div>
                                                @php
                                                    $tooltip = "";
                                                    if(permissionCheck('course.subcategory.store')){
                                                          $tooltip = "";
                                                      }else{
                                                          $tooltip = trans('courses.You have no permission to add');
                                                      }
                                                @endphp
                                                <div class="col-lg-12 text-center">
                                                    <div class="d-flex justify-content-center pt_20">
                                                        <button type="submit" class="primary-btn semi_large fix-gr-bg"
                                                                data-toggle="tooltip" title="{{@$tooltip}}"
                                                                id="save_button_parent">
                                                            <i class="ti-check"></i>
                                                            @if(!isset($edit)) {{ __('common.Save') }} @else {{ __('common.Update') }} @endif
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0">{{__('courses.Subcategory List')}}</h3>
                        </div>
                    </div>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.ID') }}</th>
                                        <th scope="col">{{ __('common.Name') }}</th>
                                        <th scope="col">{{ __('common.Category') }} {{ __('common.Name') }}</th>
                                        <th scope="col">{{ __('common.Status') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sub_categories as $key => $sub_category)
                                        <tr>
                                            <th class="m-2">{{ $key+1 }}</th>
                                            <td>{{@$sub_category->name }}</td>
                                            <td>{{@$sub_category->category->name }}</td>


                                            <td class="nowrap">
                                                <label class="switch_toggle" for="active_checkbox{{@$sub_category->id }}">
                                                    <input type="checkbox"
                                                           class="@if (permissionCheck('course.subcategory.status_update'))  status_enable_disable @endif "
                                                           id="active_checkbox{{@$sub_category->id }}"
                                                           @if (@$sub_category->status == 1) checked
                                                           @endif value="{{@$sub_category->id }}">
                                                    <i class="slider round"></i>
                                                </label>
                                            </td>

                                            <td>
                                                <!-- shortby  -->
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu1{{ @$sub_category->id }}"
                                                            data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu1{{ @$sub_category->id }}">
                                                        @if (permissionCheck('course.subcategory.edit'))
                                                            <a class="dropdown-item edit_brand"
                                                               href="{{route('course.subcategory.edit',@$sub_category->id)}}">{{__('common.Edit')}}</a>
                                                        @endif
                                                        @if (permissionCheck('course.subcategory.delete'))
                                                            <a onclick="confirm_modal('{{route('course.subcategory.delete', @$sub_category->id)}}');"
                                                               class="dropdown-item edit_brand">{{__('common.Delete')}}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- shortby  -->
                                            </td>
                                        </tr>
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
    <div id="edit_form">

    </div>
    <div id="view_details">

    </div>
    <input type="hidden" name="status_route" class="status_route"
           value="{{ route('course.subcategory.status_update') }}">

    @include('backend.partials.delete_modal')
@endsection
@push('scripts')
    <script src="{{asset('public/backend/js/category.js')}}"></script>
@endpush
