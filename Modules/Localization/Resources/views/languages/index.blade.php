@extends('backend.master')
@section('mainContent')
    @include("backend.partials.alertMessage")
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex mb-0">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('common.Language List') }}</h3>
                            @if (permissionCheck('languages.store'))
                                <ul class="d-flex">
                                    <li><a data-toggle="modal" class="primary-btn radius_30px mr-10 fix-gr-bg" href="#"
                                           onclick="open_add_laguage_modal()"><i
                                                class="ti-plus"></i>{{ __('common.Add New') }} {{ __('common.Language') }}
                                        </a></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.ID') }}</th>
                                        <th scope="col">{{ __('common.Name') }}</th>
                                        <th scope="col">{{ __('setting.Code') }}</th>
                                        <th scope="col">{{ __('setting.RTL/LTL') }}</th>
                                        <th scope="col">{{ __('setting.Active') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($languages as $key=>$language)
                                        <tr>
                                            <th>{{ $key+1 }}</th>
                                            <td>{{ $language->name }}</td>
                                            <td>{{ $language->code }}</td>
                                            <td>
                                                <span class="primary-btn radius_30px mr-10 fix-gr-bg">
                                                    {{ $language->rtl==1?'RTL':'LTL' }}
                                                </span>
                                            </td>
                                            <td>
                                                <label class="switch_toggle" for="active_checkbox{{ $language->id }}">
                                                    <input type="checkbox" id="active_checkbox{{ $language->id }}"
                                                           @if ($language->status == 1) checked
                                                           @endif @if (!permissionCheck('languages.update_active_status')) disabled
                                                           @endif value="{{ $language->id }}"
                                                           onchange="update_active_status(this)">
                                                    <i class="slider round"></i>
                                                </label>
                                            </td>
                                            <td>
                                                <!-- shortby  -->
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2">
                                                        @if (permissionCheck('languages.edit'))
                                                            <a href="#" data-toggle="modal" data-target="#Item_Edit"
                                                               class="dropdown-item edit_brand"
                                                               onclick="edit_language_modal({{ $language->id }})">{{__('common.Edit')}}</a>
                                                        @endif
                                                        @if (permissionCheck('languages.translate_view'))
                                                            <a href="{{ route('language.translate_view', $language->id) }}"
                                                               class="dropdown-item edit_brand">{{ __('setting.Translation') }}</a>
                                                        @endif
                                                        @if ($language->id > 114 && permissionCheck('languages.destroy'))
                                                            <a onclick="confirm_modal('{{route('languages.destroy', $language->id)}}');"
                                                               class="dropdown-item edit_brand">{{__('common.Delete')}}</a>
                                                        @endif
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
    <div id="edit_form">

    </div>
    <div id="add_laguage_modal">
        <div class="modal fade admin-query" id="language_add">
            <div class="modal-dialog modal_800px modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('common.Add New') }} {{ __('common.Language') }}</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="ti-close "></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('languages.store') }}" method="POST" id="language_addForm">
                            @csrf
                            <div class="row">

                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('common.Name') }} <strong
                                                class="text-danger">*</strong></label>
                                        <input name="name" class="primary_input_field name"
                                               placeholder="{{ __('common.Name') }}" type="text" required>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('setting.Code') }} <strong
                                                class="text-danger">*</strong></label>
                                        <input name="code" class="primary_input_field name"
                                               placeholder="{{ __('setting.Code') }}" type="text" required>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('setting.Native Name') }}<strong
                                                class="text-danger">*</strong></label>
                                        <input name="native" class="primary_input_field name"
                                               placeholder="{{ __('setting.Native Name') }}" type="text" required>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center">
                                    <div class="d-flex justify-content-center pt_20">
                                        <button type="submit" class="primary-btn semi_large2 fix-gr-bg"
                                                id="save_button_parent"><i class="ti-check"></i>{{ __('common.Save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="edit_lang" class="edit_lang" value="{{ route('languages.edit_modal') }}">
    <input type="hidden" name="status_update" class="rtl_status" value="{{ route('languages.update_rtl_status') }}">
    <input type="hidden" name="status_update" class="active_status" value="{{ route('languages.update_active_status') }}">
    @include('backend.partials.delete_modal')
@endsection
@push('scripts')
    <script src="{{asset('public/backend/js/language.js')}}"></script>
@endpush
