@include('frontend.infixlmstheme.layouts.header')
@include('frontend.infixlmstheme.layouts.menu')
@php
    $currency = getSetting()->currency;
@endphp
<input type="hidden" name="base_url" class="base_url" value="{{url('/')}}">
<input type="hidden" name="csrf_token" class="csrf_token" value="{{csrf_token()}}">
@if(auth()->check())
    <input type="hidden" name="balance" class="user_balance" value="{{auth()->user()->balance}}">
@endif
<input type="hidden" name="currency_symbol" class="currency_symbol" value="{{$currency->symbol}}">
@yield('mainContent')
@include('frontend.infixlmstheme.layouts.footer')
