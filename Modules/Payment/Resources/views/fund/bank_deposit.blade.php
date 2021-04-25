
@extends('backend.master')
@push('styles')
    <link rel="stylesheet" href="{{asset('public/backend/')}}/approved_deposit.css">
@endpush
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.bank_deposit_request')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                <a href="#">@lang('lang.bank_payment') </a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row mt-40 mb-25">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 no-gutters">
                            <div class="main-title">
                            <h3 class="mb-0">{{@$user_info->full_name}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="15%">@lang('lang.dipositor')</th>
                                <th width="15%">@lang('lang.amount')</th>
                                <th width="40%">@lang('lang.bank_info')</th>
                                <th width="15%">@lang('lang.date')</th>
                                <th width="15%">@lang('lang.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($bank_deposits as $value)
                                <tr>
                                {{-- <td>{{@$value->id}}</td> --}}
                                <td>{{@$value->full_name}}</td>
                                <td>{{@$value->amount}}</td>
                                <td>
                                    <ul>
                                        <li>@lang('lang.name'): {{@$value->bank_name}} </li>
                                        <li>@lang('lang.account_no'): {{@$value->account_number}} </li>
                                        <li>@lang('lang.owner_name') : {{@$value->owner_name}} </li>
                                    </ul>
                                </td>
                                <td>{{@$value->created_at->format('Y-m-d')}}</td>
                                <td>
                                    @if (@$value->status==1)
                                        @lang('lang.approved')
                                    @else


                                    <div class="row">
                                    <div class="col-sm-6">

                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            @lang('lang.select')
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            {{-- <a class="dropdown-item" data-toggle="modal" data-target="#EditFund{{@$value->id}}"  href="#">@lang('lang.edit')</a> --}}
                                            <a class="dropdown-item" data-toggle="modal" data-target="#DeleteFund{{@$value->id}}"  href="#">@lang('lang.delete')</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#ApproveDeposit{{@$value->id}}"  href="#">@lang('lang.approve')</a>


                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </tr>


                            <div class="modal fade admin-query" id="EditFund{{@$value->id}}" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">@lang('lang.edit') @lang('lang.fund')</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                        <form action="{{url('admin/update-fund')}}" method="post">
                                        @csrf
                                            <div class="row no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="input-effect">
                                                    <input class="primary-input form-control" id="fund_amount" min="0" type="number" name="fund_amount" value="{{@$value->amount}}">
                                                        <label>@lang('lang.amount')<span>*</span></label>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="fund_id" value="{{ @$value->id}}">
                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>

                                                <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.update')</button>

                                            </div>

                                        </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="modal fade admin-query" id="DeleteFund{{@$value->id}}" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">@lang('lang.delete') @lang('lang.deposit')</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                            </div>

                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                  <a href="{{ route('admin.depositDelete',@$value->id)}}" class="text-light">
                                                <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                 </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal fade admin-query" id="ApproveDeposit{{@$value->id}}" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">@lang('lang.approve') @lang('lang.deposit')</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4>@lang('lang.are_you_sure_to_approve_this_deposit_request')</h4>
                                            </div>

                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                  <a href="{{ route('admin.approveDeposit',@$value->id)}}" class="text-light">
                                                <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.approve')</button>
                                                 </a>
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
</section>


@endsection
