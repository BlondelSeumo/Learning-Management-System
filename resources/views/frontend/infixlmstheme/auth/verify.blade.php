@extends('frontend.infixlmstheme.auth.layouts.app')
@section('content')


    <style>
        .error_wrapper{
            padding: 243px 0 250px 0;

        }
    </style>

    <div class="error_wrapper">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12">
                    <div class="error_wrapper_info text-center">
                        <div class="thumb">
                            <img src="{{asset('/public/infixlmstheme/')}}/img/banner/error_thumb.png" alt="">
                        </div>
                        <h3>{{ __('Verify Your Email Address') }}</h3>
                        @if (session('resent'))
                            <p>{{ __('A fresh verification link has been sent to your email address.') }}</p>

                        @endif
                        <br>

                        <p class="mb-2 h6">
                            {{ __('Before proceeding, please check your email for a verification link Login in Using that Link.') }}
                        </p>
                        <form method="POST" class="" action="{{ route('verification_mail_resend') }}">
                            @csrf
                            <div class="">
                                <button type="submit" class="theme_btn">
                                    {{ __('Resend Mail') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
