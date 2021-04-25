@extends('backend.master')
@section('mainContent')
    @include("backend.partials.alertMessage")

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('coupons.Invite By Code')}}</h1>
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
                <div class="col-lg-3" style="display: none">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="box_header common_table_header">
                                <div class="main-title d-md-flex">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px"> @if(!isset($edit)) {{__('coupons.Add New Invite By Code') }} @else {{__('coupons.Update Invite By Code')}} @endif</h3>
                                    @if(isset($edit)) <a href="{{route('coupons.manage')}}"
                                                         class="primary-btn small fix-gr-bg">+ {{__('coupons.Add')}}</a> @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white-box ">
                        <form action="{{isset($edit)?route('coupons.update'): route('coupons.store') }}" method="POST"
                              id="coupon-form" name="coupon-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            @if(isset($edit)) <input type="hidden" name="id" value="{{$edit->id}}"> @endif
                            <input type="hidden" name="category" value="2">
                            <div class="row">

                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="category_id">{{ __('coupons.Select A Category') }}</label>
                                        <select
                                            class="primary_select mb-25  {{ @$errors->has('category_id') ? ' is-invalid' : '' }}"
                                            name="category_id" id="category_id" required>
                                            <option data-display="{{ __('coupons.Select A Category') }}"
                                                    value="">{{ __('coupons.Select A Category') }}</option>
                                            @if(@$categories->count()>0)
                                                @foreach ($categories as $category)
                                                    <option
                                                        value="{{@$category->id}}" {{isset($edit)?($edit->type==$category->id?'selected':''):''}}>{{@$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                <strong>{{ @$errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="primary_input mb-25" id="subCategoryDiv">
                                        <label class="primary_input_label"
                                               for="subcategory_id">{{ __('coupons.Select A Subcategory') }}</label>
                                        <select
                                            class="primary_select mb-25  {{ @$errors->has('subcategory_id') ? ' is-invalid' : '' }}"
                                            name="subcategory_id" id="subcategory_id" required>
                                            <option data-display="{{ __('coupons.Select A Subcategory') }}"
                                                    value="">{{ __('coupons.Select A Subcategory') }}</option>
                                        </select>
                                        @if ($errors->has('subcategory_id'))
                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                <strong>{{ @$errors->first('subcategory_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="primary_input mb-25" id="CourseDiv">
                                        <label class="primary_input_label"
                                               for="course_id">{{ __('coupons.Select A Course') }}</label>
                                        <select
                                            class="primary_select mb-25  {{ @$errors->has('course_id') ? ' is-invalid' : '' }}"
                                            name="course_id" id="course_id" required>
                                            <option data-display="{{ __('coupons.Select A Course') }}"
                                                    value="">{{ __('coupons.Select A Course') }}</option>
                                        </select>
                                        @if ($errors->has('course_id'))
                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('course_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="role_id">{{ __('coupons.Select A Role') }}</label>
                                        <select
                                            class="primary_select mb-25  {{ @$errors->has('role_id') ? ' is-invalid' : '' }}"
                                            name="role_id" id="role_id" required>
                                            <option data-display="{{ __('coupons.Select A role') }}"
                                                    value="">{{ __('coupons.Select A role') }}</option>
                                            @if(@$roles->count()>0)
                                                @foreach ($roles as $role)
                                                    <option
                                                        value="{{@$role->id}}" {{isset($edit)?($edit->type==$role->id?'selected':''):''}}>{{@$role->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('role_id'))
                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                <strong>{{ @$errors->first('role_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                {{-- input title  --}}
                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="number">{{ __('coupons.Maximum Limit') }}</label>
                                        <input name="max_limit" id="max_limit"
                                               class="primary_input_field name {{ @$errors->has('max_limit') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('coupons.Maximum Limit') }}" type="number" step="any"
                                               min="0" value="{{isset($edit)?$edit->max_limit:old('max_limit')}}">
                                        @if ($errors->has('max_limit'))
                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('max_limit') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- input title  --}}
                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="number2">{{ __('coupons.Amount') }}</label>
                                        <input name="amount" id="amount"
                                               class="primary_input_field name {{ @$errors->has('amount') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('coupons.Amount') }}" type="number2" step="any"
                                               min="0" value="{{isset($edit)?$edit->amount:old('amount')}}">
                                        @if ($errors->has('amount'))
                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('amount') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="type">{{ __('coupons.Type') }}</label>
                                        <select
                                            class="primary_select mb-25  {{ @$errors->has('type') ? ' is-invalid' : '' }}"
                                            name="type" id="type" required>
                                            <option
                                                value="1" {{isset($edit)?($edit->type==1?'selected':''):''}}>{{__('Fixed') }}</option>
                                            <option
                                                value="0" {{isset($edit)?($edit->type==0?'selected':''):''}}>{{__('Percentage (%)') }}</option>
                                        </select>
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
                                <div class="col-lg-12 text-center">
                                    <div class="d-flex justify-content-center pt_20">
                                        <button type="submit" class="primary-btn semi_large fix-gr-bg"
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
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-20">{{__('coupons.Invite By Code')}}</h3>
                            </div>
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
                                        <th scope="col">{{ __('coupons.Invited By') }}</th>
                                        <th scope="col">{{ __('coupons.Invite Accept By') }}</th>
                                        <th scope="col">{{ __('coupons.Invite Code') }}</th>
                                        <th scope="col">{{ __('coupons.Category') }}</th>
                                        <th scope="col">{{ __('coupons.Subcategory') }}</th>
                                        <th scope="col">{{ __('coupons.Course') }}</th>
                                        <th scope="col">{{ __('common.Date') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user_wise_coupons as $key => $s)
                                        <tr>
                                            <th>{{ $key+1 }}</th>
                                            <td>{{@$s->invite_byF->name }}</td>
                                            <td>{{@$s->invite_accept_byF->name }}</td>
                                            <td>{{@$s->invite_code}}</td>
                                            <td>{{@$s->category->name }}</td>
                                            <td>{{@$s->subCategory->name }}</td>
                                            <td>{{@$s->course->title }}</td>
                                            <td>{{ date(getSetting()->date_format->format, strtotime($s->created_at)) }}</td>

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
    <script src="{{url('Modules/Coupons/Resources/assets/js/app.js')}}"></script>
@endpush
