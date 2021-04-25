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
                <h4>{{__('common.Sign Up Details')}}</h4>
                <form action="{{route('register')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group custom_group_field">
                                <input type="text" class="form-control pl-0"
                                       placeholder="{{__('student.Enter Full Name')}} *" aria-label="Username"
                                       name="name" value="{{old('name')}}">
                            </div>
                            <span class="text-danger" role="alert">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-12 mt_20">
                            <div class="input-group custom_group_field">
                                <input type="email" class="form-control pl-0"
                                       placeholder="{{__('common.Enter Email')}} *"
                                       aria-label="email" name="email" value="{{old('email')}}">
                            </div>
                            <span class="text-danger" role="alert">{{$errors->first('email')}}</span>
                        </div>


                        <div class="col-12 mt_20">
                            <div class="input-group custom_group_field">
                                <input type="text" class="form-control pl-0"
                                       placeholder="{{__('common.Enter Phone Number')}}"
                                       aria-label="phone" name="phone" value="{{old('phone')}}">
                            </div>
                            <span class="text-danger" role="alert">{{$errors->first('phone')}}</span>
                        </div>
                        <div class="col-12 mt_20">
                            <div class="input-group custom_group_field">
                                <input type="password" class="form-control pl-0"
                                       placeholder="{{__('frontend.Enter Password')}} *"
                                       aria-label="password" name="password">
                            </div>
                            <span class="text-danger" role="alert">{{$errors->first('password')}}</span>
                        </div>
                        <div class="col-12 mt_20">
                            <div class="input-group custom_group_field">
                                <input type="password" class="form-control pl-0"
                                       placeholder="{{__('common.Enter Confirm Password')}} *"
                                       name="password_confirmation" aria-label="password_confirmation">
                            </div>
                            <span class="text-danger" role="alert">{{$errors->first('password_confirmation')}}</span>
                        </div>
                        <div class="col-12 mt_20">
                            <div class="remember_forgot_pass d-flex align-items-center">
                                <label class="primary_checkbox d-flex" for="checkbox">
                                    <input checked="" type="checkbox" id="checkbox" required>
                                    <span class="checkmark mr_15"></span>
                                    <p>{{__('frontend.By signing up, you agree to')}} <a target="_blank"
                                                                                         href="{{url('privacy')}}">{{__('frontend.Terms of Service')}}</a> {{__('frontend.and')}}
                                        <a href="{{url('privacy')}}">{{__('frontend.Privacy Policy')}}.</a></p>
                                </label>

                            </div>
                        </div>


                        <div class="col-12">
                            <button type="submit" class="theme_btn text-center w-100" id="submitBtn">
                                {{__('common.Register')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>


            <h5 class="shitch_text">
                {{__('common.You have already an account?')}} <a href="{{route('login')}}"> {{__('common.Login')}}</a>

            </h5>
        </div>

        @include('frontend.infixlmstheme.auth.login_wrapper_right')

    </div>
    <script>
        $(function () {
            $('#checkbox').click(function () {

                if ($(this).is(':checked')) {
                    $('#submitBtn   ').removeClass('disable_btn');
                    $('#submitBtn   ').removeAttr('disabled');

                } else {
                    $('#submitBtn   ').addClass('disable_btn');
                    $('#submitBtn').attr('disabled', 'disabled');

                }
            });
        });
    </script>


@endsection
