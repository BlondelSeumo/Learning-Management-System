@extends('backend.master')
@section('mainContent')
    <input type="text" hidden value="{{ @$clas->class_name }}" id="cls">
    <input type="text" hidden value="{{ @$sec->section_name }}" id="sec">
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> {{__('quiz.Online Quiz')}} {{__('quiz.Report')}} </h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('quiz.Quiz')}}</a>
                    <a href="#"> {{__('quiz.Online Quiz')}} {{__('quiz.Report')}} </a>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-12">
            @if(session()->has('message-success') != "")
                @if(session()->has('message-success'))
                    <div class="alert alert-success">
                        {{ session()->get('message-success') }}
                    </div>
                @endif
            @endif
            @if(session()->has('message-danger') != "")
                @if(session()->has('message-danger'))
                    <div class="alert alert-danger">
                        {{ session()->get('message-danger') }}
                    </div>
                @endif
            @endif
            <div class="white-box mb-30">
                {{ Form::open(['class' => 'form-horizontal', 'files' => false, 'route' => 'quizResult', 'method' => 'GET', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                <div class="row">

                    <div class="col-lg-4 mt-30-md md_mb_20">
                        <label class="primary_input_label" for="category_id">{{__('quiz.Category')}}</label>
                        <select class="primary_select {{ $errors->has('category') ? ' is-invalid' : '' }}"
                                id="category_id" name="category">
                            <option data-display=" {{__('quiz.Category')}} *" value=""> {{__('quiz.Category')}}*
                            </option>
                            @foreach($categories as $category)
                                <option
                                    value="{{$category->id}}" {{old('category')!=''? (old('category') == $category->id? 'selected':''):''}} {{isset($category_search)?$category_search==$category->id?'selected':'':''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category'))
                            <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="col-lg-4 mt-30-md md_mb_20" id="subCategoryDiv">
                        <label class="primary_input_label" for="subcategory_id">{{__('quiz.Sub Category')}}</label>
                        <select
                            class="primary_select{{ $errors->has('sub_category') ? ' is-invalid' : '' }} select_section"
                            id="subcategory_id" name="sub_category">
                            <option data-display=" {{__('common.Select')}} {{__('quiz.Sub Category')}}"
                                    value="">{{__('common.Select')}} {{__('quiz.Sub Category')}}</option>
                            @if(isset($category_search))
                                @foreach($categories->where('id',$category_search) as $category)
                                    @if(isset($subcategory_search))
                                        @foreach($category->subcategories as $cat)
                                            <option value="{{@$cat->id}}"
                                                {{$subcategory_search==$cat->id?'selected':''}}>{{@$cat->name}}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('sub_category'))
                            <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('sub_category') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="col-lg-4 mt-30-md md_mb_20" id="CourseDiv">
                        <label class="primary_input_label" for="course_id">{{__('quiz.Course')}}</label>
                        <select class="primary_select{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                                id="course_id" name="course">
                            <option data-display=" {{__('quiz.Course')}}" value=""> {{__('quiz.Course')}} *</option>
                            @if(isset($category_search))
                                @foreach($categories->where('id',$category_search) as $category)
                                    @if(isset($subcategory_search))
                                        @foreach($category->subcategories as $cat)
                                            @if(isset($course_search))
                                                @foreach($cat->courses as $course)
                                                    <option value="{{@$course->id}}"
                                                        {{$course_search==$course->id?'selected':''}}>{{@$course->title}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('sub_category'))
                            <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('sub_category') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="col-lg-12 mt-20 text-right">
                        <button type="submit" class="primary-btn small fix-gr-bg">
                            <span class="ti-search pr-2"></span>
                            {{__('quiz.Search')}}
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <section class="mt-20 admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row mt-40">
                <div class="col-lg-6 col-md-6">
                    <div class="box_header">
                        <div class="main-title mb_xs_20px">
                            <h3 class="mb-0 mb_xs_20px"> {{__('quiz.Result')}} {{__('common.View')}} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="QA_section QA_section_heading_custom check_box_table">
                <div class="QA_table ">

                    <table id="lms_table" class="table Crm_table_active3">
                        <thead>
                        <tr>
                            <th> {{__('quiz.Student')}} </th>
                            <th>{{__('quiz.Category')}}</th>
                            <th>{{__('quiz.Quiz')}}</th>
                            <th>{{__('quiz.Course')}}</th>
                            <th> {{__('quiz.Total Marks')}} </th>
                            <th> {{__('quiz.Obtained Marks')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <th> {{$report['user_name']}} </th>
                                <th> {{$report['category']}} </th>
                                <th> {{$report['quiz']}} </th>
                                <th> {{$report['course']}} </th>
                                <th> {{$report['totalMarks']}} </th>
                                <th> {{$report['marks']}} </th>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>





@endsection
@push('scripts')
    <script src="{{asset('/')}}/Modules/Quiz/Resources/assets/js/quiz.js"></script>
@endpush
