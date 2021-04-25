@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('frontend.Subscription')}} @endsection
@section('css') @endsection


@section('mainContent')

    <style>


        .section_tittle {
            text-align: center;
            margin-bottom: 50px;
        }

        @media (max-width: 991px) {
            .section_tittle {
                margin-bottom: 40px;
            }
        }

        @media only screen and (min-width: 991px) and (max-width: 1200px) {
            .section_tittle {
                margin-bottom: 50px;
            }
        }

        .section_tittle h2 {
            font-size: 28px;
            margin-bottom: 11px;
            line-height: 1.5;
        }

        @media (max-width: 991px) {
            .section_tittle h2 {
                margin-bottom: 15px;
                font-size: 25px;
            }
        }

        @media (max-width: 991px) {
            .section_tittle h2 {
                font-size: 30px;
            }
        }


        .pricing_plan .single_pricing_plan {
            border: 1px solid #e8e8e8;
            border-radius: 5px;
            text-align: center;
            padding: 40px 20px 36px;
            margin: 10px;
        }

        @media (max-width: 768px) {
            .pricing_plan .single_pricing_plan {
                margin-bottom: 20px;
            }
        }

        .pricing_plan .single_pricing_plan h5 {
            font-size: 28px;
            font-weight: 600;
            color: #FB1159;
            margin-bottom: 18px;
        }

        .pricing_plan .single_pricing_plan h2 {
            font-size: 50px;
            font-weight: 600;
            position: relative;
            padding-left: 15px;
            display: inline-block;
            margin-bottom: 2px;
        }

        .pricing_plan .single_pricing_plan h2 span {
            font-size: 20px;
            position: absolute;
            left: 0;
            top: -1px;
        }

        .pricing_plan .single_pricing_plan p a {
            color: #8f8f8f;
            text-decoration: underline;
        }

        .pricing_plan .single_pricing_plan .theme_btn small_btn2 {
            margin: 26px 0 16px;
        }


        .list_style {
            /*margin-top: 30px;*/
        }

        .list_style h5 {
            background-color: #f6f8fa;
            font-size: 20px;
            margin-bottom: 0;
            padding: 18px 30px;
            border-radius: 5px 5px 0 0;
        }

        .list_style h5 span {
            font-size: 12px;
            font-weight: 500;
            color: #8f8f8f;
            margin-left: 5px;
        }

        .list_style ul {
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px 30px;
            border: 1px solid #e8e8e8;
            border-radius: 0 0 5px 5px;
        }

        .list_style ul li {
            list-style: none;
            flex: 48% 0 0;
            color: #212e40;
            margin: 7px 0;
        }

        @media (max-width: 768px) {
            .list_style ul li {
                flex: 100% 0 0;
            }
        }

        .list_style ul li i {
            margin-right: 10px;
            color: #FB1159;
        }

        .theme_according .card .card-header button.collapsed {
            padding: 12px 26px 10px 30px;
        }
        .mb_100{
            margin-bottom: 100px;
        }
        .mt_100{
            margin-top: 100px;
        }
        .pb_100{
            padding-bottom: 100px;
        }
         .pt_100{
            padding-top: 100px;
        }

    </style>

    <div class="breadcrumb_area bradcam_bg_2"
         style="background-image: url('{{asset(@$frontendContent->subscription_page_banner)}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="breadcam_wrap">
                        <span>
                            {{@$frontendContent->subscription_page_title}}
                        </span>
                        <h3>
                            {{@$frontendContent->subscription_page_sub_title}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="contact_section ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="contact_address">
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12">


                                        <section class="pricing_plan pt_100   bg-white">
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6">
                                                        <div class="section_tittle"><h2
                                                            >{{__('subscription.Pricing Plan & Package')}}</h2>
                                                            <p></p></div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    @foreach($plans as $key2=>$plan)
                                                        <div class="col-lg-4 col-sm-6 ">
                                                            <div
                                                                class="single_pricing_plan row_padding"><h5
                                                                >{{$plan->title}}</h5>
                                                                <h2><span>{{getSetting()->currency->symbol}}</span>
                                                                    {{$plan->price}}.00</h2>
                                                                <p class="pb-2">{{$plan->about}}</p>
                                                                <form action="{{route('courseSubscriptionCheckout')}}">
                                                                    <input type="hidden" name="price"
                                                                           value="{{$plan->price}}">
                                                                    <input type="hidden" name="plan"
                                                                           value="{{$plan->id}}">
                                                                    <button type="submit"
                                                                            class="theme_btn small_btn2 payment-link">
                                                                        {{$plan->btn_txt}}
                                                                    </button>
                                                                </form>


                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>


                                                <div class="row justify-content-center">
                                                    <div class="col-lg-8">
                                                        <div class="features_list  pt_100 pb_100 list_style  "><h5
                                                            >{{__('subscription.Included features')}} <span
                                                                >({{__('subscription.These features for both of the plan')}})</span>
                                                            </h5>
                                                            <ul>
                                                                @foreach($plan_features as $key=>$feature)
                                                                    <li>
                                                                        <i class="fas fa-check-circle"></i>
                                                                        {{$feature->title}}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>


                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <h3 style="    text-align: center;
    margin-bottom: 72px;"> {{__('subscription.Frequently Ask Question')}} </h3>
                                        <div class="theme_according mb_100" id="accordion1"  >
                                            @foreach($faqs as $key=>$faq)
                                                <div class="card">
                                                    <div class="card-header pink_bg" id="headingFour{{$key}}">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link text_white collapsed"
                                                                    data-toggle="collapse"
                                                                    data-target="#collapseFour{{$key}}"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapseFour{{$key}}">
                                                                {{$faq->question}}
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div class="collapse" id="collapseFour{{$key}}"
                                                         aria-labelledby="headingFour{{$key}}"
                                                         data-parent="#accordion1">
                                                        <div class="card-body">
                                                            <div class="curriculam_list">

                                                                <div class="curriculam_single">
                                                                    <div class="curriculam_left">

                                                                        <span>{!! $faq->answer !!}</span>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


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


@endsection
@section('js')
    <script>

        $('body').on('click', '.payment-link', function () {
            $('.paymentForm').modal('show');
        });

        $(document).ready(function () {
            $(".stripe-button-el").remove();
            $(".razorpay-payment-button").hide();

            $('.submitBtn').css('cursor', 'pointer');
            $('.stripeSubmitBtn').css('cursor', 'pointer');
            $('.razorSubmitBtn').css('cursor', 'pointer');


            $('body').on('click', '.submitBtn', function () {
                $(this).closest("form").submit();
            });

            $('body').on('click', '.stripeSubmitBtn', function () {
                $(".stripeSubmit").trigger('click');
            });

            $('body').on('click', '.razorSubmitBtn', function () {
                $(this).closest("form").submit();
            });
        });
    </script>
@endsection
