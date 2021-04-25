@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} |    {{$course->title}} @endsection
@section('css')

@endsection
@section('js')

@endsection

@section('mainContent')
    <!-- bradcam::start  -->
    <div class="breadcrumb_area bradcam_bg_3">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <div class="breadcam_wrap width_730px">
                        <span>{{__('student.Course Details')}}</span>
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


                            <div class="quiz_score_wrapper mb_30">
                                <!-- quiz_test_header  -->
                                <div class="quiz_test_header">
                                    <h3>{{__('student.Your Exam Score')}}</h3>
                                </div>
                                <!-- quiz_test_body  -->
                                <div class="quiz_test_body">
                                    <h3>{{__('student.Congratulations! You’ve completed')}} {{$course->quiz->title}}</h3>
                                    <div class="">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="score_view_wrapper">
                                                    <div class="single_score_view">
                                                        <p>{{__('student.Exam Score')}}:</p>
                                                        <ul>
                                                            <li class="mb_15">
                                                                <label class="primary_checkbox2 d-flex">
                                                                    <input checked="" type="checkbox" disabled>
                                                                    <span class="checkmark mr_10"></span>
                                                                    <span
                                                                        class="label_name">{{$result['totalCorrect']}} {{__('student.Correct Answer')}}</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="primary_checkbox2 error_ans d-flex">
                                                                    <input checked="" name="qus" type="checkbox"
                                                                           disabled>
                                                                    <span class="checkmark mr_10"></span>
                                                                    <span
                                                                        class="label_name">{{$result['totalWrong']}} {{__('student.Wrong Answer')}}</span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="single_score_view">
                                                        <p>{{__('student.Rating')}}:</p>
                                                        <h4 class="f_w_700 theme_text">{{$result['status']}}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sumit_skip_btns d-flex align-items-center">
                                        <a href="{{route('quizDetailsView',[@$course->id,@$course->slug])}}"
                                           class="theme_btn small_btn  mr_20">{{__('student.Done')}}</a>

                                        @if($quizSetup->show_result_each_submit==1)
                                            <a href="{{route('quizResultPreview',$quiz->id)}}"
                                               class=" font_1 font_16 f_w_600 theme_text3 submit_q_btn">{{__('student.See Answer Sheet')}}</a>
                                        @endif


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


