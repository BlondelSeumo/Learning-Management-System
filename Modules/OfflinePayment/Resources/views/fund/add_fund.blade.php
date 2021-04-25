@extends('backend.master')
@section('mainContent')
    @php
        $currency = getSetting()->currency;
    @endphp
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('payment.Offline Payment')}} </h1>
                <div class="bc-pages">
                    <a href="{{url('/dashboard')}}">{{__('common.Dashboard')}} </a>
                    <a href="#">{{__('payment.Payment')}} </a>
                    <a href="#">{{__('common.Add')}} {{__('payment.Fund')}} </a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-between">
                <div class="col-md-12">

                    <div class="row student-details student-details_tab mt_0_sm m-0">

                        <!-- Start Sms Details -->
                        <div class="col-lg-12 p-0">
                            <ul class="nav nav-tabs no-bottom-border mt_0_sm mb-20 m-0 justify-content-start" role="tablist">
                                <li class="nav-item mb-0">
                                    <a class="nav-link
                                    @if(Session::has('isStudent'))
                                    @if(!Session::get('isStudent'))
                                        active
                                        @endif
                                    @else
                                        active
                                    @endif
                                        " href="#group_email_sms" selectTab="G" role="tab"
                                       data-toggle="tab">{{__('quiz.Instructor')}}  </a>
                                </li>
                                <li class="nav-item mb-0">
                                    <a class="nav-link
 @if(Session::has('isStudent'))
                                    @if(Session::get('isStudent'))
                                        active
                                        @endif
                                    @endif
                                        " selectTab="I" href="#indivitual_email_sms" role="tab"
                                       data-toggle="tab">{{__('quiz.Student')}}</a>
                                </li>


                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <input type="hidden" name="selectTab" id="selectTab">
                                <div role="tabpanel" class="tab-pane fade   @if(Session::has('isStudent'))
                                @if(!Session::get('isStudent'))
                                    show    active
@endif
                                @else
                                    show   active
@endif" id="group_email_sms">

                                    <div class="QA_section QA_section_heading_custom check_box_table mt-20">
                                        <div class="QA_table ">
                                            <table id="lms_table" class="table Crm_table_active3">
                                                <thead>
                                                <tr>
                                                    <th >{{__('common.Name')}}</th>
                                                    <th >{{__('common.Username')}}</th>
                                                    <th >{{__('common.Email')}}</th>
                                                    <th >{{__('payment.Wallet')}}</th>
                                                    <th>{{__('common.Image')}}</th>
                                                    <th>{{__('common.Action')}}</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($instructor as $value)
                                                    <tr id="{{ @$value->id}}">
                                                        <td>{{@$value->name}}</td>
                                                        <td>{{@$value->username}}</td>
                                                        <td>{{@$value->email}}</td>
                                                        <td>{{$currency->symbol}} {{@$value->balance * @$value->currency->conversion_rate}}</td>

                                                        <td valign="top">
                                                            <div class="profile_info">

                                                                <img
                                                               alt="{{@$value->name}}"     src="{{ @$value->image ? asset(@$value->image) :asset('public/frontend/img/client_img.png') }}"

                                                                    class="add_fund_profile_img">
                                                            </div>
                                                        </td>
                                                        <td>

                                                            <div class="dropdown CRM_dropdown">
                                                                <button class="btn btn-secondary dropdown-toggle"
                                                                        type="button" id="dropdownMenu2{{ @$value->id}}"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    {{__('common.Action')}}
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    @if (permissionCheck('offlinePayment.add'))
                                                                        <a class="dropdown-item" data-toggle="modal"
                                                                           data-target="#AddFund{{@$value->id}}"
                                                                           href="#">{{__('common.Add')}}</a>
                                                                    @endif
                                                                    @if (permissionCheck('offlinePayment.fund-history'))
                                                                        <a class="dropdown-item"
                                                                           href="{{ route('fundHistory',@$value->id)}}"> {{__('payment.Fund History')}} </a>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>

                                                    <div class="modal fade admin-query" id="AddFund{{@$value->id}}">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">{{__('common.Add')}} {{__('payment.Fund')}}</h4>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"><i
                                                                            class="ti-close "></i></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form action="{{route('addBalance')}}"
                                                                          method="post">
                                                                        @csrf
                                                                        <div class="row no-gutters input-right-icon">
                                                                            <div class="col">
                                                                                <div class="input-effect">
                                                                                    <label>{{__('payment.Amount')}}
                                                                                        <span>*</span></label>
                                                                                    <input class="primary_input_field"
                                                                                           id="fund_amount" min="0"
                                                                                           type="number"
                                                                                           placeholder="{{__('payment.Amount')}} {{$currency->symbol}} "
                                                                                           name="amount" value="">
                                                                                    <span class="focus-border"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <input type="hidden" name="user_id"
                                                                               value="{{ @$value->id}}">


                                                                        <div
                                                                            class="mt-40 d-flex justify-content-between">
                                                                            <button type="button"
                                                                                    class="primary-btn tr-bg"
                                                                                    data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                                            <button class="primary-btn fix-gr-bg"
                                                                                    type="submit">{{__('common.Add')}}</button>
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

                                <div role="tabpanel" class="tab-pane fade
 @if(Session::has('isStudent'))
                                @if(Session::get('isStudent'))
                                    show   active
@endif
                                @endif
                                    " id="indivitual_email_sms">

                                    <div class="QA_section QA_section_heading_custom check_box_table mt-20">
                                        <div class="QA_table ">
                                            <!-- table-responsive -->
                                            <table id="lms_table" class="table Crm_table_active3">
                                                <thead>
                                                <tr>
                                                    <th >{{__('common.Name')}}</th>
                                                    <th >{{__('common.Username')}}</th>
                                                    <th >{{__('common.Email')}}</th>
                                                    <th >{{__('payment.Wallet')}}</th>
                                                    <th>{{__('common.Image')}}</th>
                                                    <th>{{__('common.Action')}}</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($student as $value)
                                                    <tr id="{{ @$value->id}}">
                                                        <td>{{@$value->name}}</td>
                                                        <td>{{@$value->username}}</td>
                                                        <td>{{@$value->email}}</td>
                                                        <td>{{$currency->symbol}}  {{@$value->balance * @$value->currency->conversion_rate}}</td>

                                                        <td valign="top">
                                                            <div class="profile_info">

                                                                <img
                                                                    src="{{ @$value->image ? asset(@$value->image) :asset('public/frontend/img/client_img.png') }}"
                                                                    class="add_fund_profile_img">
                                                            </div>
                                                        </td>

                                                        <td>

                                                            <div class="dropdown CRM_dropdown">
                                                                <button class="btn btn-secondary dropdown-toggle"
                                                                        type="button" id="dropdownMenu2{{ @$value->id}}"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    {{__('common.Action')}}
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    @if (permissionCheck('offlinePayment.add'))
                                                                        <a class="dropdown-item" data-toggle="modal"
                                                                           data-target="#AddFund{{@$value->id}}"
                                                                           href="#">{{__('common.Add')}}</a>
                                                                    @endif
                                                                    @if (permissionCheck('offlinePayment.fund-history'))
                                                                        <a class="dropdown-item"
                                                                           href="{{ route('fundHistory',@$value->id)}}"> {{__('payment.Fund History')}} </a>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>

                                                    <div class="modal fade admin-query" id="AddFund{{@$value->id}}">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">{{__('common.Add')}} {{__('payment.Fund')}}</h4>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"><i
                                                                            class="ti-close "></i></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form action="{{route('addBalance')}}"
                                                                          method="post">
                                                                        @csrf
                                                                        <div class="row no-gutters input-right-icon">
                                                                            <div class="col">
                                                                                <div class="input-effect">
                                                                                    <label>{{__('payment.Amount')}}
                                                                                        <span>*</span></label>
                                                                                    <input class="primary_input_field"
                                                                                           id="fund_amount" min="0"
                                                                                           type="number"
                                                                                           placeholder="{{__('payment.Amount')}} {{$currency->name}} "
                                                                                           name="amount" value="">
                                                                                    <span class="focus-border"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <input type="hidden" name="user_id"
                                                                               value="{{ @$value->id}}">
                                                                        <div
                                                                            class="mt-40 d-flex justify-content-between">
                                                                            <button type="button"
                                                                                    class="primary-btn tr-bg"
                                                                                    data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                                            <button class="primary-btn fix-gr-bg"
                                                                                    type="submit">{{__('common.Add')}}</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
