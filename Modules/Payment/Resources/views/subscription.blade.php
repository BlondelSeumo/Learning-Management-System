
@extends('backend.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>{{__('communication.Subscriptions')}} </h1>
            <div class="bc-pages">
                <a href="{{url('/dashboard')}}">{{__('common.Dashboard')}} </a>
                <a href="#">{{__('communication.Subscriptions')}}</a>
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
                                <th scope="col">{{__('common.Email Address')}}</th>
                                <th scope="col">{{__('communication.Subscriptions')}} {{__('common.Date')}}</th>
                                <th scope="col">{{__('common.Action')}}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($subscriptions as $subscription)
                                <tr>
                                    <td>{{@$subscription->email}}</td>
                                    <td>{{@$subscription->subscriptionDate}}</td>
                                    <td>
                                                 <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   {{__('common.Action')}}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                        @if (permissionCheck('subscriptions.send_mail'))
                                                            <a href="#" data-toggle="modal" data-target="#ComposeMail{{@$subscription->id}}" class="dropdown-item" type="button">{{__('communication.Send Email')}}</a>
                                                        @endif
                                                         @if (permissionCheck('subscriptions.remove'))
                                                            <a href="#" data-toggle="modal" data-target="#removeSubscription{{@$subscription->id}}" class="dropdown-item" type="button">{{__('setting.Remove')}}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                </tr>

                                         <!-- Add Modal New_Expenditure -->
                <div class="modal fade admin-query" id="ComposeMail{{@$subscription->id}}">
                    <div class="modal-dialog modal_800px modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{__('communication.Compose Message')}}</h4>
                                <button type="button" class="close " data-dismiss="modal">
                                    <i class="ti-close "></i>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action="{{route('admin.singleEmailSend')}}" method="POST">
                                @csrf
                                    <div class="row">

                                        <input  type="hidden" value="{{@$subscription->id}}" name="id">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="">{{__('dashboard.Subjects')}}</label>
                                                <input class="primary_input_field" name="subject" placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-35">
                                                <label class="primary_input_label" for="">{{__('setting.Email Body')}}</label>
                                               <textarea class="lms_summernote" name="body" name="" id="" cols="30" rows="10"></textarea>

                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center pt_15">
                                            <div class="d-flex justify-content-center">
                                                <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent"  type="submit"><i class="ti-check"></i> {{__('communication.Send Message')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                 <div class="modal fade admin-query" id="removeSubscription{{@$subscription->id}}" >
                        <div class="modal-dialog  modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__('setting.Remove')}} {{__('communication.Subscriptions')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                                </div>

                                <div class="modal-body">
                                <form action="{{route('admin.subscriptionDelete',[$subscription->id])}}" method="post">
                                    @csrf
                                    <div class="text-center">
                                            <h4>{{__('common.Are You Sure To Remove This?')}}</h4>
                                        </div>

                                    <div class="mt-40 d-flex justify-content-between">
                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">{{__('common.Cancel')}}</button>
                                    <button class="primary-btn fix-gr-bg" type="submit">{{__('setting.Remove')}}</button>
                                    </div>
                                </form>
                                </div>

                            </div>
                        </div>
                    </div>
                <!--/ New_Expenditure -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
</section>


@endsection
