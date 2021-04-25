@extends('frontend.infixlmstheme.layouts.dashboard_master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('coupons.My Cart')}} @endsection
@section('css') @endsection


@section('mainContent')
    <div class="cart_wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="cart_table_wrapper">
                        <h4>{{__('coupons.My Cart')}}</h4>

                        @if(count($carts)==0)
                            <div class="col-lg-12">
                                <h3 class="text-center text-secondary"> {{__('common.No Item found')}} <i
                                        class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </h3>
                            </div>
                        @else
                            <div class="table-responsive">
                                @php $totalSum=0; @endphp
                                <table class="table custom_table3 mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{__('common.SL')}}</th>
                                        <th scope="col">{{__('courses.Courses')}}</th>
                                        <th scope="col">{{__('instructor.Instructors')}}</th>
                                        <th scope="col">{{__('payment.Price')}}</th>
                                        <th scope="col">{{__('common.Remove')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($carts))
                                        @foreach ($carts as $key=>$cart)
                                            @php
                                                if ($cart->course->discount_price!=null) {
                                                   $price = $cart->course->discount_price;
                                               } else {
                                                   $price = $cart->course->price;
                                               }
                                                 $totalSum =  $totalSum + @$price;

                                            @endphp

                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>
                                                    <div class="CourseMeta d-flex align-items-center">
                                                        {{--                                                <div class="thumb">--}}
                                                        {{--                                                    <img--}}
                                                        {{--                                                        src="{{getCourseImage(@$cart->course->thumbnail)}}"--}}
                                                        {{--                                                        alt="">--}}
                                                        {{--                                                </div>--}}
                                                        <a href="{{route('courseDetailsView',[@$cart->course->id,@$cart->course->slug])}}">
                                                            <h5>{{@$cart->course->title}}</h5></a>
                                                    </div>
                                                </td>
                                                <td>{{@$cart->course->user->name}}</td>
                                                <td>{{getPriceFormat($price)}}</td>
                                                <td><a href="{{route('removeItem',[$cart->id])}}"
                                                       class="link_value">{{__('common.Remove')}}</a></td>
                                            </tr>

                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                        @endif
                    </div>
                    <div class="cart_table_wrapper mb-0">
                        @if(count($carts)!=0)
                            <div class="row mt_30">
                                <div class="col-12 text-right">
                                    <a href="{{route('CheckOut')}}"
                                       class="theme_btn">{{__('student.Proceed to checkout')}}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- category::end  -->
@endsection

