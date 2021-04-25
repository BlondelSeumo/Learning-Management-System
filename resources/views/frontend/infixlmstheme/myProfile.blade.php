@extends('frontend.infixlmstheme.layouts.dashboard_master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('frontendmanage.My Profile')}} @endsection
@section('css')
    <link href="{{asset('public/frontend/infixlmstheme/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/frontend/infixlmstheme/css/checkout.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/frontend/infixlmstheme/css/myProfile.css')}}" rel="stylesheet"/>
@endsection
@section('js')
    <script src="{{asset('public/frontend/infixlmstheme/js/select2.min.js')}}"></script>
    <script src="{{ asset('public/frontend/infixlmstheme/js/my_profile.js') }}"></script>
@endsection

@section('mainContent')

    <div class="main_content_iner account_main_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <!-- account_profile_wrapper  -->
                    <div class="account_profile_wrapper">
                        <div class="account_profile_thumb text-center mb_30">
                            <div class="thumb">
                                <img src="{{getProfileImage($profile->image)}}" alt="">
                            </div>
                            <h4>{{$profile->name}}</h4>
                            <p>{{$profile->headline}}</p>
                        </div>
                        <div class="account_profile_form">
                            <h3 class="font_22 f_w_700 mb_30">{{__('frontendmanage.My Profile')}}</h3>

                            <form action="{{route('myProfileUpdate')}}" method="POST"
                                  enctype="multipart/form-data">@csrf
                                <div class="row">
                                    <input type="hidden" name="username" value="{{$profile->email}}">
                                    <div class="col-lg-12">
                                        <label class="primary_label2">{{__('student.Full Name')}}
                                            <span>*</span></label>
                                        <input name="name" placeholder="{{__('frontend.Enter First Name')}}"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = '{{__('frontend.Enter First Name')}}'"
                                               class="primary_input4" {{$errors->first('name') ? 'autofocus' : ''}}
                                               value="{{$profile->name !=""? @$profile->name:old('name')}}" type="text">
                                        <span class="text-danger" role="alert">{{$errors->first('name')}}</span>
                                    </div>


                                    <div class="col-lg-12 mt_20">
                                        <label class="primary_label2">{{__('student.Add a professional headline like')}}
                                            ({{__('student.Engineer at InfixLMS')}})</label>
                                        <input name="headline" placeholder="{{__('student.Headline')}}"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = '{{__('student.Headline')}}'"
                                               class="primary_input4" type="text"
                                               value="{{$profile->headline !=""? @$profile->headline:old('headline')}}">
                                        <span class="text-danger" role="alert">{{$errors->first('headline')}}</span>
                                    </div>


                                    <div class="col-lg-6 col-md-6 mt_20">
                                        <div class="single_input ">
                                            <span class="primary_label2">{{__('student.Phone Number')}} </span>
                                            <input type="text" placeholder="{{__('student.Phone Number')}}"
                                                   class="primary_input4  {{ @$errors->has('phone') ? ' is-invalid' : '' }}"
                                                   value="{{$profile->phone !=""? @$profile->phone:old('phone')}}"
                                                   name="phone" {{$errors->first('phone') ? 'autofocus' : ''}}>
                                            <span class="text-danger" role="alert">{{$errors->first('phone')}}</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6 mt_20">
                                        <div class="single_input ">
                                            <span class="primary_label2">{{__('common.Email')}} <span
                                                    class=""> *</span></span>
                                            <input type="email" placeholder="{{__('common.Email')}}"
                                                   class="primary_input4 {{ @$errors->has('email') ? ' is-invalid' : '' }}"
                                                   value="{{$profile->email !=""? @$profile->email:old('email')}}"
                                                   name="email" {{$errors->first('email') ? 'autofocus' : ''}}>
                                            <span class="text-danger" role="alert">{{$errors->first('email')}}</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6 mt_20">
                                        <div class="single_input ">
                                            <span class="primary_label2">{{__('common.Language')}}  <span
                                                    class=""> *</span> </span>
                                            <select class="theme_select wide mb_20"
                                                    name="language" {{$errors->first('language') ? 'autofocus' : ''}}>
                                                <option data-display="{{__('common.Language')}}"
                                                        value="#">{{__('common.Select')}} {{__('common.Language')}}</option>
                                                @if(isset($langs))
                                                    @foreach ($langs as $lang)
                                                        <option
                                                            value="{{@$lang->id}}|{{@$lang->code}}|{{@$lang->native}}"
                                                            @if ($profile->language_code==$lang->code) selected @endif>{{@$lang->native}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span class="text-danger" role="alert">{{$errors->first('language')}}</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6 mt_20">
                                        <div class="single_input ">
                                            <span class="primary_label2">{{__('common.Country')}} <span
                                                    class=""> *</span></span>
                                            <select class="select2 mb-3 wide w-100" name="country"
                                                    id="select_country" {{$errors->first('country') ? 'autofocus' : ''}}>
                                                <option data-display="{{__('common.Country')}}"
                                                        value="">{{__('common.Select')}}</option>
                                                @if(isset($countries))
                                                    @foreach ($countries as $country)
                                                        <option value="{{@$country->id}}"
                                                                @if ($profile->country==$country->id) selected @endif>{{@$country->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span class="text-danger" role="alert">{{$errors->first('country')}}</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-4 col-md-4 mt_20">
                                        <div class="single_input " id="city_div">
                                            <span class="primary_label2">{{__('common.City')}} <span
                                                    class=""> *</span></span>
                                            <select class="theme_select wide mb_20" name="city"
                                                    id="city" {{$errors->first('city') ? 'autofocus' : ''}}>
                                                <option data-display="{{__('common.City')}}"
                                                        value="#">{{__('common.Select')}} {{__('common.City')}}</option>
                                                @if(isset($cities))
                                                    @foreach ($cities as $city)
                                                        <option value="{{$city->id}}"
                                                                @if ($profile->city==$city->id) selected @endif>{{$city->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span class="text-danger" role="alert">{{$errors->first('city')}}</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-4 col-md-4 mt_20">
                                        <div class="single_input ">
                                            <span class="primary_label2">{{__('common.Address')}} <span
                                                    class=""> *</span></span>
                                            <input type="text" placeholder="{{__('common.Address')}}"
                                                   class="primary_input4 {{ @$errors->has('address') ? ' is-invalid' : '' }}"
                                                   value="{{$profile->address !=""? @$profile->address:old('address')}}"
                                                   name="address" {{$errors->first('address') ? 'autofocus' : ''}}>
                                            <span class="text-danger" role="alert">{{$errors->first('address')}}</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-4 col-md-4 mt_20">
                                        <div class="single_input ">
                                            <span class="primary_label2">{{__('common.Zip Code')}} <span
                                                    class=""> *</span></span>
                                            <input type="text" placeholder="{{__('common.Zip Code')}}"
                                                   class="primary_input4 {{ @$errors->has('zip') ? ' is-invalid' : '' }}"
                                                   value="{{$profile->zip !=""? @$profile->zip:old('zip')}}"
                                                   name="zip" {{$errors->first('zip') ? 'autofocus' : ''}}>
                                            <span class="text-danger" role="alert">{{$errors->first('zip')}}</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 mt_20">
                                        <label class="primary_label2">{{__('common.About')}}</label>
                                        <textarea name="about" class="primary_textarea4 mb_20"
                                                  placeholder="{{__('student.Write Note here')}}"
                                                  onfocus="this.placeholder = ''"
                                                  onblur="this.placeholder = '{{__('student.Write Note here')}}'">{{$profile->about !=""? @$profile->about:old('about')}}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <div class="preview_upload">
                                            <div class="preview_upload_thumb">
                                                <img src="" alt="" id="imgPreview"
                                                     style=" display:none;height: 100%;width: 100%;">
                                                <span id="previewTxt">{{__('student.Preview')}}</span>
                                            </div>
                                            <div class="preview_drag">
                                                <div class="preview_drag_inner">
                                                    <div class="img">
                                                        <img
                                                            src="{{asset('public/frontend/infixlmstheme')}}/img/account/gallery_icon.png"
                                                            alt="">
                                                    </div>
                                                    <p>{{__('student.Drop your file here')}}</p>
                                                    <small>{{__('student.Recommended image size')}} (330x400)</small>
                                                    <div class="chose_file">
                                                        <input type="file" name="image" id="imgInp"
                                                               onchange="readURL(this)">
                                                        {{__('student.or choose files to upload')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="font_22 f_w_700 mb_30">{{__('student.Social Links')}}</h3>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label class="primary_label2">{{__('student.Add your Facebook URL')}}</label>
                                        <div class="input-group custom_input_group mb_20">
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"> <i class="ti-facebook"></i> <span>www.facebook.com/</span> </span>
                                            </div>
                                            <input name="facebook" type="text"
                                                   value="{{$profile->facebook !=""? @$profile->facebook:old('facebook')}}"
                                                   placeholder="{{__('student.Facebook URL')}}"
                                                   onfocus="this.placeholder = ''"
                                                   onblur="this.placeholder = '{{__('student.Facebook URL')}}'"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="primary_label2">{{__('student.Add your Twitter URL')}}</label>
                                        <div class="input-group custom_input_group mb_20">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text twitter_bg"> <i
                                                            class="ti-twitter-alt"></i> <span>www.twitter.com/</span> </span>
                                            </div>
                                            <input type="text" placeholder="{{__('student.Twitter URL')}}"
                                                   name="twitter"
                                                   onfocus="this.placeholder = ''"
                                                   onblur="this.placeholder = '{{__('student.Twitter URL')}}'"
                                                   class="form-control"
                                                   value="{{$profile->twitter !=""? @$profile->twitter:old('twitter')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="primary_label2">{{__('student.Add your LinkedIn URL')}}</label>
                                        <div class="input-group custom_input_group mb_20">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text linkedin_bg"> <i
                                                            class="ti-linkedin"></i> <span>www.linkedin.com/</span> </span>
                                            </div>
                                            <input type="text" placeholder="{{__('student.LinkedIn profile')}}"
                                                   onfocus="this.placeholder = ''"
                                                   onblur="this.placeholder = '{{__('student.LinkedIn profile')}}'"
                                                   class="form-control" name="linkedin"
                                                   value="{{$profile->linkedin !=""? @$profile->linkedin:old('linkedin')}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <label class="primary_label2">{{__('student.Add your Youtube URL')}}</label>
                                        <div class="input-group custom_input_group mb_20">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text youtube_bg"> <i
                                                            class="ti-youtube"></i> <span>www.youtube.com/</span> </span>
                                            </div>
                                            <input type="text" placeholder="{{__('student.Youtube Profile')}}"
                                                   onfocus="this.placeholder = ''"
                                                   onblur="this.placeholder = '{{__('student.Youtube Profile')}}'"
                                                   class="form-control"
                                                   value="{{$profile->youtube !=""? @$profile->youtube:old('youtube')}}"
                                                   name="youtube">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button
                                            class="theme_btn w-100 text-center mt_40">{{__('student.Save')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
