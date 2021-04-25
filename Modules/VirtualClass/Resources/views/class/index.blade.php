@extends('backend.master')
@push('styles')
    <link rel="stylesheet" href="{{asset('public/backend/css/class.css')}}"/>
@endpush
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> {{__('virtual-class.Class List')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                    <a href="#"> {{__('virtual-class.Class List')}}</a>
                </div>
            </div>
        </div>
    </section>
    @php
        $currency = getSetting()->currency;
    @endphp
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            @if(isset($bank))
                @if (permissionCheck('virtual-class.store'))
                    <div class="row">
                        <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                            <a href="{{route('virtual-class')}}" class="primary-btn small fix-gr-bg">
                                <span class="ti-plus pr-2"></span>
                                {{__('common.Add')}}
                            </a>
                        </div>
                    </div>
                @endif
            @endif
            <div class="row">
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-20">
                                    @if(isset($class))
                                        {{__('common.Edit')}}
                                    @else
                                        {{__('common.Add')}}
                                    @endif
                                    {{__('virtual-class.Create Class')}}
                                </h3>
                            </div>

                            @if(isset($class))

                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('virtual-class.update',$class->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'id' => 'question_bank']) }}

                            @else
                                @if (permissionCheck('virtual-class.create'))

                                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'virtual-class.store',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'question_bank']) }}

                                @endif
                            @endif
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <label> {{__('virtual-class.Title')}} *</label>
                                                <input type="text" placeholder="{{__('virtual-class.Title')}}"
                                                       class="primary_input_field name{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                       name="title" {{ $errors->has('title') ? ' autofocus' : '' }}
                                                       value="{{isset($class)? $class->title:(old('title')!=''?(old('title')):'')}}">
                                                <span class="focus-border textarea"></span>
                                                @if ($errors->has('title'))
                                                    <span
                                                        class="error text-danger"><strong>{{ $errors->first('title') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <label> {{__('virtual-class.Duration')}}
                                                    ({{__('virtual-class.in Minute')}}) *</label>
                                                <input {{ $errors->has('duration') ? ' autofocus' : '' }}
                                                       class="primary_input_field name{{ $errors->has('duration') ? ' is-invalid' : '' }}"
                                                       type="number" name="duration" placeholder="e.g.30min"
                                                       value="{{isset($class)? $class->duration:(old('duration')!=''?(old('duration')):'')}}">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('duration'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('duration') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <label class="primary_input_label" for="">{{__('quiz.Category')}}</label>
                                            <select {{ $errors->has('category') ? ' autofocus' : '' }}
                                                    class="primary_select {{ $errors->has('category') ? ' is-invalid' : '' }}"
                                                    id="category_id" name="category">
                                                <option data-display=" {{__('quiz.Category')}} *"
                                                        value=""> {{__('quiz.Category')}} *
                                                </option>
                                                @foreach($categories as $category)
                                                    @if(isset($class))
                                                        <option
                                                            value="{{$category->id}}" {{$class->category_id == $category->id? 'selected': ''}}>{{$category->name}}</option>
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
                                            <select {{ $errors->has('sub_category') ? ' autofocus' : '' }}
                                                    class="primary_select{{ $errors->has('sub_category') ? ' is-invalid' : '' }} select_section"
                                                    id="subcategory_id" name="sub_category">
                                                <option
                                                    data-display=" {{__('common.Select')}} {{__('quiz.Sub Category')}} *"
                                                    value="">{{__('common.Select')}} {{__('quiz.Sub Category')}} *
                                                </option>

                                                @if(isset($class))
                                                    <option value="{{@$class->sub_category_id}}"
                                                            selected>{{@$class->subCategory->name}}</option>
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
                                            <div class="checkbox_wrap d-flex align-items-center">
                                                <label for="edit_course"
                                                       class="switch_toggle">
                                                    <input type="checkbox" name="free"
                                                           {{isset($class) && $class->fees == 0 ? 'checked' : ''}} class="free_class"
                                                           id="edit_course"
                                                           value="0">
                                                    <i class="slider round"></i>
                                                </label>
                                                <label>{{__('virtual-class.This class is free')}}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-25 fees"
                                         @if (isset($class) && $class->fees == 0) style="display:none;" @endif>
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <label> {{__('virtual-class.Fees')}} *</label>
                                                <input
                                                    class="primary_input_field name{{ $errors->has('fees') ? ' is-invalid' : '' }}"
                                                    type="number" name="fees"
                                                    value="{{isset($class)? $class->fees:(old('fees')!=''?(old('fees')):0)}}">
                                                <span class="focus-border"></span>
                                                @if ($errors->has('fees'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fees') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-25">
                                        <div class="col-xl-12">
                                            <div class="primary_input">
                                                <label class="primary_input_label" for="">{{__('common.Image')}}
                                                    *</label>
                                                <div class="primary_file_uploader">
                                                    <input class="primary-input filePlaceholder" type="text"
                                                           placeholder="{{isset($class) && $class->image ? showPicName($class->image) :__('virtual-class.Browse Image file')}}"
                                                           readonly="" {{ $errors->has('image') ? ' autofocus' : '' }}>
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg"
                                                               for="document_file">{{__('common.Browse')}}</label>
                                                        <input type="file" class="d-none fileUpload" name="image"
                                                               id="document_file">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <label class="primary_input_label"
                                                   for="">{{__('virtual-class.Language')}} *</label>
                                            <select class="primary_select" name="lang_id" id="" required>
                                                <option
                                                    data-display="{{ __('common.Select') }} {{ __('common.Language') }}"
                                                    value="">{{ __('common.Select') }} {{ __('common.Language') }}</option>
                                                @foreach ($languages as $language)
                                                    <option
                                                        value="{{$language->id}}"
                                                        @if(!isset($class)) @if($language->id==19) selected @endif @endif{{isset($class) && $class->lang_id == $language->id ? 'selected' : ''}} >{{$language->native}}</option>

                                                @endforeach
                                            </select>
                                            @if ($errors->has('lang_id'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('lang_id') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <label class="primary_input_label"
                                                   for="">{{__('virtual-class.Type')}}</label>
                                            <select
                                                class="primary_select type {{ $errors->has('type') ? ' is-invalid' : '' }}"
                                                id="type" name="type">
                                                <option
                                                    value="0" {{isset($class) && $class->type == 0 ? 'selected' : old('type')}}>{{__('virtual-class.Single Class')}}</option>
                                                <option
                                                    value="1" {{isset($class) && $class->type == 1 ? 'selected' : old('type')}}>{{__('virtual-class.Continuous Class')}}</option>
                                            </select>
                                            @if ($errors->has('type'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div @if(!isset($class) || $class->type == 0) style="display: none"
                                         @endif class="row mt-25 continuous_class">
                                        <div class="col-xl-12">
                                            <div class="primary_input">
                                                <label class="primary_input_label"
                                                       for="">{{ __('coupons.Start Date') }}</label>
                                                <div class="primary_datepicker_input">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="">
                                                                <input placeholder="Start Date"
                                                                       class="primary_input_field primary-input date form-control  {{ @$errors->has('start_date') ? ' is-invalid' : '' }}"
                                                                       id="start_date" type="text"
                                                                       name="start_date"
                                                                       value="{{isset($class)? $class->start_date : date('m/d/Y')}}"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <button class="" type="button">
                                                            <i class="ti-calendar" id="start-date-icon"></i>
                                                        </button>
                                                    </div>
                                                    @if ($errors->has('start_date'))
                                                        <span class="invalid-feedback d-block mb-10" role="alert">
                                                <strong>{{ @$errors->first('start_date') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 mt-25">
                                            <div class="primary_input">
                                                <label class="primary_input_label"
                                                       for="">{{ __('virtual-class.End Date') }}</label>
                                                <div class="primary_datepicker_input">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="">
                                                                <input placeholder="End Date"
                                                                       class="primary_input_field primary-input date form-control  {{ @$errors->has('end_date') ? ' is-invalid' : '' }}"
                                                                       id="end_date" type="text"
                                                                       name="end_date"
                                                                       value="{{isset($class)?  $class->end_date : date('m/d/Y')}}"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <button class="" type="button">
                                                            <i class="ti-calendar" id="start-date-icon"></i>
                                                        </button>
                                                    </div>
                                                    @if ($errors->has('end_date'))
                                                        <span class="invalid-feedback d-block mb-10" role="alert">
                                                <strong>{{ @$errors->first('end_date') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div @if(isset($class) && $class->type == 1) style="display: none"
                                         @endif class="row mt-25 single_class">
                                        <div class="col-xl-12">
                                            <div class="primary_input">
                                                <label class="primary_input_label"
                                                       for="">{{ __('virtual-class.Date') }}</label>
                                                <div class="primary_datepicker_input">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="">
                                                                <input placeholder="Date"
                                                                       class="primary_input_field primary-input date form-control  {{ @$errors->has('date') ? ' is-invalid' : '' }}"
                                                                       id="start_date" type="text"
                                                                       name="date"
                                                                       value="{{isset($class) && $class->type == 0 ? $class->start_date : date('m/d/Y')}}"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <button class="" type="button">
                                                            <i class="ti-calendar" id="start-date-icon"></i>
                                                        </button>
                                                    </div>
                                                    @if ($errors->has('start_date'))
                                                        <span class="invalid-feedback d-block mb-10" role="alert">
                                                <strong>{{ @$errors->first('start_date') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-6">
                                            <label>{{__('virtual-class.Time')}} <span>*</span></label>
                                            <input required
                                                   class="primary-input time form-control{{ @$errors->has('time') ? ' is-invalid' : '' }}"
                                                   type="text" name="time"
                                                   value="{{ isset($class) ? old('time',$class->time): old('time')}}">
                                            <span class="focus-border"></span>
                                            @if ($errors->has('time'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ @$errors->first('time') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="col-md-12 mt-25">
                                            <label class="primary_input_label"
                                                   for=""> {{__('virtual-class.Host')}} </label>
                                        </div>

                                        <div class="col-md-6">

                                            <input type="radio" class="common-checkbox" id="type1" name="host"
                                                   value="Zoom"
                                                   @if(isset($class)) @if($class->host=="Zoom") checked @endif @else
                                                   checked @endif>
                                            <label for="type1">{{__('virtual-class.Zoom')}}</label>
                                        </div>

                                        @if(moduleStatusCheck("BBB"))
                                            <div class="col-md-6">
                                                <input type="radio" class="common-checkbox" id="type2" name="host"
                                                       value="BBB"
                                                       @if(isset($class)) @if($class->host=="BBB") checked @endif @endif
                                                >
                                                <label for="type2">{{__('virtual-class.BBB')}}</label>
                                            </div>
                                        @endif

                                        @if(moduleStatusCheck("Jitsi"))
                                            <div class="col-md-6">
                                                <input type="radio" class="common-checkbox" id="type3" name="host"
                                                       value="Jitsi"
                                                       @if(isset($class)) @if($class->host=="Jitsi") checked @endif @endif
                                                >
                                                <label for="type3">{{__('jitsi.Jitsi')}}</label>
                                            </div>
                                        @endif
                                    </div>


                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="primary-btn fix-gr-bg"
                                                    data-toggle="tooltip">
                                                <span class="ti-check"></span>
                                                @if(isset($class))
                                                    {{__('common.Update')}}
                                                @else
                                                    {{__('common.Save')}}
                                                @endif
                                                {{__('virtual-class.Class')}}
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 ">
                    <div class="main-title">
                        <h3 class="mb-20">{{__('virtual-class.Class List')}}</h3>
                    </div>

                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    @if(session()->has('message-success-delete') != "" ||
                                    session()->get('message-danger-delete') != "")
                                        <tr>
                                            <td colspan="5">
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
                                        <th>{{__('virtual-class.Title')}}</th>
                                        <th>{{__('virtual-class.Category')}}</th>
                                        <th>{{__('virtual-class.Sub Category')}}</th>
                                        <th>{{__('virtual-class.Language')}}</th>
                                        <th>{{__('virtual-class.Duration')}}</th>
                                        <th>{{__('virtual-class.Fees')}}</th>
                                        <th>{{__('virtual-class.Type')}}</th>
                                        <th>{{__('virtual-class.Start Date')}}</th>
                                        <th>{{__('virtual-class.End Date')}}</th>
                                        <th>{{__('virtual-class.Time')}}</th>
                                        <th>{{__('common.Action')}}</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($classes as $class)
                                        <tr>

                                            <td>{{$class->title}}</td>
                                            <td>{{$class->category->name}}</td>
                                            <td>{{$class->subCategory->name}}</td>
                                            <td>{{$class->language->native}}</td>
                                            <td>{{$class->duration}}</td>
                                            <td>{{$currency->symbol}} {{$class->fees}}</td>
                                            <td>
                                                @if($class->type == 0)
                                                    {{__('virtual-class.Single Class')}}
                                                @else
                                                    {{__('virtual-class.Continuous Class')}}
                                                @endif
                                            </td>
                                            <td>{{$class->start_date}}</td>
                                            <td>{{$class->end_date}}</td>
                                            <td>{{$class->time}}</td>

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
                                                           href="{{route('virtual-class.details', [$class->id])}}">{{__('common.Details')}}</a>
                                                        @if (permissionCheck('virtual-class.edit'))
                                                            <a class="dropdown-item edit_brand"
                                                               href="{{route('virtual-class.edit', [$class->id])}}">{{__('common.Edit')}}</a>
                                                        @endif
                                                        @if (permissionCheck('virtual-class.destroy'))
                                                            <a class="dropdown-item" data-toggle="modal"
                                                               data-target="#deleteQuestionBankModal{{$class->id}}"
                                                               href="#">{{__('common.Delete')}}</a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deleteQuestionBankModal{{$class->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{__('common.Delete')}} {{__('virtual-class.Class')}}</h4>
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
                                                            {{ Form::open(['route' => array('virtual-class.destroy',$class->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
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
