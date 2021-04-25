@extends('backend.master')
@section('table'){{__('testimonials')}}@endsection
@section('mainContent')
    @include("backend.partials.alertMessage")
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('frontendmanage.Testimonial')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('frontendmanage.Frontend CMS')}}</a>
                    <a class="active" href="{{url('frontend/testimonials')}}">{{__('frontendmanage.Testimonial')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="box_header common_table_header">
                                <div class="main-title d-md-flex w-100">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">
                                        @if(!isset($edit)) {{__('frontendmanage.Add New Testimonial') }} @else {{__('common.Update')}} @endif</h3>

                                    @if(isset($edit))
                                        <div class="float-right text-right">
                                            <a href="{{route('frontend.testimonials')}}"
                                               class="primary-btn small fix-gr-bg updatebtn float-right"
                                               title="{{__('frontendmanage.Add New Testimonial') }}">+ </a>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white-box mb_30 ">
                        <form
                            action="{{isset($edit)?route('frontend.testimonials_update'): route('frontend.testimonials_store') }}"
                            method="POST" id="coupon-form" name="coupon-form" enctype="multipart/form-data">
                            @csrf
                            @if(isset($edit)) <input type="hidden" name="id" value="{{$edit->id}}"> @endif
                            <input type="hidden" name="category" value="1">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('frontendmanage.Body Text') }}
                                            *</label>
                                        <textarea name="body" id="" cols="30" rows="10"
                                                  {{ $errors->has('body') ? ' autofocus' : '' }}
                                                  placeholder="{{ __('frontendmanage.Body Text') }}"
                                                  class="primary_textarea {{ @$errors->has('body') ? ' is-invalid' : '' }}">{{isset($edit)?$edit->body:old('body')}}</textarea>
                                        @if ($errors->has('body'))
                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('body') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('frontendmanage.Author') }}
                                            *</label>
                                        <input name="author" id="author"
                                               {{ $errors->has('author') ? ' autofocus' : '' }}
                                               class="primary_input_field name {{ @$errors->has('author') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('frontendmanage.Enter Author Name') }}" type="text"
                                               value="{{isset($edit)?$edit->author:old('author')}}">
                                        @if ($errors->has('author'))
                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('author') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- input Profession  --}}
                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('frontendmanage.Profession') }}
                                            *</label>
                                        <input name="profession" id="profession"
                                               {{ $errors->has('profession') ? ' autofocus' : '' }}
                                               class="primary_input_field name {{ @$errors->has('profession') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('frontendmanage.Enter Profession') }}" type="text"
                                               value="{{isset($edit)?$edit->profession:old('profession')}}">
                                        @if ($errors->has('profession'))
                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('profession') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('common.Star') }}
                                            *</label>
                                        <select class="primary_select mb-25" name="star" id="star">
                                            <option value="1" @if(isset($edit)){{$edit->star==1?'selected':''}} @endif>
                                                1
                                            </option>
                                            <option value="2" @if(isset($edit)){{$edit->star==2?'selected':''}} @endif>
                                                2
                                            </option>
                                            <option value="3" @if(isset($edit)){{$edit->star==3?'selected':''}} @endif>
                                                3
                                            </option>
                                            <option value="4" @if(isset($edit)){{$edit->star==4?'selected':''}} @endif>
                                                4
                                            </option>
                                            <option value="5"
                                                    @if(isset($edit)){{$edit->star==5?'selected':''}} @else selected @endif >
                                                5
                                            </option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="">{{ __('imagegallery.Image') }}
                                            *</label>
                                        <div class="primary_file_uploader">
                                            <input {{ $errors->has('image') ? ' autofocus' : '' }}
                                                   class="primary-input  {{ @$errors->has('image') ? ' is-invalid' : '' }}"
                                                   type="text" id="placeholderFileOneName"
                                                   placeholder="{{__('common.Browse file')}}" readonly="">
                                            <button class="" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="document_file_1">{{ __('common.Browse') }}</label>
                                                <input type="file" class="d-none" name="image" id="document_file_1">
                                            </button>
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback d-block mb-10" role="alert">
                                            <strong>{{ @$errors->first('image') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('common.Status') }} *</label>
                                        <select
                                            class="primary_select mb-25  {{ @$errors->has('status') ? ' is-invalid' : '' }}"
                                            name="status" id="status" required>
                                            <option
                                                value="1" {{isset($edit)?($edit->status==1?'selected':''):''}}>{{__('common.Active') }}</option>
                                            <option
                                                value="0" {{isset($edit)?($edit->status==0?'selected':''):''}}>{{__('common.Inactive') }}</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-12 text-center">
                                    <div class="d-flex justify-content-center pt_20">
                                        <button type="submit" class="primary-btn semi_large fix-gr-bg"
                                                id="save_button_parent">
                                            <i class="ti-check"></i>
                                            @if(!isset($edit)) {{ __('common.Save') }} @else {{ __('common.Update') }} @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex mb-0">
                            <h3 class="mb-0">{{__('frontendmanage.Testimonial')}} </h3>
                        </div>
                    </div>
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.ID') }}</th>
                                        <th scope="col">{{ __('frontendmanage.Body') }}</th>
                                        <th scope="col">{{ __('frontendmanage.Author') }}</th>
                                        <th scope="col">{{ __('frontendmanage.Profession') }}</th>
                                        <th scope="col">{{ __('common.Image') }}</th>
                                        <th scope="col">{{ __('frontendmanage.Date') }}</th>

                                        <th scope="col">{{ __('common.Status') }}</th>
                                        <th scope="col">{{ __('common.Star') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach($data['testimonials'] as $key => $item)
                                        <tr>
                                            <th>{{ $key+1 }}</th>
                                            <td>{{ @$item->body }}</td>
                                            <td>{{ @$item->author }}</td>
                                            <td>{{ @$item->profession }}</td>
                                            <td>
                                                <img src="{{asset('/'.@$item->image)}}" alt=""
                                                     class="img img-responsive"
                                                     style="width: auto; height:100px !important">
                                            </td>
                                            <td>{{ date(getSetting()->date_format->format, strtotime(@$item->created_at)) }}</td>
                                            <td>
                                                <label class="switch_toggle"
                                                       for="status_enable_disable{{ @$item->id }}">
                                                    <input type="checkbox" id="status_enable_disable{{ @$item->id }}"
                                                           class="status_enable_disable"
                                                           @if (@$item->status == 1) checked
                                                           @endif value="{{ @$item->id }}">
                                                    <i class="slider round"></i>
                                                </label>
                                            </td>
                                            <td>
                                                @for($i=1;$i<=$item->star;$i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            </td>
                                            <td>
                                                <!-- shortby  -->
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2">
                                                        <a href="{{route('frontend.testimonials_edit',@$item->id)}}"
                                                           class="dropdown-item edit_brand">{{__('common.Edit')}}</a>
                                                        <a onclick="confirm_modal('{{route('frontend.testimonials_delete', @$item->id)}}');"
                                                           class="dropdown-item edit_brand">{{__('common.Delete')}}</a>
                                                    </div>
                                                </div>
                                                <!-- shortby  -->
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
        </div>
    </section>

    @include('backend.partials.delete_modal')
@endsection
@push('scripts')

@endpush
