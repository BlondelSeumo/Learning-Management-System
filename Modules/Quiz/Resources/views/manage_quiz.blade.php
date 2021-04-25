@extends('backend.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('quiz.Quiz')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('quiz.Quiz')}}</a>
                    <a href="{{route("manage_online_exam_question", [$online_exam->id])}}"> {{__('quiz.Quiz Question')}} </a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-lg-12 mb-30">
                    <div class="white_box mb_20">
                        <div class="white_box_tittle list_header">
                            <h4>{{__('quiz.filterBy')}} </h4>
                        </div>
                        <form action="" method="GET">
                            <div class="row">

                                <div class="col-lg-6 mt-20">

                                    <select class="primary_select" name="group" id="">
                                        <option data-display="{{__('quiz.selectGroup')}}"
                                                value=""> {{__('quiz.selectGroup')}}</option>
                                        @foreach($groups as $group)
                                            <option
                                                value="{{$group->id}}" {{$group->id==$searchGroup?'selected':''}}> {{$group->title}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-lg-6 mt-1">
                                    <div class="search_course_btn ">
                                        <br>
                                        <button type="submit"
                                                class="primary-btn radius_30px mr-10 fix-gr-bg">{{__('courses.Filter')}} </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 mt--1">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3>{{__('quiz.Question List')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'online_exam_question_assign',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'student_form']) }}
                    <input type="hidden" id="online_exam_id" name="online_exam_id" value="{{ @$online_exam->id}}">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">

                            <table id="lms_table" class="table Crm_table_active3">
                                <thead>
                                @if(session()->has('message-success') != "" ||
                                session()->get('message-danger') != "")
                                    <tr>
                                        <td colspan="6">
                                            @if(session()->has('message-success'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('message-success') }}
                                                </div>
                                            @elseif(session()->has('message-danger'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('message-danger') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>

                                        <input type="checkbox" id="questionSelectAll"
                                               class="common-checkbox selectAllQuiz" name=""
                                               @if(count($question_banks)==count($already_assigned)) checked @endif
                                               value="">
                                        <label for="questionSelectAll"></label>


                                    </th>
                                    <th> {{__('quiz.Group')}} </th>
                                    <th>{{__('quiz.Question Type')}}</th>
                                    <th>{{__('quiz.Question')}}</th>
                                    <th>{{__('quiz.Marks')}}</th>
                                    <th>{{__('common.Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php $total_marks = 0; @endphp
                                @foreach($question_banks as $question_bank)

                                    @php $total_marks += $question_bank->mark; @endphp
                                    <tr class="abc">
                                        <td>
                                            <input type="checkbox" id="question{{ @$question_bank->id}}"
                                                   class="common-checkbox question" name="questions[]"
                                                   value="{{ @$question_bank->id}}" {{in_array(@$question_bank->id, @$already_assigned)? 'checked': ''}}>
                                            <label for="question{{@$question_bank->id}}"></label>
                                        </td>
                                        <td>{{@$question_bank->questionGroup !=""?@$question_bank->questionGroup->title:""}}</td>
                                        <td>
                                            @if(@$question_bank->type == "M")
                                                {{'Multiple Choice'}}
                                            @elseif(@$question_bank->type == "F")
                                                {{'Fill In The Blanks'}}
                                            @else
                                                {{'True False'}}
                                            @endif
                                        </td>
                                        <td>{{@$question_bank->question}}</td>
                                        <td>{{@$question_bank->marks}}</td>
                                        <td>
                                            <div class="dropdown CRM_dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenu2" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    {{ __('common.Select') }}
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item modalLink" data-modal-size="modal-lg"
                                                       data-toggle="modal" data-target="#show{{$question_bank->id}}"
                                                       title="View Question"
                                                       href="{{route('view_online_question_modal', [$question_bank->id])}}"> {{__('quiz.View')}} </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div id="show{{$question_bank->id}}" class="modal fade" tabindex="-1"
                                         aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="exampleModalLabel">{{@$question_bank->question}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="common-fields" id="common-fields">

                                                        <div class="row  mt-25">
                                                            <div class="col-lg-12">
                                                                <div class="input-effect">
                                                                    <input class="primary-input form-control"
                                                                           type="number" name="mark" autocomplete="off"
                                                                           value="{{@$question_bank->marks}}" required>
                                                                    <label> {{__('quiz.Marks')}} </label>
                                                                    <span class="focus-border"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-25">
                                                            <div class="col-lg-12">
                                                                <div class="input-effect">
                                                                <textarea class="primary-input form-control" cols="0"
                                                                          rows="5" name="question_title"
                                                                          readonly="true">{{@$question_bank->question}}</textarea>
                                                                    <label>{{__('quiz.Question')}} {{__('coupons.Title')}}</label>
                                                                    <span class="focus-border textarea"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(@$question_bank->type == "M")
                                                        @php
                                                            $multiple_options = $question_bank->questionMu;
                                                            $number_of_option = $question_bank->questionMu->count();
                                                        @endphp
                                                        <div class="multiple-choice" id="multiple-choice">

                                                            <div class="row  mt-25">
                                                                <div class="col-lg-10">
                                                                    <div class="input-effect">
                                                                        <input class="primary-input form-control"
                                                                               type="number" name="number_of_option"
                                                                               autocomplete="off"
                                                                               id="number_of_option_edit"
                                                                               value="{{@$number_of_option}}">
                                                                        <label>{{__('quiz.Number Of Options')}}</label>
                                                                        <span class="focus-border"></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="multiple-options" id="multiple-options">
                                                            @php $i=0; @endphp
                                                            @foreach($multiple_options as $multiple_option)
                                                                @php $i++; @endphp
                                                                <div class='row  mt-25'>
                                                                    <div class='col-lg-10'>
                                                                        <div class='input-effect'>
                                                                            <input class='primary-input form-control'
                                                                                   type='text' name='option[]'
                                                                                   autocomplete='off' required
                                                                                   value="{{@$multiple_option->title}}">
                                                                            <label>{{__('quiz.Option')}} {{$i}}</label>
                                                                            <span class='focus-border'></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class='col-lg-2'>
                                                                        <input type='checkbox' class="common-checkbox"
                                                                               id="commonCheckbox{{$i}}"
                                                                               name='option_check_{{$i}}' value='1'
                                                                               {{@$multiple_option->status == 1? 'checked': ''}} disabled="">
                                                                        <label for="commonCheckbox{{$i}}"></label>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @elseif($question_bank->type == "T")
                                                        <div class="true-false" id="true-false">
                                                            <div class="row  mt-25">
                                                                <div class="col-lg-12 d-flex">
                                                                    <p class="text-uppercase fw-500 mb-10"></p>
                                                                    <div class="d-flex radio-btn-flex">
                                                                        <div class="mr-30">
                                                                            <input type="radio" name="trueOrFalse"
                                                                                   id="relationFatherEdit" value="T"
                                                                                   class="common-radio relationButton"
                                                                                   {{@$question_bank->trueFalse == 'T'? 'checked': ''}} disabled="">
                                                                            <label
                                                                                for="relationFatherEdit">{{__('quiz.True')}} </label>
                                                                        </div>
                                                                        <div class="mr-30">
                                                                            <input type="radio" name="trueOrFalse"
                                                                                   id="relationMotherEdit" value="F"
                                                                                   class="common-radio relationButton"
                                                                                   {{@$question_bank->trueFalse == 'F'? 'checked': ''}} disabled="">
                                                                            <label
                                                                                for="relationMotherEdit">{{__('quiz.False')}}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="fill-in-the-blanks" id="fill-in-the-blanks">
                                                            <div class="row  mt-25">
                                                                <div class="col-lg-12">
                                                                    <div class="input-effect">
                                                                    <textarea class="primary-input form-control"
                                                                              cols="0" rows="5" name="suitable_words"
                                                                              readonly="true">{{@$question_bank->suitable_words}}</textarea>
                                                                        <label>@lang('lang.suitable_words')</label>
                                                                        <span class="focus-border textarea"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>

                <div class="col-lg-4 mt--1">
                    <div class="row">
                        <div class="col-lg-12 no-gutters">
                            <div class="main-title">
                                <h3> {{__('quiz.Quiz Details')}} </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row student-details">
                        <div class="col-lg-12">
                            <div class="student-meta-box">
                                <div class=" staff-meta-top"></div>
                                <div class="white-box">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="single-meta mt-20">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="value text-left">
                                                            {{__('coupons.Title')}}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="name">
                                                            {{$online_exam->title}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="single-meta">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="value text-left">
                                                            {{__('quiz.Passing %')}}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="name">
                                                            {{@$online_exam->percentage}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-meta">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="value text-left">
                                                            {{__('quiz.Total Marks')}}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="name" id="totalMarks">
                                                            {{@$online_exam->total_marks}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="single-meta">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="value text-left">
                                                            {{__('quiz.Total Questions')}}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="name" id="totalQuestions">
                                                            {{@$online_exam->total_questions}}
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
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade admin-query" id="deleteOnlineExamQuestion">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('lang.delete') @lang('lang.item')</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                </div>

                <div class="modal-body">
                    <div class="text-center">
                        <h4>@lang('lang.are_you_sure_to_delete')</h4>
                    </div>

                    <div class="mt-40 d-flex justify-content-between">
                        <button type="button" class="primary-btn tr-bg"
                                data-dismiss="modal">@lang('lang.cancel')</button>
                        {{ Form::open(['route' => 'online-exam-question-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <input type="hidden" name="id" id="online_exam_question_id">
                        <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                        {{ Form::close() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <input type="hidden" name="ques_assign" class="ques_assign"
           value="{{route('online_exam_question_assign_by_ajax')}}">
@endsection
@push('scripts')
    <script src="{{asset('public/backend/js/manage_quiz.js')}}"></script>
    <script>

    </script>
@endpush
