@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('frontendmanage.Privacy Policy')}} @endsection
@section('css') @endsection
@section('js')
    <script src="{{asset('public/frontend/infixlmstheme/js/scrollIt.js')}}"></script>
@endsection

@section('mainContent')
    <div class="category_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title mb_40">
                        <h3>{{__('frontendmanage.Privacy Policy')}}</h3>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-4 col-xl-3 col-md-4 mb_50 position-relative">
                    <div class="cat_sidebar_menu privacy_menu_fixed">
                        <ul>
                            <li><a data-scroll-nav="0" class="active" href="#">{{__('frontendmanage.General')}}</a></li>
                            <li><a data-scroll-nav="1" href="#">{{__('frontendmanage.Personal Data')}}</a></li>
                            <li><a data-scroll-nav="2" href="#">{{__('frontendmanage.Voluntary Disclosure')}}</a></li>
                            <li><a data-scroll-nav="3" href="#">{{__('frontendmanage.Children Privacy')}}</a></li>
                            <li><a data-scroll-nav="4" href="#">{{__('frontendmanage.Information About Cookies')}}</a>
                            </li>
                            <li><a data-scroll-nav="5" href="#">{{__('frontendmanage.Thirt Party Advertising')}}</a>
                            </li>
                            <li><a data-scroll-nav="6" href="#">{{__('frontendmanage.Other Sites')}}</a></li>
                            <li><a data-scroll-nav="7" href="#">{{__('frontendmanage.Teacher')}}</a></li>
                            <li><a data-scroll-nav="8" href="#">{{__('student.Student')}}</a></li>
                            <li><a data-scroll-nav="9" href="#">{{__('frontendmanage.Business Transfer')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9 col-md-8">
                    <div class="privacy_wrap">
                        <div data-scroll-index="0" class="single_privacy_section">
                            <p class="mb_30">{{@$privacy_policy->description}}</p>
                            <h3>{{__('frontendmanage.General')}}</h3>
                            <p>{{@$privacy_policy->general}}</p>
                        </div>
                        <div data-scroll-index="1" class="single_privacy_section">
                            <h3>{{__('frontendmanage.Personal Data')}}</h3>
                            <p class="mb_10">{{@$privacy_policy->personal_data}}</p>
                        </div>
                        <div data-scroll-index="2" class="single_privacy_section">
                            <h3>{{__('frontendmanage.Voluntary Disclosure')}}</h3>
                            <p class="mb_10">{{@$privacy_policy->voluntary_disclosure}}</p>
                        </div>
                        <div data-scroll-index="3" class="single_privacy_section">
                            <h3>{{__('frontendmanage.Children Privacy')}} </h3>
                            <p class="mb_10">{{@$privacy_policy->children_privacy}}</p>
                        </div>
                        <div data-scroll-index="4" class="single_privacy_section">
                            <h3>{{__('frontendmanage.Information About Cookies')}}</h3>
                            <p class="mb_10">{{@$privacy_policy->information_about_cookies}}</p>
                        </div>
                        <div data-scroll-index="5" class="single_privacy_section">
                            <h3>{{__('frontendmanage.Thirt Party Advertising')}}</h3>
                            <p class="mb_10">{{@$privacy_policy->thirt_party_adv}}</p>
                        </div>
                        <div data-scroll-index="6" class="single_privacy_section">
                            <h3>{{__('frontendmanage.Other Sites')}}</h3>
                            <p class="mb_10">{{@$privacy_policy->other_sites}}</p>
                        </div>
                        <div data-scroll-index="7" class="single_privacy_section">
                            <h3>{{__('frontendmanage.Teacher')}}</h3>
                            <p class="mb_10">{{@$privacy_policy->teacher}}</p>
                        </div>
                        <div data-scroll-index="8" class="single_privacy_section">
                            <h3>{{__('student.Student')}}</h3>
                            <p class="mb_10">{{@$privacy_policy->student}}</p>
                        </div>
                        <div data-scroll-index="9" class="single_privacy_section">
                            <h3>{{__('frontendmanage.Business Transfer')}}</h3>
                            <p class="mb_10">{{@$privacy_policy->business_transfer}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- category::end  -->


@endsection
