@extends('backend.master')

@section('table')
    @php
        $table_name='sponsors';
    @endphp
    {{$table_name}}
@stop
@section('mainContent')


    @include("backend.partials.alertMessage")

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('sponsor.Sponsor List')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('sponsor.Frontend CMS')}}</a>
                    <a class="active" href="{{route('frontend.sponsors.index')}}">{{__('sponsor.Sponsors')}}</a>
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
                                <div class="main-title d-md-flex mb-0">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"> @if(!isset($sponsor)) {{__('sponsor.Add New Sponsor') }} @else {{__('common.Update')}} @endif</h3>
                                    @if(isset($edit))
                                        @if (permissionCheck('sponsor.store'))
                                            <a href="{{route('frontend.sponsors.index')}}"
                                               class="primary-btn small fix-gr-bg ml-3 "
                                               style="position: absolute;  right: 0;   margin-right: 15px;"
                                               title="{{__('coupons.Add')}}">+ </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white-box ">
                        @if (isset($sponsor))
                            <form action="{{route('frontend.sponsors.update')}}" method="POST" id="coupon-form"
                                  name="coupon-form"
                                  enctype="multipart/form-data">@csrf
                                <input type="hidden" name="id" value="{{$sponsor->id}}">
                                @else
                                    @if (permissionCheck('frontend.sponsors.store'))
                                        <form action="{{route('frontend.sponsors.store') }}" method="POST"
                                              id="coupon-form"
                                              name="coupon-form" enctype="multipart/form-data">
                                            @endif
                                            @endif
                                            @csrf
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{ __('sponsor.Title') }} <strong
                                                                class="text-danger">*</strong></label>
                                                        <input name="title" id="title"
                                                               class="primary_input_field name {{ @$errors->has('title') ? ' is-invalid' : '' }}"
                                                               placeholder="{{ __('sponsor.Title') }}" type="text"
                                                               value="{{isset($sponsor)?$sponsor->title:old('title')}}" {{$errors->has('title') ? 'autofocus' : ''}}>
                                                        @if ($errors->has('title'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                            <strong>{{ @$errors->first('title') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="primary_input">
                                                        <label class="primary_input_label"
                                                               for="">{{__('sponsor.Image')}}
                                                            *</label>
                                                        <div class="primary_file_uploader">
                                                            <input class="primary-input filePlaceholder" type="text"
                                                                   placeholder="{{isset($sponsor) && $sponsor->image ? showPicName($sponsor->image) :__('virtual-class.Browse Image file')}}"
                                                                   readonly="" {{ $errors->has('image') ? ' autofocus' : '' }}>
                                                            <button class="" type="button">
                                                                <label class="primary-btn small fix-gr-bg"
                                                                       for="document_file1">{{__('common.Browse')}}</label>
                                                                <input type="file"
                                                                       class="d-none fileUpload" name="image"
                                                                       id="document_file1">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                @php
                                                    $tooltip = "";
                                                      if (permissionCheck('coupons.store')){
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
                                                            @if(!isset($sponsor)) {{ __('common.Save') }} @else {{ __('common.Update') }} @endif
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                    </div>
                </div>
                <div class="col-lg-9 ">
                    <div class="main-title">
                        <h3 class="mb-20">{{__('sponsor.Sponsor List')}}</h3>
                    </div>

                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.ID') }}</th>
                                        <th scope="col">{{ __('coupons.Title') }}</th>
                                        <th scope="col">{{ __('common.Status') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sponsors as $key => $sponsor)
                                        <tr>
                                            <th><span class="m-3">{{ $key+1 }}</span></th>

                                            <td>{{@$sponsor->title }}</td>
                                            <td>
                                                <label class="switch_toggle" for="active_checkbox{{@$sponsor->id }}">
                                                    <input type="checkbox" class="status_enable_disable"
                                                           id="active_checkbox{{@$sponsor->id }}"
                                                           @if (@$sponsor->status == 1) checked
                                                           @endif value="{{@$sponsor->id }}">
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
                                                        @if (permissionCheck('frontend.sponsors.edit'))
                                                            <a class="dropdown-item edit_brand"
                                                               href="{{route('frontend.sponsors.edit',$sponsor->id)}}">{{__('common.Edit')}}</a>
                                                        @endif
                                                        @if (permissionCheck('frontend.sponsors.destroy'))
                                                            <a onclick="confirm_modal('{{route('frontend.sponsors.destroy', $sponsor->id)}}');"
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


    @include('backend.partials.delete_modal')
@endsection
@push('scripts')
@endpush
