<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <title>Document</title>
    {{--    <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('public/frontend/infixlmstheme') }}/css/style.css">--}}
    <style media="all">
        @media print {

            .common_table_header .table_btn_wrap > ul {
                display: flex;
                align-items: center;
                flex-wrap: wrap;
            }

            .common_table_header .table_btn_wrap > ul > li {
                display: inline-block;
                margin-right: 6px;
            }

            .box_header {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
                align-items: center;
            }

            .main-title h3 {
                font-weight: 500;
                font-size: 18px;
                line-height: 27px;
                color: #202E3B;
            }

            .primary_btn {
                color: #202E3B;
                border: 1px solid #EE2330;
                display: inline-block;
                padding: 7px 23px;
                text-transform: uppercase;
                line-height: 16px;
                font-size: 12px;
                font-weight: 500;
                border-radius: 30px;
                background-color: transparent;
                white-space: nowrap;
            }

            .primary_btn:hover {
                border: 1px solid #EE2330;
                color: #fff;
                background: #EE2330;
            }

            .border_none {
                border: 0 solid transparent;
                border-top: 0 solid transparent !important;
            }

            .invoice_part_iner {
                background-color: #fff;
                padding: 70px 105px;
            }

            .invoice_part_iner h4 {
                font-size: 30px;
                font-weight: 500;
                margin-bottom: 40px;

            }

            .table_border thead {
                background-color: #F6F8FA;
            }

            .table td, .table th {
                padding: 10px 0;
                vertical-align: top;
                border-top: 0 solid transparent;
                color: #79838b;
            }

            .table td, .table th {
                padding: 10px 0;
                vertical-align: top;
                border-top: 0 solid transparent;
                color: #79838b;
            }

            .table_border tr {
                border-bottom: 1px solid #f1f2f3 !important;
            }

            .table_border tr:last-child {
                border-bottom: 0 solid transparent !important;
            }

            th p span, td p span {
                color: #212E40;
            }

            .table th {
                color: #00273d;
                font-weight: 300;
                border-bottom: 1px solid #f1f2f3 !important;
                background-color: #fafafa;
            }

            td h5 {
                font-size: 16px;
                font-weight: 500;
                color: #202E3B;
            }

            td h5 span {
                color: #707DB7;
            }

            td h6 {
                font-size: 14px;
                font-weight: 500;
                color: #202E3B;
            }

            td h3 {
                font-size: 24px;
                font-weight: 500;
                color: #202E3B;
            }

            .mt_40 {
                margin-top: 40px;
            }

            .table_header_logo {
                padding: 10px 0 40px !important;
            }

            .table_header_logo td {
                width: 50%;
                padding: 10px 0 40px !important;
                border-top: 0 solid transparent;
            }

            .table_header_logo img {
                margin-top: 12px;
            }

            .table_header_logo .btn_3 {
                text-align: right;
                float: right;
            }

            .invoice_btn .btn_1 {
                width: 100%;
                margin-bottom: 15px;
                text-align: center;
            }

            .invoice_btn .btn_1 i {
                margin-right: 8px;
            }

            .invoice_btn .btn_1:hover {
                color: #fff;
            }

            .invoice_btn .download {
                background-color: #E63E45;
            }

            .invoice_btn .print {
                background-color: #2EC9B8;
                border: 1px solid #2EC9B8;
            }

            .table_style th, .table_style td {
                padding: 20px;
            }

            td p {
                color: #707DB7;
                font-size: 16px;
                font-weight: 500;
                margin-bottom: 0;
                line-height: 24px
            }

            hr {
                border-top: 1px solid #202E3B !important;
                opacity: .1 !important;
            }

            .table.blueish_table thead th {

                color: #202E3B;
                font-size: 12px;
                font-weight: 500;
                text-transform: uppercase;
                border-top: 0;
                padding: 25px 12px 25px 20px !important;
                white-space: nowrap;

            }

            .table.blueish_table tbody td {

                padding: 25px 12px 25px 20px !important;
                background: #F6F7FB;
                font-weight: 400;
            }

            .table.blueish_table tbody td h6 {
                font-weight: 400;
            }

            .tax_vat_amount_table td {
                padding: 0 0 9px 0 !important;
            }

            .invoice_grid {
                display: grid;
                grid-template-columns: 90px auto;
                margin-bottom: 10px;
                grid-gap: 25px;
            }

        }

    </style>
</head>

<body>


<div id="invoice_print" class="invoice_part_iner">
    <table style=" margin-bottom: 30px" class="table">
        <tbody>
        <tr>
            <td>
                <img style="width: 108px" src="{{getCourseImage(getSetting()->logo)}}"
                     alt="{{ getSetting()->site_name }}">
            </td>
            <td style="text-align: right">
                <h3 class="invoice_no" style=" margin-bottom: 10px" ;>INV-{{$enroll->id+1000}}</h3>
            </td>
        </tr>
        </tbody>
    </table>


    <table style="margin-bottom: 0 !important;" class="table">
        <tbody>
        <tr>
            <td class="w-50">
                <p class="invoice_grid"
                   style="font-size:14px; font-weight: 400; color:#3C4777;">
                    <span>Date: </span><span>{{date('d F Y',strtotime(@$enroll->billing->created_at))}}</span>
                </p>
                <p class="invoice_grid"
                   style="font-size:14px; font-weight: 400; color:#3C4777;">
                    <span>Pay Method: </span><span>{{$enroll->payment_method}}</span></p>
                <p class="invoice_grid"
                   style="font-size:14px; font-weight: 400; color:#3C4777;">
                    @if($enroll->courses->sum('purchase_price') == 0 )
                        <span>Status: </span>
                        <span>{{trans('frontendmanage.Paid')}}</span></p>
                @else
                    <span>Status: </span>
                    <span>{{$enroll->status==1?'Paid':'Unpaid'}}</span></p>
                @endif
            </td>

            <td>
                <p class="invoice_grid"
                   style="font-size:14px; font-weight: 400; color:#3C4777;">
                    <span>Company: </span><span>{{getSetting()->site_title}}</span>
                </p>
                <p class="invoice_grid"
                   style="font-size:14px; font-weight: 400; color:#3C4777;">
                    <span>Phone: </span><span>{{getSetting()->phone}}</span></p>
                <p class="invoice_grid"
                   style="font-size:14px; font-weight: 400; color:#3C4777;">
                    <span>Email: </span><span>{{getSetting()->email}}</span></p>
                <p class="invoice_grid"
                   style="font-size:14px; font-weight: 400; color:#3C4777;">
                    <span>Address: </span><span>{{getSetting()->address}}</span>
                </p>
            </td>
        </tr>


        </tbody>
    </table>
    <h4 style=" font-size: 16px; font-weight: 500; color: #000000; margin-top: 0; margin-bottom: 3px "
        ;>Billed To,</h4>

    <span style="font-family: DejaVu Sans"> &#2547;</span>
    <table style="margin-bottom: 35px !important;" class="table">
        <tbody>
        <tr>
            <td>
                <p class="invoice_grid"
                   style="font-size:14px; font-weight: 400; color:#3C4777;">
                    <span>Name: </span><span> {{@$enroll->billing->first_name}} {{@$enroll->billing->last_name}}</span>
                </p>
                <p class="invoice_grid"
                   style="font-size:14px; font-weight: 400; color:#3C4777;">
                    <span>Phone: </span><span> {{@$enroll->billing->phone}} </span>
                </p>
                <p class="invoice_grid"
                   style="font-size:14px; font-weight: 400; color:#3C4777;">
                    <span>Email: </span><span> {{@$enroll->billing->email}} </span>
                </p>
                <p class="invoice_grid"
                   style="font-size:14px; font-weight: 400; color:#3C4777;">
                    <span>Address: </span>
                    <span>
                                            {{@$enroll->billing->address2}}
                        {{@$enroll->billing->city}}, {{@$enroll->billing->zip_code}}
                        {{@$enroll->billing->country}}
                                            </span>
                </p>
            </td>
        </tr>
        </tbody>
    </table>
    <h2 style=" font-size: 18px; font-weight: 500; color: #000000; margin-top: 70px; margin-bottom: 33px "
        ;>Order List</h2>

    <table class="table custom_table3 mb-0">
        <thead>
        <tr>
            <th scope="col">
                                            <span class="pl-3">
                                                #
                                            </span>
            </th>
            <th scope="col">Course name</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>

        @php
            $total =0;
        @endphp
        @if(isset($enroll->courses))
            @foreach($enroll->courses as $key=>$item)
                <tr>
                    <td>
                                                 <span class="pl-3">
                                                {{++$key}}
                                                 </span>
                    </td>
                    <td>
                        <h5>   {{@$item->course->title}}</h5>

                    </td>
                    <td>
                        {{getPriceFormat($item->purchase_price)}}
                    </td>
                </tr>
                @php
                    $total =$total+$item->purchase_price;
                @endphp
            @endforeach
        @endif
        <tr>
            <td></td>
            <td class="text-right">Total</td>
            <td>{{getPriceFormat($total)}}</td>
        </tr>
        </tbody>
    </table>
</div>


</body>
</html>

