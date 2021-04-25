@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{$course->title}} @endsection
@section('css')
    <link href="{{asset('public/frontend/infixlmstheme/css/class_details.css')}}" rel="stylesheet"/>
@endsection
@section('js') @endsection

@section('mainContent')
    <!-- bradcam::start  -->
    <div class="breadcrumb_area bradcam_bg_3">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <div class="breadcam_wrap width_730px">
                        <span>Course Details</span>
                        <h3>
                            {{$course->title}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam::end  -->

    <!-- quiz__details::start  -->
    <div class="quiz__details">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-12">
                            <div class="quiz_test_wrapper mb_60">
                                <div class="quiz_test_header">
                                    <h3>  {{$course->quiz->title}}</h3>
                                </div>
                                <div class="quiz_test_body">
                                    <p>
                                        {{--                                        {{$course->quiz->instruction}}--}}
                                    </p>
                                    <ul class="quiz_test_info">
                                        <li><span>Questions <span>:</span></span>{{count($course->quiz->assign)}}
                                            questions.
                                        </li>
                                        <li><span>Duration   <span>:</span></span> {{count($course->quiz->assign)}}
                                            minutes (1 minutes time limit per
                                            question.)
                                        </li>
                                    </ul>
                                    <a href="quiz_start.php" class="theme_btn">Start Exam</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-lg-8">
                            <div class="course_tabs">
                                <ul class="nav lms_tabmenu justify-content-center mb_55" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Overview-tab" data-toggle="tab" href="#Overview"
                                           role="tab" aria-controls="Overview" aria-selected="true">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews"
                                           role="tab" aria-controls="Reviews" aria-selected="false">Reviews</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content lms_tab_content" id="myTabContent">
                                <div class="tab-pane fade show active " id="Overview" role="tabpanel"
                                     aria-labelledby="Overview-tab">
                                    <!-- content  -->
                                    <div class="course_overview_description">
                                        <div class="single_overview">
                                            <h4 class="font_22 f_w_700 mb_20">Instructions</h4>
                                            <div class="theme_border"></div>
                                            <p class="mb_25">  {{$course->quiz->instruction}} </p>

                                        </div>
                                    </div>
                                    <!--/ content  -->
                                </div>
                                <div class="tab-pane fade " id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                                    <!-- content  -->
                                    <div class="course_review_wrapper">
                                        <div class="details_title">
                                            <h4 class="font_22 f_w_700">Student Feedback</h4>
                                            <p class="font_16 f_w_400">{{$course->title}}</p>
                                        </div>
                                        <div class="course_feedback">
                                            <div class="course_feedback_left">
                                                <h2>{{getTotalRating($course->id)}}</h2>
                                                <div class="feedmak_stars">
                                                    @php
                                                        $main_stars=getTotalRating($course->id);

                                                        $stars=intval(getTotalRating($course->id));

                                                    @endphp
                                                    @for ($i = 0; $i <  $stars; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                    @if ($main_stars>$stars)
                                                        <i class="fas fa-star-half"></i>
                                                    @endif
                                                    @if($main_stars==0)
                                                        @for ($i = 0; $i <  5; $i++)
                                                            <i class="far fa-star"></i>
                                                        @endfor
                                                    @endif


                                                </div>
                                                <span>Course Rating</span>
                                            </div>
                                            <div class="feedbark_progressbar">
                                                <div class="single_progrssbar">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{getPercentageRating($course->id,5)}}%"
                                                             aria-valuenow="{{getPercentageRating($course->id,5)}}"
                                                             aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating_percent d-flex align-items-center">
                                                        <div class="feedmak_stars d-flex align-items-center">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                        <span>{{getPercentageRating($course->id,5)}}%</span>
                                                    </div>
                                                </div>
                                                <div class="single_progrssbar">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{getPercentageRating($course->id,4)}}%"
                                                             aria-valuenow="{{getPercentageRating($course->id,4)}}"
                                                             aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating_percent d-flex align-items-center">
                                                        <div class="feedmak_stars d-flex align-items-center">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        </div>
                                                        <span>{{getPercentageRating($course->id,4)}}%</span>
                                                    </div>
                                                </div>
                                                <div class="single_progrssbar">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{getPercentageRating($course->id,3)}}%"
                                                             aria-valuenow="{{getPercentageRating($course->id,3)}}"
                                                             aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating_percent d-flex align-items-center">
                                                        <div class="feedmak_stars d-flex align-items-center">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>

                                                        </div>
                                                        <span>{{getPercentageRating($course->id,3)}}%</span>
                                                    </div>
                                                </div>
                                                <div class="single_progrssbar">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{getPercentageRating($course->id,2)}}%"
                                                             aria-valuenow="{{getPercentageRating($course->id,2)}}"
                                                             aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating_percent d-flex align-items-center">
                                                        <div class="feedmak_stars d-flex align-items-center">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        </div>
                                                        <span>{{getPercentageRating($course->id,2)}}%</span>
                                                    </div>
                                                </div>
                                                <div class="single_progrssbar">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{getPercentageRating($course->id,1)}}%"
                                                             aria-valuenow="{{getPercentageRating($course->id,1)}}"
                                                             aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating_percent d-flex align-items-center">
                                                        <div class="feedmak_stars d-flex align-items-center">
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        </div>
                                                        <span>{{getPercentageRating($course->id,1)}}%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="course_review_header mb_20">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="review_poients">
                                                        @if ($course->reviews->count()<1)
                                                            @if (Auth::check() && $isEnrolled)
                                                                <p class="theme_color font_16 mb-0">{{ __('frontend.Be the first reviewer') }}</p>
                                                            @else

                                                                <p class="theme_color font_16 mb-0">{{ __('frontend.No Review found') }}</p>
                                                            @endif

                                                        @else


                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="rating_star text-right">

                                                        @php
                                                            $PickId=$course->id;
                                                        @endphp
                                                        @if (Auth::check() && Auth::user()->role_id==3)
                                                            @if (!in_array(Auth::user()->id,$reviewer_user_ids) && $isEnrolled)


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
                                                            @endif
                                                        @else

                                                            <p class="font_14 f_w_400 mt-0"><a href="{{url('login')}}"
                                                                                               class="theme_color2">Sign
                                                                    In</a>
                                                                or <a
                                                                    class="theme_color2" href="{{url('register')}}">Sign
                                                                    Up</a>
                                                                as student to post a review</p>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(count($reviews)!=0)
                                            <div class="course_cutomer_reviews">
                                                <div class="details_title">
                                                    <h4 class="font_22 f_w_700">Reviews</h4>

                                                </div>
                                                <div class="customers_reviews">

                                                    @if(isset($reviews))
                                                        @foreach ($reviews as $review)
                                                            <div class="single_reviews">
                                                                <div class="thumb">
                                                                    {{substr($review->userName, 0, 1)}}
                                                                </div>
                                                                <div class="review_content">
                                                                    <h4 class="f_w_700">{{$review->userName}}</h4>
                                                                    <div
                                                                        class="rated_customer d-flex align-items-center">
                                                                        <div class="feedmak_stars">
                                                                            @php
                                                                                $main_stars=$review->star;
                                                                                $stars=intval($review->star);
                                                                            @endphp
                                                                            @for ($i = 0; $i <  $stars; $i++)
                                                                                <i class="fas fa-star"></i>
                                                                            @endfor
                                                                            @if ($main_stars>$stars)
                                                                                <i class="fas fa-star-half"></i>
                                                                            @endif

                                                                        </div>
                                                                        <span>{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                                                    </div>
                                                                    <p>
                                                                        {{$review->comment}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        <div class="author_courses">
                                            <div class="section__title mb_80">
                                                <h3>Course you might like</h3>
                                            </div>
                                            <div class="row">
                                                @if(isset($related))
                                                    @foreach(@$related as $r)
                                                        <div class="col-xl-6">
                                                            <div class="couse_wizged mb_30">
                                                                <div class="thumb">
                                                                    <a href="{{route('courseDetailsView',[@$r->id,@$r->slug])}}">
                                                                        <img class="w-100"
                                                                             src="{{ file_exists($r->thumbnail) ? asset($r->thumbnail) : asset('public/\uploads/course_sample.png') }}"
                                                                             alt="">
                                                                        <span class="prise_tag">
                                                                                                                                @if (@$r->discount_price!=null)
                                                                                {{getPriceFormat($r->discount_price)}}
                                                                            @else
                                                                                {{getPriceFormat($r->price)}}
                                                                            @endif
                                                                                                                           </span>
                                                                    </a>
                                                                </div>
                                                                <div class="course_content">
                                                                    <a href="{{route('courseDetailsView',[@$r->id,@$r->slug])}}">
                                                                        <h4>{{@$r->title}}</h4>
                                                                    </a>
                                                                    <div class="rating_cart">
                                                                        <div class="rateing">
                                                                            <span>{{getTotalRating($course->id)}}/5</span>
                                                                            <i class="fas fa-star"></i>
                                                                        </div>
                                                                        <a href="#" class="cart_store"
                                                                           data-id="{{$course->id}}">
                                                                            <i class="fas fa-shopping-cart"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="course_less_students">
                                                                        <a href="#"> <i
                                                                                class="ti-agenda"></i> {{count($r->lessons)}}
                                                                            Lessons</a>
                                                                        <a href="#"> <i
                                                                                class="ti-user"></i> {{$r->total_enrolled}}
                                                                            Students </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- content  -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <div class="sidebar__widget mb_30">
                                <div class="sidebar__title">
                                    <h3>
                                        @if (@$course->discount_price!=null)

                                            {{getPriceFormat($course->discount_price)}}
                                        @else
                                            {{getPriceFormat($course->price)}}
                                        @endif
                                    </h3>
                                    <p>
                                        @if (Auth::check() && $isBookmarked )
                                            <i class="fas fa-heart"></i>
                                            <a href="{{route('bookmarkSave',[$course->id])}}"
                                               class="theme_button mr_10 sm_mb_10">{{__('frontend.Already Bookmarked')}}
                                            </a>
                                        @elseif (Auth::check() && !$isBookmarked )
                                            <a href="{{route('bookmarkSave',[$course->id])}}"
                                               class="">
                                                <i class="far fa-heart"></i>
                                                {{__('frontend.Add To Bookmark')}}  </a>
                                    @endif

                                </div>
                                @if (Auth::check())
                                    @if ($isEnrolled)
                                        <a href="#"
                                           class="theme_btn d-block text-center height_50 mb_10">{{__('common.Already Enrolled')}}</a>
                                    @else
                                        @if($isFree)
                                            <a href="{{route('enrollNow',[@$course->id])}}"
                                               class="theme_btn d-block text-center height_50 mb_20"> {{__('common.Enroll
                                                                                                           Now')}}</a>
                                        @else
                                            <a href=" {{route('addToCart',[@$course->id])}} "
                                               class="theme_btn d-block text-center height_50 mb_10">{{__('common.Add To Cart')}}</a>
                                            <a href="{{route('buyNow',[@$course->id])}}"
                                               class="theme_line_btn d-block text-center height_50 mb_20">{{__('common.Buy Now')}}</a>
                                        @endif
                                    @endif

                                @else
                                    @if($isFree)
                                        <a href="{{route('enrollNow',[@$course->id])}}"
                                           class="theme_btn d-block text-center height_50 mb_20">{{__('common.Enroll Now')}}</a>
                                    @else
                                        <a href=" {{route('addToCart',[@$course->id])}} "
                                           class="theme_btn d-block text-center height_50 mb_10">{{__('common.Add To Cart')}}</a>
                                        <a href="{{route('buyNow',[@$course->id])}}"
                                           class="theme_line_btn d-block text-center height_50 mb_20">{{__('common.Buy Now')}}</a>
                                    @endif
                                @endif
                                {{--                                <p class="font_14 f_w_500 text-center mb_30">30-Day Money-Back Guarantee</p>--}}
                                <h4 class="f_w_700 mb_10">This course includes:</h4>
                                <ul class="course_includes">
                                    <li><i class="ti-alarm-clock"></i>
                                        <p> {{ __('frontend.Duration') }} {{@$course->duration}}

                                        </p></li>
                                    <li><i class="ti-thumb-up"></i>
                                        <p>Skill Level @if (@$course->level==1)
                                                {{ __('courses.Beginner') }}
                                            @elseif (@$course->level==2)
                                                {{ __('courses.Intermediate') }}
                                            @elseif (@$course->level==3)
                                                {{ __('courses.Advance') }}
                                            @else
                                                {{ __('courses.Pro') }}
                                            @endif</p></li>
                                    <li><i class="ti-agenda"></i>
                                        <p>Lectures {{count($course->lessons)}} lessons</p></li>
                                    <li><i class="ti-user"></i>
                                        <p>Enrolled {{$course->total_enrolled}} students</p></li>
                                    <li><i class="ti-user"></i>
                                        <p>Certificate of Completion</p></li>
                                    <li><i class="ti-blackboard"></i>
                                        <p>Full lifetime access</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
                                                                          rows="10"></textarea>
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
    <input type="hidden" class="question_review" name="question_review" value="{{$quizSetup->question_review}}">
    <input type="hidden" class="total_ques" name="totalQus" value="{{count($course->quiz->assign)}}">
    <input type="hidden" class="show_result_each_submit" name="show_result_each_submit"
           value="{{$quizSetup->show_result_each_submit}}">
@endsection

@section('js')
    <script src="{{asset('public/frontend/development/js/quiz_details.js')}}"></script>
@endsection
