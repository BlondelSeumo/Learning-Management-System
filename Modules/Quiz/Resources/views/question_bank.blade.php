@extends('backend.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> {{__('quiz.Quiz')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                    <a href="#"> {{__('quiz.Quiz')}}</a>
                    <a href="#"> {{__('quiz.Question Bank')}}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            @if(isset($bank))
                @if (permissionCheck('question-bank.store'))
                    <div class="row">
                        <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">

                        </div>
                    </div>
                @endif
            @endif
            <div class="row">
                {{-- @dd($bank) --}}
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-20">
                                    @if(isset($bank))
                                        {{__('common.Edit')}}
                                        <a href="{{route('question-bank')}}" title=" {{__('common.Add')}}"
                                           class="primary-btn small updateBtn fix-gr-bg">
                                            +
                                        </a>
                                    @else
                                        {{__('common.Add')}}
                                    @endif
                                    {{__('quiz.Question Bank')}}
                                </h3>
                            </div>

                            @if(isset($bank))

                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('question-bank-update',$bank->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'id' => 'question_bank']) }}

                            @else
                                @if (permissionCheck('question-bank.store'))

                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'question-bank.store',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'question_bank']) }}

                                @endif
                            @endif
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if(session()->has('message-success'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('message-success') }}
                                                </div>
                                            @elseif(session()->has('message-danger'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('message-danger') }}
                                                </div>
                                            @endif
                                            <label class="primary_input_label"
                                                   for="groupInput">{{__('quiz.Group')}}</label>
                                            <select {{ $errors->has('group') ? ' autofocus' : '' }}
                                                    class="primary_select{{ $errors->has('group') ? ' is-invalid' : '' }}"
                                                    name="group" id="groupInput">
                                                <option data-display="{{__('common.Select')}} {{__('quiz.Group')}} *"
                                                        value="">{{__('common.Select')}} {{__('quiz.Group')}} *
                                                </option>
                                                @foreach($groups as $group)
                                                    @if(isset($bank))
                                                        <option
                                                            value="{{$group->id}}" {{$group->id == $bank->q_group_id? 'selected': ''}}>{{$group->title}}</option>
                                                    @else
                                                        <option
                                                            value="{{$group->id}}" {{old('group')!=''? (old('group') == $group->id? 'selected':''):''}} >{{$group->title}}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                            @if ($errors->has('group'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('group') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <label class="primary_input_label"
                                                   for="category_id">{{__('quiz.Category')}}</label>
                                            <select {{ $errors->has('category') ? ' autofocus' : '' }}
                                                    class="primary_select {{ $errors->has('category') ? ' is-invalid' : '' }}"
                                                    id="category_id" name="category">
                                                <option data-display=" {{__('quiz.Category')}} *"
                                                        value=""> {{__('quiz.Category')}} *
                                                </option>
                                                @foreach($categories as $category)
                                                    @if(isset($bank))
                                                        <option
                                                            value="{{$category->id}}" {{$bank->category_id == $category->id? 'selected': ''}}>{{$category->name}}</option>
                                                    @else
                                                        <option
                                                            value="{{$category->id}}" {{old('category')!=''? (old('category') == $category->id? 'selected':''):''}}>{{$category->name}}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                            @if ($errors->has('category'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12 mt-30-md" id="subCategoryDiv">
                                            <label class="primary_input_label"
                                                   for="subcategory_id">{{__('quiz.Sub Category')}}</label>
                                            <select {{ $errors->has('sub_category') ? ' autofocus' : '' }}
                                                    class="primary_select{{ $errors->has('sub_category') ? ' is-invalid' : '' }} select_section"
                                                    id="subcategory_id" name="sub_category">
                                                <option
                                                    data-display=" {{__('common.Select')}} {{__('quiz.Sub Category')}} *"
                                                    value="">{{__('common.Select')}} {{__('quiz.Sub Category')}} *
                                                </option>

                                                @if(isset($bank))
                                                    <option value="{{@$bank->subcategory_id}}"
                                                            selected>{{@$bank->subCategory->name}}</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('sub_category'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('sub_category') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <input type="hidden" name="question_type" value="M"> --}}
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <label class="primary_input_label"
                                                   for="question-type">{{__('quiz.Question Type')}}</label>
                                            <select {{ $errors->has('question_type') ? ' autofocus' : '' }}
                                                    class="primary_select{{ $errors->has('question_type') ? ' is-invalid' : '' }}"
                                                    name="question_type" id="question-type">
                                                <option data-display="{{__('quiz.Question Type')}} *"
                                                        value="">{{__('quiz.Question Type')}} *
                                                </option>

                                                <option
                                                    value="M" {{isset($bank)? $bank->type == "M"? 'selected': '' : ''}}> {{__('Multiple Choice')}}</option>
                                            </select>
                                            @if ($errors->has('question_type'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('question_type') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <label> {{__('quiz.Question')}} *</label>
                                                <textarea {{ $errors->has('question') ? ' autofocus' : '' }}
                                                          class="primary_input_field name{{ $errors->has('question') ? ' is-invalid' : '' }}"
                                                            rows="4"
                                                          name="question">{{isset($bank)? $bank->question:(old('question')!=''?(old('question')):'')}}</textarea>
                                                <span class="focus-border textarea"></span>
                                                @if ($errors->has('question'))
                                                    <span
                                                        class="error text-danger"><strong>{{ $errors->first('question') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <label> {{__('quiz.Marks')}} *</label>
                                                <input {{ $errors->has('marks') ? ' autofocus' : '' }}
                                                       class="primary_input_field name{{ $errors->has('marks') ? ' is-invalid' : '' }}"
                                                       type="number" name="marks"
                                                       value="{{isset($bank)? $bank->marks:(old('marks')!=''?(old('marks')):'')}}">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('marks'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('marks') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        if(!isset($bank)){
                                            if(old('question_type') == "M"){
                                                $multiple_choice = "";
                                            }
                                        }else{
                                            if($bank->type == "M" || old('question_type') == "M"){
                                                $multiple_choice = "";
                                            }
                                        }
                                    @endphp
                                    <div class="multiple-choice"
                                         id="{{isset($multiple_choice)? $multiple_choice: 'multiple-choice'}}">
                                        <div class="row  mt-25">
                                            <div class="col-lg-8">
                                                <div class="input-effect">
                                                    <label> {{__('quiz.Number Of Options')}}*</label>
                                                    <input {{ $errors->has('number_of_option') ? ' autofocus' : '' }}
                                                           class="primary_input_field name{{ $errors->has('number_of_option') ? ' is-invalid' : '' }}"
                                                           type="number" name="number_of_option" autocomplete="off"
                                                           id="number_of_option"
                                                           value="{{isset($bank)? $bank->number_of_option: ''}}">
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('number_of_option'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('number_of_option') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mt-40">
                                                <button type="button" class="primary-btn small fix-gr-bg"
                                                        id="create-option">{{__('quiz.Create')}} </button>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        if(!isset($bank)){
                                            if(old('question_type') == "M"){
                                                $multiple_options = "";
                                            }
                                        }else{
                                            if($bank->type == "M" || old('question_type') == "M"){
                                                $multiple_options = "";
                                            }
                                        }
                                    @endphp
                                    <div class="multiple-options"
                                         id="{{isset($multiple_options)? "": 'multiple-options'}}">
                                        @php
                                            $i=0;
                                            $multiple_options = [];

                                            if(isset($bank)){
                                                if($bank->type == "M"){
                                                    $multiple_options = $bank->questionMu;
                                                }
                                            }
                                        @endphp
                                        @foreach($multiple_options as $multiple_option)

                                            @php $i++; @endphp
                                            <div class='row  mt-25'>
                                                <div class='col-lg-10'>
                                                    <div class='input-effect'>
                                                        <label> {{__('quiz.Option')}} {{$i}}</label>
                                                        <input class='primary_input_field name' type='text'
                                                               name='option[]' autocomplete='off' required
                                                               value="{{$multiple_option->title}}">
                                                        <span class='focus-border'></span>
                                                    </div>
                                                </div>
                                                <div class='col-lg-2 mt-40'>
                                                    <label class="primary_checkbox d-flex mr-12 "
                                                           for="option_check_{{$i}}" {{__('quiz.Yes')}}>
                                                        <input type="checkbox" @if ($multiple_option->status==1) checked
                                                               @endif id="option_check_{{$i}}"
                                                               name="option_check_{{$i}}" value="1">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @php
                                        if(!isset($bank)){
                                            if(old('question_type') == "T"){
                                                $true_false = "";
                                            }
                                        }else{
                                            if($bank->type == "T" || old('question_type') == "T"){
                                                $true_false = "";
                                            }
                                        }
                                    @endphp
                                    <div class="true-false" id="{{isset($true_false)? $true_false: 'true-false'}}">
                                        <div class="row  mt-25">
                                            <div class="col-lg-12 d-flex">
                                                <p class="text-uppercase fw-500 mb-10"></p>
                                                <div class="d-flex radio-btn-flex">
                                                    <div class="mr-30">
                                                        <input type="radio" name="trueOrFalse" id="relationFather"
                                                               value="T"
                                                               class="common-radio relationButton" {{isset($bank)? $bank->trueFalse == "T"? 'checked': '' : 'checked'}}>
                                                        <label for="relationFather"> {{__('quiz.True')}} </label>
                                                    </div>
                                                    <div class="mr-30">
                                                        <input type="radio" name="trueOrFalse" id="relationMother"
                                                               value="F"
                                                               class="common-radio relationButton" {{isset($bank)? $bank->trueFalse == "F"? 'checked': '' : ''}}>
                                                        <label for="relationMother">{{__('quiz.False')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        if(!isset($bank)){
                                            if(old('question_type') == "F"){
                                                $fill_in = "";
                                            }
                                        }else{
                                            if($bank->type == "F" || old('question_type') == "F"){
                                                $fill_in = "";
                                            }
                                        }
                                    @endphp
                                    <div class="fill-in-the-blanks"
                                         id="{{isset($fill_in)? $fill_in : 'fill-in-the-blanks'}}">
                                        <div class="row  mt-25">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <textarea
                                                        class="primary-input form-control{{ $errors->has('suitable_words') ? ' is-invalid' : '' }}"
                                                       rows="5"
                                                        name="suitable_words">{{isset($bank)? $bank->suitable_words: ''}}</textarea>
                                                    <label>{{__('Suitable Words')}} *</label>
                                                    <span class="focus-border textarea"></span>
                                                    @if ($errors->has('suitable_words'))
                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('suitable_words') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $tooltip = "";
                                          if (permissionCheck('question-bank.store')){
                                              $tooltip = "";
                                          }else{
                                              $tooltip = "You have no permission to add";
                                          }
                                    @endphp
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg" data-toggle="tooltip"
                                                    title="{{$tooltip}}">
                                                <span class="ti-check"></span>
                                                @if(isset($bank))
                                                    {{__('common.Update')}}
                                                @else
                                                    {{__('common.Save')}}
                                                @endif
                                                {{__('quiz.Question')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="main-title">
                        <h3 class="mb-20">{{__('quiz.Question Bank List')}}</h3>
                    </div>

                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">

                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>

                                    <tr>
                                        <th>{{__('quiz.Group')}}</th>
                                        <th>{{__('quiz.Category')}}</th>
                                        <th>{{__('quiz.Question')}}</th>
                                        <th>{{__('common.Type')}}</th>
                                        <th>{{__('common.Action')}}</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($banks as $bank)
                                        <tr>

                                            <td>{{($bank->questionGroup)!=''?$bank->questionGroup->title:''}}</td>
                                            <td>{{@$bank->category->name}}/{{@$bank->subCategory->name}}</td>
                                            <td>{{@$bank->question}}</td>
                                            <td>
                                                @if(@$bank->type == "M")
                                                    Multiple Choice
                                                @elseif(@$bank->type == "T")
                                                    True False
                                                @else
                                                    Fill in the blank
                                                @endif
                                            </td>
                                            <td>


                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2{{$bank->id}}" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2{{$bank->id}}">
                                                        @if (permissionCheck('question-bank.edit'))
                                                            <a class="dropdown-item edit_brand"
                                                               href="{{route('question-bank-edit', [$bank->id])}}">{{__('common.Edit')}}</a>
                                                        @endif
                                                        @if (permissionCheck('question-bank.delete'))
                                                            <a class="dropdown-item" data-toggle="modal"
                                                               data-target="#deleteQuestionBankModal{{$bank->id}}"
                                                               href="#">{{__('common.Delete')}}</a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deleteQuestionBankModal{{$bank->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{__('common.Delete')}} {{__('quiz.Question Bank')}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"><i
                                                                class="ti-close "></i></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4> {{__('common.Are you sure to delete ?')}}</h4>
                                                        </div>
                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                            {{ Form::open(['route' => array('question-bank-delete',$bank->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                                            <button class="primary-btn fix-gr-bg"
                                                                    type="submit">{{__('common.Delete')}}</button>
                                                            {{ Form::close() }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{asset('/')}}/Modules/CourseSetting/Resources/assets/js/course.js"></script>
@endpush
