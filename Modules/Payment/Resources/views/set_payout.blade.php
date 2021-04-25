@extends('backend.master')
@section('mainContent')
    @php
        $table_name='withdraws';
    @endphp
@section('table'){{$table_name}}@endsection
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>{{__('withdraw.Instructor Payment')}}</h1>
            <div class="bc-pages">
                <a href="{{url('/dashboard')}}">{{__('common.Dashboard')}} </a>
                <a href="#">{{__('quiz.Report')}} </a>
                <a href="#">{{__('common.Dashboard')}}</a>
            </div>
        </div>
    </div>

</section>
<section class="mb-40 student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="row pt-20">
                    <div class="main-title pt-10">
                        <h3 class="mb-30 ml-3">{{__('withdraw.Set Payout')}}</h3>
                    </div>
                    <ul class="nav nav-tabs no-bottom-border  mt-sm-md-20 mb-30 ml-3" role="tablist">
                        @foreach($payment_methods as $key => $method)
                            <li class="nav-item m-1">
                                <a class="nav-link {{ $user->payout == $method->method ? 'active' : ''}}"
                                   href="#tab_{{$method->id}}"
                                   role="tab" data-toggle="tab">{{$method->method}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tab panes -->
                <div class="tab-content">
                    @foreach($payment_methods as $key => $method)
                        <div role="tabpanel"
                             class="tab-pane fade {{  $user->payout == $method->method ? 'active show' : ''}}"
                             id="tab_{{$method->id}}">
                            <form class="form-horizontal" action="{{route('save.payout.email')}}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="white-box">
                                    <div class="col-md-12 ">
                                        <div class="row mb-30">
                                            <div class="col-md-12">
                                                <input type="hidden" name="payout_icon" value="{{$method->logo}}">
                                                <input type="hidden" name="payout" value="{{$method->method}}">

                                                @if($method->method=="Bank Payment")
                                                    <div class="row">
                                                        <div class="col-lg-6 mb-30">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control"
                                                                       type="text" name="bank_name"
                                                                       autocomplete="off"
                                                                       value="{{$user->bank_name}}">
                                                                <label> {{__('setting.Bank Name')}} </label>
                                                                <span class="focus-border"></span>
                                                                <span class="modal_input_validation red_alert"></span>
                                                            </div>
                                                            <span
                                                                class="error text-danger">{{$errors->first('bank_name')}}</span>
                                                        </div>

                                                        <div class="col-lg-6 mb-30">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control"
                                                                       type="text" name="branch_name"
                                                                       autocomplete="off"
                                                                       value="{{$user->branch_name}}">
                                                                <label> {{__('setting.Branch Name')}}</label>
                                                                <span class="focus-border"></span>
                                                                <span class="modal_input_validation red_alert"></span>
                                                            </div>
                                                            <span
                                                                class="error text-danger">{{$errors->first('branch_name')}}</span>
                                                        </div>


                                                        <div class="col-lg-6 mb-30">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control"
                                                                       type="text" name="bank_account_number"
                                                                       autocomplete="off"
                                                                       value="{{$user->bank_account_number}}">
                                                                <label>{{__('setting.Account Number')}} </label>
                                                                <span class="focus-border"></span>
                                                                <span class="modal_input_validation red_alert"></span>
                                                            </div>
                                                            <span
                                                                class="error text-danger">{{$errors->first('bank_account_number')}}</span>
                                                        </div>

                                                        <div class="col-lg-6 mb-30">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control"
                                                                       type="text" name="account_holder_name"
                                                                       autocomplete="off"
                                                                       value="{{$user->account_holder_name}}">
                                                                <label> {{__('setting.Account Holder')}}</label>
                                                                <span class="focus-border"></span>
                                                                <span class="modal_input_validation red_alert"></span>
                                                            </div>
                                                            <span
                                                                class="error text-danger">{{$errors->first('account_holder_name')}}</span>
                                                        </div>


                                                        <div class="col-lg-6 mb-30">
                                                            <div class="input-effect">
                                                                <select class="primary_select" name="bank_type"
                                                                        id="bank_type"
                                                                        style="margin-top: -10px;">
                                                                    <option
                                                                        data-display="{{__('common.Select')}}  {{__('setting.Account Type')}}"
                                                                        value="">{{__('common.Select')}} {{__('setting.Account Type')}}</option>
                                                                    <option
                                                                        value="Current Account" {{($user->bank_type? $user->bank_type : '')=='Current Account'?'selected':''}}>
                                                                        Current Account
                                                                    </option>

                                                                    <option
                                                                        value="Savings Account" {{($user->bank_type? $user->bank_type : '')=='Savings Account'?'selected':''}}>
                                                                        Savings Account
                                                                    </option>
                                                                    <option
                                                                        value="Salary Account" {{($user->bank_type? $user->bank_type : '')=='Salary Account'?'selected':''}}>
                                                                        Salary Account
                                                                    </option>
                                                                    <option
                                                                        value="Fixed Deposit" {{($user->bank_type? $user->bank_type : '')=='Fixed Deposit'?'selected':''}}>
                                                                        Fixed Deposit
                                                                    </option>

                                                                </select>
                                                                <span class="focus-border"></span>
                                                                <span class="modal_input_validation red_alert"></span>
                                                            </div>
                                                            <span
                                                                class="error text-danger">{{$errors->first('bank_type')}}</span>
                                                        </div>
                                                    </div>

                                                @else


                                                    <div class="row">
                                                        <div class="col-lg-12 mb-30">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control"
                                                                       type="text" name="payout_email"
                                                                       autocomplete="off"
                                                                       value="@if(strtolower($method->method)==strtolower($user->payout)){{$user->payout_email}}@endif">
                                                                <label>{{$method->method}} {{__('withdraw.Payout Email')}}
                                                                    <span></span> </label>
                                                                <span class="focus-border"></span>
                                                                <span class="modal_input_validation red_alert"></span>
                                                            </div>
                                                            <span
                                                                class="error text-danger">{{$errors->first('payout_email')}}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                                <button class="primary-btn fix-gr-bg">
                                                    <span class="ti-check"></span>
                                                    {{__('common.Update')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
