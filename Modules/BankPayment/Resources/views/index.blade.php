@extends('backend.master')
@section('mainContent')

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('payment.Bank Payment Log')}} </h1>
                <div class="bc-pages">
                    <a href="{{url('/dashboard')}}">{{__('common.Dashboard')}} </a>
                    <a href="#">{{__('payment.Payment')}} </a>
                    <a href="#">{{__('payment.Bank Payment Log')}}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">

            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h3 class="mb-0">{{__('payment.Payment')}}  </h3>
                    </div>
                </div>
                <!-- </div> -->
                <div class="col-lg-12  mt_25">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{__('common.SL')}}</th>
                                        <th scope="col">{{__('common.User')}}</th>
                                        <th scope="col">{{__('setting.Bank Name')}}</th>
                                        <th scope="col">{{__('setting.Branch Name')}}</th>
                                        <th scope="col">{{__('setting.Account Type')}}</th>
                                        <th scope="col">{{__('setting.Account Holder')}}</th>
                                        <th scope="col">{{__('setting.Account Number')}}</th>
                                        <th scope="col">  {{__('payment.Amount')}}</th>
                                        <th scope="col">{{__('common.Status')}}</th>
                                        <th scope="col">{{__('common.Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payments as $key =>$payment)

                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$payment->user->name}}</td>
                                            <td>{{$payment->bank_name}}</td>
                                            <td>{{$payment->branch_name}}</td>
                                            <td>{{$payment->account_type}}</td>
                                            <td>{{$payment->account_holder}}</td>
                                            <td>{{$payment->account_number}}</td>
                                            <td>{{$payment->amount}}</td>
                                            <td>
                                                <div class="primary-btn small fix-gr-bg">
                                                    {{$payment->status==0?'Pending':'Approved'}}
                                                </div>
                                            </td>

                                            <td>
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2{{$payment->id}}" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{__('common.Action')}}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2{{$payment->id}}">

                                                        <a  target="_blank" href="{{asset($payment->image)}}"
                                                           class="dropdown-item"
                                                          >View</a>
                                                        @if($payment->status==0)
                                                            <button  data-toggle="modal"
                                                               data-target="#approve{{@$payment->id}}"
                                                               class="dropdown-item"
                                                               type="button">Approve</button>
                                                        @endif
                                                        <button   data-toggle="modal"
                                                           data-target="#delete{{@$payment->id}}" class="dropdown-item"
                                                           type="button">{{__('common.Delete')}}</button>

                                                    </div>
                                                </div>

                                            </td>
                                        </tr>

                                        <div class="modal fade admin-query" id="approve{{@$payment->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Approve {{__('payment.Payment')}} </h4>
                                                        <button type="button" class="close" data-dismiss="modal"><i
                                                                class="ti-close "></i></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">

                                                            <h4>Are you sure ?</h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal">{{__('common.Cancel')}}</button>

                                                            <form method="post"
                                                                  action="{{route('bankPayment.update', [$payment->id])}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="primary-btn fix-gr-bg"
                                                                        type="submit">Approve
                                                                </button>
                                                            </form>


                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade admin-query" id="delete{{@$payment->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{__('common.Delete')}} {{__('payment.Payment')}} </h4>
                                                        <button type="button" class="close" data-dismiss="modal"><i
                                                                class="ti-close "></i></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">

                                                            <h4>{{__('common.Are you sure to delete ?')}} </h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal">{{__('common.Cancel')}}</button>

                                                            <form method="post"
                                                                  action="{{route('bankPayment.destroy', [$payment->id])}}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="primary-btn fix-gr-bg"
                                                                        type="submit">{{__('common.Delete')}}</button>
                                                            </form>


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
