@extends('backend.master')
@section('mainContent')


    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('courses.Course')}} </h1>
                <div class="bc-pages">
                    <a href="{{url('/dashboard')}}">{{__('common.Dashboard')}} </a>
                    <a href="#">{{__('courses.Course')}} </a>
                    <a href="#">{{__('courses.Course')}} {{__('common.Details')}} </a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area student-details">
        <div class="container-fluid p-0">
            <div class="row">
                @if($course->type==1)
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h3 class="">
                                        @if(isset($editChapter) || isset($editLesson))
                                            {{__('common.Edit')}}
                                        @else
                                            {{__('common.Add')}}
                                        @endif

                                    </h3>
                                </div>
                                @if(isset($editChapter) || isset($editLesson))
                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'updateChapter', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                                @else
                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'saveChapter',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                @endif

                                <input type="hidden" id="url" value="{{url('/')}}">
                                <input type="hidden" name="course_id" value="{{@$course->id}}">
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
                                                <div class="row mt-0">
                                                    <div class="col-lg-12" id="CourseDiv">

                                                        <label class="primary_input_label mt-1"
                                                               for="">{{__('courses.Add Chapter / Lesson')}} </label>
                                                        <select
                                                            class="primary_select{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                                                            id="select_input_type" name="input_type">
                                                            <option data-display=" {{__('quiz.Course')}}"
                                                                    value=""> {{__('quiz.Course')}} *
                                                            </option>

                                                            <option value="1"
                                                                    @if (isset($editChapter)) selected @endif >{{__('quiz.Chapter')}}</option>
                                                            <option value="0"
                                                                    @if (isset($editLesson)&& $editLesson->is_quiz==0) selected @endif>{{__('courses.Lesson')}}</option>
                                                            <option value="2"
                                                                    @if (isset($editLesson)&& $editLesson->is_quiz==1) selected @endif>{{__('quiz.Quiz')}}</option>

                                                        </select>
                                                        @if ($errors->has('input_type'))
                                                            <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('input_type') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                @php
                                                    if(isset($editChapter)){
                                                            $show_chapter='block';
                                                    }else{
                                                            $show_chapter='none';
                                                    }
                                                @endphp
                                                <div class="chapter_div" style="display:{{$show_chapter}}">

                                                    <div class="input-effect mt-2 pt-1">
                                                        <label>{{__('quiz.Chapter')}} {{__('common.Name')}}
                                                            <span>*</span></label>
                                                        <input
                                                            class="primary_input_field name{{ $errors->has('chapter_name') ? ' is-invalid' : '' }}"
                                                            type="text" name="chapter_name" placeholder="Title"
                                                            autocomplete="off"
                                                            value="{{isset($editChapter)? $editChapter->name:''}}">
                                                        <input type="hidden" name="chapter"
                                                               value="{{isset($editChapter)? $editChapter->id: ''}}">
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('chapter_name'))
                                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('chapter_name') }}</strong>
                                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @php
                                                    if(isset($editLesson) && $editLesson->is_quiz==1){
                                                            $show_quiz='block';
                                                    }else{
                                                            $show_quiz='none';
                                                    }
                                                @endphp
                                                <div class="quiz_div" style="display:{{@$show_quiz}}">
                                                    <input type="hidden" name="is_quiz" value="1">
                                                    <div class="row ">
                                                        <div class="col-lg-12 ">
                                                            <label class="primary_input_label mt-3"
                                                                   for=""> {{__('courses.Chapter')}}
                                                                <span>*</span></label>
                                                            <select class="primary_select " name="chapterId">
                                                                <option
                                                                    data-display="{{__('common.Select')}} {{__('courses.Chapter')}}"
                                                                    value="">{{__('common.Select')}} {{__('courses.Chapter')}} </option>
                                                                @foreach ($chapters as $chapter)
                                                                    <option
                                                                        value="{{@$chapter->id}}" {{isset($editLesson)? ($editLesson->chapter_id == $chapter->id? 'selected':''):''}} >{{@$chapter->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('category'))
                                                                <span class="invalid-feedback invalid-select"
                                                                      role="alert">
                                                    <strong>{{ $errors->first('category') }}</strong>
                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="input-effect mt-2 pt-1">
                                                        <label class="primary_input_label mt-1"
                                                               for=""> {{__('quiz.Quiz')}} <span>*</span></label>
                                                        <select class="primary_select" name="quiz">
                                                            <option
                                                                data-display="{{__('common.Select')}} {{__('quiz.Quiz')}}"
                                                                value="">{{__('common.Select')}} {{__('quiz.Quiz')}} </option>
                                                            @foreach ($quizzes as $quiz)
                                                                <option
                                                                    value="{{@$quiz->id}}" {{isset($editLesson)? ($editLesson->quiz_id == $quiz->id? 'selected':''):''}} >{{@$quiz->title}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('category'))
                                                            <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('category') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>
                                                    <div class="input-effect mt-2 pt-1">
                                                        <div class=" " id="">
                                                            <label class="primary_input_label "
                                                                   for="">{{__('courses.Privacy')}}
                                                                <span>*</span></label>
                                                            <select class="primary_select" name="lock">
                                                                <option
                                                                    data-display="{{__('common.Select')}} {{__('courses.Privacy')}} "
                                                                    value="">{{__('common.Select')}} {{__('courses.Privacy')}} </option>

                                                                <option value="0"
                                                                        @if (@$editLesson->is_lock==0) selected @endif >{{__('courses.Unlock')}}</option>

                                                                <option value="1"
                                                                        @if (@$editLesson->is_lock==1) selected @endif >{{__('courses.Locked')}}</option>
                                                            </select>
                                                            @if ($errors->has('is_lock'))
                                                                <span class="invalid-feedback invalid-select"
                                                                      role="alert">
                                                        <strong>{{ $errors->first('is_lock') }}</strong>
                                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    if(isset($editLesson) && $editLesson->is_quiz!=1){
                                                            $show_lesson='block';
                                                    }else{
                                                            $show_lesson='none';
                                                    }
                                                @endphp
                                                <div class="lesson_div" style="display: {{$show_lesson}}">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label class="primary_input_label mt-1"
                                                                   for=""> {{__('courses.Chapter')}}
                                                                <span>*</span></label>
                                                            <select class="primary_select" name="chapter_id">
                                                                <option
                                                                    data-display="{{__('common.Select')}} {{__('courses.Chapter')}}"
                                                                    value="">{{__('common.Select')}} {{__('courses.Chapter')}} </option>
                                                                @foreach ($chapters as $chapter)
                                                                    <option
                                                                        value="{{@$chapter->id}}" {{isset($editLesson)? ($editLesson->chapter_id == $chapter->id? 'selected':''):''}} >{{@$chapter->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('category'))
                                                                <span class="invalid-feedback invalid-select"
                                                                      role="alert">
                                                    <strong>{{ $errors->first('category') }}</strong>
                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="input-effect mt-2 pt-1">
                                                                <label>{{__('courses.Lesson')}} {{__('common.Name')}}
                                                                    <span>*</span></label>
                                                                <input
                                                                    class="primary_input_field name{{ $errors->has('chapter_name') ? ' is-invalid' : '' }}"
                                                                    type="text" name="name"
                                                                    placeholder="{{__('courses.Lesson')}} {{__('common.Name')}}"
                                                                    autocomplete="off"
                                                                    value="{{isset($editLesson)? $editLesson->name:''}}">
                                                                <input type="hidden" name="lesson_id"
                                                                       value="{{isset($editLesson)? $editLesson->id: ''}}">
                                                                <span class="focus-border"></span>
                                                                @if ($errors->has('chapter_name'))
                                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('chapter_name') }}</strong>
                                            </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">

                                                            <div class="input-effect mt-2 pt-1">
                                                                <label>{{__('courses.Duration')}} </label>
                                                                <input
                                                                    class="primary_input_field name{{ $errors->has('chapter_name') ? ' is-invalid' : '' }}"
                                                                    type="text" name="duration"
                                                                    placeholder="{{__('courses.Duration')}}"
                                                                    autocomplete="off"
                                                                    value="{{isset($editLesson)? $editLesson->duration:''}}">

                                                                <span class="focus-border"></span>
                                                                @if ($errors->has('chapter_name'))
                                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('chapter_name') }}</strong>
                                            </span>
                                                                @endif
                                                            </div>
                                                            <div class="input-effect mt-2 pt-1">
                                                                <label class="primary_input_label mt-1"
                                                                       for=""> {{__('courses.Host')}}
                                                                    <span>*</span></label>


                                                                <select class="primary_select" name="host"
                                                                        id="category_id">
                                                                    <option
                                                                        data-display="{{__('common.Select')}} {{__('courses.Host')}}"
                                                                        value="">{{__('common.Select')}} {{__('courses.Host')}} </option>
                                                                    <option value="Youtube"
                                                                            @if (@$editLesson->host=='Youtube') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$course->host=="Youtube") selected @endif
                                                                    >
                                                                        Youtube
                                                                    </option>

                                                                    <option value="Vimeo"
                                                                            @if (@$editLesson->host=='Vimeo') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$course->host=="Vimeo") selected @endif
                                                                    >
                                                                        Vimeo
                                                                    </option>
                                                                    <option value="Self"
                                                                            @if (@$editLesson->host=='Self') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$course->host=="Self") selected @endif
                                                                    >
                                                                        Self
                                                                    </option>

                                                                    <option value="URL"
                                                                            @if (@$editLesson->host=='URL') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$editLesson->host=="URL") selected @endif >
                                                                        Video URL
                                                                    </option>

                                                                    <option value="Iframe"
                                                                            @if (@$editLesson->host=='Iframe') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$editLesson->host=="Iframe") selected @endif >
                                                                        Iframe embed
                                                                    </option>

                                                                    <option value="Image"
                                                                            @if (@$editLesson->host=='Image') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$editLesson->host=="Image") selected @endif >
                                                                        Image
                                                                    </option>

                                                                    <option value="PDF"
                                                                            @if (@$editLesson->host=='PDF') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$editLesson->host=="PDF") selected @endif >
                                                                        PDF File
                                                                    </option>

                                                                    <option value="Word"
                                                                            @if (@$editLesson->host=='Word') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$editLesson->host=="Word") selected @endif >
                                                                        Word File
                                                                    </option>


                                                                    <option value="Excel"
                                                                            @if (@$editLesson->host=='Excel') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$editLesson->host=="Excel") selected @endif >
                                                                        Excel File
                                                                    </option>

                                                                    <option value="PowerPoint"
                                                                            @if (@$editLesson->host=='PowerPoint') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$editLesson->host=="PowerPoint") selected @endif >
                                                                        Power Point File
                                                                    </option>


                                                                    <option value="Text"
                                                                            @if (@$editLesson->host=='Text') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$editLesson->host=="Text") selected @endif >
                                                                        Text File
                                                                    </option>


                                                                    <option value="Zip"
                                                                            @if (@$editLesson->host=='Zip') Selected
                                                                            @endif
                                                                            @if(empty(@$editLesson) && @$editLesson->host=="Zip") selected @endif >
                                                                        Zip File
                                                                    </option>


                                                                    @if(moduleStatusCheck("AmazonS3"))
                                                                        <option value="AmazonS3"
                                                                                @if (@$editLesson->host=='AmazonS3') Selected
                                                                                @endif
                                                                                @if(empty(@$editLesson) && @$course->host=="AmazonS3") selected @endif
                                                                        >
                                                                            Amazon S3
                                                                        </option>
                                                                    @endif

                                                                    @if(moduleStatusCheck("SCORM"))
                                                                        <option value="SCORM"

                                                                                @if(empty(@$editLesson) && @$course->host=="SCORM") selected @endif
                                                                        >
                                                                            SCORM Self
                                                                        </option>
                                                                    @endif

                                                                    @if(moduleStatusCheck("AmazonS3") && moduleStatusCheck("SCORM"))
                                                                        <option value="SCORM-AwsS3"
                                                                                @if(empty(@$editLesson) && @$course->host=="SCORM-AwsS3") selected @endif
                                                                        >
                                                                            SCORM AWS S3
                                                                        </option>
                                                                    @endif
                                                                </select>
                                                                @if ($errors->has('category'))
                                                                    <span class="invalid-feedback invalid-select"
                                                                          role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                                                @endif
                                                            </div>
                                                            <div class="input-effect mt-2 pt-1" id="videoUrl"
                                                                 style="display:@if((isset($editLesson) && ($editLesson->host!="Youtube"  && $editLesson->host!="URL")) || !isset($editLesson)) none  @endif">
                                                                <label>{{__('courses.Video URL')}}
                                                                    <span>*</span></label>
                                                                <input
                                                                    id="youtubeVideo"
                                                                    class="primary_input_field name{{ $errors->has('video_url') ? ' is-invalid' : '' }}"
                                                                    type="text" name="video_url"
                                                                    placeholder="{{__('courses.Video URL')}}"
                                                                    autocomplete="off"
                                                                    value="@if(isset($editLesson)) @if($editLesson->host=="Youtube" || $editLesson->host=="URL"){{$editLesson->video_url}} @endif @endif">
                                                                <span class="focus-border"></span>
                                                                @if ($errors->has('video_url'))
                                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('video_url') }}</strong>
                                            </span>
                                                                @endif
                                                            </div>

                                                            <div class="input-effect mt-2 pt-1" id="iframeBox"
                                                                 style="display: @if((isset($editLesson) && ($editLesson->host!="Iframe")) || !isset($editLesson)) none  @endif">
                                                                <div class="" id="">

                                                                    <label>{{__('courses.Iframe URL')}}
                                                                        <span>*</span></label>
                                                                    <input
                                                                        class="primary_input_field name{{ $errors->has('iframe_url') ? ' is-invalid' : '' }}"
                                                                        type="text" name="iframe_url"
                                                                        placeholder="{{__('courses.Iframe (Provide the source only)')}}"
                                                                        autocomplete="off"
                                                                        value="@if(isset($editLesson)) @if($editLesson->host=="Iframe"){{$editLesson->iframe_url}} @endif @endif">
                                                                    <span class="focus-border"></span>
                                                                    @if ($errors->has('iframe_url'))
                                                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('iframe_url') }}</strong>
                                            </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="input-effect mt-2 pt-1" id="vimeoUrl"
                                                                 style="display: @if((isset($editLesson) && ($editLesson->host!="Vimeo")) || !isset($editLesson)) none  @endif">
                                                                <div class="" id="">

                                                                    <select class="primary_select" name="vimeo"
                                                                            id="vimeoVideo">
                                                                        <option
                                                                            data-display="{{__('common.Select')}} video "
                                                                            value="">{{__('common.Select')}} video
                                                                        </option>
                                                                        @foreach ($video_list as $video)
                                                                            @if(isset($editLesson))
                                                                                <option
                                                                                    value="{{@$video['uri']}}" {{$video['uri']==$editLesson->video_url?'selected':''}}>{{@$video['name']}}</option>
                                                                            @else
                                                                                <option
                                                                                    value="{{@$video['uri']}}">{{@$video['name']}}</option>
                                                                            @endif


                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('vimeo'))
                                                                        <span class="invalid-feedback invalid-select"
                                                                              role="alert">
                                            <strong>{{ $errors->first('vimeo') }}</strong>
                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            {{--                                                            SCORM--}}
                                                            <div class="input-effect mt-2 pt-1" id="fileupload"
                                                                 style="display: @if((isset($editLesson) && (($editLesson->host=="Vimeo") ||  ($editLesson->host=="Youtube")||  ($editLesson->host=="URL")) ) || !isset($editLesson)) none  @endif">


                                                                <div class="primary_input">
                                                                    <label class="primary_input_label mt-1"
                                                                           for=""></label>
                                                                    <div class="primary_file_uploader">
                                                                        <input class="primary-input filePlaceholder"
                                                                               type="text"
                                                                               id=""
                                                                               placeholder="{{__('common.Browse file')}}"
                                                                               readonly="">
                                                                        <button class="" type="button">
                                                                            <label
                                                                                class="primary-btn small fix-gr-bg"
                                                                                for="1_document_file_11">{{__('common.Browse') }}</label>
                                                                            <input type="file" class="d-none fileUpload"
                                                                                   name="file"
                                                                                   id="1_document_file_11">
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
                                                            <div class="input-effect mt-2 pt-1">
                                                                <div class="" id="">
                                                                    <label class="primary_input_label mt-1"
                                                                           for="">{{__('courses.Privacy')}}
                                                                        <span>*</span> </label>
                                                                    <select class="primary_select" name="is_lock">
                                                                        <option
                                                                            data-display="{{__('common.Select')}} {{__('courses.Privacy')}} "
                                                                            value="">{{__('common.Select')}} {{__('courses.Privacy')}} </option>
                                                                        @if(isset($editLesson))
                                                                            <option value="0"
                                                                                    @if ( @$editLesson->is_lock==0) selected @endif >{{__('courses.Unlock')}}</option>
                                                                            <option value="1"
                                                                                    @if (@$editLesson->is_lock==1) selected @endif >{{__('courses.Locked')}}</option>
                                                                        @else
                                                                            <option
                                                                                value="0">{{__('courses.Unlock')}}</option>
                                                                            <option value="1"
                                                                                    selected>{{__('courses.Locked')}}</option>
                                                                        @endif


                                                                    </select>
                                                                    @if ($errors->has('is_lock'))
                                                                        <span class="invalid-feedback invalid-select"
                                                                              role="alert">
                                            <strong>{{ $errors->first('is_lock') }}</strong>
                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="input-effect mt-2 pt-1">
                                                                <label>{{__('common.Description')}}
                                                                </label>
                                                                <input
                                                                    class="primary_input_field name{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                                    type="text" name="description"
                                                                    placeholder="{{__('common.Description')}}"
                                                                    autocomplete="off"
                                                                    value="{{isset($editLesson)? $editLesson->description:''}}">
                                                                <span class="focus-border"></span>
                                                                @if ($errors->has('description'))
                                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" class="primary-btn fix-gr-bg"
                                                        data-toggle="tooltip">
                                                    <span class="ti-check"></span>
                                                    {{__('common.Save')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="@if($course->type==1)col-md-8 @else col-md-12  @endif ">
                    <div class="main-title">
                        <h3 class="">

                            {{__('courses.Course')}}
                        </h3>
                    </div>

                    @if(Session::has('type'))
                        @php
                            $type=Session::get('type');
                        @endphp
                    @else
                        @php
                            if($course->type==1){
                                    $type ='courses';

}else{
                                    $type ='courseDetails';

}
                        @endphp
                    @endif
                    <div class="row pt-0">
                        <ul class="nav nav-tabs no-bottom-border  mt-sm-md-20 mb-10 ml-3" role="tablist">
                            @if($course->type==1)
                                <li class="nav-item">
                                    <a class="nav-link @if($type=="courses") active @endif" href="#group_email_sms"
                                       role="tab"
                                       data-toggle="tab">{{__('courses.Course')}} {{__('common.Name')}}  </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link  @if($type=="courseDetails") active @endif "
                                       href="#indivitual_email_sms" role="tab"
                                       data-toggle="tab">{{__('courses.Course')}} {{__('common.Details')}}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link  @if($type=="files") active @endif" href="#file_list" role="tab"
                                       data-toggle="tab">{{__('courses.Exercise')}} {{__('common.Files')}}</a>
                                </li>
                                @if($course->drip==1)
                                    <li class="nav-item">
                                        <a class="nav-link @if($type=="drip") active @endif" href="#drip" role="tab"
                                           data-toggle="tab"> {{__('common.Drip Content')}}</a>
                                    </li>
                                @endif
                            @endif

                        </ul>
                    </div>
                    <div class="white_box_30px">
                        <div class="row  mt_0_sm">

                            <!-- Start Sms Details -->
                            <div class="col-lg-12">


                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <input type="hidden" name="selectTab" id="selectTab">
                                    <div role="tabpanel"
                                         class="tab-pane fade  @if( ($type=="courses")) show active  @endif "
                                         id="group_email_sms">

                                        <div class="QA_section QA_section_heading_custom check_box_table   ">
                                            <div class="QA_table ">
                                                <!-- table-responsive -->


                                                @if(count($chapters)==0)
                                                    <div class="text-center">
                                                        {{__('courses.No Data Found')}}
                                                    </div>

                                                @endif

                                                <div class="nastable">
                                                    @foreach($chapters as $chapter)

                                                        <div class="parent" data-id="{{$chapter->id}}">
                                                            <div class="table_capter_list">
                                                                <div
                                                                    class="single_capter_list d-flex align-items-center justify-content-between flex-wrap mt-10">
                                                                    <h4>{{@$chapter->name}}</h4>

                                                                    <div class="dropdown CRM_dropdown">
                                                                        <button
                                                                            class="btn btn-secondary dropdown-toggle"
                                                                            type="button" id="dropdownMenu2"
                                                                            data-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                            {{__('common.Action')}}
                                                                        </button>
                                                                        <div
                                                                            class="dropdown-menu dropdown-menu-right">
                                                                            <a href="{{route('editChapter',[$chapter->id,$chapter->course_id])}}"
                                                                               class="dropdown-item">{{__('common.Edit')}} {{__('courses.Chapter')}}</a>
                                                                            <a href="#" data-toggle="modal"
                                                                               data-target="#deleteChapter{{@$chapter->id}}"
                                                                               class="dropdown-item"
                                                                               type="button">{{__('common.Delete')}} {{__('courses.Chapter')}}</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="nastable2">
                                                                    @foreach ($chapter->lessons as $key => $lesson)

                                                                        <div class="child" data-id="{{$lesson->id}}">
                                                                            <div
                                                                                class="single_capter_list d-flex align-items-center justify-content-between flex-wrap mt-10">
                                                                                @if ($lesson->is_quiz==1)
                                                                                    @foreach ($lesson->quiz as $quiz)

                                                                                        <span> <i
                                                                                                class="ti-check-box"></i>   {{$key+1}}. {{@$quiz->title}} </span>
                                                                                    @endforeach
                                                                                @else

                                                                                    <span> <i
                                                                                            class="ti-control-play"></i>  {{$key+1}}. {{$lesson['name']}} [{{$lesson['duration']}}] [{{$lesson->is_lock==0?'unlock':'Lock'}}]</span>
                                                                                @endif

                                                                                <div class="dropdown CRM_dropdown">
                                                                                    <button
                                                                                        class="btn btn-secondary dropdown-toggle"
                                                                                        type="button" id="dropdownMenu2"
                                                                                        data-toggle="dropdown"
                                                                                        aria-haspopup="true"
                                                                                        aria-expanded="false">
                                                                                        {{__('common.Action')}}
                                                                                    </button>
                                                                                    <div
                                                                                        class="dropdown-menu dropdown-menu-right">
                                                                                        <a target="_blank" href="{{route('fullScreenView',[$course->id,$lesson->id])}}"
                                                                                           class="dropdown-item">{{__('common.View')}}</a>
                                                                                        <a href="{{route('editLesson',[$lesson->id])}}"
                                                                                           class="dropdown-item">{{__('common.Edit')}}</a>
                                                                                        <a href="#" data-toggle="modal"
                                                                                           data-target="#deleteLesson{{@$lesson->id}}"
                                                                                           class="dropdown-item"
                                                                                           type="button">{{__('common.Delete')}}</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="modal fade admin-query"
                                                                                 id="deleteLesson{{$lesson->id}}">
                                                                                <div
                                                                                    class="modal-dialog modal-dialog-centered">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h4 class="modal-title">{{__('common.Delete')}}  {{__('courses.Lesson')}}</h4>
                                                                                            <button type="button"
                                                                                                    class="close"
                                                                                                    data-dismiss="modal">
                                                                                                <i
                                                                                                    class="ti-close "></i>
                                                                                            </button>
                                                                                        </div>

                                                                                        <div class="modal-body">
                                                                                            <div class="text-center">
                                                                                                <h4> {{__('common.Are you sure to delete ?')}}</h4>
                                                                                            </div>

                                                                                            <div
                                                                                                class="mt-40 d-flex justify-content-between">
                                                                                                <button type="button"
                                                                                                        class="primary-btn tr-bg"
                                                                                                        data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                                                                <form
                                                                                                    action="{{route('deleteLesson')}}"
                                                                                                    method="post">
                                                                                                    @csrf
                                                                                                    <input type="hidden"
                                                                                                           name="id"
                                                                                                           value="{{$lesson->id}}">
                                                                                                    <button
                                                                                                        class="primary-btn fix-gr-bg"
                                                                                                        type="submit">{{__('common.Delete')}}</button>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    @endforeach
                                                                </div>
                                                            </div>


                                                            <div class="modal fade admin-query"
                                                                 id="deleteChapter{{$chapter->id}}">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">{{__('common.Delete')}}  {{__('courses.Chapter')}}</h4>
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal"><i
                                                                                    class="ti-close "></i></button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="text-center">
                                                                                <h4> {{__('common.Are you sure to delete ?')}}</h4>
                                                                            </div>

                                                                            <div
                                                                                class="mt-40 d-flex justify-content-between">
                                                                                <button type="button"
                                                                                        class="primary-btn tr-bg"
                                                                                        data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                                                <form
                                                                                    action="{{route('deleteChapter',[$chapter->id,$chapter->course_id])}}"
                                                                                    method="get">
                                                                                    @csrf
                                                                                    <button
                                                                                        class="primary-btn fix-gr-bg"
                                                                                        type="submit">{{__('common.Delete')}}</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>







                                                    @endforeach
                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                    <div role="tabpanel"
                                         class="tab-pane fade
@if($type=="courseDetails") show active @endif
                                             "
                                         id="indivitual_email_sms">
                                        <div class="white_box_30px pl-0 pr-0 pt-0">
                                            <form action="{{route('AdminUpdateCourse')}}" method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-xl-6 ">
                                                        <label class="primary_input_label mt-1"
                                                               for=""> {{__('courses.Type')}}</label>
                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                <input type="radio" class="common-radio type1"
                                                                       id="type{{@$course->id}}1" name="type"
                                                                       value="1" {{@$course->type==1?"checked":""}}>
                                                                <label
                                                                    for="type{{@$course->id}}1">{{__('courses.Course')}}</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="radio" class="common-radio type2"
                                                                       id="type{{@$course->id}}2" name="type"
                                                                       value="2" {{@$course->type==2?"checked":""}}>
                                                                <label
                                                                    for="type{{@$course->id}}2">{{__('quiz.Quiz')}}</label>
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="col-xl-6 dripCheck"
                                                         @if($course->type!=1)style="display: none" @endif>
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label mt-1"
                                                                   for=""> {{__('common.Drip Content')}}</label>
                                                            <div class="row">
                                                                <div class="col-md-6">

                                                                    <input type="radio" class="common-radio drip0"
                                                                           id="drip{{@$course->id}}0" name="drip"
                                                                           value="0" {{@$course->drip==0?"checked":""}}>
                                                                    <label
                                                                        for="drip{{@$course->id}}0">{{__('common.No')}}</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="radio" class="common-radio drip1"
                                                                           id="drip{{@$course->id}}1" name="drip"
                                                                           value="1" {{@$course->drip==1?"checked":""}}>
                                                                    <label
                                                                        for="drip{{@$course->id}}1">{{__('common.Yes')}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 ">
                                                        <div class="primary_input mb-25">
                                                            <label class="primary_input_label mt-1"
                                                                   for="">{{__('courses.Course Title')}} </label>
                                                            <input class="primary_input_field" name="title"
                                                                   value="{{@$course->title}}" placeholder="-"
                                                                   type="text">
                                                        </div>
                                                    </div>

                                                </div>
                                                <input type="hidden" name="id" class="course_id"
                                                       value="{{@$course->id}}">
                                                <div class="col-xl-12 p-0">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="primary_input mb-35">
                                                                <label class="primary_input_label"
                                                                       for="about">{{__('courses.Course')}} {{__('courses.Requirements')}}  </label>
                                                                <textarea class="lms_summernote" name="requirements"

                                                                          id="about" cols="30"
                                                                          rows="10">{!!@$course->requirements!!}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="primary_input mb-35">
                                                        <label class="primary_input_label mt-1"
                                                               for="">{{__('courses.Course')}} {{__('courses.Description')}}  </label>
                                                        <textarea class="lms_summernote" name="about" name="" id=""
                                                                  cols="30" rows="10">{!!@$course->about!!}</textarea>
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
                                                                    name="category" id="course">
                                                                <option
                                                                    data-display="{{__('common.Select')}} {{__('quiz.Category')}}"
                                                                    value="">{{__('common.Select')}} {{__('quiz.Category')}} </option>
                                                                @foreach($categories as $category)
                                                                    <option value="{{$category->id}}"
                                                                            @if ($category->id==$course->category_id) selected @endif>{{@$category->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-6 courseBox"
                                                             id="edit_subCategoryDiv{{@$course->id}}">
                                                            <select class="primary_select " name="sub_category"
                                                                    id="edit_subcategory_id{{@$course->id}}">
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

                                                        <div class="col-xl-6 mt-30 quizBox" style=" display: none">
                                                            <select class="primary_select" name="quiz" id="quiz_id">
                                                                <option
                                                                    data-display="{{__('common.Select')}} {{__('quiz.Quiz')}}"
                                                                    value="">{{__('common.Select')}} {{__('quiz.Quiz')}} </option>
                                                                @foreach($quizzes as $quiz)
                                                                    <option value="{{$quiz->id}}"
                                                                            @if($quiz->id==$course->quiz_id) selected @endif>{{@$quiz->title}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-xl-4 mt-30 makeResize">
                                                            <select class="primary_select" name="level">
                                                                <option
                                                                    data-display="{{__('common.Select')}} {{__('common.Level')}}"
                                                                    value="">{{__('common.Select')}} {{__('common.Level')}}</option>

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
                                                            <select class="primary_select" name="language"
                                                                    id="">
                                                                <option
                                                                    data-display="{{__('common.Select')}} {{__('courses.Language')}}"
                                                                    value="">{{__('common.Select')}} {{__('courses.Language')}}</option>
                                                                @foreach ($languages as $language)
                                                                    <option value="{{$language->id}}"
                                                                            @if ($language->id==$course->lang_id) selected @endif>{{$language->native}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-4 makeResize">
                                                            <div class="primary_input mb-25">
                                                                <label
                                                                    class="primary_input_label mt-1 primary_input_label"
                                                                    for="">{{__('common.Duration')}}</label>
                                                                <input class="primary_input_field"
                                                                       name="duration" placeholder="-"
                                                                       value="{{@$course->duration}}"
                                                                       type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row d-none">
                                                        <div class="col-lg-6">
                                                            <div class="checkbox_wrap d-flex align-items-center">
                                                                <label for="course_1" class="switch_toggle mr-2">
                                                                    <input type="checkbox" name="isFree" value="1"
                                                                           id="edit_course_1">
                                                                    <i class="slider round"></i>
                                                                </label>
                                                                <label
                                                                    class="mb-0">{{__('courses.This course is a top course')}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-20">
                                                        <div class="col-lg-6">
                                                            <div class="checkbox_wrap d-flex align-items-center mt-40">
                                                                <label for="edit_course_2{{$course->id}}"
                                                                       class="switch_toggle  mr-2">
                                                                    <input type="checkbox" class="edit_course_2"
                                                                           id="edit_course_2{{$course->id}}"
                                                                           value="{{@$course->id}}">
                                                                    <i class="slider round"></i>
                                                                </label>
                                                                <label
                                                                    class="mb-0">{{__('courses.This course is a free course')}}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6" id="edit_price_div{{@$course->id}}">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label mt-1"
                                                                       for="">{{__('courses.Price')}}</label>
                                                                <input class="primary_input_field" name="price"
                                                                       placeholder="-" value="{{@$course->price}}"
                                                                       type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-20 editDiscountDiv">
                                                        <div class="col-lg-6">
                                                            <div class="checkbox_wrap d-flex align-items-center mt-40">
                                                                <label for="edit_course_3{{$course->id}}"
                                                                       class="switch_toggle  mr-2">
                                                                    <input type="checkbox" class="edit_course_3"
                                                                           @if ($course->discount_price>0) checked

                                                                           @endif id="edit_course_3{{$course->id}}"
                                                                           value="{{@$course->id}}">
                                                                    <i class="slider round"></i>
                                                                </label>
                                                                <label
                                                                    class="mb-0">{{__('courses.This course has discounted price')}}</label>
                                                            </div>
                                                        </div>
                                                        @php
                                                            if ($course->discount_price>0){
                                                                $d_price='block';
                                                            }else{
                                                                 $d_price='none';
                                                            }
                                                        @endphp
                                                        <div class="col-xl-6"
                                                             id="edit_discount_price_div{{@$course->id}}"
                                                             style="display: {{$d_price}}">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label mt-1"
                                                                       for="">{{__('courses.Discount')}} {{__('courses.Price')}}</label>
                                                                <input class="primary_input_field editDiscount"
                                                                       name="discount_price"
                                                                       value="{{@$course->discount_price}}"
                                                                       placeholder="-" type="text">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-20 videoOption"
                                                         style="display: {{$course->type==2?"none":""}}">

                                                        <div class="col-xl-6 ">

                                                            <select class="primary_select" name="host"
                                                                    id="category_id1">
                                                                <option
                                                                    data-display="{{__('common.Select')}} {{__('courses.Host')}} *"
                                                                    value="">{{__('common.Select')}} {{__('courses.Host')}} </option>
                                                                <option value="Youtube"
                                                                        @if (@$course->host=='Youtube') Selected
                                                                        @endif
                                                                        @if(empty(@$course) && @$course->host=="Youtube") selected @endif
                                                                >
                                                                    Youtube
                                                                </option>

                                                                <option value="Vimeo"
                                                                        @if (@$course->host=='Vimeo') Selected
                                                                        @endif
                                                                        @if(empty(@$course) && @$course->host=="Vimeo") selected @endif
                                                                >
                                                                    Vimeo
                                                                </option>
                                                                <option value="Self"
                                                                        @if (@$course->host=='Self') Selected
                                                                        @endif
                                                                        @if(empty(@$course) && @$course->host=="Self") selected @endif
                                                                >
                                                                    Self
                                                                </option>


                                                                @if(moduleStatusCheck("AmazonS3"))
                                                                    <option value="AmazonS3"
                                                                            @if (@$course->host=='AmazonS3') Selected
                                                                            @endif
                                                                            @if(empty(@$course) && @$course->host=="AmazonS3") selected @endif
                                                                    >
                                                                        Amazon S3
                                                                    </option>
                                                                @endif
                                                                @if(moduleStatusCheck("SCORM"))
                                                                    <option value="SCORM"
                                                                            @if(empty(@$course) && @$course->host=="SCORM") selected @endif
                                                                    >
                                                                        SCORM Self
                                                                    </option>
                                                                @endif

                                                                @if(moduleStatusCheck("AmazonS3") && moduleStatusCheck("SCORM"))
                                                                    <option value="SCORM-AwsS3"
                                                                            @if(empty(@$course) && @$course->host=="SCORM-AwsS3") selected @endif
                                                                    >
                                                                        SCORM AWS S3
                                                                    </option>
                                                                @endif
                                                            </select>

                                                        </div>
                                                        <div class="col-xl-6">


                                                            <div class="input-effect  " id="videoUrl1"
                                                                 style="display:@if((isset($course) && ($course->host!="Youtube")) || !isset($course)) none  @endif">

                                                                <input class="primary_input_field" name="trailer_link"
                                                                       id="youtubeVideo1"
                                                                       placeholder="{{__('courses.Video URL')}} *"
                                                                       value="@if(isset($course) && $course->host=="Youtube"){{$course->trailer_link}}@endif"
                                                                       type="text">

                                                                <span class="focus-border"></span>
                                                                @if ($errors->has('video_url'))
                                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('video_url') }}</strong>
                                            </span>
                                                                @endif
                                                            </div>

                                                            <div class="input-effect " id="vimeoUrl1"
                                                                 style="display: @if((isset($course) && ($course->host!="Vimeo")) || !isset($course)) none  @endif">
                                                                <div class="" id="">

                                                                    <select class="primary_select" name="vimeo"
                                                                            id="vimeoVideo1">
                                                                        <option
                                                                            data-display="{{__('common.Select')}} video "
                                                                            value="">{{__('common.Select')}} video
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
                                                                        <span class="invalid-feedback invalid-select"
                                                                              role="alert">
                                            <strong>{{ $errors->first('vimeo') }}</strong>
                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="input-effect " id="fileupload1"
                                                                 style="display: @if((isset($course) && (($course->host=="Vimeo") ||  ($course->host=="Youtube")) ) || !isset($course)) none  @endif">


                                                                <div class="primary_input">

                                                                    <div class="primary_file_uploader">
                                                                        <input class="primary-input filePlaceholder"
                                                                               type="text"
                                                                               value="{{isset($course)?$course->trailer_link:''}}"
                                                                               placeholder="{{__('common.Browse Video file')}}"
                                                                               readonly="">
                                                                        <button class="" type="button">
                                                                            <label
                                                                                class="primary-btn small fix-gr-bg"
                                                                                for="2_document_file_22">{{__('common.Browse') }}</label>
                                                                            <input type="file" class="d-none fileUpload"
                                                                                   name="file"
                                                                                   id="2_document_file_22">
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
                                                    <div class="row mt-20">


                                                        <div class="col-xl-12">
                                                            <div class="primary_input mb-35">
                                                                <label class="primary_input_label mt-1"
                                                                       for="">{{__('courses.Course Thumbnail')}}</label>
                                                                <div class="primary_file_uploader">
                                                                    <input class="primary-input filePlaceholder"
                                                                           type="text"
                                                                           id=""
                                                                           value="{{showPicName(@$course->thumbnail)}}"
                                                                           placeholder="Browse Image file" readonly="">
                                                                    <button class="" type="button">
                                                                        <label class="primary-btn small fix-gr-bg"
                                                                               for="3_document_file_33">{{__('common.Browse')}}</label>
                                                                        <input type="file" class="d-none fileUpload"
                                                                               name="image"
                                                                               id="3_document_file_33">
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-xl-12">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label mt-1"
                                                                       for="">{{__('courses.Meta keywords')}}</label>
                                                                <input class="primary_input_field" name="meta_keywords"
                                                                       value="{{@$course->meta_keywords}}"
                                                                       placeholder="-" type="text">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">

                                                        <div class="col-xl-12">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label mt-1"
                                                                       for="">{{__('courses.Meta description')}}</label>
                                                                <textarea id="my-textarea" class="primary_input_field"
                                                                          name="meta_description" style="height: 200px"
                                                                          rows="3">{!!@$course->meta_description!!}</textarea>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-lg-12 text-center pt_15">
                                                        <div class="d-flex justify-content-center">
                                                            <button class="primary-btn semi_large2  fix-gr-bg"
                                                                    id="save_button_parent" type="submit"><i
                                                                    class="ti-check"></i> {{__('common.Update')}} {{__('courses.Course')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                    <!-- End Individual Tab -->
                                    <div role="tabpanel" class="tab-pane fade  @if($type=="files") show active @endif "
                                         id="file_list">

                                        <div class="">
                                            <div class="row mb_20 mt-20">
                                                <div class="col-lg-2">

                                                    <ul class="d-flex">
                                                        <li><a data-toggle="modal" data-target="#addFile"
                                                               class="primary-btn radius_30px  fix-gr-bg" href="#"><i
                                                                    class="ti-plus"></i>{{__('common.Add')}} {{__('common.File')}}
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="modal fade admin-query" id="addFile">
                                                <div class="modal-dialog  modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">{{__('common.Add')}} {{__('courses.Exercise')}} {{__('common.File')}}</h4>
                                                            <button type="button" class="close" data-dismiss="modal"><i
                                                                    class="ti-close "></i></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="{{route('saveFile')}}" method="post"
                                                                  enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{@$course->id}}">


                                                                <div class="primary_file_uploader">
                                                                    <input class="primary-input filePlaceholder"
                                                                           type="text"
                                                                           id="" value=""
                                                                           placeholder="{{__('common.Browse') }} {{__('common.File') }}"
                                                                           readonly="">
                                                                    <button class="" type="button">
                                                                        <label class="primary-btn small fix-gr-bg"
                                                                               for="4_document_file_44">{{__('common.Browse')}}</label>
                                                                        <input type="file" class="d-none fileUpload"
                                                                               name="exercise_file"
                                                                               id="4_document_file_44">
                                                                    </button>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xl-12 mt-20">
                                                                        <div class="primary_input">
                                                                            {{-- <label class="primary_input_label mt-1" for=""> {{__('common.Name')}} </label> --}}
                                                                            <input class="primary_input_field"
                                                                                   name="fileName" value="" required
                                                                                   placeholder="{{__('common.File')}} {{__('common.Name')}} *"
                                                                                   type="text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <select class="primary_select  mt-20"
                                                                                name="status"
                                                                                id="">
                                                                            <option
                                                                                data-display="{{__('common.Select')}} {{__('common.Status')}}"
                                                                                value="">{{__('common.Select')}} {{__('common.Status')}} </option>
                                                                            <option
                                                                                value="1"
                                                                                selected>{{__('courses.Active')}}</option>
                                                                            <option
                                                                                value="0">{{__('courses.Pending')}}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12 mt-3">
                                                                        <select
                                                                            class="primary_select"
                                                                            name="lock" id="">
                                                                            <option
                                                                                data-display="{{__('common.Select')}} {{__('courses.Privacy')}}"
                                                                                value="">{{__('common.Select')}} {{__('courses.Privacy')}} </option>
                                                                            <option value="0"
                                                                            >{{__('courses.Unlock')}}</option>
                                                                            <option value="1"
                                                                                    selected>{{__('courses.Locked')}}</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div
                                                                            class="mt-40 d-flex justify-content-between">
                                                                            <button type="button"
                                                                                    class="primary-btn tr-bg"
                                                                                    data-dismiss="modal"> {{__('common.Cancel')}} </button>
                                                                            <button class="primary-btn fix-gr-bg"
                                                                                    type="submit">{{__('common.Add')}}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="QA_section QA_section_heading_custom check_box_table hide_btn_tab">
                                                <div class="QA_table ">
                                                    <!-- table-responsive -->
                                                    <div class="">
                                                        <table id="lms_table" class="table ">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">{{ __('common.ID') }}</th>
                                                                <th scope="col">{{__('common.Name')}}</th>
                                                                <th scope="col">{{ __('common.Download') }}</th>
                                                                <th scope="col">{{ __('common.Action') }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @if(count($course_exercises)==0)
                                                                <tr>
                                                                    <td colspan="4"
                                                                        class="text-center">{{__('courses.No Data Found')}}</td>
                                                                </tr>
                                                            @endif
                                                            @foreach($course_exercises as $key => $exercise_file)
                                                                <tr>
                                                                    <th>{{ $key+1 }}</th>

                                                                    <td>{{@$exercise_file->fileName }}</td>
                                                                    <td>

                                                                        @if (file_exists($exercise_file->file))

                                                                            <a href="{{route('download_course_file',[$exercise_file->id])}}">{{ __('common.Download') }}</a>
                                                                        @else
                                                                            {{__('common.File Not Found')}}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <!-- shortby  -->
                                                                        <div class="dropdown CRM_dropdown">
                                                                            <button
                                                                                class="btn btn-secondary dropdown-toggle"
                                                                                type="button"
                                                                                id="dropdownMenu2"
                                                                                data-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                                {{ __('common.Select') }}
                                                                            </button>
                                                                            <div
                                                                                class="dropdown-menu dropdown-menu-right"
                                                                                aria-labelledby="dropdownMenu2">
                                                                                <a class="dropdown-item"
                                                                                   data-toggle="modal"
                                                                                   data-target="#editFile{{$exercise_file->id}}"
                                                                                   href="#">{{__('common.Edit')}}</a>
                                                                                <a class="dropdown-item"
                                                                                   data-toggle="modal"
                                                                                   data-target="#deleteQuestionGroupModal{{$exercise_file->id}}"
                                                                                   href="#">{{__('common.Delete')}}</a>
                                                                            </div>
                                                                        </div>
                                                                        <!-- shortby  -->
                                                                    </td>
                                                                </tr>
                                                                <div class="modal fade admin-query"
                                                                     id="editFile{{$exercise_file->id}}">
                                                                    <div class="modal-dialog  modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">{{ __('common.Edit') }} {{ __('courses.Exercise') }} {{ __('common.File') }}</h4>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"><i
                                                                                        class="ti-close "></i></button>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                <form action="{{route('updateFile')}}"
                                                                                      method="post"
                                                                                      enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <input type="hidden" name="id"
                                                                                           value="{{@$exercise_file->id}}">

                                                                                    {{-- <label class="primary_input_label mt-1" for="">Exercise File</label> --}}
                                                                                    <div class="primary_file_uploader">
                                                                                        <input
                                                                                            class="primary-input filePlaceholder "
                                                                                            type="text"
                                                                                            id=" "
                                                                                            value=""
                                                                                            placeholder="{{showPicName(@$exercise_file->file)}}"
                                                                                            readonly="">
                                                                                        <button class="" type="button">
                                                                                            <label
                                                                                                class="primary-btn small fix-gr-bg"
                                                                                                for="document_file_ex_{{$exercise_file->id}}">{{ __('common.Browse') }}</label>
                                                                                            <input type="file"
                                                                                                   class="d-none  fileUpload"
                                                                                                   name="exercise_file_update"
                                                                                                   id="document_file_ex_{{$exercise_file->id}}">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="row">

                                                                                        <div class="col-xl-12 mt-20">
                                                                                            <div class="primary_input">
                                                                                                <input
                                                                                                    class="primary_input_field"
                                                                                                    name="fileName"
                                                                                                    required
                                                                                                    value="{{$exercise_file->fileName}}"
                                                                                                    placeholder="{{__('common.File')}} {{__('common.Name')}}"
                                                                                                    type="text">
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="row">

                                                                                        <div class="col-12 mt-20 ">
                                                                                            <select
                                                                                                class="primary_select"
                                                                                                name="lock" id="">
                                                                                                <option
                                                                                                    data-display="{{__('common.Select')}} {{__('courses.Privacy')}}"
                                                                                                    value="">{{__('common.Select')}} {{__('courses.Privacy')}} </option>
                                                                                                <option value="0"
                                                                                                        @if ($exercise_file->lock==0) selected @endif>{{__('courses.Unlock')}}</option>
                                                                                                <option value="1"
                                                                                                        @if ($exercise_file->lock==1) selected @endif>{{__('courses.Locked')}}</option>

                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-12 mt-25">
                                                                                            <select
                                                                                                class="primary_select"
                                                                                                name="status" id="">
                                                                                                <option
                                                                                                    data-display="{{__('common.Select')}} {{__('common.Status')}}"
                                                                                                    value="">{{__('common.Select')}} {{__('common.Status')}} </option>
                                                                                                <option value="1"
                                                                                                        @if ($exercise_file->status==1) selected @endif>{{__('courses.Active')}}</option>
                                                                                                <option value="0"
                                                                                                        @if ($exercise_file->status==0) selected @endif>{{__('courses.Pending')}}</option>
                                                                                            </select>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div
                                                                                        class="mt-40 d-flex justify-content-between">
                                                                                        <button type="button"
                                                                                                class="primary-btn tr-bg"
                                                                                                data-dismiss="modal"> {{__('common.Cancel')}} </button>
                                                                                        <button
                                                                                            class="primary-btn fix-gr-bg"
                                                                                            type="submit">{{__('common.Update')}}</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal fade admin-query"
                                                                     id="deleteQuestionGroupModal{{$exercise_file->id}}">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">{{__('common.Delete')}} {{ __('courses.Exercise') }} {{ __('common.File') }}</h4>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"><i
                                                                                        class="ti-close "></i></button>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                <div class="text-center">
                                                                                    <h4> {{__('common.Are you sure to delete ?')}}</h4>
                                                                                </div>

                                                                                <div
                                                                                    class="mt-40 d-flex justify-content-between">
                                                                                    <button type="button"
                                                                                            class="primary-btn tr-bg"
                                                                                            data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                                                    {{ Form::open(['route' => 'deleteFile', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                                                                    <input type="hidden" name="id"
                                                                                           value="{{$exercise_file->id}}">
                                                                                    <button
                                                                                        class="primary-btn fix-gr-bg"
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

                                    <div role="tabpanel" class="tab-pane fade  @if($type=="drip") show active @endif "
                                         id="drip">

                                        <div class="QA_section QA_section_heading_custom check_box_table  pt-20">
                                            <div class="QA_table ">
                                                <form action="{{route('setCourseDripContent')}}" method="post">
                                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                                    @csrf
                                                    <table class="table  pt-0">
                                                        <thead>
                                                        <tr>
                                                            <th>{{__('common.Name')}}</th>
                                                            <th>{{__('common.Specific Date')}}</th>
                                                            <th></th>
                                                            <th>{{__('common.Days After Enrollment')}}</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @if(count($chapters)==0)
                                                            <tr>
                                                                <td colspan="3"
                                                                    class="text-center">{{__('courses.No Data Found')}}</td>
                                                            </tr>
                                                        @endif
                                                        @php
                                                            $i=0;
                                                        @endphp
                                                        @foreach($chapters as $key1 => $chapter)


                                                            @foreach ($chapter->lessons as $key => $lesson)

                                                                <input type="hidden" name="lesson_id[]"
                                                                       value="{{@$lesson->id}}">
                                                                <tr>
                                                                    <td>
                                                                        @if ($lesson->is_quiz==1)

                                                                            <span> <i class="ti-check-box"></i>   {{$key+1}}. {{@$lesson['quiz'][0]['title']}} </span>

                                                                        @else

                                                                            <span> <i class="ti-control-play"></i>  {{$key+1}}. {{$lesson['name']}} [{{$lesson['duration']}}] </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                               class="primary_input_field primary-input date form-control"
                                                                               placeholder="{{__('common.Select Date')}}"
                                                                               readonly
                                                                               name="lesson_date[]"
                                                                               value="{{@$lesson->unlock_date!=""?date('m/d/Y',strtotime($lesson->unlock_date)):""}}">
                                                                    </td>
                                                                    <td>
                                                                        <div class="row">

                                                                            {{--todo working--}}
                                                                            <div class="form-check p-1">
                                                                                <input
                                                                                    class="form-check-input  common-radio"
                                                                                    type="radio"
                                                                                    name="drip_type[{{$i}}]"
                                                                                    id="select_drip_{{$i}}1"
                                                                                    value="1"
                                                                                    @if(!empty($lesson->unlock_date))checked @endif>
                                                                                <label class="form-check-label"
                                                                                       for="select_drip_{{$i}}1">
                                                                                    {{__('common.Date')}}
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check  p-1">
                                                                                <input
                                                                                    class="form-check-input common-radio"
                                                                                    type="radio"
                                                                                    name="drip_type[{{$i}}]"
                                                                                    id="select_drip_{{$i}}2"
                                                                                    @if(empty($lesson->unlock_date))checked
                                                                                    @endif
                                                                                    value="2">
                                                                                <label class="form-check-label"
                                                                                       for="select_drip_{{$i}}2">
                                                                                    {{__('common.Days')}}
                                                                                </label>
                                                                            </div>

                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="1" max="365"
                                                                               class="form-control"
                                                                               placeholder="{{__('common.Days')}}"
                                                                               name="lesson_day[]"
                                                                               value="{{@$lesson['unlock_days']}}">
                                                                    </td>

                                                                </tr>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach



                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        @if(count($chapters)!=0)
                                                            <tr>
                                                                <td colspan="3">
                                                                    <button class="primary-btn fix-gr-bg" type="submit"
                                                                            data-toggle="tooltip">
                                                                        <span class="ti-check"></span>
                                                                        {{__('common.Save')}}
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        </tfoot>
                                                    </table>
                                                </form>
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
@endsection

@push('scripts')
    <script src="{{asset('/')}}/Modules/CourseSetting/Resources/assets/js/course.js"></script>



    <script>
        $('.nastable').sortable({
            cursor: "move",
            update: function (event, ui) {
                let ids = $(this).sortable('toArray', {attribute: 'data-id'});
                console.log(ids);
                if (ids.length > 0) {
                    let data = {
                        '_token': '{{ csrf_token() }}',
                        'ids': ids,
                    }
                    $.post("{{route('changeChapterPosition')}}", data, function (data) {

                    });
                }
            }
        }).disableSelection();

        $('.nastable2').sortable({
            cursor: "move",
            update: function (event, ui) {
                let ids = $(this).sortable('toArray', {attribute: 'data-id'});
                console.log(ids);
                if (ids.length > 0) {
                    let data = {
                        '_token': '{{ csrf_token() }}',
                        'ids': ids,
                    }
                    $.post("{{route('changeLessonPosition')}}", data, function (data) {

                    });
                }
            }
        }).disableSelection();


    </script>



    <script>
        @if($course->type==2)
        $(".courseBox").hide();
        $(".quizBox").show();
        $(".makeResize").addClass("col-xl-6");
        $(".makeResize").removeClass("col-xl-4");
        @endif

        $(".type1").on("click", function () {
            if ($('.type1').is(':checked')) {
                $(".courseBox").show();
                $(".quizBox").hide();
                $(".dripCheck").show();
                $("#quiz_id").val('');

                $(".makeResize").addClass("col-xl-4");
                $(".makeResize").removeClass("col-xl-6");
            }
        });

        $(".type2").on("click", function () {
            if ($('.type2').is(':checked')) {
                $(".courseBox").hide();
                $(".quizBox").show();
                $(".dripCheck").hide();

                $(".makeResize").addClass("col-xl-6");
                $(".makeResize").removeClass("col-xl-4");
            }
        });
        //
        // durationBox


        $(document).ready(function () {
            $('#select_input_type').change(function () {
                console.log('selected');
                if ($(this).val() === '1') {

                    $(".chapter_div").css("display", "block");
                    $(".lesson_div").css("display", "none");
                    $(".quiz_div").css("display", "none");

                } else if ($(this).val() === '2') {

                    $(".chapter_div").css("display", "none");
                    $(".lesson_div").css("display", "none");
                    $(".quiz_div").css("display", "block");

                } else {
                    $(".chapter_div").css("display", "none");
                    $(".lesson_div").css("display", "block");
                    $(".quiz_div").css("display", "none");
                }
            });

            $('#category_id').change(function () {
                let category_id = $('#category_id').find(":selected").val();

                if (category_id === 'Youtube' || category_id === 'URL') {
                    $("#iframeBox").hide();
                    $("#videoUrl").show();
                    $("#vimeoUrl").hide();
                    $("#vimeoVideo").val('');
                    $("#youtubeVideo").val('');
                    $("#fileupload").hide();

                } else if ((category_id === 'Self') || (category_id === 'Zip') || (category_id === 'PowerPoint') || (category_id === 'Excel') || (category_id === 'Text') || (category_id === 'Word') || (category_id === 'PDF') || (category_id === 'Image') || (category_id === 'AmazonS3') || (category_id === 'SCORM') || (category_id === 'SCORM-AwsS3')) {

                    $("#iframeBox").hide();
                    $("#fileupload").show();
                    $("#videoUrl").hide();
                    $("#vimeoUrl").hide();
                    $("#vimeoVideo").val('');
                    $("#youtubeVideo").val('');

                } else if (category_id === 'Vimeo') {
                    $("#iframeBox").hide();
                    $("#videoUrl").hide();
                    $("#vimeoUrl").show();
                    $("#vimeoVideo").val('');
                    $("#youtubeVideo").val('');
                    $("#fileupload").hide();
                } else if (category_id === 'Iframe') {
                    $("#iframeBox").show();
                    $("#videoUrl").hide();
                    $("#vimeoUrl").hide();
                    $("#vimeoVideo").val('');
                    $("#youtubeVideo").val('');
                    $("#fileupload").hide();
                } else {
                    $("#iframeBox").hide();
                    $("#videoUrl").hide();
                    $("#vimeoUrl").hide();
                    $("#vimeoVideo").val('');
                    $("#youtubeVideo").val('');
                    $("#fileupload").hide();
                }

            });


            $('#category_id1').change(function () {
                let category_id1 = $('#category_id1').find(":selected").val();
                if (category_id1 === 'Youtube') {
                    $("#videoUrl1").show();
                    $("#vimeoUrl1").hide();
                    $("#vimeoVideo1").val('');
                    $("#youtubeVideo1").val('');
                    $("#fileupload1").hide();

                } else if ((category_id1 === 'Self') || (category_id === 'Document') || (category_id === 'Image') || (category_id1 === 'AmazonS3') || (category_id1 === 'SCORM') || (category_id1 === 'SCORM-AwsS3')) {
                    $("#fileupload1").show();
                    $("#videoUrl1").hide();
                    $("#vimeoUrl1").hide();
                    $("#vimeoVideo1").val('');
                    $("#youtubeVideo1").val('');

                } else if (category_id1 === 'Vimeo') {
                    $("#videoUrl1").hide();
                    $("#vimeoUrl1").show();
                    $("#vimeoVideo1").val('');
                    $("#youtubeVideo1").val('');
                    $("#fileupload1").hide();
                } else {
                    $("#videoUrl1").hide();
                    $("#vimeoUrl1").hide();
                    $("#vimeoVideo1").val('');
                    $("#youtubeVideo1").val('');
                    $("#fileupload1").hide();
                }
            });


            @if(empty(@$editLesson))
            $('#category_id').trigger('change');
            @endif
            // $('#category_id1').trigger('change');

        });


    </script>


@endpush
