@extends('backend.master')
@section('table'){{__('privacy_policies')}}@endsection
@section('mainContent')
    @include("backend.partials.alertMessage")
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('frontendmanage.Privacy Policy')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('frontendmanage.Frontend CMS')}}</a>
                    <a class="active" href="#">{{__('frontendmanage.Privacy Policy')}}</a>
                </div>
            </div>
        </div>
    </section>


    <section class="mb-40 student-details">
        <div class="container-fluid p-0">
            <div class="row">

                <div class="col-lg-12">
                  

                    @if (permissionCheck('null'))
                        <form class="form-horizontal" action="{{route('frontend.privacy_policy_Update')}}" method="POST"
                              enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="white-box">

                                <div class="col-md-12 ">
                                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                    <input type="hidden" name="id" value="{{@$privacy_policy->id}}">
                                    <div class="row mb-30">
                                        <div class="col-md-12 p-0">

                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{__('frontendmanage.Description')}} *</label>
                                                        <textarea name="description"
                                                                  {{ $errors->has('description') ? ' autofocus' : '' }} class="lms_summernote"
                                                                  cols="30" rows="10"
                                                                  placeholder="{{ __('frontendmanage.Description') }}"
                                                                  class="textArea {{ @$errors->has('description') ? ' is-invalid' : '' }}">{{isset($privacy_policy)?$privacy_policy->description:old('description')}}</textarea>
                                                        @if ($errors->has('description'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                                <strong>{{ @$errors->first('description') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{__('frontendmanage.General')}} *</label>
                                                        <textarea name="general"
                                                                  {{ $errors->has('general') ? ' autofocus' : '' }} class="lms_summernote"
                                                                  cols="30" rows="10"
                                                                  placeholder="{{ __('frontendmanage.General') }}"
                                                                  class="textArea {{ @$errors->has('general') ? ' is-invalid' : '' }}">{{isset($privacy_policy)?$privacy_policy->general:old('general')}}</textarea>
                                                        @if ($errors->has('general'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                                <strong>{{ @$errors->first('general') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{__('frontendmanage.Personal Data')}} *</label>
                                                        <textarea name="personal_data" class="lms_summernote"
                                                                  {{ $errors->has('personal_data') ? ' autofocus' : '' }} cols="30"
                                                                  rows="10"
                                                                  placeholder="{{ __('frontendmanage.Personal Data') }}"
                                                                  class="textArea {{ @$errors->has('personal_data') ? ' is-invalid' : '' }}">{{isset($privacy_policy)?$privacy_policy->personal_data:old('personal_data')}}</textarea>
                                                        @if ($errors->has('personal_data'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                                <strong>{{ @$errors->first('personal_data') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label" class="lms_summernote"
                                                               for="">{{__('frontendmanage.Voluntary Disclosure')}}
                                                            *</label>
                                                        <textarea name="voluntary_disclosure"
                                                                  {{ $errors->has('voluntary_disclosure') ? ' autofocus' : '' }} cols="30"
                                                                  rows="10"
                                                                  placeholder="{{ __('frontendmanage.Voluntary Disclosure') }}"
                                                                  class="lms_summernote textArea {{ @$errors->has('voluntary_disclosure') ? ' is-invalid' : '' }}">{{isset($privacy_policy)?$privacy_policy->voluntary_disclosure:old('voluntary_disclosure')}}</textarea>
                                                        @if ($errors->has('voluntary_disclosure'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                                <strong>{{ @$errors->first('voluntary_disclosure') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{__('frontendmanage.Children Privacy')}}
                                                            *</label>
                                                        <textarea name="children_privacy" class="lms_summernote"
                                                                  {{ $errors->has('children_privacy') ? ' autofocus' : '' }} cols="30"
                                                                  rows="10"
                                                                  placeholder="{{ __('frontendmanage.Children Privacy') }}"
                                                                  class="textArea {{ @$errors->has('children_privacy') ? ' is-invalid' : '' }}">{{isset($privacy_policy)?$privacy_policy->children_privacy:old('children_privacy')}}</textarea>
                                                        @if ($errors->has('children_privacy'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                                <strong>{{ @$errors->first('children_privacy') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{__('frontendmanage.Information About Cookies')}}
                                                            *</label>
                                                        <textarea name="information_about_cookies"
                                                                  class="lms_summernote"
                                                                  {{ $errors->has('information_about_cookies') ? ' autofocus' : '' }} cols="30"
                                                                  rows="10"
                                                                  placeholder="{{ __('frontendmanage.Information About Cookies') }}"
                                                                  class="textArea {{ @$errors->has('information_about_cookies') ? ' is-invalid' : '' }}">{{isset($privacy_policy)?$privacy_policy->information_about_cookies:old('information_about_cookies')}}</textarea>
                                                        @if ($errors->has('information_about_cookies'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                                <strong>{{ @$errors->first('information_about_cookies') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{__('frontendmanage.Thirt Party Advertising')}}
                                                            *</label>
                                                        <textarea name="thirt_party_adv" class="lms_summernote"
                                                                  {{ $errors->has('thirt_party_adv') ? ' autofocus' : '' }} cols="30"
                                                                  rows="10"
                                                                  placeholder="{{ __('frontendmanage.Thirt Party Advertising') }}"
                                                                  class="textArea {{ @$errors->has('thirt_party_adv') ? ' is-invalid' : '' }}">{{isset($privacy_policy)?$privacy_policy->thirt_party_adv:old('thirt_party_adv')}}</textarea>
                                                        @if ($errors->has('thirt_party_adv'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                                <strong>{{ @$errors->first('thirt_party_adv') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{__('frontendmanage.Other Sites')}} *</label>
                                                        <textarea name="other_sites"
                                                                  {{ $errors->has('other_sites') ? ' autofocus' : '' }} class="lms_summernote"
                                                                  cols="30" rows="10"
                                                                  placeholder="{{ __('frontendmanage.Other Sites') }}"
                                                                  class="textArea {{ @$errors->has('other_sites') ? ' is-invalid' : '' }}">{{isset($privacy_policy)?$privacy_policy->other_sites:old('other_sites')}}</textarea>
                                                        @if ($errors->has('other_sites'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                                <strong>{{ @$errors->first('other_sites') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{__('frontendmanage.Teacher')}} *</label>
                                                        <textarea name="teacher"
                                                                  {{ $errors->has('teacher') ? ' autofocus' : '' }} class="lms_summernote"
                                                                  cols="30" rows="10"
                                                                  placeholder="{{ __('frontendmanage.Teacher') }}"
                                                                  class="textArea {{ @$errors->has('teacher') ? ' is-invalid' : '' }}">{{isset($privacy_policy)?$privacy_policy->teacher:old('teacher')}}</textarea>
                                                        @if ($errors->has('teacher'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                                <strong>{{ @$errors->first('teacher') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{__('student.Student')}} *</label>
                                                        <textarea name="student"
                                                                  {{ $errors->has('student') ? ' autofocus' : '' }} class="lms_summernote"
                                                                  cols="30" rows="10"
                                                                  placeholder="{{ __('frontendmanage.Student') }}"
                                                                  class="textArea {{ @$errors->has('student') ? ' is-invalid' : '' }}">{{isset($privacy_policy)?$privacy_policy->student:old('student')}}</textarea>
                                                        @if ($errors->has('student'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                                <strong>{{ @$errors->first('student') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="primary_input mb-25">
                                                        <label class="primary_input_label"
                                                               for="">{{__('frontendmanage.Business Transfer')}}
                                                            *</label>
                                                        <textarea name="business_transfer"
                                                                  {{ $errors->has('business_transfer') ? ' autofocus' : '' }} class="lms_summernote"
                                                                  cols="30" rows="10"
                                                                  placeholder="{{ __('frontendmanage.Business Transfer') }}"
                                                                  class="textArea {{ @$errors->has('business_transfer') ? ' is-invalid' : '' }}">{{isset($privacy_policy)?$privacy_policy->business_transfer:old('business_transfer')}}</textarea>
                                                        @if ($errors->has('business_transfer'))
                                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                                                <strong>{{ @$errors->first('business_transfer') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-7">
                                            <div class="row justify-content-center">

                                                @if(session()->has('message-success'))
                                                    <p class=" text-success">
                                                        {{ session()->get('message-success') }}
                                                    </p>
                                                @elseif(session()->has('message-danger'))
                                                    <p class=" text-danger">
                                                        {{ session()->get('message-danger') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $tooltip = "";
                                    if(permissionCheck('null')){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to Update";
                                    }
                                @endphp
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip"
                                                title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            {{__('common.Update')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                </div>


            </div>
        </div>
    </section>

@endsection
