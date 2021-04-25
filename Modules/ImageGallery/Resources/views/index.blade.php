@extends('backend.master')


@section('table')

    @php
        $table_name='image_galleries';
    @endphp
    {{$table_name}}@stop
@section('mainContent')

    @include("backend.partials.alertMessage")
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('imagegallery.Image Gallery')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('imagegallery.Manage Gallery')}}</a>
                    <a class="active" href="{{route('imagegallery.list')}}">{{__('imagegallery.Image Gallery')}}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="box_header common_table_header">
                                <div class="main-title d-md-flex">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"> @if(!isset($edit)) {{__('imagegallery.Add New Image') }} @else {{__('imagegallery.Update Image')}} @endif</h3>
                                    @if(isset($edit))
                                        @if (permissionCheck('imagegallery.store'))
                                            <a href="{{route('imagegallery.list')}}"
                                               class="primary-btn small fix-gr-bg updateBtn"
                                               title=" {{__('imagegallery.Add')}}">+</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white-box ">
                        @if (isset($edit))
                            <form action="{{route('imagegallery.update')}}" method="POST" id="coupon-form"
                                  name="coupon-form" enctype="multipart/form-data">
                                @else
                                    @if(permissionCheck('imagegallery.store'))
                                        <form action="{{route('imagegallery.store') }}" method="POST" id="coupon-form"
                                              name="coupon-form" enctype="multipart/form-data">
                                            @endif
                                            @endif
                                            @csrf
                                            @if(isset($edit)) <input type="hidden" name="id"
                                                                     value="{{$edit->id}}"> @endif
                                            <input type="hidden" name="category" value="1">
                                            <div class="row">


                                                <div class="col-lg-12">
                                                    <div class="primary_input mb-15">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('imagegallery.Image') }} <strong
                                                                class="text-danger">*</strong></label>
                                                        <div class="primary_file_uploader">
                                                            <input
                                                                class="filePlaceholder primary-input  {{ @$errors->has('image') ? ' is-invalid' : '' }}"
                                                                type="text" id=""
                                                                placeholder="{{__('common.Browse')}}" readonly="">
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="document_file_1">{{ __('common.Browse') }}</label>
                                                                <input type="file" class="d-none fileUpload" name="image"
                                                                       id="document_file_1">
                                                            </button>
                                                        </div>
                                                        @if ($errors->has('image'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('image') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('imagegallery.Title') }} <strong
                                                                class="text-danger">*</strong></label>
                                                        <input name="title" id="title"
                                                               class="primary_input_field name {{ @$errors->has('title') ? ' is-invalid' : '' }}"
                                                               placeholder="{{ __('imagegallery.Title') }}" type="text"
                                                               value="{{isset($edit)?$edit->title:old('title')}}">
                                                        @if ($errors->has('title'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('title') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('imagegallery.Status') }}</label>
                                                        <select
                                                            class="primary_select mb-25  {{ @$errors->has('status') ? ' is-invalid' : '' }}"
                                                            name="status" id="status" required>
                                                            <option
                                                                value="1" {{isset($edit)?($edit->status==1?'selected':''):''}}>{{__('common.Active') }}</option>
                                                            <option
                                                                value="0" {{isset($edit)?($edit->status==0?'selected':''):''}}>{{__('common.Inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @php
                                                    $tooltip = "";
                                                      if(permissionCheck('imagegallery.store')){
                                                          $tooltip = "";
                                                      }else{
                                                          $tooltip = "You have no permission to add";
                                                      }
                                                @endphp
                                                <div class="col-lg-12 text-center">
                                                    <div class="d-flex justify-content-center pt_20">
                                                        <button type="submit" class="primary-btn semi_large fix-gr-bg"
                                                                data-toggle="tooltip" title="{{$tooltip}}"
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
                    <div class="main-title">
                        <h3 class="mb-20">{{__('imagegallery.Image Gallery')}}</h3>
                    </div>

                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.ID') }}</th>
                                        <th scope="col">{{ __('imagegallery.Image') }}</th>
                                        <th scope="col">{{ __('imagegallery.Title') }}</th>
                                        <th scope="col">{{ __('common.Date') }}</th>
                                        <th scope="col">{{ __('common.Status') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($images))
                                        @foreach($images as $key => $img)
                                            <tr>
                                                <th>{{ $key+1 }}</th>
                                                <td><img src="{{getGealleryImage($img->image)}}" alt=""
                                                         class="img img-responsive " style="width: 100px; height:auto">
                                                </td>
                                                <td>{{@$img->title }}</td>
                                                <td>{{ date(getSetting()->date_format->format, strtotime($img->created_at)) }}</td>
                                                <td>
                                                    <label class="switch_toggle" for="active_checkbox{{@$img->id }}">
                                                        <input type="checkbox" class="status_enable_disable"
                                                               id="active_checkbox{{@$img->id }}"
                                                               @if (@$img->status == 1) checked
                                                               @endif value="{{@$img->id }}">
                                                        <i class="slider round"></i>
                                                    </label>
                                                </td>
                                                <td>
                                                    <!-- shortby  -->
                                                    <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenu2" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            {{ __('common.Select') }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                             aria-labelledby="dropdownMenu2">
                                                            @if (permissionCheck('imagegallery.edit'))
                                                                <a class="dropdown-item edit_brand"
                                                                   href="{{route('imagegallery.edit',$img->id)}}">{{__('common.Edit')}}</a>
                                                            @endif
                                                            @if (permissionCheck('imagegallery.delete'))
                                                                <a onclick="confirm_modal('{{route('imagegallery.delete', $img->id)}}');"
                                                                   class="dropdown-item edit_brand">{{__('common.Delete')}}</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- shortby  -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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

    @include('backend.partials.delete_modal')
@endsection
@push('scripts')

@endpush
