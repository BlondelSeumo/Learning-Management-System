@extends('frontend.infixlmstheme.layouts.dashboard_master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('communication.Your referral link')}} @endsection
@section('css') @endsection
@section('js')
    <script src="{{ asset('public/frontend/infixlmstheme/js/copy_currency.js') }}"></script>
@endsection
@section('mainContent')
    <!-- category::start  -->

    <div class="main_content_iner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="purchase_history_wrapper">
                        <div class="row">
                            <div class="col-12">
                                <div class="section__title3 mb_40">
                                    <h3 class="mb-0">{{__('communication.Your referral link')}}</h3>
                                    <p>{{__('communication.Share the referral link with your friends.')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="col-12">
                                    <div class="referral_copy_link mb_30">
                                        <div class="referral_copy_inner">
                                            <div class="single_input">
                                                <input type="text" id="referral_link"
                                                       placeholder="http://tutees.com/user256"
                                                       value="{{route('referralCode',Auth::user()->referral)}}"
                                                       class="primary_input white_input">
                                            </div>
                                            <button onclick="copyCurrentUrl()"
                                                    class="theme_btn mt-3 height_50">{{__('communication.Copy Link')}}</button>
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



    @if(count($referrals)!=0)
        <div class="main_content_iner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="purchase_history_wrapper">
                            <div class="row">
                                <div class="col-12">
                                    <div class="section__title3 mb_40">
                                        <h3 class="mb-0">{{__('communication.Your referral list')}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="table-responsive">
                                        <table class="table custom_table3 mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col">{{__('common.SL')}}</th>
                                                <th scope="col">{{__('common.User')}}</th>
                                                <th scope="col">{{__('common.Date')}}</th>
                                                <th scope="col">{{__('payment.Discount Amount')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($referrals))
                                                @foreach ($referrals as $key=> $referral)
                                                    {{-- {{dd($referral)}} --}}
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>
                                                            <div class="CourseMeta d-flex align-items-center">
                                                                <div class="profile_info">
                                                                    <img class=""
                                                                         src="{{getProfileImage(@$referral->image)}}"
                                                                         alt="">
                                                                </div>
                                                                <div class="reffer_meta">
                                                                    <a href="#"><h4
                                                                            class="font_16 f_w_400 mb-0 d-inline-block">{{@$referral->name}}</h4>
                                                                    </a>
                                                                    <a href="#"><p
                                                                            class="font_14">{{@$referral->email}}</p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ date(getSetting()->date_format->format, strtotime($referral->created_at)) }}</td>
                                                        <td>{{getSetting()->currency->symbol??'৳'}}  {{@$referral->bonus_amount}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif





@endsection
