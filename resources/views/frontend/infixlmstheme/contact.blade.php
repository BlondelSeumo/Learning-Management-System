@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('frontend.Contact Us')}} @endsection
@section('css') @endsection


@section('mainContent')
    <!-- bradcam::start  -->
    <div class="breadcrumb_area bradcam_bg_2"
         style="background-image: url('{{asset(@$frontendContent->contact_page_banner)}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <div class="breadcam_wrap ">
                       <span>
                            {{@$frontendContent->contact_page_title}}
                        </span>
                        <h3>
                            {{@$frontendContent->contact_sub_title}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam::end  -->

    <!-- CONTACT::START  -->
    <div class="contact_section ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="contact_address">
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div class="row justify-content-between">
                                    <div class="col-lg-5">
                                        <div class="contact_info mb_30">
                                            <div class="contact_title">
                                                <h4 class="mb-0">{{__('frontend.Contact Information')}}</h4>
                                            </div>
                                            <p>{{__('frontend.contact_subtitle')}}</p>


                                            <div class="address_lines">
                                                @if(!empty(getSetting()->address))
                                                    <div class="single_address_line d-flex">
                                                        <i class="ti-direction-alt"></i>
                                                        <div class="address_info">
                                                            <p> {!!getSetting()->address ? getSetting()->address : '89/2 Panthapath, Dhaka 1215, Bangladesh' !!}</p>

                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty(getSetting()->phone))
                                                    <div class="single_address_line d-flex">
                                                        <i class="ti-headphone-alt"></i>
                                                        <div class="address_info">
                                                            <p> {!!getSetting()->phone!!}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty(getSetting()->email))

                                                    <div class="single_address_line d-flex">
                                                        <i class="ti-email"></i>
                                                        <div class="address_info">
                                                            <p> {!!getSetting()->email!!}</p>
                                                            <p>{{__('frontend.Send us your query anytime')}}!</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="contact_form_box mb_30">
                                            <div class="contact_title">
                                                <h4 class="mb-0">{{__('frontend.Send Us Message')}}</h4>
                                            </div>
                                            <form class="form-area contact-form" id="myForm"
                                                  action="{{url('contactMsgSubmit')}}"
                                                  method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label class="primary_label">{{__('frontend.Name')}}</label>
                                                        <input name="name" placeholder="{{__('frontend.Enter Name')}}"
                                                               onfocus="this.placeholder = ''"
                                                               onblur="this.placeholder = '{{__('frontend.Enter Name')}}'"
                                                               class="primary_input mb_20" type="text"
                                                               value="{{old('name')}}">
                                                        <span class="text-danger"
                                                              role="alert">{{$errors->first('name')}}</span>

                                                        <label
                                                            class="primary_label">{{__('frontend.Email Address')}}</label>
                                                        <input name="email"
                                                               placeholder="{{__('frontend.Type e-mail address')}}"
                                                               pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
                                                               onfocus="this.placeholder = ''"
                                                               onblur="this.placeholder = '{{__('frontend.Type e-mail address')}}'"
                                                               class="primary_input mb_20"
                                                               type="email" value="{{old('email')}}">
                                                        <span class="text-danger"
                                                              role="alert">{{$errors->first('email')}}</span>
                                                        <label class="primary_label">{{__('frontend.Subject')}}</label>
                                                        <input name="subject"
                                                               placeholder="{{__('frontend.Enter your subject')}}"
                                                               onfocus="this.placeholder = ''"
                                                               onblur="this.placeholder = '{{__('frontend.Enter your subject')}}'"
                                                               class="primary_input mb_20" type="text"
                                                               value="{{old('subject')}}">
                                                        <span class="text-danger"
                                                              role="alert">{{$errors->first('subject')}}</span>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label class="primary_label">{{__('frontend.Message')}}</label>
                                                        <textarea class="primary_textarea mb_20" name="message"
                                                                  placeholder="{{__('frontend.Write your message')}}"
                                                                  onfocus="this.placeholder = ''"
                                                                  onblur="this.placeholder = '{{__('frontend.Write your message')}}'"
                                                        >{{old('message')}}</textarea>
                                                        <span class="text-danger"
                                                              role="alert">{{$errors->first('message')}}</span>
                                                    </div>
                                                    <div class="col-lg-12 text-left">
                                                        <div class="alert-msg"></div>
                                                        <button type="submit"
                                                                class="theme_btn small_btn submit-btn w-100 text-center">
                                                            {{__('frontend.Send Message')}}
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
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT::END  -->
    <div class="contact_map">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div id="contact-map"></div>
                </div>
            </div>
        </div>
    </div>



    <input type="hidden" name="lat" class="lat" value="{{getSetting()->lat}}">
    <input type="hidden" name="lng" class="lng" value="{{getSetting()->lng}}">
    <input type="hidden" name="zoom" class="zoom" value="{{getSetting()->zoom_level}}">
@endsection
@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{getSetting()->gmap_key}}"></script>
    <script src="{{ asset('public/frontend/infixlmstheme') }}/js/map.js"></script>
    <script src="{{asset('public/frontend/infixlmstheme/js/contact.js')}}"></script>
@endsection
