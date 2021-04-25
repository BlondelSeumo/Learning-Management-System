@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | @lang('frontendmanage.Payment Method') @endsection
@section('css')
@endsection
@section('mainContent')


    @csrf

    <div class="checkout_wrapper payment_area" id="mainFormData">

        <div class="billing_details_wrapper">
            <div class="biling_address gray-bg">
                <div class="biling-header d-flex justify-content-between align-items-center">
                    <h4>{{__('frontendmanage.Billing Address')}}</h4>
                    <a href="{{ route('CheckOut') }}?type=edit">{{__('common.Edit')}}</a>
                </div>
                <div class="biling_body_content">
                    <p>{{ @$checkout->billing->first_name }} {{ @$checkout->billing->last_name }}</p>
                    <p>{{ @$checkout->billing->address }}</p>
                    <p>{{ @$checkout->billing->city }} - {{ @$checkout->billing->zip_code }} </p>
                    <p>  {{ @$checkout->billing->countryDetails->name }} </p>
                </div>
            </div>
            <div class="select_payment_method">
                <div class="input_box_tittle">
                    <h4>@lang('frontendmanage.Payment Method')</h4>

                </div>

                <div class="privaci_polecy_area section-padding checkout_area ">
                    <div class="">
                        <div class="row">
                            <div class="col-12">
                                <div class="payment_method_wrapper">
                                    @if(isset($methods))
                                        @foreach($methods->where('method','!=','Bank Payment')->where('method','!=','Offline Payment') as $key=>$gateway)

                                            <div class="payment_method_single">
                                                <div class="deposite_payment_wrapper customer_payment_wrapper">
                                                    @if($gateway->method=="Stripe")
                                                        <form action="{{route('paymentSubmit')}}" method="post">
                                                            <input type="hidden" name="tracking_id"
                                                                   value="{{$checkout->tracking}}">
                                                            <input type="hidden" name="id" value="{{$checkout->id}}">
                                                            @csrf
                                                            <input type="hidden" name="payment_method"
                                                                   value="{{$gateway->method}}">
                                                            <!-- single_deposite_item  -->
                                                            <button type="submit" class="Payment_btn">
                                                                <img class=" w-100 " style="padding: 12px;
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

                                                            <input hidden
                                                                   value="{{ convertCurrency(getSetting()->currency->code??'BDT', 'USD', $checkout->purchase_price)}}"
                                                                   readonly="readonly" type="text" id="amount"
                                                                   name="amount">


                                                        </form>
                                                    @elseif($gateway->method=="Wallet")

                                                        <form action="{{route('paymentSubmit')}}" method="post">

                                                            @csrf

                                                            <div class="bank_check">

                                                                <a href="#" data-toggle="modal"
                                                                   data-target="#MakePaymentFromCredit"
                                                                   class=" payment_btn_text">Wallet</a>

                                                            </div>
                                                        </form>

                                                        <div class="modal fade " id="MakePaymentFromCredit"
                                                             tabindex="-1"
                                                             role="dialog" aria-labelledby="exampleModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel">{{__('student.My Account')}}</h5>
                                                                    </div>
                                                                    <form action="{{route('paymentSubmit')}}"
                                                                          id="infix_payment_form1" method="POST"
                                                                          name="payment_main_balance">
                                                                        @csrf

                                                                        <input type="hidden" name="payment_method"
                                                                               value="{{$gateway->method}}">
                                                                        <input name="payment_method" value="Wallet"
                                                                               id="balanceInput"
                                                                               style="display: {{Auth::user()->balance >= $checkout->purchase_price?'':'none'}}"
                                                                               class="method"
                                                                               type="hidden">
                                                                        <input type="hidden" name="tracking_id"
                                                                               value="{{$checkout->tracking}}">
                                                                        <input type="hidden" name="id"
                                                                               value="{{$checkout->id}}">


                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-xl-6 col-md-6">
                                                                                    <label for="name"
                                                                                           class="mb-2">{{__('frontend.Balance')}}</label>
                                                                                    <input type="text"
                                                                                           class="primary_input3"
                                                                                           value="@if(Auth::user()->balance==0)
                                                                                           {{getSetting()->currency->symbol??'৳'}} 0  @else   {{getPriceFormat(Auth::user()->balance)}}
                                                                                           @endif"
                                                                                           readonly>
                                                                                </div>
                                                                                <div class="col-xl-6 col-md-6">
                                                                                    <label for="name"
                                                                                           class="mb-2">@lang('common.Purchase Price')</label>
                                                                                    <input type="text" name="amount"
                                                                                           class="primary_input3"
                                                                                           value="{{getPriceFormat($checkout->purchase_price)}}"
                                                                                           readonly>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                        <div
                                                                            class="modal-footer payment_btn d-flex justify-content-between">
                                                                            <button type="button" class="theme_line_btn"
                                                                                    data-dismiss="modal">@lang('common.Cancel')</button>

                                                                            @if (Auth::user()->balance >= $checkout->purchase_price)
                                                                                <button class=" theme_btn"
                                                                                        type="submit">
                                                                                    @lang('common.Pay')
                                                                                </button>
                                                                            @else
                                                                                <a class="theme_btn"
                                                                                   href="{{route('deposit')}}">{{__('common.Deposit')}}</a>
                                                                            @endif
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif($gateway->method=="RazorPay")

                                                        @csrf

                                                        <div class="single_deposite_item">

                                                            <div class="deposite_button text-center">
                                                                <form action="{{ route('paymentSubmit') }}"
                                                                      method="POST">
                                                                    <input type="hidden" name="payment_method"
                                                                           value="{{$gateway->method}}">
                                                                    <button type="submit" class="Payment_btn">
                                                                        <img class=" w-100" style="padding: 0;
                                        margin-top: -2px;"
                                                                             src="{{asset($gateway->logo)}}"
                                                                             alt="">
                                                                    </button>
                                                                    <input type="hidden" name="tracking_id"
                                                                           value="{{$checkout->tracking}}">
                                                                    <input type="hidden" name="id"
                                                                           value="{{$checkout->id}}">
                                                                    @csrf
                                                                    <script
                                                                        src="https://checkout.razorpay.com/v1/checkout.js"
                                                                        data-key="{{ env('RAZOR_KEY') }}"
                                                                        data-amount="{{ convertCurrency(getSetting()->currency->code??'BDT', 'INR', $checkout->purchase_price)*100}}"
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

                                                        <form action="{{route('paymentSubmit')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="payment_method"
                                                                   value="{{$gateway->method}}">
                                                            <input type="hidden" name="tracking_id"
                                                                   value="{{$checkout->tracking}}">
                                                            <input type="hidden" name="id" value="{{$checkout->id}}">
                                                            <button type="submit" class="Payment_btn">
                                                                <img class=" w-100" style="    padding: 0;
                                        margin-top: -2px;"
                                                                     src="{{asset($gateway->logo)}}"
                                                                     alt="">
                                                            </button>

                                                        </form>
                                                    @elseif($gateway->method=="PayTM")

                                                        <form action="{{route('paymentSubmit')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="payment_method"
                                                                   value="{{$gateway->method}}">
                                                            <input type="hidden" name="tracking_id"
                                                                   value="{{$checkout->tracking}}">
                                                            <input type="hidden" name="id" value="{{$checkout->id}}">
                                                            <button type="submit" class="Payment_btn">
                                                                <img class=" w-100" style="    padding: 10px;
                                        margin-top: -6px;"
                                                                     src="{{asset($gateway->logo)}}"
                                                                     alt="">
                                                            </button>

                                                        </form>
                                                    @elseif($gateway->method=="PayStack")

                                                        <form action="{{route('paymentSubmit')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="email"
                                                                   value="{{ @Auth::user()->email}}"> {{-- required --}}
                                                            <input type="hidden" name="orderID"
                                                                   value="{{$checkout->tracking}}">
                                                            <input type="hidden" name="amount"
                                                                   value="{{ convertCurrency(getSetting()->currency->code??'BDT', 'ZAR', $checkout->purchase_price)*100}}"> {{-- required in kobo --}}

                                                            <input type="hidden" name="currency" value="ZAR">
                                                            <input type="hidden" name="metadata"
                                                                   value="{{ json_encode($array = ['type' => 'Payment',]) }}">
                                                            <input type="hidden" name="reference"
                                                                   value="{{ Paystack::genTranxRef() }}"> {{-- required --}}

                                                            <input type="hidden" name="payment_method"
                                                                   value="{{$gateway->method}}">
                                                            <input type="hidden" name="tracking_id"
                                                                   value="{{$checkout->tracking}}">
                                                            <input type="hidden" name="id" value="{{$checkout->id}}">
                                                            <button type="submit" class="Payment_btn">
                                                                <img class=" w-100" style="    padding: 10px;
                                        margin-top: -6px;"
                                                                     src="{{asset($gateway->logo)}}"
                                                                     alt="">
                                                            </button>

                                                        </form>

                                                    @else

                                                        <form action="{{route('paymentSubmit')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="payment_method"
                                                                   value="{{$gateway->method}}">
                                                            <input type="hidden" name="tracking_id"
                                                                   value="{{$checkout->tracking}}">
                                                            <input type="hidden" name="id" value="{{$checkout->id}}">
                                                            <button type="submit" class="Payment_btn">
                                                                <img class=" w-100"
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
        </div>

        <div class="order_wrapper">
            <h3 class="font_22 f_w_700 mb_30">{{__('frontend.Your order')}}</h3>
            <div class="ordered_products">
                @php $totalSum=0; @endphp
                @if(isset($carts))
                    @foreach($carts as $cart)
                        @php
                            if ($cart->course->discount_price!=null) {
                               $price = $cart->course->discount_price;
                           } else {
                               $price = $cart->course->price;
                           }
                             $totalSum =  $totalSum + @$price;

                        @endphp
                        <div class="single_ordered_product">
                            <div class="product_name d-flex align-items-center">
                                <div class="thumb">
                                    <img src="{{getCourseImage(@$cart->course->thumbnail)}}" alt="">
                                </div>
                                <span>{{@$cart->course->title}}</span>
                            </div>
                            <span class="order_prise f_w_500 font_16">
                             @if (@$cart->course->discount_price!=null)
                                    {{getPriceFormat($cart->course->discount_price)}}
                                @else
                                    {{getPriceFormat($cart->course->price)}}
                                @endif
                            </span>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="ordered_products_lists">
                <div class="single_lists">
                    <span class=" total_text">{{__('frontend.Subtotal')}}</span>
                    <span>{{getPriceFormat($checkout->price)}}</span>
                </div>
                @if($checkout->purchase_price > 0)
                    <div class="single_lists">

                        <span class="total_text">{{__('payment.Discount Amount')}}</span>
                        <span>{{$checkout->discount==""?'0':getPriceFormat($checkout->discount)}}</span>
                    </div>
                    <div class="single_lists">
                        <span class="total_text">{{__('frontend.Payable Amount')}} </span>
                        <span class="totalBalance">{{getPriceFormat($checkout->purchase_price)}}</span>
                    </div>
                @endif
            </div>

        </div>
    </div>


@endsection
@section('js')
@endsection
