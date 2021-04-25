@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} |    {{$course->title}} @endsection
@section('css')

@endsection
@section('js')
    <script src="{{ asset('public/frontend/infixlmstheme/js/quiz_start.js') }}"></script>
@endsection

@section('mainContent')


    <input type="hidden" name="quiz_assign" class="quiz_assign" value="{{count($quiz->assign)}}">

    <div class="breadcrumb_area bradcam_bg_2"
         style="background-image: url('{{asset(@$frontendContent->quiz_page_banner)}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <div class="breadcam_wrap width_730px">
                        <h3>
                            {{$course->title}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- quiz__details::start  -->
    <div class="quiz__details">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-12">
                            <div class="quiz_questions_wrapper mb_30">
                                <!-- quiz_test_header  -->
                                <div class="quiz_test_header d-flex justify-content-between align-items-center">
                                    <div class="quiz_header_left">
                                        <h3>{{$quiz->title}}</h3>
                                    </div>
                                    <div class="quiz_header_right">

                                            <span class="question_time">
                                @php
                                    $timer =0;
                                        if(!empty($quizSetup->time_total_question)){
                                            $timer=$quizSetup->time_total_question;
                                        }else{
                                           $timer= $quizSetup->time_per_question*count($quiz->assign);
                                        }
                                @endphp

                                <span id="timer">{{$timer}}:00</span> min</span>
                                        <p>{{__('student.Left of this Section')}}</p>
                                    </div>
                                </div>
                                <!-- quiz_test_body  -->
                                <form action="{{route('quizSubmit')}}" method="POST">
                                    <input type="hidden" name="courseId" value="{{$course->id}}">
                                    <input type="hidden" name="quizId" value="{{$quiz->id}}">
                                    @csrf

                                    <div class="quiz_test_body">
                                        <div class="tabControl">
                                            <!-- nav-pills  -->
                                            <ul class="nav nav-pills nav-fill d-none" id="pills-tab" role="tablist">
                                                @if(isset($quiz->assign))
                                                    @foreach($quiz->assign as $key=>$itemAssign)
                                                        <li class="nav-item">
                                                            <a class="nav-link {{$key==0?'active':''}}"
                                                               id="pills-home-tab{{$itemAssign->id}}" data-toggle="pill"
                                                               href="#pills-{{$itemAssign->id}}" role="tab">Tab1</a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                            <!-- tab-content  -->
                                            <div class="tab-content" id="pills-tabContent">
                                                @php
                                                    $count =1;
                                                @endphp
                                                @if(isset($quiz->assign))
                                                    @foreach($quiz->assign as $key=>$assign)
                                                        <div class="tab-pane fade  {{$key==0?'active show':''}}"
                                                             id="pills-{{$assign->id}}" role="tabpanel"
                                                             aria-labelledby="pills-home-tab{{$assign->id}}">
                                                            <!-- content  -->
                                                            <div class="question_list_header">
                                                                <div class="question_list_top">
                                                                    <p>Question {{$count}} out
                                                                        of {{count($quiz->assign)}}</p>
                                                                    <div class="arrow_controller">
                                                                        @if($quizSetup->question_review==1)
                                                                            <span class="btnPrevious"> <i
                                                                                    class="ti-angle-left"></i> </span>
                                                                            <span class="next"> <i
                                                                                    class="ti-angle-right"></i> </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="question_list_counters">
                                                                    @foreach($quiz->assign as $key2=>$a)
                                                                        @php
                                                                            $value =$key2+1;
                                                                        @endphp
                                                                        <span
                                                                            class=" @if($value==$count) skip_qus @endif">{{$value}}</span>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                            <div class="multypol_qustion mb_30">
                                                                <h4 class="font_18 f_w_700 mb-0"> {{@$assign->questionBank->question}}</h4>
                                                            </div>
                                                            <ul class="quiz_select">
                                                                @if(isset($assign->questionBank->questionMu))
                                                                    @foreach(@$assign->questionBank->questionMu as $option)

                                                                        {{--                                                            $user_previous->question_id . '|' . $option->id--}}
                                                                        <li>
                                                                            <label
                                                                                class="primary_bulet_checkbox d-flex">
                                                                                <input class="quizAns"
                                                                                       name="ans[{{$option->question_bank_id}}]"
                                                                                       type="radio"
                                                                                       value="{{$option->question_bank_id}}|{{$option->id}}">

                                                                                <span class="checkmark mr_10"></span>
                                                                                <span
                                                                                    class="label_name">{{$option->title}} </span>
                                                                            </label>
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                            <div class="sumit_skip_btns d-flex align-items-center">
                                                                @if(count($quiz->assign)!=$count)
                                                                    <span
                                                                        class="theme_btn small_btn  mr_20 next"
                                                                        id="next">{{__('student.Continue')}}</span>
                                                                    <span
                                                                        class=" font_1 font_16 f_w_600 theme_text3 submit_q_btn skip"
                                                                        id="skip">{{__('student.Skip')}}
                                                                        {{__('frontend.Question')}}</span>
                                                                @else
                                                                    <button type="submit"
                                                                            class="submitBtn theme_btn small_btn  mr_20">
                                                                        {{__('student.Submit')}}
                                                                    </button>
                                                                @endif
                                                            </div>
                                                            <!-- content::end  -->
                                                        </div>
                                                        @php
                                                            $count++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

