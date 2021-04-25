@extends('frontend.infixlmstheme.layouts.dashboard_master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('common.Dashboard')}} @endsection
@section('css')
    <link href="{{asset('public/frontend/infixlmstheme/css/class_details.css')}}" rel="stylesheet"/>

@endsection

@section('mainContent')
    <div class="main_content_iner main_content_padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="cat_welcome_text">
                        <h3>{{@$wish_string}}, {{Auth::user()->name}} </h3>
                        <p>{{@$date}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>
                                @if($total_spent!=0)
                                    {{getPriceFormat(round($total_spent))}}
                                @else
                                    {{getSetting()->currency->symbol??'৳'}}  0
                                @endif
                            </h4>
                            <p>{{__('frontend.Total Spent')}}</p>
                        </div>
                        <div class="col-md-4">
                            <h4>{{@$total_purchase}}</h4>
                            <p>{{__('frontend.Course Purchased')}}</p>
                        </div>
                        <div class="col-md-4">
                            <h4>
                                @if(Auth::user()->balance==0)
                                    {{getSetting()->currency->symbol??'৳'}} 0
                                @else
                                    {{getPriceFormat(Auth::user()->balance)}}
                                @endif
                            </h4>
                            <p>{{__('frontend.Balance')}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="container">
            <div class="col-12">
                <!-- dashboard_banner  -->
                @if(count($mycourses)!=0)
                    <div class="dashboard_banner">
                        <div class="thumb">
                            <img class="thumb w-100" src="{{getCourseImage($mycourses[0]->thumbnail)}}" alt="">
                        </div>
                        <div class="banner_info">
                            <h4>
                                <a href="{{courseDetailsUrl($mycourses[0]->id,$mycourses[0]->type,$mycourses[0]->slug)}}">
                                    {{$mycourses[0]->title}}
                                </a>
                            </h4>
                            <p>{!! $mycourses[0]->about !!}</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{$percentage}}%"
                                     aria-valuenow="25"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="course_qualification">
                                <p>{{round($percentage)}}% {{__('student.Complete')}}</p>
                                <div class="rating_star text-right pt-2">

                                    @php
                                        $PickId=$mycourses[0]->id;
                                    @endphp

                                    @if (!in_array(Auth::user()->id,$reviewer_user_ids))
                                        <div
                                            class="star_icon d-flex align-items-center justify-content-end">
                                            <a class="rating">
                                                <input type="radio" id="star5" name="rating"
                                                       value="5"
                                                       class="rating"/><label
                                                    class="full" for="star5" id="star5"
                                                    title="Awesome - 5 stars"
                                                    onclick="Rates(5, {{@$PickId }})"></label>
                                                <input type="radio" id="star4half" name="rating"
                                                       value="4.5"
                                                       class="rating"/><label class="half"
                                                                              for="star4half"
                                                                              title="Pretty good - 4.5 stars"
                                                                              onclick="Rates(4.5, {{@$PickId }})"></label>
                                                <input type="radio" id="star4" name="rating"
                                                       value="4"
                                                       class="rating"/><label
                                                    class="full" for="star4"
                                                    title="Pretty good - 4 stars"
                                                    onclick="Rates(4, {{@$PickId }})"></label>
                                                <input type="radio" id="star3half" name="rating"
                                                       value="3.5"
                                                       class="rating"/><label class="half"
                                                                              for="star3half"
                                                                              title="Meh - 3.5 stars"
                                                                              onclick="Rates(3.5, {{@$PickId }})"></label>
                                                <input type="radio" id="star3" name="rating"
                                                       value="3"
                                                       class="rating"/><label
                                                    class="full" for="star3"
                                                    title="Meh - 3 stars"
                                                    onclick="Rates(3, {{@$PickId }})"></label>
                                                <input type="radio" id="star2half" name="rating"
                                                       value="2.5"
                                                       class="rating"/><label class="half"
                                                                              for="star2half"
                                                                              title="Kinda bad - 2.5 stars"
                                                                              onclick="Rates(2.5, {{@$PickId }})"></label>
                                                <input type="radio" id="star2" name="rating"
                                                       value="2"
                                                       class="rating"/><label
                                                    class="full" for="star2"
                                                    title="Kinda bad - 2 stars"
                                                    onclick="Rates(2, {{@$PickId }})"></label>
                                                <input type="radio" id="star1half" name="rating"
                                                       value="1.5"
                                                       class="rating"/><label class="half"
                                                                              for="star1half"
                                                                              title="Meh - 1.5 stars"
                                                                              onclick="Rates(1.5, {{@$PickId }})"></label>
                                                <input type="radio" id="star1" name="rating"
                                                       value="1"
                                                       class="rating"/><label
                                                    class="full" for="star1"
                                                    title="Bad  - 1 star"
                                                    onclick="Rates(1,{{@$PickId }})"></label>
                                                <input type="radio" id="starhalf" name="rating"
                                                       value=".5"
                                                       class="rating"/><label class="half"
                                                                              for="starhalf"
                                                                              title="So bad  - 0.5 stars"
                                                                              onclick="Rates(.5,{{@$PickId }})"></label>
                                            </a>
                                        </div>
                                    @else
                                        <div class="rating_cart">
                                            <div class="rateing">
                                                <span>{{getTotalRating($mycourses[0]->id)}}/5</span>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            @auth()
                                                @if(!isEnrolled($mycourses[0]->id,\Illuminate\Support\Facades\Auth::user()->id) && !isCart($course->id))
                                                    <a href="#" class="cart_store"
                                                       data-id="{{$mycourses[0]->id}}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                @endif
                                            @endauth
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            </div>


            <div class="recommended_courses">
                <div class="row">
                    <div class="col-12">
                        <div class="section__title3 margin_50">
                            <h3>{{__('student.Recommended For You')}}</h3>
                            <p>{{__('student.Are you ready for your next lesson')}}?</p>
                        </div>
                    </div>

                    @if(isset($courses))
                        @foreach($courses as $course)
                            <div class="col-xl-4 col-md-6">
                                <div class="couse_wizged mb_30">
                                    <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                        <div class="thumb">
                                            <div class="thumb_inner"
                                                 style="background-image: url('{{ file_exists($course->thumbnail) ? asset($course->thumbnail) : asset('public/\uploads/course_sample.png') }}')">
<span class="prise_tag">
     {{getPriceFormat($course->price)}}
</span>

                                            </div>
                                        </div>
                                    </a>
                                    <div class="course_content">
                                        <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                            <h4 class="noBrake" title="{{@$course->title}}">{{@$course->title}}</h4>
                                        </a>
                                        <div class="rating_cart">
                                            <div class="rateing">
                                                <span>{{getTotalRating($course->id)}}/5</span>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            @auth()
                                                @if(!isEnrolled($course->id,\Illuminate\Support\Facades\Auth::user()->id) && !isCart($course->id))
                                                    <a href="#" class="cart_store"
                                                       data-id="{{$course->id}}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                @endif
                                            @endauth
                                            @guest()
                                                <a href="#" class="cart_store"
                                                   data-id="{{$course->id}}">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                            @endguest

                                        </div>
                                        <div class="course_less_students">
                                            <a>
                                                <i class="ti-agenda"></i> {{count($course->lessons)}}{{__('student.Lessons')}}
                                            </a>
                                            <a>
                                                <i class="ti-user"></i> {{$course->total_enrolled}} {{__('student.Students')}}
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="recommended_courses">
                <div class="row">
                    <div class="col-12">
                        <div class="section__title3 margin_50">
                            <h3>{{__('student.Quiz you might like')}}</h3>
                            <p>{{__('student.Are you ready for your next lesson')}}?</p>
                        </div>
                    </div>
                    @if(isset($quizzes))
                        @foreach($quizzes as $course)
                            <div class="col-xl-4 col-md-6">
                                <div class="quiz_wizged">

                                    <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                        <div class="thumb">
                                            <div class="thumb_inner"
                                                 style="background-image: url('{{ file_exists($course->thumbnail) ? asset($course->thumbnail) : asset('public/\uploads/course_sample.png') }}')">
<span class="prise_tag">
     {{getPriceFormat($course->price)}}
</span>


                                            </div>
                                            <span class="quiz_tag">{{__('quiz.Quiz')}}</span>
                                        </div>
                                    </a>

                                    <div class="course_content">
                                        <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                            <h4 class="noBrake" title="{{$course->title}}"> {{$course->title}}</h4>
                                        </a>
                                        <div class="rating_cart">
                                            <div class="rateing">
                                                <span>{{getTotalRating($course->id)}}/5</span>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            @auth()
                                                @if(!isEnrolled($course->id,\Illuminate\Support\Facades\Auth::user()->id) && !isCart($course->id))
                                                    <a href="#" class="cart_store"
                                                       data-id="{{$course->id}}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                @endif
                                            @endauth
                                            @guest()
                                                <a href="#" class="cart_store"
                                                   data-id="{{$course->id}}">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                            @endguest
                                        </div>
                                        <div class="course_less_students">
                                            <a> <i class="ti-agenda"></i> {{count($course->quiz->assign)}}
                                                {{__('student.Question')}}</a>
                                            <a>
                                                <i class="ti-user"></i> {{$course->total_enrolled}} {{__('student.Students')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>


    </div>



    <div class="modal cs_modal fade admin-query" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('frontend.Course Review') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><i
                            class="ti-close "></i></button>
                </div>

                <form action="{{route('student.submitReview')}}" method="Post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="course_id" id="rating_course_id"
                               value="">
                        <input type="hidden" name="rating" id="rating_value" value="">

                        <div class="text-center">
                                                                <textarea class="lms_summernote" name="review"
                                                                          id=""
                                                                          placeholder="{{__('frontend.Write your review') }}"
                                                                          cols="30"
                                                                          rows="10">{{old('review')}}</textarea>
                            <span class="text-danger" role="alert">{{$errors->first('review')}}</span>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="theme_line_btn mr-2"
                                    data-dismiss="modal">{{ __('common.Cancel') }}
                            </button>
                            <button class="theme_btn "
                                    type="submit">{{ __('common.Submit') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('public/frontend/infixlmstheme/js/class_details.js')}}"></script>
@endsection
