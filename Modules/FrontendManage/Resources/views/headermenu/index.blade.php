@extends('backend.master')
@section('mainContent')
    @push('styles')
        <link href="{{asset('public/backend/vendors/nestable/jquery.nestable.min.css')}}" rel="stylesheet">
        <link href="{{asset('public/backend/css/headermenu.css')}}" rel="stylesheet">
        <style>
            .dd {
                position: relative;
                display: block;
                margin: 0;
                padding: 0;
                max-width: 100%;
                list-style: none;
                font-size: 13px;
                line-height: 20px;
            }


            .dd-list {
                display: block;
                position: relative;
                margin: 0;
                padding: 0;
                list-style: none;
            }


            .dd-list .dd-list {
                padding-left: 30px;
            }


            .dd-collapsed .dd-list {
                display: none;
            }


            .dd-item,
            .dd-empty,
            .dd-placeholder {
                display: block;
                position: relative;
                margin: 0;
                padding: 0;
                min-height: 20px;
                font-size: 13px;
                line-height: 20px;
                margin-bottom: 5px;
            }


            .dd-handle {
                display: block;
                margin: 0px;
                text-decoration: none;
                border: 1px solid #ebebeb;
                background: rgba(0, 0, 0, .03);
                -webkit-border-radius: 3px;
                border-radius: 0px;
                background: #F5F7FB;
                padding: 2px 10px;
                border: 0;
                height: 50px;
                line-height: 46px;
                font-size: 14px;
                font-weight: 400;
                color: #415094;
                padding-left: 30px;
                cursor: grab;

            }


            .dd-handle .menu_icon {
                float: left;
                padding: 0px 16px;
                font-size: 14px;
                font-weight: 400;
                border: 0;
                border: 1px solid #F5F7FB;
                box-sizing: border-box;
                border-radius: 23px 0px 0px 23px;
                color: #415094;
                background: #fff;
                height: 46px;
                margin-right: 12px;
                position: absolute;
                left: 0;
                top: 0;
            }


            .edit_icon {
                float: right;
                cursor: pointer;
                font-size: 16px;
                color: #707DB7;
                font-weight: 400;
                padding-right: 20px;
                height: 46px;
                line-height: 46px;
                position: absolute;
                right: 0;
                top: 0;
            }


            .dd-item > button {
                display: none;
                position: relative;
                cursor: pointer;
                float: left;
                width: 60px;
                height: 46px;
                padding: 0;
                text-indent: 100%;
                white-space: nowrap;
                overflow: hidden;
                border: 0;
                background: transparent;
                font-size: 12px;
                line-height: 1;
                text-align: center;
                font-weight: bold;
                line-height: 46px;
                margin-left: 0px;
                z-index: 99;
                width: 38px;
            }


            .dd-item > button:before {
                content: "\e61a";
                position: absolute;
                left: 0;
                top: 0;
                font-family: 'themify';
                font-size: 14px;
                color: #415094;
                top: 0px;
                left: 0px;
                font-size: 14px;
            }


            .dd-item > button[data-action="collapse"]:before {
                content: '\e622';
                font-size: 14px;
            }


            .dd-placeholder,
            .dd-empty {
                margin: 5px 0;
                padding: 0;
                min-height: 46px;
                background: #f2fbff;
                border: 1px dashed #415094;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                border-radius: 10px;
            }


            .dd-empty {
                border: 1px dashed #415094;
                min-height: 100px;
                background-color: #e5e5e5;
                background-size: 60px 60px;
                background-position: 0 0, 30px 30px;
            }


            .dd-dragel {
                position: absolute;
                pointer-events: none;
                z-index: 9999;
            }


            .dd-dragel > .dd-item .dd-handle {
                margin-top: 0;
            }


            .dd-dragel .dd-handle {
                -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, 0.1);
                box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, 0.1);
            }

            /**
            * Nestable Extras
            */

            .nestable-lists {
                display: block;
                clear: both;
                padding: 30px 0;
                width: 100%;
                border: 0;
                border-top: 2px solid #ddd;
                border-bottom: 2px solid #ddd;
            }

            @media only screen and (min-width: 700px) {

                .dd + .dd {
                    margin-left: 2%;
                }
            }


            .dd-hover > .dd-handle {
                background: #2ea8e5 !important;
            }

            /**
            * Nestable Draggable Handles
            */

            .dd3-content {
                display: block;
                margin: 5px 0;
                padding: 5px 10px 0px 44px;
                text-decoration: none;
                border: 1px solid #ebebeb;
                background: #fff;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                overflow: hidden;
            }


            .dd-dragel > .dd3-item > .dd3-content {
                margin: 0;
            }


            .dd3-item > button {
                margin-left: 40px;
            }


            .dd3-handle {
                position: absolute;
                margin: 0;
                left: 0;
                top: 0;
                cursor: pointer;
                width: 40px;
                text-indent: 100%;
                white-space: nowrap;
                overflow: hidden;
                border: 1px solid #ebebeb;
                background: #fff;
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
            }


            .dd3-handle:before {
                content: '≡';
                display: block;
                position: absolute;
                left: 0;
                top: 10px;
                width: 100%;
                text-align: center;
                text-indent: 0;
                color: #ccc;
                font-size: 20px;
                font-weight: normal;
            }


            .dd3-handle:hover {
                background: #f7f7f7;
            }

            .collapge_arrow_normal::after {
                content: "\f107";
                color: #ffffff;
                top: 4px;
                right: 4px;
                padding-top: 5px;
                position: absolute;
                font-family: "Font Awesome\ 5 Free";
            }

            .panel-title[aria-expanded="true"] .collapge_arrow_normal::after {
                content: "\f106";
            }

            .btn_zindex {
                z-index: 1000;
            }

            .btn_div {
                margin-top: -43px;
                max-height: 10px;
            }

            .mt-55 {
                margin-top: 55px !important;
            }

            .column_header {
                padding: 10px;
                background: #415094;
                color: #fff;
            }

            .item_list .card_header {
                background: #415094;
                color: #fff;
            }

            .item_list .card_header h4 {
                color: #fff;
            }

            .card_header_element {
                padding: 3px 1.25rem;
                padding-top: 10px;
                padding-bottom: 0px;
            }

            .card_header_element .pull-right {
                margin-top: -6px;
            }

            .p-15 {
                padding: 15px;
            }

            .card-header {
                padding: 5px;
            }

            .card {
                margin-top: 5px;
            }

            .create-title {
                position: relative;
                cursor: pointer;
            }

            .create-title::after {
                content: "\f107";
                color: #333;
                top: 12px;
                right: 5px;
                position: absolute;
                font-family: "Font Awesome\ 5 Free"
            }

            .create-title[aria-expanded="true"]::after {
                content: "\f106";
            }

            .cust-btn-link {
                color: #415094;
                text-decoration: none !important;
            }

            .cust-btn-link:hover {
                text-decoration: none !important;

            }
            .button {
                border: none;
                color: white;
                padding: 10px 14px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                margin-right: 0!important;
                border-radius: 50%;
                height: 40px;
                width: 40px;
                line-height:22px!important;
            }
.settingBtn{
    position: absolute;
    left: 11px;
    top: 14px;;
}

        </style>
    @endpush


    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('frontendmanage.Home Content')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('frontendmanage.Frontend CMS')}}</a>
                    <a class="active"
                       href="{{url('frontendmanage.sectionSetting')}}">{{__('frontendmanage.Menu Manager')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">
                                    @lang('common.Add') @lang('frontendmanage.Header Menu')
                                </h3>
                            </div>
                            @include('frontendmanage::headermenu.menu_list')

                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-30">@lang('frontendmanage.Menu List')</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" id="menuList">
                            @include('frontendmanage::headermenu.submenu_list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Delete Modal Start --}}
        <div class="modal fade admin-query" id="deleteSubmenuItem">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">@lang('common.Delete') @lang('frontendmanage.Sub Menu')</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <h4>@lang('common.Are you sure to delete ?')</h4>
                        </div>
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg"
                                    data-dismiss="modal">@lang('common.Cancel')</button>
                            <input type="hidden" name="id" id="item-delete" value="">
                            <a class="primary-btn fix-gr-bg" id="delete-item" href="#">@lang('common.Delete')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="headermenu_reordering_url" value="{{route('frontend.headermenu.reordering')}}">
        <input type="hidden" id="headermenu_delete_url" value="{{ route('frontend.headermenu.delete') }}">
        <input type="hidden" id="headermenu_edit_url" value="{{route('frontend.headermenu.edit-element')}}">
        <input type="hidden" id="headermenu_add_url" value="{{route('frontend.headermenu.add-element')}}">
        <input type="hidden" id="header_token" value="{{csrf_token()}}">
        {{-- Delete Modal End --}}
    </section>
    @push('scripts')
        <script src="{{asset('public/backend/vendors/nestable/jquery.nestable.min.js')}}"></script>
        <script src="{{asset('public/backend/js/headermenu.js')}}"></script>
        <script>

        </script>
    @endpush
@endsection
