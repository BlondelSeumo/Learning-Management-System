@extends('frontend.infixlmstheme.layouts.dashboard_master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} |  {{__('payment.Fund Deposit')}} @endsection
@section('css') @endsection
@section('js')
    <script src="{{asset('public/frontend/infixlmstheme/js/deposit.js')}}"></script>
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
                                    <h3 class="mb-0">{{__('common.Select')}} {{__('payment.Payment Method')}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(isset($methods))
                                @foreach($methods as $key=>$gateway)

                                    <div class="col-xl-2 pt-10 pb-10">
                                        <div class=" payment_area">
                                            @if($gateway->method=="Stripe")
                                                <form action="{{route('depositSubmit')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="method"
                                                           value="{{$gateway->method}}">
                                                    <input type="hidden" name="deposit_amount"
                                                           value="{{$amount}}">
                                                    <!-- single_deposite_item  -->
                                                    <button type="button" class="theme_line_payment_btn">
                                                        <img class="stripeSubmitBtn  " style="padding: 12px;width: 70%!important;
        margin-top: -9px;"
                                                             src="{{asset($gateway->logo)}}"
                                                             alt="">
                                                    </button>
                                                    @csrf
                                                    <script
                                                        src="https://checkout.stripe.com/checkout.js"
                                                        class="stripe-button"
                                                        data-key="{{ env('STRIPE_KEY') }}"
                                                        data-name="Stripe Payment"
                                                        data-image="{{asset(getSetting()->favicon)}}"
                                                        data-locale="auto"
                                                        data-currency="usd">
                                                    </script>


                                                    <button type="submit" class="d-none stripeSubmit">
                                                    </button>

                                                </form>
                                            @elseif($gateway->method=="Wallet")
                                                <form action="{{route('depositSubmit')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="method"
                                                           value="{{$gateway->method}}">
                                                    <input type="hidden" name="deposit_amount"
                                                           value="{{$amount}}">
                                                    <div class="bank_check">
                                                        <button type="button" class="theme_line_payment_btn">

                                                            {{--                                                        @if (Auth::user()->balance >= $checkout->purchase_price)--}}
                                                            <input name="payment_method" value="Wallet"
                                                                   id="balanceInput"
                                                                   style="display: {{Auth::user()->balance >= $checkout->purchase_price?'':'none'}}"
                                                                   class="method"
                                                                   type="hidden">


                                                            <span
                                                                class="label_name">Wallet</span>

                                                        </button>

                                                    </div>
                                                </form>
                                            @elseif($gateway->method=="RazorPay")

                                                @csrf

                                                <div class="single_deposite_item">

                                                    <div class="deposite_button text-center">
                                                        <form action="{{ route('depositSubmit') }}" method="POST">
                                                            <input type="hidden" name="method"
                                                                   value="{{$gateway->method}}">
                                                            <input type="hidden" name="deposit_amount"
                                                                   value="{{$amount}}">
                                                            <button type="button" class="theme_line_payment_btn">
                                                                <img class="razorSubmitBtn" style="padding: 0;width: 70%!important;
    margin-top: -2px;"
                                                                     src="{{asset($gateway->logo)}}"
                                                                     alt="">
                                                            </button>
                                                            @csrf
                                                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                                    data-key="{{ env('RAZOR_KEY') }}"
                                                                    data-amount="{{ convertCurrency(getSetting()->currency->code??'BDT', 'INR', $amount)*100}}"
                                                                    data-name="{{str_replace('_', ' ',config('app.name') ) }}"
                                                                    data-description="Cart Payment"
                                                                    data-image="{{asset(getSetting()->favicon)}}"
                                                                    data-prefill.name="{{ @Auth::user()->username }}"
                                                                    data-prefill.email="{{ @Auth::user()->email }}"
                                                                    data-theme.color="#ff7529">
                                                            </script>
                                                        </form>
                                                    </div>
                                                </div>

                                            @elseif($gateway->method=="PayPal")

                                                <form action="{{route('depositSubmit')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="method"
                                                           value="{{$gateway->method}}">
                                                    <input type="hidden" name="deposit_amount"
                                                           value="{{$amount}}">
                                                    <button type="button" class="theme_line_payment_btn">
                                                        <img class="submitBtn" style="    padding: 0;width: 70%!important;
    margin-top: -2px;"
                                                             src="{{asset($gateway->logo)}}"
                                                             alt="">
                                                    </button>

                                                </form>
                                            @elseif($gateway->method=="PayTM")

                                                <form action="{{route('depositSubmit')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="method"
                                                           value="{{$gateway->method}}">
                                                    <input type="hidden" name="deposit_amount"
                                                           value="{{$amount}}">
                                                    <button type="button" class="theme_line_payment_btn">
                                                        <img class="submitBtn" style="    padding: 10px;
    margin-top: -6px;width: 70%!important;"
                                                             src="{{asset($gateway->logo)}}"
                                                             alt="">
                                                    </button>

                                                </form>

                                            @else

                                                <form action="{{route('depositSubmit')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="method"
                                                           value="{{$gateway->method}}">
                                                    <input type="hidden" name="deposit_amount"
                                                           value="{{$amount}}">
                                                    <button type="button" class="theme_line_payment_btn">
                                                        <img class="submitBtn " style="width: 70%!important;"
                                                             src="{{asset($gateway->logo)}}"
                                                             alt="">
                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- category::end  -->
@endsection
