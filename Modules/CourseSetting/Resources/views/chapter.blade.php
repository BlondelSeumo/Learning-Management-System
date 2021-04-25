@extends('backend.master')
@section('mainContent')
    @include("backend.partials.alertMessage")

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> {{__('quiz.Chapter')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('courses.Course')}}</a>
                    <a class="active" href="{{route('coupons.manage')}}"> {{__('quiz.Chapter')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="row justify-content-center mt-50">
            <div class="col-lg-12">
                <div class="white_box mb_30">

                    <form action="{{route('chapterSearchByCourse')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="primary_input_label" for=""> {{__('courses.Category')}}</label>
                                <select class="primary_select" name="category" id="Acategory_id">
                                    <option data-display="Select Category"
                                            value="">{{__('common.Select')}} {{__('courses.Category')}}</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{@$category->name}} </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-lg-4 " id="AsubCategoryDiv">
                                <label class="primary_input_label" for="">{{__('quiz.Sub Category')}}</label>
                                <select
                                    class="primary_select{{ $errors->has('sub_category') ? ' is-invalid' : '' }} select_section"
                                    id="Asubcategory_id" name="sub_category">
                                    <option data-display="{{__('common.Select')}} {{__('quiz.Sub Category')}}"
                                            value="">{{__('common.Select')}} {{__('quiz.Sub Category')}}</option>

                                </select>

                            </div>
                            <div class="col-lg-4 " id="ACourseDiv">
                                <label class="primary_input_label" for="">{{__('quiz.Course')}}</label>
                                <select class="primary_select{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                                        id="Acourse_id" name="course">
                                    <option data-display="{{__('common.Select')}} {{__('courses.Course')}}"
                                            value="">{{__('common.Select')}} {{__('courses.Course')}}</option>

                                </select>

                            </div>


                            <div class="col-12 mt-20">
                                <div class="search_course_btn text-right">
                                    <button type="submit"
                                            class="primary-btn radius_30px mr-10 fix-gr-bg">{{__('courses.Filter')}} </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">@if(isset($chapter))
                                        {{__('common.Edit')}}
                                    @else
                                        {{__('common.Add')}}
                                    @endif
                                    {{__('quiz.Chapter')}}
                                </h3>
                            </div>
                            @if(isset($chapter))
                                @if (permissionCheck('chapterEdit'))
                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'chapterUpdate', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                                @endif
                            @else
                                @if (permissionCheck('saveChapterPage'))
                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'saveChapterPage',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                @endif
                            @endif
                            <input type="hidden" id="url" value="{{url('/')}}">
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
                                            <div class="row mt-25">
                                                <div class="col-lg-12">
                                                    <label class="primary_input_label"
                                                           for="">{{__('quiz.Category')}}</label>
                                                    <select
                                                        class="primary_select {{ $errors->has('category') ? ' is-invalid' : '' }}"
                                                        id="category_id" name="category">
                                                        <option data-display=" {{__('quiz.Category')}} *"
                                                                value=""> {{__('quiz.Category')}} *
                                                        </option>
                                                        @foreach($categories as $category)
                                                            @if(isset($chapter))
                                                                <option
                                                                    value="{{$category->id}}" {{$chapter->category_id == $category->id? 'selected': ''}}>{{$category->name}}</option>
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
                                                           for="">{{__('quiz.Sub Category')}}</label>
                                                    <select
                                                        class="primary_select{{ $errors->has('sub_category') ? ' is-invalid' : '' }} select_section"
                                                        id="subcategory_id" name="sub_category">
                                                        <option
                                                            data-display=" {{__('common.Select')}} {{__('quiz.Sub Category')}} *"
                                                            value="">{{__('common.Select')}} {{__('quiz.Sub Category')}}
                                                            *
                                                        </option>

                                                        @if(isset($chapter))
                                                            <option value="{{@$chapter->subcategory_id}}"
                                                                    selected>{{@$chapter->subcategory_name}}</option>
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
                                                <div class="col-lg-12" id="CourseDiv">
                                                    <label class="primary_input_label"
                                                           for="">{{__('quiz.Course')}}</label>
                                                    <select
                                                        class="primary_select{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                                                        id="course_id" name="course">
                                                        <option data-display=" {{__('quiz.Course')}}"
                                                                value=""> {{__('quiz.Course')}} *
                                                        </option>
                                                        @if(isset($chapter))
                                                            <option value="{{@$chapter->course_id}}"
                                                                    selected>{{@$chapter->title}}</option>
                                                        @endif
                                                    </select>
                                                    @if ($errors->has('question_type'))
                                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('question_type') }}</strong>
                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="input-effect">
                                                <label>{{__('quiz.Chapter')}} {{__('common.Name')}}
                                                    <span>*</span></label>
                                                <input
                                                    class="primary_input_field name{{ $errors->has('chapter_name') ? ' is-invalid' : '' }}"
                                                    type="text" name="chapter_name" placeholder="Title"
                                                    autocomplete="off" value="{{isset($chapter)? $chapter->name:''}}">
                                                <input type="hidden" name="id"
                                                       value="{{isset($chapter)? $chapter->id: ''}}">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('chapter_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('chapter_name') }}</strong>
                                            </span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    @php
                                        $tooltip = "";
                                    @endphp
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip"
                                                    title="{{$tooltip}}">
                                                <span class="ti-check"></span>
                                                @if(isset($chapter))
                                                    {{__('common.Update')}}
                                                @else
                                                    {{__('common.Save')}}
                                                @endif
                                                {{__('quiz.Chapter')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-20">{{__('quiz.Chapter List')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.ID') }}</th>
                                        <th scope="col">{{ __('quiz.Course') }} {{ __('coupons.Title') }}</th>
                                        <th scope="col">{{ __('coupons.Title') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($chapters as $key => $chapter)
                                        <tr>
                                            <th>{{ $key+1 }}</th>
                                            <td>{{@$chapter->title }}</td>
                                            <td>{{@$chapter->name }}</td>
                                            <td>
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2">
                                                        <a class="dropdown-item edit_brand"
                                                           href="{{route('chapterEdit',$chapter->id)}}">{{__('common.Edit')}}</a>
                                                        @if (permissionCheck('chapterDelete'))
                                                            <a class="dropdown-item edit_brand"
                                                               href="{{route('lessonPage',$chapter->id)}}">{{__('courses.Lesson')}}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                        <div class="modal fade admin-query"
                                             id="deleteQuestionGroupModal{{$chapter->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{__('common.Delete')}} {{__('quiz.Chapter')}}</h4>
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
                                                            {{ Form::open(['route' => array('question-group-delete',$chapter->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
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
    <div id="edit_form">

    </div>
    <div id="view_details">

    </div>

    @include('backend.partials.delete_modal')
@endsection

@push('scripts')
    <script src="{{asset('/')}}/Modules/CourseSetting/Resources/assets/js/course.js"></script>
    <script src="{{asset('/')}}/Modules/CourseSetting/Resources/assets/js/advance_search.js"></script>
@endpush
