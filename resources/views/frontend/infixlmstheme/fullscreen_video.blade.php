@extends('frontend.infixlmstheme.layouts.full_screen_master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{ $course->title}} @endsection
@section('css')
    <link href="{{asset('public/frontend/infixlmstheme/css/full_screen.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/frontend/infixlmstheme/css/class_details.css')}}" rel="stylesheet"/>
    <style>

    </style>
@endsection

@section('mainContent')


    <header>
        <div id="sticky-header" class="header_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="header__wrapper">
                            <!-- header__left__start  -->
                            <div class="header__left d-flex align-items-center">
                                <div class="logo_img">
                                    <a href="{{url('/')}}">
                                        <img class="p-2" style="width: 108px"
                                             src="{{getCourseImage(getSetting()->logo)}}"
                                             alt="{{ getSetting()->site_name }}">
                                    </a>
                                </div>

                                <div class="category_search d-flex category_box_iner">

                                    <div class="input-group-prepend2 pl-3 ">
                                        <a class="headerTitle"
                                           href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}"
                                           style="padding-top: 3px;">
                                            <h4 class="headerTitle">{{$course->title}}</h4>
                                        </a>


                                    </div>

                                </div>
                            </div>

                            <div class="header__right">
                                <div class="contact_wrap d-flex align-items-center">
                                    <div class="contact_btn d-flex align-items-center">

                                        @if (Auth::check())
                                            @if(Auth::user()->role_id==3)
                                                @if (!in_array(Auth::user()->id,$reviewer_user_ids))

                                                    <a href="" data-toggle="modal"
                                                       data-target="#courseRating"
                                                       class="  headerSub p-2 mr-3">
                                                        <i class="fa fa-star pr-2"></i>
                                                        Leave a rating

                                                    </a>


                                                @endif
                                            @endif
                                        @endif


                                        <a href="" class="mr-3">
                                            <div class="progress p-2" data-percentage="{{$percentage}}">
		<span class="progress-left">
			<span class="progress-bar"></span>
		</span>
                                                <span class="progress-right">
			<span class="progress-bar"></span>
		</span>
                                                <div class="progress-value">
                                                    <div class="headerSubProcess">
                                                        {{$percentage}}%
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="#" data-toggle="modal"
                                           data-target="#ShareLink"
                                           class="theme_btn small_btn2 p-2 m-1">
                                            <i class="fa fa-share"></i>
                                            Share
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- header__right_end  -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>


    <div class="course_fullview_wrapper">


        @if ($lesson->host=='Youtube')
            @php
                if (Str::contains( $lesson->video_url, '&')) {
                    $video_id = explode("=", $lesson->video_url);
                    $youtube_url= youtubeVideo($video_id[1]);
                } else {
                   $youtube_url=getVideoId(showPicName(@$lesson->video_url));

                }
            @endphp
            <iframe id="video-id" class="video_iframe" src="https://www.youtube.com/embed/{{$youtube_url}}?autoplay=1"
                    frameborder="0"></iframe>
        @endif
        @if ($lesson->host=='Vimeo')

            <iframe class="video_iframe" id="video-id"
                    src="https://player.vimeo.com/video/{{getVideoId(showPicName(@$lesson->video_url))}}?autoplay=1"
                    frameborder="0"></iframe>
        @endif

        @if ($lesson->host=='Self')

            <video class="video_iframe" id="video-id">
                <source src="{{asset($lesson->video_url)}}" type="video/mp4"/>
                <source src="{{asset($lesson->video_url)}}" type="video/ogg">

            </video>
        @endif


        @if ($lesson->host=='URL')
            <video class="video_iframe" id="video-id" controls autoplay>
                <source src="{{$lesson->video_url}}" type="video/mp4">
                <source src="{{$lesson->video_url}}" type="video/ogg">
                Your browser does not support the video.
            </video>
        @endif
        @if ($lesson->host=='AmazonS3')
            <video class="video_iframe" id="video-id">
                <source src="{{$lesson->video_url}}" type="video/mp4"/>

            </video>

        @endif

        @if ($lesson->host=='SCORM')

            <iframe class="video_iframe" id="video-id"
                    src="{{asset($lesson->video_url)}}"
            ></iframe>
        @endif

        @if ($lesson->host=='SCORM-AwsS3')

            <iframe class="video_iframe" id="video-id"
                    src="{{$lesson->video_url}}"
            ></iframe>
        @endif

        @if ($lesson->host=='Iframe')
            @if(!empty($lesson->video_url))
                <iframe class="video_iframe" id="video-id"
                        src="{{asset($lesson->video_url)}}"
                ></iframe>
            @endif
        @endif


        @if ($lesson->host=='Image')
            <img src="{{asset($lesson->video_url)}}" alt="" class="w-100  h-100">
        @endif

        @if ($lesson->host=='PDF')


            <div id="pdfShow" class="w-100  h-100"></div>
            <script src="{{asset('public/js/pdfobject.js')}}"></script>
            <script>PDFObject.embed("{{asset($lesson->video_url)}}", "#pdfShow");</script>

        @endif
        @if ($lesson->host=='Word' || $lesson->host=='Excel' || $lesson->host=='PowerPoint' )

            <iframe class="w-100  h-100"
                    src="https://view.officeapps.live.com/op/view.aspx?src={{asset($lesson->video_url)}}"></iframe>


            {{--                <iframe class="w-100  h-100" src="https://view.officeapps.live.com/op/view.aspx?src=https://filesamples.com/samples/document/doc/sample2.doc"></iframe>--}}


        @endif

        @if ($lesson->host=='Text')
            <div class="w-100  h-100 textViewer">

            </div>
            <script>
                $(".textViewer").load("{{asset($lesson->video_url)}}");

            </script>
        @endif

        @if ($lesson->host=='Zip')
            <style>
                .parent {
                    position: fixed;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .child {
                    position: relative;
                    font-size: 10vw;
                }
            </style>
            <div class="w-100 parent  h-100 ">
                <div class="">
                    <div class="row">
                        <div class="col  text-center">
                            <div class="child">
                                <a class="theme_btn " href="{{asset($lesson->video_url)}}" download="">Download File</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif

        <input type="hidden" id="url" value="{{url('/')}}">
        <div class="course__play_warp courseListPlayer ">
            <div class="play_toggle_btn">
                <i class="ti-menu-alt"></i>
            </div>

            <div class="play_warp_header d-flex justify-content-between">
                <h3 class="font_16 f_w_500 mb-0 lesson_count">
                    <a href="{{route('courseDetailsView',[@$course->id,@$course->slug])}}" class="theme_btn_mini">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    {{@$total}} {{__('common.Lessons')}}</h3>
                <p class="font_14 f_w_400 duration_time"> {{@$course->duration}} </p>
            </div>
            <div class="course__play_list">
                @if(isset($lessons))
                    @foreach ($lessons as $key=> $lesson)
                        <div class="single_play_list">
                            <a class="@if(showPicName(Request::url())==$lesson->id) active @endif" href="#">

                                @if ($lesson->is_quiz==1)
                                    <span class="course_play_name">
                                <i class="ti-check-box"></i>
                                @foreach ($lesson->quiz as $quiz)
                                            <span class="quizLink"
                                                  onclick='goQuizTest("{{route('courseQuizDetails',[$course->id,$quiz->id,$quiz->title])}}")'
                                                  data-url="{{route('courseQuizDetails',[$course->id,$quiz->id,$quiz->title])}}">

                                                                    <span
                                                                        class="quiz_name">{{@$key+1}}. {{@$quiz->title}}</span>
                                                                </span>
                                </span>
                                    @endforeach
                                @else
                                    <span class="course_play_name">
                                    @if(request()->route('lesson_id') == $lesson->id)
                                            <div class="remember_forgot_pass d-flex justify-content-between">
                                            <label class="primary_checkbox d-flex mb-0">
                                                @if($isEnrolled)
                                                    <input type="checkbox" data-lesson="{{$lesson->id}}"
                                                           data-course="{{$course->id}}" class="course_name"
                                                           {{$lesson->completed && $lesson->completed->status == 1 ? 'checked' : ''}}  name="billing_address"
                                                           value="1">
                                                    <span class="checkmark mr_15"></span>
                                                @else
                                                    <i class="ti-control-play"></i>
                                                @endif
                                            </label>
                                        </div>
                                        @else
                                            <i class="ti-control-play"></i>
                                        @endif
                                        <span
                                            onclick="goFullScreen({{$course->id}},{{$lesson->id}})">{{$key+1}}. {{$lesson->name}} {{$lesson->completed && $lesson->completed->status == 1 ? '(completed)' : ''}}</span>
                                </span>
                                    <span class="course_play_duration">{{$lesson->duration}}</span>
                                @endif
                            </a>
                        </div>
                    @endforeach
                @endif
                <div class="row justify-content-center text-center">
                    @if($certificate)
                        @auth()
                            @if(count($course->lessons) == count($course->completeLessons->where('status',1)->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)))
                                <a href="{{route('getCertificate',[$course->id,$course->title])}}"
                                   class="theme_btn certificate_btn mt-5">
                                    {{__('frontend.Get Certificate')}}
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if ($lesson->host=='Self'|| $lesson->host=='AmazonS3')
        <script>
            let myFP = fluidPlayer(
                'video-id', {
                    "layoutControls": {
                        "controlBar": {
                            "autoHideTimeout": 3,
                            "animated": true,
                            "autoHide": false
                        },
                        "htmlOnPauseBlock": {
                            "html": null,
                            "height": null,
                            "width": null
                        },
                        "autoPlay": true,
                        "mute": false,
                        "hideWithControls": false,
                        "allowTheatre": true,
                        "playPauseAnimation": false,
                        "playbackRateEnabled": false,
                        "allowDownload": false,
                        "playButtonShowing": true,
                        "fillToContainer": true,
                        "posterImage": ""
                    },
                    "vastOptions": {
                        "adList": [],
                        "adCTAText": false,
                        "adCTATextPosition": ""
                    }
                });

        </script>
    @endif


    <div class="modal fade " id="ShareLink"
         tabindex="-1" role="dialog"
         aria-labelledby=" "
         aria-hidden="true">
        <div class="modal-dialog modal-lg "
             role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Share this course

                    </h5>
                </div>

                <div class="modal-body">


                    <div class="row mb-20">
                        <div class="col-md-12">
                            <input type="text"
                                   required
                                   class="primary_input4 mb_20"
                                   name=""
                                   value="{{URL::current()}}">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="social_btns ">
                                <a target="_blank"
                                   href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}"
                                   class="social_btn fb_bg"> <i class="fab fa-facebook-f"></i>
                                </a>
                                <a target="_blank"
                                   href="https://twitter.com/intent/tweet?text={{$course->title}}&amp;url={{URL::current()}}"
                                   class="social_btn Twitter_bg"> <i
                                        class="fab fa-twitter"></i> </a>
                                <a target="_blank"
                                   href="https://pinterest.com/pin/create/link/?url={{URL::current()}}&amp;description={{$course->title}}"
                                   class="social_btn Pinterest_bg"> <i
                                        class="fab fa-pinterest-p"></i> </a>
                                <a target="_blank"
                                   href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{URL::current()}}&amp;title={{$course->title}}&amp;summary={{$course->title}}"
                                   class="social_btn Linkedin_bg"> <i
                                        class="fab fa-linkedin-in"></i> </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade " id="courseRating"
         tabindex="-1" role="dialog"
         aria-labelledby=" "
         aria-hidden="true">
        <div class="modal-dialog modal-lg "
             role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Rate this course

                    </h5>
                </div>
                <div class="modal-body">


                    <div class="row mb-20">
                        <div class="col-md-12">
                            <div class="rating_star text-right">

                                @php
                                    $PickId=$course->id;
                                @endphp
                                @if (Auth::check())
                                    @if(Auth::user()->role_id==3)
                                        @if (!in_array(Auth::user()->id,$reviewer_user_ids))


                                            <div
                                                class="star_icon d-flex align-items-center justify-content-between">
                                                <a class="rating">
                                                    <input type="radio" id="star5" name="rating"
                                                           value="5"
                                                           class="rating"/><label
                                                        class="full" for="star5" id="star5"
                                                        title="Awesome - 5 stars"
                                                        onclick="Rates(5, {{@$PickId }})"></label>
                                                    <input type="radio" id="star4half"
                                                           name="rating"
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
                                                    <input type="radio" id="star3half"
                                                           name="rating"
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
                                                    <input type="radio" id="star2half"
                                                           name="rating"
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
                                                    <input type="radio" id="star1half"
                                                           name="rating"
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
                                                    <input type="radio" id="starhalf"
                                                           name="rating"
                                                           value=".5"
                                                           class="rating"/><label class="half"
                                                                                  for="starhalf"
                                                                                  title="So bad  - 0.5 stars"
                                                                                  onclick="Rates(.5,{{@$PickId }})"></label>
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                @else

                                    <p class="font_14 f_w_400 mt-0"><a href="{{url('login')}}"
                                                                       class="theme_color2">{{__('frontend.Sign In')}}</a>
                                        {{__('frontend.or')}} <a
                                            class="theme_color2"
                                            href="{{url('register')}}">{{__('frontend.Sign Up')}}</a>
                                        {{__('frontend.as student to post a review')}}</p>
                                @endif

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
                                                                <textarea class="lms_summernote" name="review" name=""
                                                                          id=""
                                                                          placeholder="{{__('frontend.Write your review') }}"
                                                                          cols="30"
                                                                          rows="10">{{old('review')}}</textarea>
                            <span class="text-danger" role="alert">{{$errors->first('review')}}</span>
                        </div>


                    </div>
                    <div class="modal-footer justify-content-center">
                        <div class="mt-40">
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
@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            let course = '{{$course->id}}';
            let lesson = '{{$lesson->id}}';

            $("iframe").each(function () {
                //Using closures to capture each one
                var iframe = $(this);
                iframe.on("load", function () { //Make sure it is fully loaded
                    iframe.contents().click(function (event) {
                        iframe.trigger("click");
                    });

                });

                iframe.click(function () {
                    $.ajax({
                        type: 'POST',
                        "_token": "{{ csrf_token() }}",
                        url: '{{route('lesson.complete.ajax')}}',
                        data: {course: course, lesson: lesson},
                        success: function (data) {

                        }
                    });
                });
            });

            if (window.outerWidth < 425) {
                $('.courseListPlayer').toggleClass("active");
                $('.course_fullview_wrapper').toggleClass("active");
            }
        });


    </script>
    <script src="{{asset('public/frontend/infixlmstheme/js/full_screen_video.js')}}"></script>
    <script src="{{asset('public/frontend/infixlmstheme/js/class_details.js')}}"></script>
@endpush
