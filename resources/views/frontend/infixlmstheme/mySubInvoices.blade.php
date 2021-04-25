@extends('frontend.infixlmstheme.layouts.dashboard_master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | Invoice @endsection
@section('css')
    <link href="{{asset('public/frontend/infixlmstheme/css/my_invoice.css')}}" rel="stylesheet"/>
@endsection
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor pt-5 mt-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-xl-9">
                    <div class="box_header common_table_header">
                        <div class="main-title d-flex">
                            <h3 class="mb-0 mr-30 text-uppercase">INV-{{$enroll->id+1000}}</h3>
                        </div>
                        <div class="table_btn_wrap">
                            <ul>

                                <li>
                                    <button class="primary_btn printBtn">{{__('student.Print')}}</button>
                                </li>
                                <li>
                                    <button class="primary_btn downloadBtn">{{__('student.Download')}}</button>

                                    {{--    <a href="{{route('purchase-invoice',$enroll->id)}}" target="_blank"
                                           class="primary_btn">{{__('student.Download')}}</a>--}}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- invoice print part here -->
                    <div class="invoice_print pb-5">
                        <div class="container-fluid p-0">
                            <div id="invoice_print" class="invoice_part_iner">
                                <table style=" margin-bottom: 30px" class="table">
                                    <tbody>
                                    <td>
                                        <img style="width: 108px" src="{{getCourseImage(getSetting()->logo)}}"
                                             alt="{{ getSetting()->site_name }}">
                                    </td>
                                    <td style="text-align: right">
                                        <h3 class="invoice_no black_color" style=" margin-bottom: 10px" ;>
                                            INV-{{$enroll->id+1000}}</h3>
                                    </td>
                                    </tbody>
                                </table>

                                <table style="margin-bottom: 0 !important;" class="table">
                                    <tbody>
                                    <tr>
                                        <td class="w-50">
                                            <p class="invoice_grid"
                                               style="font-size:14px; font-weight: 400; color:#3C4777;">
                                                <span
                                                    class="black_color">{{__('student.Date')}}: </span><span>{{date('d F Y',strtotime(@$enroll->billing->created_at))}}</span>
                                            </p>
                                            <p class="invoice_grid"
                                               style="font-size:14px; font-weight: 400; color:#3C4777;">
                                                <span
                                                    class="black_color">{{__('student.Pay Method')}}: </span><span>{{$enroll->payment_method}}</span>
                                            </p>
                                            <p class="invoice_grid"
                                               style="font-size:14px; font-weight: 400; color:#3C4777;">
                                                @if($enroll->price == 0 )
                                                    <span class="black_color">{{__('student.Status')}}: </span>
                                                    <span class="black_color">{{__('common.Paid')}}</span></p>
                                            @else
                                                <span class="black_color">{{__('student.Status')}}: </span>
                                                <span
                                                    class="black_color">{{$enroll->status==1?__('student.Paid'):__('student.Unpaid')}}</span></p>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="invoice_grid"
                                               style="font-size:14px; font-weight: 400; color:#3C4777;">
                                                <span
                                                    class="black_color">{{__('student.Company')}}: </span><span>{{getSetting()->site_title}}</span>
                                            </p>
                                            <p class="invoice_grid"
                                               style="font-size:14px; font-weight: 400; color:#3C4777;">
                                                <span
                                                    class="black_color">{{__('student.Phone')}}: </span><span>{{getSetting()->phone}}</span>
                                            </p>
                                            <p class="invoice_grid"
                                               style="font-size:14px; font-weight: 400; color:#3C4777;">
                                                <span
                                                    class="black_color">{{__('student.Email')}}: </span><span>{{getSetting()->email}}</span>
                                            </p>
                                            <p class="invoice_grid"
                                               style="font-size:14px; font-weight: 400; color:#3C4777;">
                                                <span
                                                    class="black_color">{{__('student.Address')}}: </span><span>{{getSetting()->address}}</span>
                                            </p>
                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                                <h4 style=" font-size: 16px; font-weight: 500; color: #000000; margin-top: 0; margin-bottom: 3px "
                                    class="black_color"
                                    ;>{{__('student.Billed To')}},</h4>

                                <table style="margin-bottom: 35px !important;" class="table">
                                    <tbody>
                                    <td>
                                        <p class="invoice_grid"
                                           style="font-size:14px; font-weight: 400; color:#3C4777;">
                                            <span
                                                class="black_color">{{__('student.Name')}}: </span><span> {{@$enroll->billing->first_name}} {{@$enroll->billing->last_name}}</span>
                                        </p>
                                        <p class="invoice_grid"
                                           style="font-size:14px; font-weight: 400; color:#3C4777;">
                                            <span
                                                class="black_color">{{__('student.Phone')}}: </span><span> {{@$enroll->billing->phone}} </span>
                                        </p>
                                        <p class="invoice_grid"
                                           style="font-size:14px; font-weight: 400; color:#3C4777;">
                                            <span
                                                class="black_color">{{__('student.Email')}}: </span><span> {{@$enroll->billing->email}} </span>
                                        </p>
                                        <p class="invoice_grid"
                                           style="font-size:14px; font-weight: 400; color:#3C4777;">
                                            <span class="black_color">{{__('student.Address')}}: </span>
                                            <span class="black_color">
                                            {{@$enroll->billing->address2}}
                                                {{@$enroll->billing->city}}, {{@$enroll->billing->zip_code}}
                                                {{@$enroll->billing->country}}
                                            </span>
                                        </p>
                                    </td>
                                    </tbody>
                                </table>
                                <h2 style=" font-size: 18px; font-weight: 500; color: #000000; margin-top: 70px; margin-bottom: 33px "
                                    class="black_color"
                                    ;>{{__('student.Order List')}}</h2>

                                <table class="table custom_table3 mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">
                                            <span class="pl-3">
                                            {{__('common.SL')}}
                                            </span>
                                        </th>
                                        <th scope="col" class="black_color">{{__('subscription.Plan')}}</th>
                                        <th scope="col">{{__('subscription.Start Date')}}</th>
                                        <th scope="col">{{__('subscription.End Date')}}</th>
                                        <th scope="col">{{__('subscription.Days')}}</th>


                                        <th scope="col" class="black_color">{{__('student.Price')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total =0;
                                    @endphp
                                    @if(isset($enroll->plan))

                                            <tr>
                                                <td class="black_color">
                                                 <span class="pl-3">
                                                1
                                                 </span>
                                                </td>
                                                <td>
                                                    <h5 class="black_color">   {{@$enroll->plan->title}}</h5>

                                                </td>
                                                <td>{{ date(getSetting()->date_format->format, strtotime(@$enroll->plan->start_date)) }}</td>
                                                <td>{{ date(getSetting()->date_format->format, strtotime(@$enroll->plan->end_date)) }}</td>
                                                <td> {{@$enroll->plan->days}}    </td>
                                                <td class="black_color">
                                                    {{getPriceFormat($enroll->plan->price)}}
                                                </td>
                                            </tr>


                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- invoice print part end -->
                </div>
            </div>
        </div>
    </section>
    <div id="editor"></div>

@endsection
@section('js')
    <script src="{{ asset('public/frontend/infixlmstheme') }}/js/html2pdf.bundle.js"></script>
    <script src="{{ asset('public/frontend/infixlmstheme/js/my_invoice.js') }}"></script>
@endsection
