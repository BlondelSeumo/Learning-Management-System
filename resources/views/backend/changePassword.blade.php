@extends('backend.master')
@section('mainContent')
    @include("backend.partials.alertMessage")

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex">
                            <h3 class="mb-0 mr-30">{{__('common.My Profile')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="common_grid_wrapper">
                        <!-- white_box -->
                        <div class="white_box_30px">
                            <div class="main-title mb-25">
                                <h3 class="mb-0">{{__('common.Profile Settings')}}</h3>
                            </div>
                            <form action="{{route('update_user')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="name">{{__('common.Name')}} <strong
                                                    class="text-danger">*</strong></label>
                                            <input class="primary_input_field" name="name" value="{{@$user->name}}"
                                                   id="name" placeholder="" required
                                                   type="text" {{$errors->first('name') ? 'autofocus' : ''}}>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="role">{{__('common.Role')}} </label>
                                            <input class="primary_input_field" name="" readonly
                                                   id="role" value="{{@$user->role->name}}" placeholder="-" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="email">{{__('common.Email')}}
                                                <strong
                                                    class="text-danger">*</strong></label>
                                            <input class="primary_input_field" name="email" value="{{@$user->email}}"
                                                   id="email" placeholder="-"
                                                   type="email" {{$errors->first('email') ? 'autofocus' : ''}}>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="phone">{{__('common.Phone')}} </label>
                                            <input class="primary_input_field" name="phone" value="{{@$user->phone }}"
                                                   id="phone" placeholder="-" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-25">
                                        <label class="primary_input_label"
                                               for="country">{{__('common.Country')}} </label>
                                        <select class="primary_select" name="country" id="country">
                                            @foreach ($countries as $country)
                                                <option value="{{@$country->id}}"
                                                        @if (@$user->country==$country->id) selected @endif>{{@$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-25">
                                        <label class="primary_input_label"
                                               for="city">{{__('common.City')}} </label>
                                        <select class="primary_select" name="city" id="city">
                                            @foreach ($cities as $city)
                                                <option value="{{@$city->id}}"
                                                        @if (@$user->city==$city->id) selected @endif>{{@$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="zip">{{__('common.Zip Code')}} </label>
                                            <input class="primary_input_field" name="zip" value="{{@$user->zip }}"
                                                   id="zip" placeholder="-" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-25">
                                        <label class="primary_input_label"
                                               for="currency">{{__('common.Currency')}}</label>
                                        <select class="primary_select" name="currency" id="currency">
                                            <option data-display="{{__('common.Select')}} Currency"
                                                    value="">{{__('common.Select')}} Currency
                                            </option>
                                            @foreach ($currencies as $currency)
                                                <option value="{{@$currency->id}}"
                                                        @if (@$user->currency_id==$currency->id) selected @endif>{{@$currency->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-25">
                                        <label class="primary_input_label"
                                               for="language">{{__('common.Language')}} </label>
                                        <select class="primary_select" name="language" id="language">
                                            <option data-display="{{__('common.Select')}} Language"
                                                    value="">{{__('common.Select')}}
                                                {{__('passwords.Language')}}</option>
                                            @foreach ($languages as $language)
                                                <option value="{{@$language->id}}"
                                                        @if (@$user->language_id==$language->id) selected @endif>{{@$language->native}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="facebook">{{__('common.Facebook URL')}} </label>
                                            <input class="primary_input_field" name="facebook" id="facebook"
                                                   value="{{@$user->facebook}}" placeholder="-" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="twitter">{{__('common.Twitter URL')}} </label>
                                            <input class="primary_input_field" name="twitter" id="twitter"
                                                   value="{{@$user->twitter}}" placeholder="-" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="linkedin">{{__('common.LinkedIn URL')}} </label>
                                            <input class="primary_input_field" name="linkedin" id="linkedin"
                                                   value="{{@$user->linkedin}}" placeholder="-" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="instagram">{{__('common.Instagram URL')}} </label>
                                            <input class="primary_input_field" name="instagram" id="instagram"
                                                   value="{{@$user->instagram}}" placeholder="-" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="shortDetails">{{__('common.Short Description')}} </label>
                                            <input class="primary_input_field" name="short_details"
                                                   id="shortDetails" value="{{@$user->short_details}}" placeholder="-"
                                                   type="text">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="about">{{__('common.Description')}} </label>
                                            <textarea class="lms_summernote" name="about"

                                                      id="about" cols="30"
                                                      rows="10">{!!@$user->about!!}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="primary_input mb-35">
                                            <label class="primary_input_label"
                                                   for="">{{__('common.Browse')}}  {{__('common.Avatar')}} </label>
                                            <div class="primary_file_uploader">
                                                <input class="primary-input" type="text" id="placeholderFileOneName"
                                                       placeholder="{{showPicName($user->image)}}" readonly="">
                                                <button class="primary_btn_2" type="button">
                                                    <label class="primary_btn_2"
                                                           for="document_file_1">{{__('common.Browse')}} </label>
                                                    <input type="file" class="d-none" name="image" id="document_file_1">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-10">
                                        <div class="submit_btn text-center">
                                            <button class="primary_btn_large" type="submit"><i
                                                    class="ti-check"></i> {{__('common.Save')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- white_box  -->
                        <div class="white_box_30px">
                            <div class="main-title mb-25">
                                <h3 class="mb-0">{{__('common.Change')}}  {{__('common.Password')}} </h3>
                            </div>
                            <form action="{{route('updatePassword')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="password-field">{{__('common.Current')}} {{__('common.Password')}}
                                                <strong
                                                    class="text-danger">*</strong></label>
                                            <div>

                                                <input class="primary_input_field" name="current_password"
                                                       {{$errors->first('current_password') ? 'autofocus' : ''}}
                                                       placeholder="{{__('common.Current')}} {{__('common.Password')}}"
                                                       id="password-field"
                                                       type="password">
                                                <span toggle="#password-field"
                                                      class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="password-field2">{{__('common.New')}}  {{__('common.Password')}}
                                                <strong
                                                    class="text-danger">*</strong></label>
                                            <input class="primary_input_field" name="new_password"
                                                   placeholder="{{__('common.New')}}  {{__('common.Password')}} {{__('common.Minimum 8 characters')}}"
                                                   id="password-field2"
                                                   type="password" {{$errors->first('new_password') ? 'autofocus' : ''}}>
                                            <span toggle="#password-field2"
                                                  class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label"
                                                   for="password-field3">{{__('common.Re-Type Password')}}
                                                <strong class="text-danger">*</strong></label>
                                            <input class="primary_input_field" name="confirm_password"
                                                   {{$errors->first('confirm_password') ? 'autofocus' : ''}}
                                                   id="password-field3" placeholder="{{__('common.Re-Type Password')}}"
                                                   type="password">
                                            <span toggle="#password-field3"
                                                  class="fa fa-fw fa-eye field-icon toggle-password3"></span>
                                        </div>
                                    </div>


                                    <div class="col-12 mb-10">
                                        <div class="submit_btn text-center">
                                            <button class="primary_btn_large" type="submit"><i
                                                    class="ti-check"></i> {{__('common.Update')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    @include('backend.partials.delete_modal')
@endsection

