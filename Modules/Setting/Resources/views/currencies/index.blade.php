@extends('backend.master')
@section('mainContent')
    @include("backend.partials.alertMessage")

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> {{ __('setting.Currency List') }}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('setting.Setting')}}</a>
                    <a class="active" href="#"> {{ __('setting.Currency List') }}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="box_header common_table_header">
                                <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('setting.Currency List') }}</h3>
                                    <ul class="d-flex">
                                        @if (permissionCheck('currency.stor'))
                                            <li><a data-toggle="modal"class="primary-btn radius_30px mr-10 fix-gr-bg" href="#" onclick="open_add_currency_modal()"><i class="ti-plus"></i>{{ __('common.Add New') }} {{ __('common.Currency') }}</a></li>
                                        @endif
                                    </ul>
                                </div>
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
                                        <th scope="col">{{ __('setting.Code') }}</th>
                                        <th scope="col">{{ __('setting.Symbol') }}</th>
                                        <th scope="col">{{ __('setting.Conversion Rate') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($currencies as $key=>$currency)
                                        <tr>
                                            <th>{{ $key+1 }}</th>
                                            <td>{{ $currency->name }}</td>
                                            <td>{{ $currency->code }}</td>
                                            <td>{{ $currency->symbol }}</td>
                                            <td>{{ $currency->conversion_rate }}</td>
                                            <td>
                                                <!-- shortby  -->
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                        @if (permissionCheck('currencies.edit_modal'))
                                                            <a href="#" data-toggle="modal" data-target="#Item_Edit" class="dropdown-item edit_brand" onclick="edit_currency_modal({{ $currency->id }})">{{__('common.Edit')}}</a>
                                                        @endif
                                                        @if ($currency->id > 120)
                                                            @if (permissionCheck('currencies.destroy'))
                                                                <a onclick="confirm_modal('{{route('currencies.destroy', $currency->id)}}');" class="dropdown-item edit_brand">{{__('common.Delete')}}</a>
                                                            @endif
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
       <div id="add_currency_modal">
        <div class="modal fade admin-query" id="currency_add">
            <div class="modal-dialog modal_800px modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('common.Add New') }} {{ __('common.Currency') }}</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="ti-close "></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('currencies.store') }}" method="POST" id="currency_addForm">
                            @csrf
                            <div class="row">

                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('common.Name') }} <strong class="text-danger">*</strong></label>
                                        <input name="name" class="primary_input_field name" placeholder="Dollar" type="text" required>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('setting.Code') }} <strong class="text-danger">*</strong></label>
                                        <input name="code" class="primary_input_field name" placeholder="USD" type="text" required>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('setting.Symbol') }} <strong class="text-danger">*</strong></label>
                                        <input name="symbol" class="primary_input_field name" placeholder="$" type="text" required>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('setting.Conversion Rate') }} <strong class="text-danger">*</strong></label>
                                        <input name="conversion_rate" class="primary_input_field name" placeholder="1" type="text" required>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center">
                                    <div class="d-flex justify-content-center pt_20">
                                        <button type="submit" class="primary-btn semi_large2  fix-gr-bg"
                                                id="save_button_parent"><i
                                                class="ti-check"></i>{{ __('common.Save') }}
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
    <input type="hidden" name="currency_edit" class="currency_edit" value="{{ route('currencies.edit_modal') }}">

    @include('backend.partials.delete_modal')
@endsection
@push('scripts')
    <script src="{{asset('public/backend/js/currency.js')}}"></script>
@endpush
