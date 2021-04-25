@extends('backend.master')

@section('table')
    @php
        $table_name='withdraws';
    @endphp
    {{$table_name}}@endsection
@section('mainContent')

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
    @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
        <div class="row justify-content-center mt-50">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="white_box_tittle list_header">
                        <h4>{{__('courses.Advanced Filter')}} </h4>
                    </div>
                    <form action="{{route('admin.instructor.payout')}}" method="GET">

                        <div class="row">

                            <div class="col-lg-3 mt-30">

                                <label class="primary_input_label" for="month">{{__('courses.Month')}}</label>
                                <select name="month" size='1' class="primary_select" id="month">
                                    <option data-display="{{__('common.Select')}} {{__('courses.Month')}}"
                                            value="">{{__('common.Select')}} {{__('courses.Month')}}</option>
                                    @php
                                        for ($i = 0; $i < 12; $i++) {
                                        $time = strtotime(sprintf('%d months', $i));
                                        $label = date('F', $time);
                                        $value = date('n', $time);
                                    @endphp
                                    <option value="{{$value}}"
                                    @if(isset($_GET['month'])) {{$_GET['month']==$value?'selected':''}} @endif>{{$label}}</option>

                                    @php
                                        }
                                    @endphp
                                </select>

                            </div>
                            <div class="col-lg-3 mt-30">

                                <label class="primary_input_label" for="year">{{__('courses.Year')}}</label>
                                <select name="year" size='1' class="primary_select" id="year">
                                    <option data-display="{{__('common.Select')}} {{__('courses.Year')}}"
                                            value="">{{__('common.Select')}} {{__('courses.Year')}}</option>
                                    @php
                                        for ($i = date('Y'); $i > 2010; $i--) {
                                    @endphp
                                    <option value="{{$i}}"
                                    @if(isset($_GET['year'])) {{$_GET['year']==$i?'selected':''}} @endif>{{$i}}</option>


                                    @php            }
                                    @endphp
                                </select>

                            </div>
                            <div class="col-lg-3 mt-30">

                                <label class="primary_input_label"
                                       for="instructor">{{__('courses.Instructor')}}</label>
                                <select class="primary_select" name="instructor" id="instructor">
                                    <option data-display="{{__('common.Select')}} {{__('courses.Instructor')}}"
                                            value="">{{__('common.Select')}} {{__('courses.Instructor')}}</option>
                                    @foreach(@$instructors as $instructor)
                                        <option
                                            value="{{$instructor->id}}"
                                        @if(isset($_GET['instructor'])) {{$_GET['instructor']==$instructor->id?'selected':''}} @endif
                                        >{{@$instructor->name}} </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-lg-3 mt-30">


                                <div class="search_course_btn mt-40">
                                    <button type="submit"
                                            class="primary-btn radius_30px mr-10 fix-gr-bg">{{__('courses.Filter')}} </button>
                                </div>

                            </div>


                            <div class="col-12 mt-20">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-4">
                <div class="white-box p-3" style="height: 200px">
                    <h1>{{__('payment.Balance')}} </h1>
                    <p class="mt-30">{{__('withdraw.You Currently Have')}}
                        @if(Auth::user()->balance==0)
                            {{getSetting()->currency->symbol??'৳'}} 0
                        @else
                            {{getPriceFormat(Auth::user()->balance)}}
                        @endif
                    </p>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="white-box p-3" style="height: 200px">
                    <h1>{{__('withdraw.Next Payout')}}</h1>
                    <p class="mt-10">{{__('withdraw.You Currently Have')}} {{$next_pay!=0?getPriceFormat($next_pay):0 }} {{__('withdraw.in earnings for next months payout') }}</p>

                    @if($next_pay!=0)
                        <button type="button" data-toggle="modal" data-target="#requestForm"
                                class="primary-btn fix-gr-bg mt-40">{{__('withdraw.Payment Request')}}</button>
                    @endif

                </div>
            </div>

            <div class="col-md-4">
                <div class="white-box p-3" style="height: 200px">
                    <h1>{{__('withdraw.Payout Account')}}</h1>
                    <div class="row">
                        <div class="col-md-12">
                            @if(auth()->user()->payout=="Bank Payment")
                                {{--                        <b class="pt-3  ">{{auth()->user()->payout}}</b>--}}
                                <p class="pb-20">
                                    <b>{{__('setting.Bank Name')}}</b>: {{auth()->user()->bank_name}} <br>
                                    <b>{{__('setting.Branch Name')}}</b>: {{auth()->user()->branch_name}} <br>
                                    <b>{{__('setting.Account Number')}}</b>: {{auth()->user()->bank_account_number}}
                                    <br>
                                    <b>{{__('setting.Account Holder')}}</b>: {{auth()->user()->account_holder_name}}
                                    <br>
                                </p>
                            @else
                                <img src="{{asset(auth()->user()->payout_icon)}}" width="100px"
                                     alt="{{auth()->user()->payout_icon}}">
                                <p class="pt-3 pb-3">{{auth()->user()->payout_email}}</p>
                            @endif

                            <a href="{{route('set.payout')}}" class="primary-btn fix-gr-bg pl-2 pr-2" style="    right: 15px;
    width: 120px;
    text-align: center;
    float: right;
    top: 0;
    position: absolute;
    right: 15px;">{{__('withdraw.Set Account')}}</a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row mt-40 mb-25">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">{{__('withdraw.Instructor Payment')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <div class="QA_section QA_section_heading_custom check_box_table mt-30">
                <div class="QA_table ">
                    <!-- table-responsive -->
                    <table id="lms_table" class="table Crm_table_active3">
                        <thead>
                        <tr>
                            <th scope="col">{{__('common.SL')}}</th>
                            <th scope="col">{{__('withdraw.Instructor')}}</th>
                            <th scope="col">{{__('withdraw.Amount')}}</th>
                            <th scope="col">{{__('withdraw.Request Date')}}</th>
                            <th scope="col">{{__('payment.Payment Method')}}</th>
                            <th scope="col">{{__('withdraw.Payment Status')}}</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                                <th scope="col">{{__('common.Action')}}</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($withdraws as $key=> $withdraw)
                            <tr>
                                <th scope="row">
                                    {{@$key+1}}
                                </th>
                                <td>{{@$withdraw->user->name}}</td>
                                <td> {{ getPriceFormat($withdraw->amount)}}</td>

                                <td>{{ date(getSetting()->date_format->format, strtotime(@$withdraw->created_at)) }} </td>
                                <td>

                                    @if($withdraw->method!="Bank Payment")
                                        {{$withdraw->method}} <br>
                                        {{$withdraw->user->payout_email}}

                                    @else
                                        <a href="#" data-toggle="modal"
                                           data-target="#show_{{@$withdraw->id}}">{{$withdraw->method}}</a>


                                        <div class="modal fade admin-query" id="show_{{@$withdraw->id}}">
                                            <div class="modal-dialog   modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{__('setting.Payment Details')}}</h4>
                                                        <button type="button" class="close " data-dismiss="modal">
                                                            <i class="ti-close "></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <table class="table">
                                                            <tr>
                                                                <th>{{__('setting.Bank Name')}}</th>
                                                                <td>
                                                                    @if($withdraw->user->bank_name)
                                                                        {{$withdraw->user->bank_name}}
                                                                    @else
                                                                        N/A
                                                                    @endif</td>
                                                            </tr>

                                                            <tr>
                                                                <th>{{__('setting.Branch Name')}}</th>
                                                                <td>
                                                                    @if($withdraw->user->branch_name)
                                                                        {{$withdraw->user->branch_name}}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>{{__('setting.Account Number')}}</th>
                                                                <td>
                                                                    @if($withdraw->user->branch_name)
                                                                        {{$withdraw->user->bank_account_number}}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>{{__('setting.Account Holder')}}</th>
                                                                <td>
                                                                    @if($withdraw->user->account_holder_name)
                                                                        {{$withdraw->user->account_holder_name}}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>{{__('setting.Account Type')}}</th>
                                                                <td>
                                                                    @if($withdraw->user->bank_type)
                                                                        {{$withdraw->user->bank_type}}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                        </table>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </td>
                                <td>
                                    @if($withdraw->status==1)
                                        Paid
                                    @else
                                        Pending
                                    @endif
                                </td>

                                @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
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
                                                <a href="#" class="dropdown-item makeAsPaid" data-item="{{$withdraw}}"
                                                   type="button">{{__('common.Make Paid')}}</a>

                                            </div>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>



    <div class="modal fade admin-query" id="requestForm">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('withdraw.Confirm')}}</h4>
                    <button type="button" class="close" data-dismiss="modal"><i
                            class="ti-close "></i></button>
                </div>

                <div class="modal-body">
                    <form action="{{route('admin.instructor.instructorRequestPayout')}}" method="post">
                        @csrf

                        <div class="text-center">

                            <h4>{{__('withdraw.Are you Sure, You want to request for payment?')}} </h4>
                        </div>
                        <input type="hidden" name="id" value="" id="studentDeleteId">
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg"
                                    data-dismiss="modal">{{__('common.Cancel')}}</button>

                            <button class="primary-btn fix-gr-bg"
                                    type="submit">{{__('withdraw.Confirm')}}</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade admin-query" id="makeAsPay">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('withdraw.Confirm')}}</h4>
                    <button type="button" class="close" data-dismiss="modal"><i
                            class="ti-close "></i></button>
                </div>

                <div class="modal-body">
                    <form action="{{route('admin.instructor.instructorCompletePayout')}}" method="post">
                        @csrf

                        <div class="text-center">
                            <input type="hidden" value="" name="withdraw_id" id="withdraw_id">
                            <input type="hidden" value="" name="instructor_id" id="instructor_id">
                            <h4>{{__('withdraw.Are you Sure, You want to mark as payment?')}} </h4>
                        </div>
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg"
                                    data-dismiss="modal">{{__('common.Cancel')}}</button>

                            <button class="primary-btn fix-gr-bg"
                                    type="submit">{{__('withdraw.Confirm')}}</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.makeAsPaid', function () {
            let item = $(this).data('item');
            $("#instructor_id").val(item.instructor_id);
            $("#withdraw_id").val(item.id);
            $("#makeAsPay").modal('show');

        });
    </script>
@endpush
