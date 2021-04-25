@extends('backend.master')

@php
    $table_name='courses';
@endphp
@section('table'){{$table_name}}@stop
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('courses.Courses')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('courses.Courses')}}</a>
                    <a href="#">{{__('courses.Courses List')}}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">

            <div class="row justify-content-center mt-50">
                <div class="col-lg-12">
                    <div class="white_box mb_30">
                        <div class="white_box_tittle list_header">
                            <h4>{{__('courses.Advanced Filter')}} </h4>
                        </div>
                        <form action="{{route('courseSortBy')}}" method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-lg-3 mt-30">

                                    <label class="primary_input_label" for="category">{{__('courses.Category')}}</label>
                                    <select class="primary_select" name="category" id="category">
                                        <option data-display="{{__('common.Select')}} {{__('courses.Category')}}"
                                                value="">{{__('common.Select')}} {{__('courses.Category')}}</option>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}}" {{isset($category_search)?$category_search==$category->id?'selected':'':''}}>{{@$category->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 mt-30">

                                    <label class="primary_input_label" for="type">{{__('courses.Type')}}</label>
                                    <select class="primary_select" name="type" id="type">
                                        <option data-display="{{__('common.Select')}} {{__('courses.Type')}}"
                                                value="">{{__('common.Select')}} {{__('courses.Type')}}</option>
                                        <option
                                            value="1" {{isset($category_type)?$category_type==1?'selected':'':''}}>{{__('courses.Course')}}</option>
                                        <option
                                            value="2" {{isset($category_type)?$category_type==2?'selected':'':''}}>{{__('quiz.Quiz')}}</option>
                                    </select>

                                </div>
                                <div class="col-lg-3 mt-30">

                                    <label class="primary_input_label"
                                           for="instructor">{{__('courses.Instructor')}}</label>
                                    <select class="primary_select" name="instructor" id="instructor">
                                        <option data-display="{{__('common.Select')}} {{__('courses.Instructor')}}"
                                                value="">{{__('common.Select')}} {{__('courses.Instructor')}}</option>
                                        @foreach($instructors as $instructor)
                                            <option
                                                value="{{$instructor->id}}" {{isset($category_instructor)?$category_instructor==$instructor->id?'selected':'':''}}>{{@$instructor->name}} </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-lg-3 mt-30 d-none">
                                    <label class="primary_input_label" for="course">{{__('courses.Statistics')}}</label>
                                    <select class="primary_select" name="course" id="course">
                                        <option data-display="{{__('common.Select')}} {{__('courses.Statistics')}}"
                                                value="">{{__('common.Select')}} {{__('courses.Statistics')}}</option>
                                        <option value="statistics">{{__('courses.Statistics')}}</option>
                                        <option value="topSell">Top Sells</option>
                                        <option value="mostReview">Most Review</option>
                                        <option value="mostComment">Most Comment</option>
                                        <option value="topReview">Top Review</option>
                                    </select>

                                </div>
                                <div class="col-lg-3 mt-30">

                                    <label class="primary_input_label" for="publish">{{__('common.Status')}}</label>
                                    <select class="primary_select" name="publish" id="publish">
                                        <option data-display="{{__('common.Select')}} {{__('common.Status')}}"
                                                value="">{{__('common.Select')}} {{__('common.Status')}}</option>
                                        <option
                                            value="1" {{isset($category_publish)?$category_publish==1?'selected':'':''}}>{{__('courses.Publish')}} </option>
                                        <option
                                            value="0" {{isset($category_publish)?$category_publish==0?'selected':'':''}}>{{__('courses.Unpublished')}} </option>
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
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{$title??""}} {{__('courses.Course')}}
                                /{{__('quiz.Quiz')}} {{__('courses.List')}}</h3>
                            @if (permissionCheck('course.store'))
                                <ul class="d-flex">
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" data-toggle="modal"
                                           id="add_course_btn"
                                           data-target="#add_course" href="#"><i
                                                class="ti-plus"></i>{{__('common.Add')}} {{__('courses.Course')}}
                                            /{{__('quiz.Quiz')}}</a></li>
                                </ul>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col"> {{__('coupons.Type')}}</th>
                                        <th scope="col">{{__('courses.Course')}}
                                            /{{__('quiz.Quiz')}} {{__('coupons.Title')}}</th>
                                        <th scope="col">{{__('quiz.Category')}}</th>
                                        <th scope="col">{{__('quiz.Quiz')}}</th>
                                        <th scope="col">{{__('courses.Instructor')}}</th>
                                        <th scope="col">{{__('common.Status')}}</th>
                                        <th scope="col">{{__('courses.Lesson')}}</th>
                                        <th scope="col">{{__('courses.Enrolled')}}</th>

                                        <th scope="col">{{__('courses.Price')}}</th>
                                        <th scope="col">{{__('common.Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($courses as $key => $course)
                                        <tr>
                                            <td class="">
                                                <span class="m-2">
                                                    @if($course->type==1)
                                                        {{__('courses.Course')}}

                                                    @else
                                                        {{__('quiz.Quiz')}}
                                                    @endif

                                                </span>
                                            </td>
                                            <td>{{@$course->title}}</td>
                                            <td>{{@$course->category->name}}
                                                /<span> {{@$course->subCategory->name}}</span>
                                            </td>
                                            <td>{{@$course->quiz->title}} </td>
                                            <td>{{@$course->user->name}} </td>
                                            <td>
                                                <label class="switch_toggle" for="active_checkbox{{@$course->id }}">
                                                    <input type="checkbox" class="status_enable_disable"
                                                           id="active_checkbox{{@$course->id }}"
                                                           @if (@$course->status == 1) checked
                                                           @endif value="{{@$course->id }}">
                                                    <i class="slider round"></i>
                                                </label>

                                            </td>
                                            <td>{{@$course->lessons->count()}}</td>
                                            <td>{{@$course->enrolls->count()}}</td>

                                            <td>
                                                @if (@$course->discount_price!=null)
                                                    <span>{{@$getsmSetting->symbol}} {{@$course->discount_price * $getsmSetting->conversion_rate}} </span>
                                                @else
                                                    <span>{{@$getsmSetting->symbol}} {{@$course->price * $getsmSetting->conversion_rate}} </span>

                                                @endif
                                                @if (@$course->discount_price!=null)
                                                    <br>
                                                    <span
                                                        style="text-decoration: line-through"> {{@$getsmSetting->symbol}} {{@$course->price * $getsmSetting->conversion_rate}} </span>
                                                @endif

                                            </td>


                                            <td>
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{__('common.Action')}}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2">
                                                        <a target="_blank" href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}"
                                                           class="dropdown-item"
                                                        >{{__('courses.Frontend View')}}</a>

                                                        @if (permissionCheck('course.details'))
                                                            <a href="{{route('courseDetails',[@$course->id])}}"
                                                               class="dropdown-item"
                                                            >{{__('courses.Add Lesson')}}</a>

                                                        @endif

                                                        @if (permissionCheck('course.edit'))
                                                            <button data-toggle="modal"
                                                                    data-target="#editCourse{{@$course->id}}"
                                                                    class="dropdown-item"
                                                                    type="button">{{__('common.Edit')}}</button>
                                                        @endif

                                                        @if (permissionCheck('course.view'))
                                                            <a href="{{courseDetailsUrl(@$course->id,@$course->type,@$course->slug)}}"
                                                               class="dropdown-item"
                                                            >{{__('common.View')}}</a>
                                                        @endif
                                                    </div>
                                                </div>

                                            </td>


                                        </tr>


                                        <div class="modal fade admin-query" id="editCourse{{@$course->id}}">
                                            <div class="modal-dialog modal_1000px modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{__('common.Edit')}} {{__('quiz.Topic')}} </h4>
                                                        <button type="button" class="close " data-dismiss="modal">
                                                            <i class="ti-close "></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('AdminUpdateCourse')}}" method="POST"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-xl-6 ">
                                                                    <div class="primary_input mb-25">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label class="primary_input_label"
                                                                                       for="    "> {{__('courses.Type')}}</label>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <input type="radio"
                                                                                       class="common-radio type1"
                                                                                       id="type{{@$course->id}}1"
                                                                                       name="type"
                                                                                       value="1" {{@$course->type==1?"checked":""}}>
                                                                                <label
                                                                                    for="type{{@$course->id}}1">{{__('courses.Course')}}</label>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <input type="radio"
                                                                                       class="common-radio type2"
                                                                                       id="type{{@$course->id}}2"
                                                                                       name="type"
                                                                                       value="2" {{@$course->type==2?"checked":""}}>
                                                                                <label
                                                                                    for="type{{@$course->id}}2">{{__('quiz.Quiz')}}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-xl-6 dripCheck"
                                                                     @if($course->type!=1)style="display: none" @endif>
                                                                    <div class="primary_input mb-25">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label class="primary_input_label"
                                                                                       for="    "> {{__('common.Drip Content')}}</label>
                                                                            </div>

                                                                            <div class="col-md-6">

                                                                                <input type="radio"
                                                                                       class="common-radio drip0"
                                                                                       id="drip{{@$course->id}}0"
                                                                                       name="drip"
                                                                                       value="0" {{@$course->drip==0?"checked":""}}>
                                                                                <label
                                                                                    for="drip{{@$course->id}}0">{{__('common.No')}}</label>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <input type="radio"
                                                                                       class="common-radio drip1"
                                                                                       id="drip{{@$course->id}}1"
                                                                                       name="drip"
                                                                                       value="1" {{@$course->drip==1?"checked":""}}>
                                                                                <label
                                                                                    for="drip{{@$course->id}}1">{{__('common.Yes')}}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for="title">{{__('quiz.Topic')}} {{__('common.Title')}}
                                                                            *</label>
                                                                        <input class="primary_input_field" name="title"
                                                                               id="title"
                                                                               value="{{@$course->title}}"
                                                                               placeholder="-"
                                                                               type="text" {{$errors->has('title') ? 'autofocus' : ''}}>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="id" class="course_id"
                                                                   value="{{@$course->id}}">

                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-35">
                                                                        <label class="primary_input_label"
                                                                               for="about">{{__('courses.Course')}} {{__('courses.Requirements')}} </label>
                                                                        <textarea class="lms_summernote" name="requirements"

                                                                                  id="about" cols="30"
                                                                                  rows="10">{!!@$course->requirements!!}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-35">
                                                                        <label class="primary_input_label"
                                                                               for="about">{{__('courses.Course')}} {{__('courses.Description')}}</label>
                                                                        <textarea class="lms_summernote" name="about"

                                                                                  id="about" cols="30"
                                                                                  rows="10">{!!@$course->about!!}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-35">
                                                                        <label class="primary_input_label"
                                                                               for="about">{{__('courses.Course')}} {{__('courses.Outcomes')}}  </label>
                                                                        <textarea class="lms_summernote" name="outcomes"

                                                                                  id="about" cols="30"
                                                                                  rows="10">{!!@$course->outcomes!!}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">

                                                                <div class="col-xl-6 courseBox">
                                                                    <select class="primary_select edit_category_id"
                                                                            data-course_id="{{@$course->id}}"
                                                                            name="category"
                                                                            id="course" {{$errors->has('category') ? 'autofocus' : ''}}>
                                                                        <option
                                                                            data-display="{{__('common.Select')}} {{__('quiz.Category')}}"
                                                                            value="">{{__('common.Select')}} {{__('quiz.Category')}}
                                                                            *
                                                                        </option>
                                                                        @foreach($categories as $category)
                                                                            <option value="{{$category->id}}"
                                                                                    @if ($category->id==$course->category_id) selected @endif>{{@$category->name}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-xl-6 courseBox"
                                                                     id="edit_subCategoryDiv{{@$course->id}}">
                                                                    <select class="primary_select " name="sub_category"
                                                                            id="edit_subcategory_id{{@$course->id}}" {{$errors->has('sub_category') ? 'autofocus' : ''}}>
                                                                        <option
                                                                            data-display="{{__('common.Select')}} {{__('courses.Sub Category')}}"
                                                                            value="">{{__('common.Select')}} {{__('courses.Sub Category')}}

                                                                        </option>
                                                                        <option value="{{@$course->subcategory_id}}"
                                                                                selected>{{@$course->subCategory->name}}</option>
                                                                        @if(isset($course->category->subcategories))
                                                                            @foreach($course->category->subcategories as $sub)
                                                                                @if($course->subcategory_id !=$sub->id)
                                                                                    <option
                                                                                        value="{{@$sub->id}}"
                                                                                    >{{@$sub->name}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div class="col-xl-6 mt-30 quizBox"
                                                                     style="display: none">
                                                                    <select class="primary_select" name="quiz"
                                                                            id="quiz_id" {{$errors->has('quiz') ? 'autofocus' : ''}}>
                                                                        <option
                                                                            data-display="{{__('common.Select')}} {{__('quiz.Quiz')}}"
                                                                            value="">{{__('common.Select')}} {{__('quiz.Quiz')}}
                                                                            *
                                                                        </option>
                                                                        @foreach($quizzes as $quiz)
                                                                            <option value="{{$quiz->id}}"
                                                                                    @if($quiz->id==$course->quiz_id) selected @endif>{{@$quiz->title}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-xl-4 mt-30 makeResize">
                                                                    <select class="primary_select"
                                                                            name="level" {{$errors->has('level') ? 'autofocus' : ''}}>
                                                                        <option
                                                                            data-display="{{__('common.Select')}} {{__('courses.Level')}}"
                                                                            value="">{{__('common.Select')}} {{__('courses.Level')}}
                                                                            *
                                                                        </option>

                                                                        <option value="1"
                                                                                @if (@$course->level==1) selected @endif>
                                                                            {{__('courses.Beginner')}}
                                                                        </option>
                                                                        <option value="2"
                                                                                @if (@$course->level==2) selected @endif>
                                                                            {{__('courses.Intermediate')}}
                                                                        </option>
                                                                        <option value="3"
                                                                                @if (@$course->level==3) selected @endif>
                                                                            {{__('courses.Advance')}}
                                                                        </option>
                                                                        <option value="4"
                                                                                @if (@$course->level==4) selected @endif>
                                                                            {{__('courses.Pro')}}
                                                                        </option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-xl-4 mt-30 makeResize" id="">
                                                                    <select class="primary_select mb_30" name="language"
                                                                            id="" {{$errors->has('language') ? 'autofocus' : ''}}>
                                                                        <option
                                                                            data-display="{{__('common.Select')}} {{__('courses.Language')}}"
                                                                            value="">{{__('common.Select')}} {{__('courses.Language')}}
                                                                            *
                                                                        </option>

                                                                        @foreach ($languages as $language)
                                                                            <option value="{{$language->id}}"
                                                                                    @if ($language->id==$course->lang_id) selected @endif>{{$language->native}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-xl-4 makeResize">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for="">{{__('common.Duration')}}
                                                                            *</label>
                                                                        <input class="primary_input_field"
                                                                               name="duration" placeholder="-"
                                                                               value="{{@$course->duration}}"
                                                                               type="text" {{$errors->has('duration') ? 'autofocus' : ''}}>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row d-none">
                                                                <div class="col-lg-6">
                                                                    <div
                                                                        class="checkbox_wrap d-flex align-items-center">
                                                                        <label for="course_1" class="switch_toggle">
                                                                            <input type="checkbox" id="edit_course_1">
                                                                            <i class="slider round"></i>
                                                                        </label>
                                                                        <label>{{__('courses.This course is a top course')}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-20">
                                                                <div class="col-lg-6">
                                                                    <div
                                                                        class="checkbox_wrap d-flex align-items-center mt-40">
                                                                        <label for="edit_course_2{{$course->id}}"
                                                                               class="switch_toggle">
                                                                            <input type="checkbox" class="edit_course_2"
                                                                                   id="edit_course_2{{$course->id}}"
                                                                                   value="{{@$course->id}}">
                                                                            <i class="slider round"></i>
                                                                        </label>
                                                                        <label>{{__('courses.This course is a free course')}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4"
                                                                     id="edit_price_div{{@$course->id}}">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for="">{{__('courses.Price')}}</label>
                                                                        <input class="primary_input_field" name="price"
                                                                               placeholder="-"
                                                                               value="{{@$course->price}}" type="text">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-20 editDiscountDiv">
                                                                <div class="col-lg-6">
                                                                    <div
                                                                        class="checkbox_wrap d-flex align-items-center mt-40">
                                                                        <label for="edit_course_3{{$course->id}}"
                                                                               class="switch_toggle">
                                                                            <input type="checkbox" class="edit_course_3"
                                                                                   @if ($course->discount_price>0) checked
                                                                                   @endif
                                                                                   id="edit_course_3{{$course->id}}"
                                                                                   value="{{@$course->id}}">
                                                                            <i class="slider round"></i>
                                                                        </label>
                                                                        <label>{{__('courses.This course has discounted price')}}</label>
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    if ($course->discount_price>0){
                                                                        $d_price='block';
                                                                    }else{
                                                                            $d_price='none';
                                                                    }
                                                                @endphp
                                                                <div class="col-xl-4"
                                                                     id="edit_discount_price_div{{@$course->id}}"
                                                                     style="display:{{$d_price}} ">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for="">{{__('courses.Discount')}} {{__('courses.Price')}}</label>
                                                                        <input class="primary_input_field editDiscount"
                                                                               name="discount_price" id=""
                                                                               value="{{@$course->discount_price}}"
                                                                               placeholder="-" type="text">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-20 videoOption"
                                                                 style="display: {{@$course->type==2?'none':'block'}}">
                                                                <div class="col-xl-4 mt-25">
                                                                    <select class="primary_select category_id "
                                                                            name="host"
                                                                            {{$errors->has('host') ? 'autofocus' : ''}}
                                                                            id="">
                                                                        <option
                                                                            data-display="{{__('courses.Course overview host')}}"
                                                                            value="">{{__('courses.Course overview host')}}
                                                                            *
                                                                        </option>

                                                                        <option value="Youtube"
                                                                                @if ($course->host=='Youtube') selected @endif>
                                                                            {{__('courses.Youtube')}}
                                                                        </option>
                                                                        <option value="Vimeo"
                                                                                @if ($course->host=='Vimeo') selected @endif>
                                                                            {{__('courses.Vimeo')}}
                                                                        </option>
                                                                        @if(moduleStatusCheck("AmazonS3"))
                                                                            <option value="AmazonS3"
                                                                                    @if ($course->host=='AmazonS3') selected @endif>
                                                                                {{__('courses.Amazon S3')}}
                                                                            </option>
                                                                        @endif

                                                                        <option value="Self"
                                                                                @if ($course->host=='Self') selected @endif>
                                                                            {{__('courses.Self')}}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xl-8 ">
                                                                    <div class="input-effect videoUrl"
                                                                         style="display:@if((isset($course) && ($course->host!="Youtube")) || !isset($course)) none  @endif">
                                                                        <label>{{__('courses.Video URL')}}
                                                                            <span>*</span></label>
                                                                        <input
                                                                            id=""
                                                                            class="primary_input_field youtubeVideo name{{ $errors->has('trailer_link') ? ' is-invalid' : '' }}"
                                                                            type="text" name="trailer_link"
                                                                            placeholder="{{__('courses.Video URL')}}"
                                                                            autocomplete="off"
                                                                            {{$errors->has('trailer_link') ? 'autofocus' : ''}}
                                                                            value="{{isset($course) &&$course->host=="Youtube"? $course->trailer_link:''}}">
                                                                        <span class="focus-border"></span>
                                                                        @if ($errors->has('trailer_link'))
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $errors->first('trailer_link') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>

                                                                    <div class="row  vimeoUrl" id=""
                                                                         style="display: @if((isset($course) && ($course->host!="Vimeo")) || !isset($course)) none  @endif">
                                                                        <div class="col-lg-12" id="">
                                                                            <label class="primary_input_label"
                                                                                   for="">{{('courses.Vimeo Video')}}</label>
                                                                            <select class="primary_select vimeoVideo"
                                                                                    name="vimeo"
                                                                                    id="">
                                                                                <option
                                                                                    data-display="{{__('common.Select')}} video "
                                                                                    value="">{{__('common.Select')}}
                                                                                    {{('courses.Video')}}
                                                                                </option>
                                                                                @foreach ($video_list as $video)
                                                                                    @if(isset($course))
                                                                                        <option
                                                                                            value="{{@$video['uri']}}" {{$video['uri']==$course->trailer_link?'selected':''}}>{{@$video['name']}}</option>
                                                                                    @else
                                                                                        <option
                                                                                            value="{{@$video['uri']}}">{{@$video['name']}}</option>
                                                                                    @endif


                                                                                @endforeach
                                                                            </select>
                                                                            @if ($errors->has('vimeo'))
                                                                                <span
                                                                                    class="invalid-feedback invalid-select"
                                                                                    role="alert">
                                                                                    <strong>{{ $errors->first('vimeo') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="row  fileupload" id=""
                                                                         style="display: @if((isset($course) && (($course->host=="Vimeo") ||  ($course->host=="Youtube")) ) || !isset($course)) none  @endif">

                                                                        <div class="col-xl-12">
                                                                            <div class="primary_input">
                                                                                <label class="primary_input_label"
                                                                                       for="">{{__('courses.Video File')}}</label>
                                                                                <div class="primary_file_uploader">
                                                                                    <input
                                                                                        class="primary-input filePlaceholder"
                                                                                        type="text"
                                                                                        id=""
                                                                                        placeholder="{{__('courses.Browse Video file')}}"
                                                                                        readonly="">
                                                                                    <button class="" type="button">
                                                                                        <label
                                                                                            class="primary-btn small fix-gr-bg"
                                                                                            for="document_file_3_edit_{{@$course->id}}">{{__('common.Browse') }}</label>
                                                                                        <input type="file"
                                                                                               class="d-none fileUpload"
                                                                                               name="file"
                                                                                               id="document_file_3_edit_{{@$course->id}}">
                                                                                    </button>

                                                                                    @if ($errors->has('file'))
                                                                                        <span
                                                                                            class="invalid-feedback invalid-select"
                                                                                            role="alert">
                                                                                            <strong>{{ $errors->first('file') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-20">


                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-35">
                                                                        <label class="primary_input_label"
                                                                               for="">{{__('courses.Course Thumbnail')}}
                                                                            *</label>
                                                                        <div class="primary_file_uploader">
                                                                            <input class="primary-input filePlaceholder"
                                                                                   type="text"
                                                                                   id=""
                                                                                   value="{{showPicName(@$course->thumbnail)}}"
                                                                                   placeholder="{{__('courses.Browse Image file')}}"
                                                                                   readonly="" {{$errors->has('image') ? 'autofocus' : ''}}>
                                                                            <button class="" type="button">
                                                                                <label
                                                                                    class="primary-btn small fix-gr-bg"
                                                                                    for="document_file_1_edit_{{@$course->id}}">{{__('common.Browse')}}</label>
                                                                                <input type="file"
                                                                                       class="d-none fileUpload"
                                                                                       name="image"
                                                                                       id="document_file_1_edit_{{@$course->id}}">
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for="">{{__('courses.Meta keywords')}}</label>
                                                                        <input class="primary_input_field"
                                                                               name="meta_keywords"
                                                                               value="{{@$course->meta_keywords}}"
                                                                               placeholder="-" type="text">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for="">{{__('courses.Meta description')}}</label>
                                                                        <textarea id="my-textarea"
                                                                                  class="primary_input_field"
                                                                                  name="meta_description"
                                                                                  style="height: 200px"
                                                                                  rows="3">{!!@$course->meta_description!!}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 text-center pt_15">
                                                                <div class="d-flex justify-content-center">
                                                                    <button class="primary-btn semi_large2  fix-gr-bg"
                                                                            id="save_button_parent" type="submit"><i
                                                                            class="ti-check"></i> {{__('common.Update')}}  {{__('courses.Course')}}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
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
                {{-- @dd(Auth::user()) --}}
                <div class="modal fade admin-query" id="add_course">
                    <div class="modal-dialog modal_1000px modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{__('common.Add New')}} {{__('quiz.Topic')}}</h4>
                                <button type="button" class="close " data-dismiss="modal">
                                    <i class="ti-close "></i>
                                </button>
                            </div>
                            <input type="hidden" id="url" value="{{url('/')}}">
                            <div class="modal-body">
                                <form action="{{route('AdminSaveCourse')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6 ">
                                            <div class="primary_input mb-25">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label class="primary_input_label"
                                                               for=""> {{__('courses.Type')}} * </label>
                                                    </div>
                                                    <div class="col-md-6 ">

                                                        <input type="radio" class="common-radio" id="type1"
                                                               name="type"
                                                               value="1"
                                                               @if(empty(old('type')))checked @else {{old('type')==1?"checked":""}} @endif>
                                                        <label for="type1">{{__('courses.Course')}}</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="radio" class="common-radio" id="type2"
                                                               name="type"
                                                               value="2" {{old('type')==2?"checked":""}}>
                                                        <label for="type2">{{__('quiz.Quiz')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 " id="dripCheck">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label mt-1"
                                                       for=""> {{__('common.Drip Content')}}</label>
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <input type="radio" class="common-radio drip0"
                                                               id="drip0" name="drip"
                                                               value="0" checked>
                                                        <label
                                                            for="drip0">{{__('common.No')}}</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="radio" class="common-radio drip1"
                                                               id="drip1" name="drip"
                                                               value="1">
                                                        <label
                                                            for="drip1">{{__('common.Yes')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{__('quiz.Topic')}} {{__('common.Title')}} *</label>
                                                <input class="primary_input_field" name="title" placeholder="-"
                                                       id="addTitle"
                                                       type="text" {{$errors->has('title') ? 'autofocus' : ''}}
                                                       value="{{old('title')}}">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-35">
                                                <label class="primary_input_label"
                                                       for="">{{__('courses.Course')}} {{__('courses.Requirements')}}
                                                    </label>
                                                <textarea class="lms_summernote" name="requirements" id="addRequirements" cols="30"
                                                          rows="10">{{old('requirements')}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-35">
                                                <label class="primary_input_label"
                                                       for="">{{__('courses.Course')}} {{__('courses.Description')}}
                                                    </label>
                                                <textarea class="lms_summernote" name="about" id="addAbout" cols="30"
                                                          rows="10">{{old('about')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-35">
                                                <label class="primary_input_label"
                                                       for="">{{__('courses.Course')}} {{__('courses.Outcomes')}}
                                                 </label>
                                                <textarea class="lms_summernote" name="outcomes" id="addOutcomes" cols="30"
                                                          rows="10">{{old('outcomes')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 courseBox mb_30">
                                            <select class="primary_select category_id" name="category"
                                                    id="category_id" {{$errors->has('category') ? 'autofocus' : ''}}>
                                                <option data-display="{{__('common.Select')}} {{__('quiz.Category')}} *"
                                                        value="">{{__('common.Select')}} {{__('quiz.Category')}} </option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{@$category->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-6 courseBox" id="subCategoryDiv">
                                            <select class="primary_select" name="sub_category"
                                                    id="subcategory_id" {{$errors->has('sub_category') ? 'autofocus' : ''}}>
                                                <option
                                                    data-display="{{ __('common.Select') }} {{ __('courses.Sub Category') }}  "
                                                    value="">{{ __('common.Select') }} {{ __('courses.Sub Category') }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-xl-6 mt-30 quizBox" style="display: none">
                                            <select class="primary_select" name="quiz"
                                                    id="quiz_id" {{$errors->has('quiz') ? 'autofocus' : ''}}>
                                                <option data-display="{{__('common.Select')}} {{__('quiz.Quiz')}} *"
                                                        value="">{{__('common.Select')}} {{__('quiz.Quiz')}} </option>
                                                @foreach($quizzes as $quiz)
                                                    <option value="{{$quiz->id}}">{{@$quiz->title}} </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-xl-4 makeResize mt-30">
                                            <select class="primary_select" name="level">
                                                <option
                                                    data-display="{{ __('common.Select') }} {{ __('courses.Level') }} *"
                                                    value="">{{ __('common.Select') }} {{ __('courses.Level') }}
                                                </option>

                                                <option
                                                    value="1" {{old('level')==1?"selected":""}} >{{ __('courses.Beginner') }}</option>
                                                <option
                                                    value="2" {{old('level')==2?"selected":""}}>{{ __('courses.Intermediate') }}</option>
                                                <option
                                                    value="3" {{old('level')==3?"selected":""}}>{{ __('courses.Advance') }}</option>
                                                <option
                                                    value="4" {{old('level')==4?"selected":""}}>{{ __('courses.Pro') }}</option>

                                            </select>
                                        </div>
                                        <div class="col-xl-4 mt-30 makeResize" id="">
                                            <select class="primary_select mb-25" name="language"
                                                    id="" {{$errors->has('language') ? 'autofocus' : ''}}>
                                                <option
                                                    data-display="{{ __('common.Select') }} {{ __('common.Language') }} *"
                                                    value="">{{ __('common.Select') }} {{ __('common.Language') }}</option>
                                                @foreach ($languages as $language)
                                                    <option
                                                        value="{{$language->id}}" {{old('language')==$language->id?"selected":""}}>{{$language->native}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-4 makeResize" id="durationBox">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('common.Duration') }} *</label>
                                                <input class="primary_input_field" name="duration" placeholder="-"
                                                       id="addDuration"
                                                       type="text"
                                                       value="{{old('duration')}}" {{$errors->has('duration') ? 'autofocus' : ''}}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-none">
                                        <div class="col-lg-6">
                                            <div class="checkbox_wrap d-flex align-items-center">
                                                <label for="course_1" class="switch_toggle mr-2">
                                                    <input type="checkbox" id="course_1">
                                                    <i class="slider round"></i>
                                                </label>
                                                <label
                                                    class="mb-0">{{ __('courses.This course is a top course') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-lg-6">
                                            <div class="checkbox_wrap d-flex align-items-center mt-40">
                                                <label for="course_2" class="switch_toggle mr-2">
                                                    <input type="checkbox" id="course_2">
                                                    <i class="slider round"></i>
                                                </label>
                                                <label
                                                    class="mb-0">{{ __('courses.This course is a free course') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6" id="price_div">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('courses.Price') }}</label>
                                                <input class="primary_input_field" name="price" placeholder="-"
                                                       id="addPrice"
                                                       type="text" value="{{old('price')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20" id="discountDiv">
                                        <div class="col-lg-6">
                                            <div class="checkbox_wrap d-flex align-items-center mt-40">
                                                <label for="course_3" class="switch_toggle mr-2">
                                                    <input type="checkbox" id="course_3">
                                                    <i class="slider round"></i>
                                                </label>
                                                <label
                                                    class="mb-0">{{ __('courses.This course has discounted price') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-xl-4" id="discount_price_div" style="display: none">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{ __('courses.Discount') }} {{ __('courses.Price') }}</label>
                                                <input class="primary_input_field" name="discount_price" placeholder="-"
                                                       id="addDiscount"
                                                       type="text" value="{{old('discount_price')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-20 videoOption">
                                        <div class="col-xl-4 mt-25">
                                            <select class="primary_select category_id " name="host"
                                                    id="">
                                                <option
                                                    data-display="{{__('courses.Course overview host')}} *"
                                                    value="">{{__('courses.Course overview host')}}
                                                </option>

                                                <option value="Youtube">
                                                    {{__('courses.Youtube')}}
                                                </option>

                                                <option value="Vimeo">
                                                    {{__('courses.Vimeo')}}
                                                </option>
                                                @if(moduleStatusCheck("AmazonS3"))
                                                    <option value="AmazonS3">
                                                        {{__('courses.Amazon S3')}}
                                                    </option>
                                                @endif

                                                <option value="Self">
                                                    {{__('courses.Self')}}
                                                </option>


                                            </select>
                                        </div>
                                        <div class="col-xl-8 ">
                                            <div class="input-effect videoUrl"
                                                 style="display:@if((isset($course) && ($course->host!="Youtube")) || !isset($course)) none  @endif">
                                                <label>{{__('courses.Video URL')}}
                                                    <span>*</span></label>
                                                <input
                                                    id=""
                                                    class="primary_input_field youtubeVideo name{{ $errors->has('trailer_link') ? ' is-invalid' : '' }}"
                                                    type="text" name="trailer_link"
                                                    placeholder="{{__('courses.Video URL')}}"
                                                    autocomplete="off"
                                                    value="" {{$errors->has('trailer_link') ? 'autofocus' : ''}}>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('trailer_link'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('trailer_link') }}</strong>
                                            </span>
                                                @endif
                                            </div>

                                            <div class="row  vimeoUrl" id=""
                                                 style="display: @if((isset($course) && ($course->host!="Vimeo")) || !isset($course)) none  @endif">
                                                <div class="col-lg-12" id="">
                                                    <label class="primary_input_label"
                                                           for="">{{__('courses.Vimeo Video')}}</label>
                                                    <select class="primary_select vimeoVideo"
                                                            name="vimeo"
                                                            id="">
                                                        <option
                                                            data-display="{{__('common.Select')}} {{__('courses.Video')}}"
                                                            value="">{{__('common.Select')}} {{__('courses.Video')}}
                                                        </option>
                                                        @foreach ($video_list as $video)
                                                            @if(isset($course))
                                                                <option
                                                                    value="{{@$video['uri']}}" {{$video['uri']==$course->trailer_link?'selected':''}}>{{@$video['name']}}</option>
                                                            @else
                                                                <option
                                                                    value="{{@$video['uri']}}">{{@$video['name']}}</option>
                                                            @endif


                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('vimeo'))
                                                        <span
                                                            class="invalid-feedback invalid-select"
                                                            role="alert">
                                            <strong>{{ $errors->first('vimeo') }}</strong>
                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row  fileupload" id=""
                                                 style="display: @if((isset($course) && (($course->host=="Vimeo") ||  ($course->host=="Youtube")) ) || !isset($course)) none  @endif">

                                                <div class="col-xl-12">
                                                    <div class="primary_input">
                                                        <label class="primary_input_label"
                                                               for="">{{__('courses.Video File')}}</label>
                                                        <div class="primary_file_uploader">
                                                            <input class="primary-input filePlaceholder" type="text"
                                                                   id=" "
                                                                   placeholder="{{__('courses.Browse Video file')}}"
                                                                   readonly="">
                                                            <button class="" type="button">
                                                                <label
                                                                    class="primary-btn small fix-gr-bg"
                                                                    for="document_file_11">{{__('common.Browse') }}</label>
                                                                <input type="file" class="d-none fileUpload"
                                                                       name="file"
                                                                       id="document_file_11">
                                                            </button>

                                                            @if ($errors->has('file'))
                                                                <span
                                                                    class="invalid-feedback invalid-select"
                                                                    role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-20">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-35">
                                                <label class="primary_input_label"
                                                       for="">{{__('courses.Course Thumbnail') }} *</label>
                                                <div class="primary_file_uploader">
                                                    <input class="primary-input filePlaceholder" type="text"
                                                           id=""
                                                           {{$errors->has('image') ? 'autofocus' : ''}}
                                                           placeholder="{{__('courses.Browse Image file')}}"
                                                           readonly="">
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg"
                                                               for="document_file_2">{{__('common.Browse') }}</label>
                                                        <input type="file" class="d-none fileUpload" name="image"
                                                               id="document_file_2">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{__('courses.Meta keywords') }}</label>
                                                <input class="primary_input_field" name="meta_keywords" placeholder="-"
                                                       id="addMeta"
                                                       type="text" value="{{old('meta_keywords')}}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label"
                                                       for="">{{__('courses.Meta description') }}</label>
                                                <textarea id="my-textarea" class="primary_input_field" id
                                                          name="meta_description" style="height: 200px"
                                                          rows="3">{{old('meta_keywords')}}</textarea>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-12 text-center pt_15">
                                        <div class="d-flex justify-content-center">
                                            <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent"
                                                    type="submit"><i
                                                    class="ti-check"></i> {{__('common.Add') }} {{__('courses.Course') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

@endsection
@push('scripts')
    @if ($errors->any())
        <script>
            @if(Session::has('type'))
            @if(Session::get('type')=="store")
            $('#add_course').modal('show');
            @else
            let id = '{{Session::get('id')}}';
            $('#editCourse' + id).modal('show');
            @endif
            @endif
        </script>
    @endif
    <script src="{{asset('/')}}/Modules/CourseSetting/Resources/assets/js/course.js"></script>
@endpush
