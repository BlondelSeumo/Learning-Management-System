@extends('backend.master')
@section('mainContent')
    @include("backend.partials.alertMessage")
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> {{__('quiz.Quiz Setup')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('quiz.Quiz')}}</a>
                    <a class="active" href="{{route('coupons.manage')}}"> {{__('quiz.Quiz Setup')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">
                                    {{__('quiz.Quiz Setup')}}
                                </h3>
                            </div>

                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'quizSetup.store','method' => 'POST', 'enctype' => 'multipart/form-data']) }}

                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                        <div class="col-lg-6 mt-40">
                                            <ul class="permission_list">
                                                <li>
                                                    <label class="primary_checkbox d-flex mr-12 ">
                                                        <input name="set_per_question_time"
                                                               @if (@$quiz_setup->set_per_question_time==1) checked
                                                               @endif value="1" onChange="setQuestionTime()"
                                                               id="set_question_time" type="checkbox">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <p for="#set_question_time">{{trans('quiz.Per Question time count')}}</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6">
                                            @if ($quiz_setup->set_per_question_time==1)
                                                <div class="form-group" id="per_question_time">
                                                    <label
                                                        for="set_time_per_question">{{trans('quiz.Per Question Time Count (Minute)')}}</label>
                                                    <input type="text" class="primary_input_field name"
                                                           name="set_time_per_question"
                                                           value="{{@$quiz_setup->time_per_question}}" id="set_time_per_question"
                                                           aria-describedby="helpId" placeholder="">
                                                </div>
                                                <div class="form-group" id="total_question_time" style="display: none">
                                                    <label
                                                        for="set_time_total_question">{{trans('quiz.Total Quiz time count (Minute)')}}</label>
                                                    <input type="text" class="primary_input_field name"
                                                           name="set_time_total_question"
                                                           value="{{@$quiz_setup->time_total_question}}" id="set_time_total_question"
                                                           aria-describedby="helpId" placeholder="">
                                                </div>
                                            @else
                                                <div class="form-group" id="per_question_time" style="display: none">
                                                    <label
                                                        for="set_time_per_question">{{trans('quiz.Per Question Time Count (Minute)')}}</label>
                                                    <input type="text" class="primary_input_field name"
                                                           name="set_time_per_question"
                                                           value="{{@$quiz_setup->time_per_question}}" id="set_time_per_question"
                                                           aria-describedby="helpId" placeholder="">
                                                </div>
                                                <div class="form-group" id="total_question_time">
                                                    <label
                                                        for="set_time_total_question">{{trans('quiz.Total Quiz time count (Minute)')}}</label>
                                                    <input type="text" class="primary_input_field name"
                                                           name="set_time_total_question"
                                                           value="{{@$quiz_setup->time_total_question}}" id="set_time_total_question"
                                                           aria-describedby="helpId" placeholder="">
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-lg-6 mt-40">
                                            <ul class="permission_list">
                                                <li>
                                                    <label class="primary_checkbox d-flex mr-12 ">
                                                        <input name="question_review"
                                                               @if (@$quiz_setup->question_review==1) checked
                                                               @endif value="1" id="questionReview"
                                                               onChange="changeQuestionReview()" type="checkbox">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <p for="#set_question_time">{{trans('quiz.Question Review')}} </p>
                                                </li>
                                                <small id="helpId" class="form-text text-muted">{{trans('quiz.Note')}}
                                                    : {{trans('quiz.If you enable this option, show result: after each submit will disabled')}}</small>
                                            </ul>
                                        </div>
                                        @php
                                            if($quiz_setup->question_review!=1){
                                                    $show_result_each='';
                                            }else{
                                                $show_result_each='style=display:none';
                                            }
                                        @endphp
                                        <div class="col-lg-6 mt-40" {{@$show_result_each}} id="showResultDiv">
                                            <ul class="permission_list">
                                                <li>
                                                    <label class="primary_checkbox d-flex mr-12 ">
                                                        <input name="show_result_each_submit"
                                                               @if (@$quiz_setup->show_result_each_submit==1) checked
                                                               @endif value="1" type="checkbox">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <p for="#set_question_time">{{trans('quiz.Show Results After Each Submit')}} </p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 mt-40">
                                            <ul class="permission_list">
                                                <li>
                                                    <label class="primary_checkbox d-flex mr-12 ">
                                                        <input name="random_question"
                                                               @if (@$quiz_setup->random_question==1) checked
                                                               @endif value="1" type="checkbox">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <p for="#set_question_time">{{trans('quiz.Random Question')}} </p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 mt-40">
                                            <ul class="permission_list">
                                                <li>
                                                    <label class="primary_checkbox d-flex mr-12 ">
                                                        <input name="multiple_attend"
                                                               @if (@$quiz_setup->multiple_attend==1) checked
                                                               @endif value="1" type="checkbox">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <p for="#set_question_time">{{trans('quiz.Multiple Attend')}} </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip">
                                                <span class="ti-check"></span>
                                                {{__('quiz.Save Setup')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div id="edit_form">

    </div>
    <div id="view_details">

    </div>

    {{-- @include('coupons::create') --}}
    @include('backend.partials.delete_modal')
@endsection
@push('scripts')
    <script src="{{asset('public/backend/js/manage_quiz.js')}}"></script>
@endpush
