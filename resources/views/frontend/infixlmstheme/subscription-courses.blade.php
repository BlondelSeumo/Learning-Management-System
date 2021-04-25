@extends('frontend.infixlmstheme.layouts.dashboard_master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | @if( routeIs('myClasses'))
    {{__('courses.Live Class')}}
@elseif( routeIs('myQuizzes'))
    {{__('courses.My Quizzes')}}
@else
    {{__('courses.My Courses')}}
@endif @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')

    <div class="main_content_iner main_content_padding">
        <div class="container">
            <div class="my_courses_wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="section__title3 margin-50">
                            <h3>

                                {{__('subscription.Subscription')}} <small>
                                    ( Validity {{\Illuminate\Support\Facades\Auth::user()->subscription_validity_date}})
                                </small>

                            </h3>
                        </div>
                    </div>
                    @if(isset($courses))

                        @foreach ($courses as $course)

                            <div class="col-xl-4 col-md-6">
                                @if($course->type==1)
                                    <div class="couse_wizged">
                                        <div class="thumb">
                                            <div class="thumb_inner"
                                                 style="background-image: url('{{ file_exists($course->thumbnail) ? asset($course->thumbnail) : asset('public/\uploads/course_sample.png') }}')">
<span class="prise_tag">
     {{getPriceFormat(0)}}
</span>

                                            </div>

                                        </div>
                                        <div class="course_content">
                                            <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                                <h4 class="noBrake" title="{{$course->title}}">
                                                    {{$course->title}}
                                                </h4>
                                            </a>
                                            <div class="rating_cart">
                                                <div class="rateing">
                                                    <span>{{getTotalRating($course->id)}}/5</span>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                @if(!isEnrolled($course->id,\Illuminate\Support\Facades\Auth::user()->id) && !isCart($course->id))
                                                    <a href="#" class="cart_store"
                                                       data-id="{{$course->id}}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="course_less_students">
                                                <a>
                                                    <i class="ti-agenda"></i> {{getTotalLessons($course->id)}} {{__('student.Lessons')}}
                                                </a>
                                                <a>
                                                    <i class="ti-user"></i> {{$course->total_enrolled}} {{__('student.Students')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($course->type==2)
                                    <div class="quiz_wizged">
                                        <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                            <div class="thumb">
                                                <div class="thumb_inner"
                                                     style="background-image: url('{{ file_exists($course->thumbnail) ? asset($course->thumbnail) : asset('public/\uploads/course_sample.png') }}')">
<span class="prise_tag">
     {{getPriceFormat(0)}}
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
                                                @if(!isEnrolled($course->id,\Illuminate\Support\Facades\Auth::user()->id) && !isCart($course->id))
                                                    <a href="#" class="cart_store"
                                                       data-id="{{$course->id}}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="course_less_students">

                                                <a> <i class="ti-agenda"></i> {{getTotalQuestions($course->quiz_id)}}
                                                    {{__('student.Question')}}</a>
                                                <a>
                                                    <i class="ti-user"></i> {{$course->total_enrolled}} {{__('student.Students')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                @elseif($course->type==3)
                                    <div class="quiz_wizged">
                                        <div class="thumb">
                                            <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                                <div class="thumb">
                                                    <div class="thumb_inner"
                                                         style="background-image: url('{{ file_exists($course->thumbnail) ? asset($course->thumbnail) : asset('public/\uploads/course_sample.png') }}')">
<span class="prise_tag">
     {{getPriceFormat(0)}}
</span>


                                                    </div>
                                                    <span class="live_tag">{{__('student.Live')}}</span>
                                                </div>
                                            </a>


                                        </div>
                                        <div class="course_content">
                                            <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                                <h4 class="noBrake" title="{{$course->title}}"> {{$course->title}}</h4>
                                            </a>
                                            <div class="rating_cart">
                                                <div class="rateing">
                                                    <span>{{getTotalRating($course->id)}}/5</span>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                @if(!isEnrolled($course->id,\Illuminate\Support\Facades\Auth::user()->id) && !isCart($course->id))
                                                    <a href="#" class="cart_store"
                                                       data-id="{{$course->id}}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="course_less_students">
                                                <a> <i
                                                        class="ti-agenda"></i> {{getTotalClasses($course->class_id)}}
                                                    {{__('student.Classes')}}</a>
                                                <a>
                                                    <i class="ti-user"></i> {{$course->total_enrolled}} {{__('student.Students')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                    @if(count($courses)==0)
                        <div class="col-12">
                            <div class="section__title3 margin_50">
                                @if( routeIs('myClasses'))
                                    <p class="text-center">{{__('student.No Class Purchased Yet')}}!</p>
                                @elseif( routeIs('myQuizzes'))
                                    <p class="text-center">{{__('student.No Quiz Purchased Yet')}}!</p>
                                @else
                                    <p class="text-center">{{__('student.No Course Purchased Yet')}}!</p>
                                @endif

                            </div>
                        </div>
                    @endif

                    {{ $courses->appends(Request::all())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
