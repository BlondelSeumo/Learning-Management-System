@extends('backend.master')
@php
    $table_name='coupons';
$currency = getSetting()->currency;
@endphp
@section('table'){{$table_name}}@stop
@section('mainContent')

@include("backend.partials.alertMessage")

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>{{__('coupons.Coupons List')}}</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                <a href="#">{{__('coupons.Course')}}</a>
                <a class="active" href="{{route('coupons.manage')}}">{{__('coupons.Coupons')}}</a>
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
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"> @if(!isset($edit)) {{__('coupons.Add New Coupons') }} @else {{__('common.Update')}} @endif</h3>
                                @if(isset($edit))
                                    @if (permissionCheck('coupons.store'))
                                        <a href="{{route('coupons.manage')}}"
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
                    @if (isset($edit))
                        <form action="{{route('coupons.update')}}" method="POST" id="coupon-form" name="coupon-form"
                              enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$edit->id}}">
                            @else
                                @if (permissionCheck('coupons.store'))
                                    <form action="{{route('coupons.store') }}" method="POST" id="coupon-form"
                                          name="coupon-form" enctype="multipart/form-data">
                                        @endif
                                        @endif
                                        @csrf

                                        <input type="hidden" name="category" value="1">
                                        <div class="row">

                                            {{-- input title  --}}
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label"
                                                           for="title">{{ __('coupons.Coupon Title') }} <strong
                                                            class="text-danger">*</strong></label>
                                                    <input name="title" id="title"
                                                           class="primary_input_field name {{ @$errors->has('title') ? ' is-invalid' : '' }}"
                                                           placeholder="{{ __('coupons.Coupon Title') }}" type="text"
                                                           value="{{isset($edit)?$edit->title:old('title')}}" {{$errors->has('title') ? 'autofocus' : ''}}>
                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('title') }}</strong>
                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- input Code  --}}
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label"
                                                           for="code">{{ __('coupons.Coupon Code') }} <strong
                                                            class="text-danger">*</strong></label>
                                                    <input name="code" id="code"
                                                           class="primary_input_field name {{ @$errors->has('code') ? ' is-invalid' : '' }}"
                                                           placeholder="{{ __('coupons.Coupon Code') }}" type="text"
                                                           value="{{isset($edit)?$edit->code:old('code')}}" {{$errors->has('code') ? 'autofocus' : ''}}>
                                                    @if ($errors->has('code'))
                                                        <span class="invalid-feedback d-block mb-10" role="alert">
                                                            <strong>{{ @$errors->first('code') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            {{-- input min_purchase  --}}
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label"
                                                           for="number">{{ __('coupons.Minimum Purchase') }} <strong
                                                            class="text-danger">*</strong></label>
                                                    <input name="min_purchase"
                                                           class="primary_input_field name {{ @$errors->has('min_purchase') ? ' is-invalid' : '' }}"
                                                           placeholder="{{ __('coupons.Minimum Purchase') }}"
                                                           type="number" id="number" min="0" step="any"
                                                           {{$errors->has('min_purchase') ? 'autofocus' : ''}}
                                                           value="{{isset($edit)?$edit->min_purchase:old('min_purchase')}}">
                                                    @if ($errors->has('min_purchase'))
                                                        <span class="invalid-feedback d-block mb-10" role="alert">
                                                            <strong>{{ @$errors->first('min_purchase') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- input Amount  --}}
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label"
                                                           for="number2">{{ __('coupons.Maximum Discount') }} <strong
                                                            class="text-danger">*</strong></label>
                                                    <input name="max_discount"
                                                           {{$errors->has('max_discount') ? 'autofocus' : ''}}
                                                           class="primary_input_field name {{ @$errors->has('code') ? ' is-invalid' : '' }}"
                                                           placeholder="{{ __('coupons.Maximum Discount') }}"
                                                           type="number" id="number2" min="0" step="any"
                                                           value="{{isset($edit)?$edit->max_discount:old('max_discount')}}">
                                                    @if ($errors->has('max_discount'))
                                                        <span class="invalid-feedback d-block mb-10" role="alert">
                                                            <strong>{{ @$errors->first('max_discount') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            {{-- input Amount  --}}
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="number3">{{ __('coupons.Amount') }}
                                                        <strong class="text-danger">*</strong></label>
                                                    <input name="value"
                                                           class="primary_input_field name {{ @$errors->has('code') ? ' is-invalid' : '' }}"
                                                           placeholder="{{ __('coupons.Amount') }}" type="number"
                                                           id="number3" min="0" step="any"
                                                           {{$errors->has('value') ? 'autofocus' : ''}}
                                                           value="{{isset($edit)?$edit->value:old('value')}}">
                                                    @if ($errors->has('value'))
                                                        <span class="invalid-feedback d-block mb-10" role="alert">
                                                            <strong>{{ @$errors->first('value') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label"
                                                           for="type">{{ __('coupons.Type') }}</label>
                                                    <select
                                                        class="primary_select mb-25  {{ @$errors->has('type') ? ' is-invalid' : '' }}"
                                                        name="type" id="type"  >
                                                        <option
                                                            value="1" {{isset($edit)?($edit->type==1?'selected':''):''}}>{{__('coupons.Fixed') }}</option>
                                                        <option
                                                            value="0" {{isset($edit)?($edit->type==0?'selected':''):''}}>{{__('coupons.Percentage') }} (%)</option>
                                                    </select>
                                                </div>
                                            </div>


                                            {{-- Start Date Input --}}
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label"
                                                           for="start_date">{{ __('coupons.Start Date') }}</label>
                                                    <div class="primary_datepicker_input">
                                                        <div class="no-gutters input-right-icon">
                                                            <div class="col">
                                                                <div class="">
                                                                    <input placeholder="Date"
                                                                           class="primary_input_field primary-input date form-control  {{ @$errors->has('start_date') ? ' is-invalid' : '' }}"
                                                                           id="start_date" type="text"
                                                                           name="start_date"
                                                                           value="{{isset($edit)?  date('m/d/Y', strtotime(@$edit->start_date)) : date('m/d/Y')}}"
                                                                           autocomplete="off" required>
                                                                </div>
                                                            </div>
                                                            <button class="" type="button">
                                                                <i class="ti-calendar"  ></i>
                                                            </button>
                                                        </div>
                                                        @if ($errors->has('start_date'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                <strong>{{ @$errors->first('start_date') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- End Date Input --}}
                                            <div class="col-xl-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label"
                                                           for="end_date">{{ __('coupons.End Date') }}</label>
                                                    <div class="primary_datepicker_input">
                                                        <div class="no-gutters input-right-icon">
                                                            <div class="col">
                                                                <div class="">
                                                                    <input placeholder="Date"
                                                                           class="primary_input_field primary-input date form-control  {{ @$errors->has('end_date') ? ' is-invalid' : '' }}"
                                                                           id="end_date"
                                                                           type="text" name="end_date"
                                                                           value="{{isset($edit)?  date('m/d/Y', strtotime(@$edit->end_date)) : date('m/d/Y')}}"
                                                                           autocomplete="off" required>
                                                                </div>
                                                            </div>
                                                            <button class="" type="button">
                                                                <i class="ti-calendar" id="start-date-icon"></i>
                                                            </button>
                                                        </div>
                                                        @if ($errors->has('end_date'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                <strong>{{ @$errors->first('end_date') }}</strong>
                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label"
                                                           for="status">{{ __('coupons.Status') }}</label>
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
                                                        @if(!isset($edit)) {{ __('common.Save') }} @else {{ __('common.Update') }} @endif
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                </div>
            </div>
            <div class="col-lg-9 ">
                <div class="main-title">
                    <h3 class="mb-20">{{__('coupons.Coupons List')}}</h3>
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
                                    <th scope="col">{{ __('coupons.Code') }}</th>
                                    <th scope="col">{{ __('coupons.Amount') }}</th>
                                    <th scope="col">{{ __('coupons.Type') }}</th>
                                    <th scope="col">{{ __('common.Status') }}</th>
                                    <th scope="col">{{ __('coupons.Minimum Purchase') }}</th>
                                    <th scope="col">{{ __('coupons.Maximum Discount') }}</th>
                                    <th scope="col">{{ __('coupons.Start Date') }}</th>
                                    <th scope="col">{{ __('coupons.End Date') }}</th>

                                    <th scope="col">{{ __('common.Used') }}</th>
                                    <th scope="col">{{ __('common.Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupons as $key => $coupon)
                                    <tr>
                                        <th><span class="m-3">{{ $key+1 }}</span></th>

                                        <td>{{@$coupon->title }}</td>
                                        <td>{{@$coupon->code }}</td>
                                        <td>{{@$coupon->type==1?$currency->symbol.' '.@$coupon->value:@$coupon->value }}</td>
                                        <td>{{@$coupon->type==1?'Fixed Amount':'%' }}</td>
                                        <td>
                                            <label class="switch_toggle" for="active_checkbox{{@$coupon->id }}">
                                                <input type="checkbox" class="status_enable_disable"
                                                       id="active_checkbox{{@$coupon->id }}"
                                                       @if (@$coupon->status == 1) checked
                                                       @endif value="{{@$coupon->id }}">
                                                <i class="slider round"></i>
                                            </label>
                                        </td>
                                        <td>{{$currency->symbol}} {{@$coupon->min_purchase }}</td>
                                        <td>{{$currency->symbol}} {{@$coupon->max_discount }}</td>
                                        <td>{{ date(getSetting()->date_format->format, strtotime($coupon->start_date)) }}</td>
                                        <td>{{ date(getSetting()->date_format->format, strtotime($coupon->end_date)) }}</td>

                                        <td>{{@$coupon->totalUsed->count() }}</td>
                                        <td>
                                            <!-- shortby  -->
                                            <div class="dropdown CRM_dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenu2{{@$coupon->id }}" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    {{ __('common.Select') }}
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenu2{{@$coupon->id }}">
                                                    @if (permissionCheck('coupons.edit'))
                                                        <a class="dropdown-item edit_brand"
                                                           href="{{route('coupons.edit',$coupon->id)}}">{{__('common.Edit')}}</a>
                                                    @endif
                                                    @if (permissionCheck('coupons.delete'))
                                                        <a onclick="confirm_modal('{{route('coupons.delete', $coupon->id)}}');"
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
<input type="hidden" name="status_route" class="status_route" value="{{ route('coupons.status_update') }}">

@include('backend.partials.delete_modal')
@endsection
@push('scripts')
    <script src="{{asset('public/backend/js/category.js')}}"></script>
@endpush
