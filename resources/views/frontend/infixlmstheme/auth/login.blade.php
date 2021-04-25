@extends('frontend.infixlmstheme.auth.layouts.app')
@section('content')
    <div class="login_wrapper">
        <div class="login_wrapper_left">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img style="width: 190px" src="{{asset(getSetting()->logo)}} " alt="">
                </a>
            </div>
            <div class="login_wrapper_content">
                <h4>{{__('frontend.Welcome back, Please login')}} <br>{{__('frontend.to your account')}} </h4>


                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group custom_group_field">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">
                                        <!-- svg -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.328" height="10.662"
                                             viewBox="0 0 13.328 10.662">
                                            <path id="Path_44" data-name="Path 44"
                                                  d="M13.995,4H3.333A1.331,1.331,0,0,0,2.007,5.333l-.007,8a1.337,1.337,0,0,0,1.333,1.333H13.995a1.337,1.337,0,0,0,1.333-1.333v-8A1.337,1.337,0,0,0,13.995,4Zm0,9.329H3.333V6.666L8.664,10l5.331-3.332ZM8.664,8.665,3.333,5.333H13.995Z"
                                                  transform="translate(-2 -4)" fill="#687083"/>
                                        </svg>
                                        <!-- svg -->
                                    </span>
                                </div>
                                <input type="email" value="{{old('email')}}"
                                       class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       placeholder="{{__('common.Enter Email')}}" name="email" aria-label="Username"
                                       aria-describedby="basic-addon3">
                            </div>
                            @if($errors->first('email'))
                                <span class="text-danger" role="alert">{{$errors->first('email')}}</span>
                            @endif
                        </div>

                        <div class="col-12 mt_20">
                            <div class="input-group custom_group_field">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon4">
                                        <!-- svg -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10.697" height="14.039"
                                             viewBox="0 0 10.697 14.039">
                                        <path id="Path_46" data-name="Path 46"
                                              d="M9.348,11.7A1.337,1.337,0,1,0,8.011,10.36,1.341,1.341,0,0,0,9.348,11.7ZM13.36,5.68h-.669V4.343a3.343,3.343,0,0,0-6.685,0h1.27a2.072,2.072,0,0,1,4.145,0V5.68H5.337A1.341,1.341,0,0,0,4,7.017V13.7a1.341,1.341,0,0,0,1.337,1.337H13.36A1.341,1.341,0,0,0,14.7,13.7V7.017A1.341,1.341,0,0,0,13.36,5.68Zm0,8.022H5.337V7.017H13.36Z"
                                              transform="translate(-4 -1)" fill="#687083"/>
                                        </svg>
                                        <!-- svg -->
                                    </span>
                                </div>
                                <input type="password" name="password" class="form-control"
                                       placeholder="{{__('common.Enter Password')}}" aria-label="password"
                                       aria-describedby="basic-addon4">
                            </div>
                            @if($errors->first('password'))
                                <span class="text-danger" role="alert">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                        <div class="col-12 mt_20">
                            <div class="remember_forgot_pass d-flex justify-content-between">
                                <label class="primary_checkbox d-flex">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="1">
                                    <span class="checkmark mr_15"></span>
                                    <span class="label_name">{{__('common.Remember Me')}}</span>
                                </label>
                                <a href="{{route('SendPasswordResetLink')}}"
                                   class="forgot_pass">{{__('common.Forget Password ?')}}</a>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="theme_btn text-center w-100"> {{__('common.Login')}}</button>
                        </div>
                    </div>
                </form>
            </div>
            <h5 class="shitch_text">{{__("frontend.Don’t have an account")}}? <a href="{{route('register')}}">
                    {{__('common.Register')}}
                </a></h5>
            @if(appMode())
                <div class="row mt-4">
                    <div class="col-md-4 mb_10">
                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="support@spondonit.com">
                            <input type="hidden" name="password" value="12345678">
                            <button type="submit" class="theme_btn small_btn2 text-center w-100"> Admin</button>
                        </form>
                    </div>

                    <div class="col-md-4 mb_10">
                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="teacher@infixedu.com">
                            <input type="hidden" name="password" value="12345678">
                            <button type="submit" class="theme_btn small_btn2 text-center w-100"> Instructor</button>
                        </form>
                    </div>
                    <div class="col-md-4 mb_10">

                        <form action="{{route('login')}}" method="POST">
                            <input type="hidden" name="email" value="student@infixedu.com">
                            <input type="hidden" name="password" value="12345678">
                            @csrf
                            <button type="submit" class="theme_btn small_btn2 text-center w-100"> Student</button>
                        </form>

                    </div>
                </div>
            @endif
        </div>
     @include('frontend.infixlmstheme.auth.login_wrapper_right')
    </div>

    {!! Toastr::message() !!}

@endsection
