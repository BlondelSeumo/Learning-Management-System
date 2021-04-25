@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('coupons.My Cart')}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')

    <div class="cart_wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="">
                    <div class="cart_table_wrapper">
                        @if(count($carts)!=0)
                            <h4>{{__('coupons.My Cart')}}</h4>
                        @endif
                        @php
                            $totalSum=0;
                             if (!Auth::check()) {
                               $carts=[];
                               if (session()->has('cart')){
                                    foreach (session()->get('cart') as $key => $cart) {
                                   // dd($cart);
                                  $carts[]=$cart;
                               }
                               }

                            }

                        @endphp

                        <div class="table-responsive">
                            @if(count($carts)!=0)
                                <table class="table custom_table mb-0">
                                    <thead>
                                    <tr>
                                        {{--                                        <th scope="col">{{__('common.SL')}}</th>--}}
                                        <th scope="col">{{__('courses.Courses')}}</th>
                                        <th scope="col">{{__('instructor.Instructors')}}</th>
                                        <th scope="col">{{__('payment.Price')}}</th>
                                        <th scope="col">{{__('common.Remove')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $key=>$cart)
                                        @php
                                            // dd($cart['price']);
                                              $price = $cart['price'];
                                              $totalSum =  $totalSum + @$price;

                                        @endphp


                                        <tr>
                                            {{--                                            <td scope="col">{{$key+1}}</td>--}}
                                            <td scope="col">
                                                <a href="{{route('courseDetailsView',[@$cart['id'],@$cart['slug']])}}">
                                                    <h5>{{@$cart['title']}}</h5></a>
                                            </td>
                                            <td scope="col">{{@$cart['instructor_name']}}</td>
                                            <td scope="col">{{@$price}}</td>
                                            <td scope="col"><a href="{{route('removeItem',[$cart['id']])}}"
                                                               class="link_value">{{__('common.Remove')}}</a></td>
                                        </tr>

                                    @endforeach
                                    </tbody>

                                </table>
                            @else
                                <div class="col-lg-12">
                                    <h1 class="text-center text-secondary"> {{__('common.No Item found')}} <i
                                            class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </h1>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
