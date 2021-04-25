@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('common.Checkout')}} @endsection
@section('css')
    <link href="{{asset('public/frontend/infixlmstheme/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/frontend/infixlmstheme/css/checkout.css')}}" rel="stylesheet"/>
@endsection
@section('mainContent')

    <form action="{{route('subscriptionPayment')}}" id="orderFrom" method="post">
        @csrf

        <div class="checkout_wrapper" id="mainFormData">

            <div class="billing_details_wrapper">
                @if(count($bills) > 0)
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="remember_forgot_pass d-flex justify-content-between">
                                <label class="primary_checkbox d-flex">
                                    <input type="radio" class="billing_address" checked="checked" name="billing_address"
                                           value="previous">
                                    <span class="checkmark mr_15"></span>
                                    <span class="label_name">{{__('frontendmanage.Previous Billing Address')}}</span>
                                </label>
                            </div>
                            <div class="remember_forgot_pass d-flex justify-content-between">
                                <label class="primary_checkbox d-flex">
                                    <input type="radio" class="billing_address" name="billing_address"
                                           value="new">
                                    <span class="checkmark mr_15"></span>
                                    <span class="label_name">{{__('frontendmanage.New Billing Address')}}</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 w-100 prev_billings" style="display: none">
                            <label class="primary_label2">{{__('frontendmanage.Billing Address')}} <span>*</span>
                            </label>


                            <select name="old_billing" class="mb-3 wide mb_20 w-100 old_billing small_select">
                                @if(isset($bills))
                                    @foreach($bills as $bill)
                                        <option value="{{$bill->id}}"
                                                data-id="{{$bill}}">{{$bill->first_name}} {{$bill->last_name}}
                                            => {{$bill->address1}},{{$bill->city}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="billing_address" value="new">
                @endif
                <input type="hidden" name="plan_id" value="{{$s_plan}}">
                <h3 class="font_22 mt-3 f_w_700 mb_30 billing_heading">{{__('frontend.Billing Details')}}</h3>
                <table class="table table-bordered billing_info" style=" @if(count($bills) == 0) display: none @endif">
                    <tr>
                        <td>{{__('common.Name')}}</td>
                        <td class="billing_name">{{isset($bills[0]->first_name)?$bills[0]->first_name:''}} {{isset($bills[0]->last_name)?$bills[0]->last_name:''}}</td>
                    </tr>
                    <tr>
                        <td>{{__('common.Email')}}</td>
                        <td class="billing_email"> {{isset($bills[0]->email)?$bills[0]->email:''}}</td>
                    </tr>
                    <tr>
                        <td>{{__('common.Phone')}}</td>
                        <td class="billing_phone">{{isset($bills[0]->phone)?$bills[0]->phone:''}}</td>
                    </tr>
                    <tr>
                        <td>{{__('frontend.Company Name')}}</td>
                        <td class="billing_company">{{isset($bills[0]->company_name)?$bills[0]->company_name:''}}</td>
                    </tr>
                    <tr>
                        <td>{{__('frontend.Street Address')}}</td>
                        <td class="billing_address">{{isset($bills[0]->address1)?$bills[0]->address1:''}} {{isset($bills[0]->address2)?$bills[0]->address2:''}}</td>
                    </tr>
                    <tr>
                        <td>{{__('frontend.Zip Code')}}</td>
                        <td class="billing_zip">{{isset($bills[0]->zip_code)?$bills[0]->zip_code:''}}</td>
                    </tr>
                    <tr>
                        <td>{{__('frontend.City')}}</td>
                        <td class="billing_city">{{isset($bills[0]->city)?$bills[0]->city:''}}</td>
                    </tr>
                    <tr>
                        <td>{{__('frontend.Country')}}</td>
                        <td class="billing_country">{{isset($bills[0]->country)?$bills[0]->country:''}}</td>
                    </tr>
                    <tr>
                        <td>{{__('frontend.Order Details')}}</td>
                        <td class="billing_details">{{isset($bills[0]->details)?$bills[0]->details:''}}</td>
                    </tr>
                </table>
                <div class="row billing_form" style=" @if(count($bills) > 0) display: none @endif">

                    <div class="col-lg-6">

                        <label class="primary_label2">{{__('frontend.First Name')}} <span>*</span></label>
                        <input id="first_name" name="first_name" placeholder="{{__('frontend.Enter First Name')}}"
                               class="primary_input3"
                               value="{{(!empty($current)) ? $current->first_name : old('first_name')}}"
                               type="text" {{$errors->first('first_name') ? 'autofocus' : ''}}>
                        <span class="text-danger">{{$errors->first('first_name')}}</span>
                    </div>
                    <div class="col-lg-6">
                        <label class="primary_label2">{{__('frontend.Last Name')}} <span>*</span></label>
                        <input id="last_name" name="last_name" placeholder="{{__('frontend.Enter Last Name')}}"
                               onfocus="this.placeholder = ''"
                               onblur="this.placeholder = '{{__('frontend.Enter Last Name')}}'"
                               class="primary_input3"
                               value="@if(!empty($current)){{$current->last_name}}@else{{old('last_name')}}@endif"
                               type="text" {{$errors->first('last_name') ? 'autofocus' : ''}}>
                        <span class="text-danger">{{$errors->first('last_name')}}</span>
                    </div>

                    <div class="col-lg-12 mt_20">
                        <label class="primary_label2">{{__('frontend.Company Name')}} ({{__('frontend.Optional')}}
                            )</label>
                        <input id="company_name" name="company_name" placeholder="{{__('frontend.Enter Company Name')}}"
                               onfocus="this.placeholder = ''"
                               onblur="this.placeholder = '{{__('frontend.Enter Company Name')}}'"
                               class="primary_input3"
                               type="text"
                               value="@if(!empty($current)){{$current->company_name}}@else{{old('company_name')}}@endif">
                    </div>
                    <div class="col-lg-12 mt_20">
                        <label class="primary_label2">{{__('frontend.Country')}} <span>*</span> </label>
                        <select id="country" name="country"
                                class="select2 mb-3 wide w-100 " {{$errors->first('country') ? 'autofocus' : ''}}>
                            @if(isset($countries))
                                @foreach($countries as $country)
                                    <option
                                        value="{{$country->id}}" @if(!empty($current)){{$current->country==$country->id?'selected':''}}@else{{$profile->country==$country->id?'selected':''}}@endif >{{$country->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <span class="text-danger">{{$errors->first('country')}}</span>
                    </div>

                    <div class="col-lg-12 mt_20">
                        <label class="primary_label2">{{__('frontend.Street Address')}} <span>*</span></label>
                        <input id="address1" name="address1"
                               placeholder="{{__('frontend.House Number and street address')}}"
                               onfocus="this.placeholder = ''"
                               onblur="this.placeholder = '{{__('frontend.House Number and street addres')}}s'"
                               class="primary_input3" type="text"
                               value="@if(!empty($current)){{$current->address1}}@else{{old('address1')}}@endif" {{$errors->first('address1') ? 'autofocus' : ''}}>
                        <span class="text-danger">{{$errors->first('address1')}}</span>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <input id="address2" name="address2"
                               placeholder="{{__("frontend.Apartment, suite, unit etc (Optional)")}}"
                               onfocus="this.placeholder = ''"
                               onblur="this.placeholder = '{{__("frontend.Apartment, suite, unit etc (Optional)")}}'"
                               class="primary_input3" type="text"
                               value="@if(!empty($current)){{$current->address2}}@else{{old('address2')}}@endif">
                    </div>
                    <div class="col-lg-12 mt_20">
                        <label class="primary_label2">{{__("frontend.City / Town")}} <span>*</span></label>
                        <input id="city" name="city" placeholder="{{__("frontend.Enter city/town name")}}"
                               onfocus="this.placeholder = ''"
                               onblur="this.placeholder = '{{__("frontend.Enter city/town name")}}'"
                               class="primary_input3"
                               type="text"
                               value="@if(!empty($current)){{$current->city}}@else{{old('city')}}@endif" {{$errors->first('city') ? 'autofocus' : ''}}>
                        <span class="text-danger">{{$errors->first('city')}}</span>
                    </div>
                    <div class="col-lg-12 mt_20">
                        <label class="primary_label2">{{__("frontend.Postcode / ZIP")}} ({{__('frontend.Optional')}}
                            )</label>
                        <input id="zip_code" name="zip_code" placeholder="{{__('frontend.Enter Company Name')}}"
                               onfocus="this.placeholder = ''" class="primary_input3"
                               type="text"
                               value="@if(!empty($current)){{$current->zip_code}}@else{{old('zip_code')}}@endif">
                    </div>
                    <div class="col-lg-12 mt_20">
                        <label class="primary_label2">{{__('frontend.Phone No')}} <span>*</span></label>
                        <input id="phone" name="phone" placeholder="01XXXXXXXXXX" onfocus="this.placeholder = ''"
                               onblur="this.placeholder = '01XXXXXXXXXX'" class="primary_input3"
                               type="text"
                               value="@if(!empty($current)){{$current->phone}}@else{{old('phone')}}@endif" {{$errors->first('phone') ? 'autofocus' : ''}}>
                        <span class="text-danger">{{$errors->first('phone')}}</span>
                    </div>
                    <div class="col-lg-12 mt_20 mb_35">
                        <label class="primary_label2">{{__('frontend.Email Address')}} <span>*</span></label>
                        <input id="email" name="email" placeholder="{{__("frontend.e.g example@domian.com")}}"
                               onfocus="this.placeholder = ''"
                               onblur="this.placeholder = '{{__("frontend.e.g example@domian.com")}}'"
                               class="primary_input3"
                               type="email"
                               value="@if(!empty($current)){{$current->email}}@else{{old('email')}}@endif" {{$errors->first('email') ? 'autofocus' : ''}}>
                        <span class="text-danger">{{$errors->first('email')}}</span>
                    </div>
                    <div class="col-12">
                        <h3 class="font_22 f_w_700 mb_23">{{__('frontend.Additional Information')}}</h3>
                    </div>
                    <div class="col-lg-12">
                        <label class="primary_label2">{{__('frontend.Information details')}}</label>
                        <textarea id="details" name="details" class="primary_textarea3"
                                  placeholder="{{__("frontend.Note about your order, e.g. special note for you delivery")}}"
                                  onfocus="this.placeholder = ''"
                                  onblur="this.placeholder = '{{__("frontend.Note about your order, e.g. special note for you delivery")}}'">  @if(!empty($current)){{$current->details}}@else{{old('details')}}@endif</textarea>

                    </div>
                </div>
            </div>
            <div class="order_wrapper">
                <h3 class="font_22 f_w_700 mb_30">{{__('frontend.Your order')}}</h3>
                <div class="ordered_products">

                    <div class="single_ordered_product">
                        <div class="product_name d-flex align-items-center">

                            <span>Plan Title</span>
                        </div>
                        <span class="order_prise f_w_500 font_16">
                           {{@$cart->plan->title}}
                            </span>
                    </div>

                    <div class="single_ordered_product">
                        <div class="product_name d-flex align-items-center">
                            <span>Plan Validity</span>
                        </div>
                        <span class="order_prise f_w_500 font_16">
                           {{@$cart->plan->days}} Days
                            </span>
                    </div>

                </div>
                <div class="ordered_products_lists">


                    <div class="single_lists">
                        <span class="total_text">{{__('frontend.Payable Amount')}} </span>
                        <span class="totalBalance"> {{getPriceFormat($cart->plan->price)}}</span>

                    </div>

                </div>
                <div class="bank_transfer">
                    <p class="mb_35">{{__("frontend.Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy")}}
                        .</p>
                    <button type="submit" id="submitBtn"
                            class="theme_btn w-100">{{__('frontend.Place An Order')}}</button>
                </div>
            </div>
        </div>
    </form>


@endsection
@section('js')
    <script src="{{asset('public/frontend/infixlmstheme/js/select2.min.js')}}"></script>
    <script src="{{asset('public/frontend/infixlmstheme/js/checkout.js')}}"></script>
@endsection
