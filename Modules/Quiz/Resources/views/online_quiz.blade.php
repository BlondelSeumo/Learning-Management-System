@extends('backend.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> {{__('quiz.Quiz')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('quiz.Quiz')}}</a>
                    <a href="#"> {{__('quiz.Online Quiz')}}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3 mb_20">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-20">@if(isset($online_exam))
                                        {{__('common.Edit')}}
                                        <a href="{{route('online-quiz')}}" class="primary-btn small fix-gr-bg updateBtn"
                                           title=" {{__('common.Add')}}">
                                            +
                                        </a>
                                    @else
                                        {{__('common.Add')}}
                                    @endif
                                    {{__('quiz.Online Quiz')}}
                                </h3>
                            </div>
                            @if(isset($online_exam))
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('online-exam-update',$online_exam->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            @else
                                @if (permissionCheck('set-quiz.store'))
                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'online-exam',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
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
                                            <div class="input-effect">
                                                <label> {{__('quiz.Quiz Title')}} <span>*</span></label>
                                                <input {{ $errors->has('title') ? ' autofocus' : '' }}
                                                       class="primary_input_field name{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                       type="text" name="title" autocomplete="off"
                                                       value="{{isset($online_exam)? $online_exam->title: old('title')}}">
                                                <input type="hidden" name="id"
                                                       value="{{isset($online_exam)? $online_exam->id: ''}}">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <label class="primary_input_label"
                                                   for="category_id">{{__('quiz.Category')}}</label>
                                            <select {{ $errors->has('class') ? ' autofocus' : '' }}
                                                    class="primary_select {{ $errors->has('class') ? ' is-invalid' : '' }}"
                                                    id="category_id" name="category">
                                                <option data-display="{{__('quiz.Category')}} *"
                                                        value="">{{__('quiz.Category')}} *
                                                </option>
                                                @foreach($categories as $category)
                                                    @if (isset($online_exam))
                                                        <option value="{{$category->id}}"
                                                                @if ($category->id==$online_exam->category_id) selected @endif >{{$category->name}}</option>

                                                    @else

                                                        <option
                                                            value="{{$category->id}}" {{old('category')!=''? (old('category') == $category->id? 'selected':''):''}}>{{$category->name}}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                            @if ($errors->has('class'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('class') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12 mt-30-md" id="subCategoryDiv">
                                            <label class="primary_input_label"
                                                   for="subcategory_id  ">{{__('quiz.Sub Category')}}</label>
                                            <select {{ $errors->has('sub_category') ? ' autofocus' : '' }}
                                                    class="primary_select{{ $errors->has('sub_category') ? ' is-invalid' : '' }} select_section"
                                                    id="subcategory_id" name="sub_category">
                                                <option
                                                    data-display=" {{__('common.Select')}} {{__('quiz.Sub Category')}}"
                                                    value="">{{__('common.Select')}} {{__('quiz.Sub Category')}}
                                                </option>

                                                @if(isset($online_exam))
                                                    <option value="{{@$online_exam->sub_category_id}}"
                                                            selected>{{@$online_exam->subCategory->name}}</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('sub_category'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('sub_category') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <label>{{__('quiz.Minimum Percentage')}} *</label>
                                                <input {{ $errors->has('title') ? ' percentage' : '' }}
                                                       class="primary_input_field name{{ $errors->has('percentage') ? ' is-invalid' : '' }}"
                                                       type="number" name="percentage" autocomplete="off"
                                                       value="{{isset($online_exam)? $online_exam->percentage: old('percentage')}}">
                                                <input type="hidden" name="id"
                                                       value="{{isset($group)? $group->id: ''}}">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('percentage'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('percentage') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <label>{{__('quiz.Instruction')}} <span>*</span></label>
                                                <textarea {{ $errors->has('instruction') ? ' autofocus' : '' }}
                                                          class="primary_input_field name{{ $errors->has('instruction') ? ' is-invalid' : '' }}"
                                                          cols="0" rows="4"
                                                          name="instruction">{{isset($online_exam)? $online_exam->instruction: old('instruction')}}</textarea>
                                                <span class="focus-border textarea"></span>
                                                @if($errors->has('instruction'))
                                                    <span
                                                        class="error text-danger"><strong>{{ $errors->first('instruction') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $tooltip = "";
                                          if (permissionCheck('set-quiz.store')){
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
                                                @if(isset($online_exam))
                                                    {{__('common.Update')}}
                                                @else
                                                    {{__('common.Save')}}
                                                @endif
                                                {{__('quiz.Online Quiz')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="url" value="{{Request::url()}}">
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="main-title">
                        <h3 class="mb-20">{{__('quiz.Online Quiz List')}}</h3>
                    </div>

                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">

                            <table id="lms_table" class="table Crm_table_active3">

                                <thead>
                                @if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != "")
                                    <tr>
                                        <td colspan="6">
                                            @if(session()->has('message-success-delete'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('message-success-delete') }}
                                                </div>
                                            @elseif(session()->has('message-danger-delete'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('message-danger-delete') }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>{{__('coupons.Title')}} </th>
                                    <th>{{__('quiz.Category')}} </th>
                                    <th>{{__('common.Status')}} </th>
                                    <th>{{__('common.Action')}} </th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($online_exams as $online_exam)
                                    <tr>
                                        <td>{{$online_exam->title}}</td>
                                        <td>
                                            {{@$online_exam->category->name}}/{{@$online_exam->subCategory->name}}
                                        </td>
                                        <td>
                                            @if($online_exam->status == 0)
                                                <button
                                                    class="primary-btn small bg-warning text-white border-0">{{__('quiz.Pending')}} </button>
                                            @else
                                                <button
                                                    class="primary-btn small bg-success text-white border-0">{{__('quiz.Published')}}</button>
                                            @endif
                                        </td>
                                        <td style="width: 30%">
                                            <div class="dropdown CRM_dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenu2{{$online_exam->id}}" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    {{ __('common.Select') }}
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    @php
                                                        $is_set_online_exam_questions = DB::table('online_exam_question_assigns')->where('online_exam_id', $online_exam->id)->first();
                                                    @endphp
                                                    @if(!empty($is_set_online_exam_questions))
                                                        @if (permissionCheck('set-quiz.manage-question'))
                                                            <a class="dropdown-item"
                                                               href="{{route("manage_online_exam_question", [$online_exam->id])}}">{{__('quiz.Manage Question') }}</a>
                                                        @endif
                                                    @endif

                                                    @if (permissionCheck('set-quiz.edit'))

                                                        <a class="dropdown-item"
                                                           href="{{route("online-exam-edit",$online_exam->id)}}"> {{__('common.Edit')}} </a>

                                                    @endif
                                                    @if (permissionCheck('set-quiz.delete'))

                                                        <a class="dropdown-item deleteOnlineExam" data-toggle="modal"
                                                           href="#" data-id="{{$online_exam->id}}"
                                                           data-target="#deleteOnlineExam">{{__('common.Delete')}}</a>
                                                    @endif
                                                    @if(empty($is_set_online_exam_questions))
                                                        @if (permissionCheck('set-quiz.set-question'))
                                                            <a class="dropdown-item"
                                                               href="{{route("manage_online_exam_question", [$online_exam->id])}}">
                                                                {{__('Set')}}  {{__('quiz.Question')}}
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if($online_exam->status == 0)
                                                            @if (permissionCheck('set-quiz.publish-now'))
                                                                <a class="dropdown-item"
                                                                   href="{{route('online_exam_publish', [$online_exam->id])}}">
                                                                    {{__('quiz.Published Now')}}
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>

                                            </div>

                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade admin-query" id="deleteOnlineExam">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> {{__('common.Delete')}}  {{__('quiz.Quiz')}}  </h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                </div>

                <div class="modal-body">
                    <div class="text-center">
                        <h4>{{__('common.Are you sure to delete ?')}}</h4>
                    </div>

                    <div class="mt-40 d-flex justify-content-between">
                        <button type="button" class="primary-btn tr-bg"
                                data-dismiss="modal">{{__('common.Cancel')}}</button>
                        {{ Form::open(['route' => 'online-exam-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <input type="hidden" name="id" id="online_exam_id">
                        <button class="primary-btn fix-gr-bg" type="submit">  {{__('common.Delete')}}</button>
                        {{ Form::close() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('/')}}/Modules/Quiz/Resources/assets/js/quiz.js"></script>
@endpush
