@extends('backend.master')

@section('mainContent')

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('setting.Payment Method Settings')}}</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">{{__('common.Dashboard')}} </a>
                    <a href="#">{{__('setting.Setting')}}</a>
                    <a href="#">{{__('setting.Payment Method Settings')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-40 student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-3 ">

                    <div class="row row pt-20 justify-content-center">
                        <div class="col-12">
                            <div class="box_header common_table_header">
                                <div class="main-title d-md-flex">
                                    <h3 class="mt-10">{{__('setting.Gateway Status')}}</h3>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white-box ">
                        <form method="POST" action="{{route('paymentmethodsetting.changePaymentGatewayStatus')}}"
                              accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            @csrf


                            <div class="row">

                                @foreach ($payment_methods as $Key=>$payment_method)

                                    <div class="col-xl-12">

                                        <div class="primary_input mb-25">
                                            <div class="input-effect">
                                                <input type="checkbox" id="method_{{$payment_method->id}}"
                                                       class="common-checkbox class-checkbox read-only-input"
                                                       name="gateways[]"
                                                       value="{{$payment_method->id}}" {{$payment_method->active_status==1?'checked':''}}>
                                                <label
                                                    for="method_{{$payment_method->id}}">{{$payment_method->method}}
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-lg-12 text-center">
                                    <div class="d-flex justify-content-center pt_20">
                                        <button type="submit" class="primary-btn semi_large fix-gr-bg"
                                                id="save_button_parent">
                                            <i class="ti-check"></i>
                                            {{ __('common.Update') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
                <div class="col-lg-9">
                    <div class="row pt-20">
                        <div class="main-title pt-10">
                            <h3 class="mb-30">{{__('setting.gateway_setting')}}</h3>
                        </div>
                        <ul class="nav nav-tabs no-bottom-border mt-sm-md-20 mb-30 ml-3" role="tablist">
                            @foreach ($payment_methods->where('method','!=','Offline Payment')->where('method','!=','Wallet')  as $Key=>$payment_method)
                                <li class="nav-item m-1">
                                    <a class="nav-link  {{$Key==0?'active':''}} "
                                       href="#method{{$payment_method->id}}"
                                       role="tab" data-toggle="tab">{{@$payment_method->method}}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        @foreach ($payment_methods->where('method','!=','Offline Payment')->where('method','!=','Wallet') as $key=>$payment_method)

                            <div role="tabpanel" class="tab-pane fade  {{$key==0?'active':''}}  show "
                                 id="method{{$payment_method->id}}">

                                @if (permissionCheck('paymentmethodsetting.payment_method_setting_update'))
                                    <form class="form-horizontal"
                                          action="{{route('paymentmethodsetting.update_payment_gateway')}}"
                                          method="POST" enctype="multipart/form-data">
                                        @endif
                                        @csrf
                                        <div class="white-box">


                                            <div class="col-md-12 ">
                                                <input type="hidden" name="payment_method_id"
                                                       value="{{@$payment_method->id}}">

                                                @if($payment_method->method=="Sslcommerz")

                                                    <div class="row mb-30">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-lg-4 mb-30">
                                                                    <div class="input-effect">

                                                                        <input
                                                                            class="primary-input form-control{{ $errors->has('store_id') ? ' is-invalid' : '' }}"
                                                                            type="text" name="ssl_store_id"
                                                                            id="ssl_store_id"
                                                                            required
                                                                            autocomplete="off"
                                                                            value="{{env('STORE_ID')? env('STORE_ID') : ''}}">
                                                                        <label>{{__('setting.Store ID')}}
                                                                            <span></span>
                                                                        </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-4 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control{{ $errors->has('store_password') ? ' is-invalid' : '' }}"
                                                                            type="text" name="ssl_store_password"
                                                                            id="ssl_store_password"
                                                                            autocomplete="off"
                                                                            value="{{env('STORE_PASSWORD')? env('STORE_PASSWORD') : ''}}">
                                                                        <label>{{__('setting.Store Password')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-2 mt-20 mb-30">
                                                                    <div class="input-effect">
                                                                        <div class="input-effect">
                                                                            <div class="text-left float-left">
                                                                                <input type="radio" name="ssl_mode"
                                                                                       @if(env('IS_LOCALHOST'))
                                                                                       checked
                                                                                       @endif


                                                                                       id="mode_check_{{$payment_method->id}}"
                                                                                       value="1"
                                                                                       class="common-radio relationButton read-only-input">
                                                                                <label
                                                                                    for="mode_check_{{$payment_method->id}}">{{__('common.Sandbox')}}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2 mt-20 mb-30">
                                                                    <div class="input-effect">
                                                                        <div class="input-effect">
                                                                            <div class="text-left float-left">
                                                                                <input type="radio" name="ssl_mode"
                                                                                       id="live_mode_check_{{$payment_method->id}}"
                                                                                       @if(!env('IS_LOCALHOST'))
                                                                                       checked
                                                                                       @endif
                                                                                       value="2"
                                                                                       class="common-radio relationButton read-only-input">
                                                                                <label
                                                                                    for="live_mode_check_{{$payment_method->id}}">{{__('common.Live')}}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                @elseif($payment_method->method=='PayPal')
                                                    <div class="row mb-30">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-lg-4 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            class="primary-input form-control"
                                                                            type="text" name="paypal_client_id"
                                                                            id="paypal_client_id"
                                                                            required
                                                                            autocomplete="off"
                                                                            value="{{env('PAYPAL_CLIENT_ID')? env('PAYPAL_CLIENT_ID') : ''}}">
                                                                        <label>{{__('setting.Client ID')}}
                                                                            <span></span>
                                                                        </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control{{ $errors->has('client_secret') ? ' is-invalid' : '' }}"
                                                                            type="text" name="paypal_client_secret"
                                                                            id="paypal_client_secret"
                                                                            autocomplete="off"
                                                                            value="{{env('PAYPAL_CLIENT_SECRET')? env('PAYPAL_CLIENT_SECRET') : ''}}">
                                                                        <label>{{__('setting.Client Secret')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2 mt-20 mb-30">
                                                                    <div class="input-effect">
                                                                        <div class="input-effect">
                                                                            <div class="text-left float-left">
                                                                                <input type="radio"
                                                                                       name="paypal_mode"
                                                                                       @if(env('IS_PAYPAL_LOCALHOST'))
                                                                                       checked
                                                                                       @endif


                                                                                       id="mode_check_{{$payment_method->id}}"
                                                                                       value="1"
                                                                                       class="common-radio relationButton read-only-input">
                                                                                <label
                                                                                    for="mode_check_{{$payment_method->id}}">{{__('common.Sandbox')}}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2 mt-20 mb-30">
                                                                    <div class="input-effect">
                                                                        <div class="input-effect">
                                                                            <div class="text-left float-left">
                                                                                <input type="radio"
                                                                                       name="paypal_mode"
                                                                                       id="live_mode_check_{{$payment_method->id}}"
                                                                                       @if(!env('IS_PAYPAL_LOCALHOST'))
                                                                                       checked
                                                                                       @endif
                                                                                       value="2"
                                                                                       class="common-radio relationButton read-only-input">
                                                                                <label
                                                                                    for="live_mode_check_{{$payment_method->id}}">{{__('common.Live')}}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>


                                                    </div>
                                                @elseif($payment_method->method=='Stripe')

                                                    <div class="row mb-30">
                                                        <div class="col-md-12">
                                                            <div class="row">

                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control "
                                                                            type="text" name="client_secret"
                                                                            id="secret_key" autocomplete="off"
                                                                            value="{{env('STRIPE_SECRET')? env('STRIPE_SECRET') : ''}}">
                                                                        <label>{{__('setting.Secret Key')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control"
                                                                            type="text" name="client_publisher_key"
                                                                            id="publisher_key" autocomplete="off"
                                                                            value="{{env('STRIPE_KEY')? env('STRIPE_KEY') : ''}}">
                                                                        <label>{{__('setting.Publisher Key')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>


                                                            </div>


                                                        </div>
                                                    </div>
                                                @elseif($payment_method->method=='PayStack')

                                                    <div class="row mb-30">
                                                        <div class="col-md-12">
                                                            <div class="row">

                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control "
                                                                            type="text" name="paystack_key"
                                                                            id="razor_key" autocomplete="off"
                                                                            value="{{env('PAYSTACK_PUBLIC_KEY')? env('PAYSTACK_PUBLIC_KEY') : ''}}">
                                                                        <label>{{__('setting.PayStack Public Key')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control"
                                                                            type="text" name="paystack_secret"
                                                                            id="razor_secret" autocomplete="off"
                                                                            value="{{env('PAYSTACK_SECRET_KEY')? env('PAYSTACK_SECRET_KEY') : ''}}">
                                                                        <label>{{__('setting.PayStack Secret Key')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control"
                                                                            type="text" name="merchant_email"
                                                                            id="razor_secret" autocomplete="off"
                                                                            value="{{env('MERCHANT_EMAIL')? env('MERCHANT_EMAIL') : ''}}">
                                                                        <label>{{__('setting.Merchant Email')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control"
                                                                            type="text" name="paystack_payment_url"
                                                                            id="razor_secret" autocomplete="off"
                                                                            value="{{env('PAYSTACK_PAYMENT_URL')? env('PAYSTACK_PAYMENT_URL') : ''}}">
                                                                        <label>{{__('setting.PayStack Payment URL')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 mb_30">
                                                                    @if(Route::has('payStackCallBack'))
                                                                        <small>
                                                                            {{__('quiz.Note')}}
                                                                            : {{__('setting.Make sure you have')}}

                                                                            <b>{{route('payStackCallBack')}}</b>
                                                                            {{__('setting.registered in PayStack')}}
                                                                            <a
                                                                                href="https://dashboard.paystack.co/#/settings/developer ">{{__('dashboard.Dashboard')}}</a>


                                                                        </small>

                                                                    @endif
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>

                                                @elseif($payment_method->method=='RazorPay')

                                                    <div class="row mb-30">
                                                        <div class="col-md-12">
                                                            <div class="row">

                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control "
                                                                            type="text" name="razor_key"
                                                                            id="razor_key" autocomplete="off"
                                                                            value="{{env('RAZOR_KEY')? env('RAZOR_KEY') : ''}}">
                                                                        <label>{{__('setting.Razor Key')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control"
                                                                            type="text" name="razor_secret"
                                                                            id="razor_secret" autocomplete="off"
                                                                            value="{{env('RAZOR_SECRET')? env('RAZOR_SECRET') : ''}}">
                                                                        <label>{{__('setting.Razor Secret')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>


                                                            </div>


                                                        </div>
                                                    </div>

                                                @elseif($payment_method->method=='PayTM')

                                                    <div class="row mb-30">
                                                        <div class="col-md-12">
                                                            <div class="row">

                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control"
                                                                            type="text" name="paytm_merchant_id"
                                                                            id="paytm_merchant_id" autocomplete="off"
                                                                            value="{{env('PAYTM_MERCHANT_ID')? env('PAYTM_MERCHANT_ID') : ''}}">
                                                                        <label>{{__('setting.Merchant ID')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 mt-20 mb-30">
                                                                    <div class="input-effect">
                                                                        <div class="input-effect">

                                                                            <div class="text-left float-left">
                                                                                <input type="radio"
                                                                                       name="paytm_mode"
                                                                                       @if(env('PAYTM_ENVIRONMENT')=="local")
                                                                                       checked
                                                                                       @endif

                                                                                       id="mode_check_{{$payment_method->id}}"
                                                                                       value="local"
                                                                                       class="common-radio relationButton read-only-input">
                                                                                <label
                                                                                    for="mode_check_{{$payment_method->id}}">{{__('common.Sandbox')}}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 mt-20 mb-30">
                                                                    <div class="input-effect">
                                                                        <div class="input-effect">
                                                                            <div class="text-left float-left">
                                                                                <input type="radio"
                                                                                       name="paytm_mode"
                                                                                       id="live_mode_check_{{$payment_method->id}}"
                                                                                       @if(env('PAYTM_ENVIRONMENT')=="production")
                                                                                       checked
                                                                                       @endif
                                                                                       value="production"
                                                                                       class="common-radio relationButton read-only-input">
                                                                                <label
                                                                                    for="live_mode_check_{{$payment_method->id}}">{{__('common.Live')}}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control "
                                                                            type="text" name="paytm_merchant_key"
                                                                            id="razor_key" autocomplete="off"
                                                                            value="{{env('PAYTM_MERCHANT_KEY')? env('PAYTM_MERCHANT_KEY') : ''}}">
                                                                        <label>{{__('setting.Merchant Key')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control"
                                                                            type="text"
                                                                            name="paytm_merchant_website"
                                                                            id="razor_secret" autocomplete="off"
                                                                            value="{{env('PAYTM_MERCHANT_WEBSITE')? env('PAYTM_MERCHANT_WEBSITE') : ''}}">
                                                                        <label>{{__('setting.PayTM Merchant Website')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control "
                                                                            type="text" name="paytm_channel"
                                                                            id="razor_key" autocomplete="off"
                                                                            value="{{env('PAYTM_CHANNEL')? env('PAYTM_CHANNEL') : ''}}">
                                                                        <label>{{__('setting.PayTM Channel')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control"
                                                                            type="text" name="industry_type"
                                                                            id="razor_secret" autocomplete="off"
                                                                            value="{{env('PAYTM_INDUSTRY_TYPE')? env('PAYTM_INDUSTRY_TYPE') : ''}}">
                                                                        <label>{{__('setting.Industry Type')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>


                                                            </div>


                                                        </div>
                                                    </div>

                                                @elseif($payment_method->method=='Bank Payment')
                                                    <div class="row mb-30">
                                                        <div class="col-md-12">
                                                            <div class="row">


                                                                <div class="col-lg-4 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control "
                                                                            type="text" name="bank_name"
                                                                            id="bank_name" autocomplete="off"
                                                                            value="{{env('BANK_NAME')? env('BANK_NAME') : ''}}">
                                                                        <label>{{__('setting.Bank Name')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-4 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control"
                                                                            type="text" name="branch_name"
                                                                            id="branch_name" autocomplete="off"
                                                                            value="{{env('BRANCH_NAME')? env('BRANCH_NAME') : ''}}">
                                                                        <label>{{__('setting.Branch Name')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-30"  style="margin-top: -10px;">
                                                                    <div class="input-effect">

                                                                        <select class="primary_select" name="type"
                                                                                id="type"
                                                                                style="margin-top: -10px;">
                                                                            <option
                                                                                data-display="{{__('common.Select')}}  {{__('setting.Account Type')}}"
                                                                                value="">{{__('common.Select')}} {{__('setting.Account Type')}}</option>
                                                                            <option
                                                                                value="Current Account" {{(env('ACCOUNT_TYPE')? env('ACCOUNT_TYPE') : '')=='Current Account'?'selected':''}}>
                                                                                Current Account
                                                                            </option>

                                                                            <option
                                                                                value="Savings Account" {{(env('ACCOUNT_TYPE')? env('ACCOUNT_TYPE') : '')=='Savings Account'?'selected':''}}>
                                                                                Savings Account
                                                                            </option>
                                                                            <option
                                                                                value="Salary Account" {{(env('ACCOUNT_TYPE')? env('ACCOUNT_TYPE') : '')=='Salary Account'?'selected':''}}>
                                                                                Salary Account
                                                                            </option>
                                                                            <option
                                                                                value="Fixed Deposit" {{(env('ACCOUNT_TYPE')? env('ACCOUNT_TYPE') : '')=='Fixed Deposit'?'selected':''}}>
                                                                                Fixed Deposit
                                                                            </option>

                                                                        </select>


                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control "
                                                                            type="text" name="account_number"
                                                                            id="account_number" autocomplete="off"
                                                                            value="{{env('ACCOUNT_NUMBER')? env('ACCOUNT_NUMBER') : ''}}">
                                                                        <label>{{__('setting.Account Number')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-30">
                                                                    <div class="input-effect">
                                                                        <input
                                                                            required
                                                                            class="primary-input form-control"
                                                                            type="text" name="account_holder"
                                                                            id="razor_secret" autocomplete="off"
                                                                            value="{{env('ACCOUNT_HOLDER')? env('ACCOUNT_HOLDER') : ''}}">
                                                                        <label>{{__('setting.Account Holder')}}
                                                                            <span></span> </label>
                                                                        <span class="focus-border"></span>
                                                                        <span
                                                                            class="modal_input_validation red_alert"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                @endif

                                                @if($payment_method->method!="Bank Payment" && $payment_method->method!="Offline Payment" && $payment_method->method!="Wallet")

                                                    <div class="row imageBox">
                                                        <div class="col-xl-6">
                                                            <div class="primary_input mb-35">
                                                                <label class="primary_input_label"
                                                                       for="">{{__('setting.Logo')}}</label>
                                                                <div class="primary_file_uploader">
                                                                    <input class="primary-input filePlaceholder"
                                                                           type="text"
                                                                           value="{{showPicName(@$payment_method->logo)}}"
                                                                           placeholder="Browse Image file"
                                                                           readonly="">
                                                                    <button class="" type="button">
                                                                        <label
                                                                            class="primary-btn small fix-gr-bg"
                                                                            for="document_file_1_edit_{{@$payment_method->id}}">{{__('common.Browse')}}</label>
                                                                        <input type="file"
                                                                               class="d-none fileUpload"
                                                                               name="logo"
                                                                               id="document_file_1_edit_{{@$payment_method->id}}"
                                                                        >
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <img class="  p-3 preview"
                                                                 style="max-height: 100px;max-width: 100%"
                                                                 src="{{asset($payment_method->logo)}}"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                @endif


                                                <div class="row mt-40">
                                                    <div class="col-lg-12 text-center">
                                                        <button class="primary-btn fix-gr-bg">
                                                            <span class="ti-check"></span>
                                                            {{__('common.Update')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                            </div>
                        @endforeach

                    </div>
                </div>


            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script src="{{asset('public/backend/js/gateway.js')}}"></script>
@endpush
