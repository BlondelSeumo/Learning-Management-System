@extends('backend.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>{{__('courses.Revenue')}} {{__('common.Payouts')}}</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                <a href="#">{{__('instructor.Instructors')}}</a>
                <a href="#">{{__('courses.Revenue')}} {{__('common.Payouts')}}</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
                <div class="col-md-3">
                <a href="#" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('payment.Earning')}}</h3>
                                <p class="mb-0">{{__('payment.Total')}} {{__('payment.Earning')}}</p>
                            </div>
                            <h1 class="gradient-color2"> {{$user->currency->symbol}} {{number_format($totalRev * $user->currency->conversion_rate,2)}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
                <div class="col-md-3">
                <a href="#" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('payment.Charge')}}</h3>
                                <p class="mb-0">{{__('common.Author')}} {{__('payment.Charge')}}</p>
                            </div>
                            <h1 class="gradient-color2"> {{$user->currency->symbol}} {{number_format($history['charge'] * $user->currency->conversion_rate,2)}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
                <div class="col-md-3">
                <a href="#" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('common.Available')}}</h3>
                                <p class="mb-0">{{__('common.Payouts')}} {{__('common.Available')}}</p>
                            </div>
                            <h1 class="gradient-color2"> {{$user->currency->symbol}} {{number_format($history['payout'] * $user->currency->conversion_rate,2)}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
                <div class="col-md-3">
                <a href="{{route('userPayoutInfo')}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="mb-0">{{__('payment.Selected Payout Method')}}</p>
                            </div>
                            <h1 class="gradient-color2"> {{@$user->payout}}
                             <div class="tab_thumb">
                                 <img src="{{asset(@$user->payout_icon)}}" >
                              </div>
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center mt-50">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px" >{{__('courses.Revenue')}} {{__('common.Payouts')}}</h3>
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

                                            <th scope="col">{{__('common.SL')}}</th>
                                            <th scope="col">{{__('payment.Invoice Date')}}</th>
                                            <th scope="col">{{__('payment.Amount')}}</th>
                                            <th scope="col">{{__('payment.Payout Method')}}</th>
                                            <th scope="col">{{__('common.Issue Date')}}</th>
                                            <th scope="col">{{__('common.Status')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $key => $log)
                                        <tr>

                                            <th>{{$key+1}}</th>

                                            <td>{{@$log->invoiceDate}}</td>
                                            <td>{{@$user->currency->symbol}} {{number_format($log->amount * $user->currency->conversion_rate,2)}}</td>
                                            <td><strong>{{@$log->user->payout }}</strong></td>
                                                <td>{{@$log->issueDateFormat}}</td>
                                            <td class="nowrap">
                                                @if ($log->status==1)
                                                   <span>
                                                       <span class="btn-sm btn-success">
                                                           <i class="fas fa-check-circle"></i> {{__('setting.Success')}}
                                                        </span>
                                                    </span>
                                                @else
                                                    {{__('courses.Pending')}}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Modal Item_Details -->
            </div>
        </div>
    </div>
</section>

@endsection
