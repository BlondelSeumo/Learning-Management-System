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

                            <div class="result_sheet_wrapper mb_30">
                                <!-- quiz_test_header  -->
                                <div class="quiz_test_header">
                                    <h3>{{__('student.Result Sheet')}}</h3>
                                </div>
                                <!-- quiz_test_body  -->
                                <div class="quiz_test_body">
                                    <div class="result_sheet_view">
                                        @php
                                            $count=1;
                                        @endphp
                                        @if(isset($questions))
                                            @foreach($questions as $question)
                                                <div class="single_result_view">
                                                    <p>{{__('frontend.Question')}}: {{$count}}</p>
                                                    <h4>{{@$question['qus']}}</h4>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <ul>
                                                                @if(!empty($question['option']))
                                                                    @foreach($question['option'] as $option)
                                                                        @if($option['right'])
                                                                            <li>
                                                                                <label class="primary_checkbox2 d-flex">
                                                                                    <input checked="" type="checkbox"
                                                                                           disabled>
                                                                                    <span
                                                                                        class="checkmark mr_10"></span>
                                                                                    <span
                                                                                        class="label_name ">{{$option['title']}}</span>
                                                                                </label>
                                                                            </li>

                                                                        @else

                                                                            @if(isset($option['wrong']) && $option['wrong'])
                                                                                <li>
                                                                                    <label
                                                                                        class="primary_checkbox2 error_ans  d-flex">
                                                                                        <input checked=""
                                                                                               type="checkbox"
                                                                                               disabled>
                                                                                        <span
                                                                                            class="checkmark mr_10"></span>
                                                                                        <span
                                                                                            class="label_name ">{{$option['title']}} </span>
                                                                                    </label>
                                                                                </li>
                                                                            @else
                                                                                <li>
                                                                                    <label
                                                                                        class="primary_checkbox2 d-flex">
                                                                                        <input type="checkbox" disabled>
                                                                                        <span
                                                                                            class="checkmark mr_10"></span>
                                                                                        <span
                                                                                            class="label_name ">{{$option['title']}}</span>
                                                                                    </label>
                                                                                </li>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="marking_img">
                                                                @if(isset($question['isSubmit']))
                                                                    @if(isset($question['isWrong']) &&  $question['isWrong'])
                                                                        <img
                                                                            src="{{asset('public/frontend/infixlmstheme')}}/img/course_details/wrong.png"
                                                                            alt="">
                                                                    @else
                                                                        <img
                                                                            src="{{asset('public/frontend/infixlmstheme')}}/img/course_details/correct.png"
                                                                            alt="">
                                                                    @endif
                                                                @else
                                                                    <img
                                                                        src="{{asset('public/frontend/infixlmstheme')}}/img/course_details/wrong.png"
                                                                        alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $count++;
                                                @endphp
                                            @endforeach
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


