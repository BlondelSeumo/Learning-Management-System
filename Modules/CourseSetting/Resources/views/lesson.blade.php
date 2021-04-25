@extends('backend.master')
@section('mainContent')
    @include("backend.partials.alertMessage")

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> {{__('courses.Lesson')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('courses.Course')}}</a>
                    <a class="active" href="{{route('coupons.manage')}}"> {{__('courses.Lesson')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <h2> {{__('courses.Chapter')}} {{__('common.Name')}} :  {{@$chapter->title}} </h2>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($lesson))
                                   {{__('common.Edit')}}
                                @else
                                   {{__('common.Add')}}
                                @endif
                               {{__('courses.Lesson')}}
                            </h3>
                        </div>
                        @if(isset($lesson))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'updateLesson', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        @else

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'addLesson',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

                        @endif
                        <input type="hidden" id="url" value="{{url('/')}}">
                        <div class="white-box">
                            <div class="add-visitor">
                                <input type="hidden" name="course_id" value="{{$chapter->course_id}}">
                                <input type="hidden" name="chapter_id" value="{{$chapter->id}}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <label>{{__('courses.Lesson')}} {{__('common.Name')}} <span>*</span></label>
                                            <input class="primary_input_field name{{ $errors->has('chapter_name') ? ' is-invalid' : '' }}"
                                                type="text" name="name" placeholder="{{__('courses.Lesson')}} {{__('common.Name')}}" autocomplete="off" value="{{isset($lesson)? $lesson->name:''}}">
                                            <input type="hidden" name="id" value="{{isset($lesson)? $lesson->id: ''}}">
                                            <span class="focus-border"></span>
                                            @if ($errors->has('chapter_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('chapter_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="input-effect">
                                            <label>{{__('courses.Duration')}} <span>*</span></label>
                                            <input class="primary_input_field name{{ $errors->has('chapter_name') ? ' is-invalid' : '' }}"
                                                type="text" name="duration" placeholder="{{__('courses.Duration')}}" autocomplete="off" value="{{isset($lesson)? $lesson->duration:''}}">

                                            <span class="focus-border"></span>
                                            @if ($errors->has('chapter_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('chapter_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                         <label class="primary_input_label" for=""> {{__('courses.Host')}}</label>
                                         <select class="primary_select" name="host" id="category_id">
                                                    <option data-display="{{__('common.Select')}} {{__('courses.Host')}}" value="">{{__('common.Select')}} {{__('courses.Host')}} </option>
                                                                <option value="Youtube" @if (@$lesson->host=='Youtube') Selected @endif >Youtube</option>
                                                                    <option value="Self" @if (@$lesson->host=='Self') Selected @endif>Self</option>
                                                                    <option value="Vimeo" @if (@$lesson->host=='Vimeo') Selected @endif>Vimeo</option>
                                                                    <option value="Dailmotion" @if (@$lesson->host=='Dailmotion') Selected @endif>Dailmotion</option>
                                            </select>
                                        @if ($errors->has('category'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                 <div class="input-effect">
                                            <label>{{__('courses.Video URL')}} <span>*</span></label>
                                            <input class="primary_input_field name{{ $errors->has('video_url') ? ' is-invalid' : '' }}"
                                                type="text" name="video_url" placeholder="{{__('courses.Video URL')}}" autocomplete="off" value="{{isset($lesson)? $lesson->video_url:''}}">
                                            <span class="focus-border"></span>
                                            @if ($errors->has('video_url'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('video_url') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12" id="">
                                         <label class="primary_input_label" for="">{{__('courses.Privacy')}}</label>
                                        <select class="primary_select" name="is_lock">
                                                    <option data-display="{{__('common.Select')}} {{__('courses.Privacy')}} " value="">{{__('common.Select')}} {{__('courses.Privacy')}} </option>
                                                   <option value="1" @if (@$lesson->is_lock==1) selected @endif >{{__('courses.Locked')}}</option>
                                                    <option value="0" @if (@$lesson->is_lock==0) selected @endif >{{__('courses.Unlock')}}</option>
                                            </select>
                                        @if ($errors->has('is_lock'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('is_lock') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                        <div class="input-effect">
                                            <label>{{__('common.Description')}} <span>*</span></label>
                                            <input class="primary_input_field name{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                type="text" name="description" placeholder="{{__('common.Description')}}" autocomplete="off" value="{{isset($lesson)? $lesson->description:''}}">
                                            <span class="focus-border"></span>
                                            @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
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
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="{{$tooltip}}">
                                            <span class="ti-check"></span>
                                            @if(isset($lesson))
                                               {{__('common.Update')}}
                                            @else
                                                 {{__('common.Save')}}
                                            @endif
                                           {{__('courses.Lesson')}}
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
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-20">{{__('courses.Lesson List')}}</h3>
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
                                        <th scope="col">{{ __('common.Name') }}</th>
                                        <th scope="col">{{ __('courses.Duration') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lessons as $key => $lesson)
                                            <tr>
                                                <th>{{ $key+1 }}</th>
                                              <td>{{@$lesson->name }}</td>
                                              <td>{{@$lesson->duration }}</td>
                                                <td>
                                                   <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenu2" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            {{ __('common.Select') }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                            <a  class="dropdown-item edit_brand" href="{{route('editLesson',$lesson->id)}}">{{__('common.Edit')}}</a>
                                                           <a class="dropdown-item" data-toggle="modal" data-target="#deleteQuestionGroupModal{{$lesson->id}}"
                                                    href="#">{{__('common.Delete')}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                          <div class="modal fade admin-query" id="deleteQuestionGroupModal{{$lesson->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{__('common.Delete')}} {{__('courses.Lesson')}}</h4>
                                                <button type="button" class="close" data-dismiss="modal"> <i class="ti-close "></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4> {{__('common.Are you sure to delete ?')}}</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                     {{ Form::open(['route' => 'deleteLesson', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                                     <input type="hidden" name="id" value="{{@$lesson->id}}">
                                                    <button class="primary-btn fix-gr-bg" type="submit">{{__('common.Delete')}}</button>
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

{{-- @include('coupons::create') --}}
@include('backend.partials.delete_modal')
@endsection

@push('scripts')
    <script src="{{asset('/')}}/Modules/CourseSetting/Resources/assets/js/course.js"></script>
    <script src="{{asset('/')}}/Modules/CourseSetting/Resources/assets/js/advance_search.js"></script>
@endpush
