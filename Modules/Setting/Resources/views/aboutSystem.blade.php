@extends('backend.master')

@section('mainContent')

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('setting.About System')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('setting.Settings')}}</a>
                    <a href="#">{{__('setting.About System')}}</a>
                </div>
            </div>
        </div>
    </section>


    <section class="admin-visitor-area up_admin_visitor empty_table_tab">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <h1>{{__('setting.About System')}}</h1>
                        <div class="add-visitor">
                            <table style="width:100%; box-shadow: none;"
                                   class="display school-table school-table-style">

                                <tr>
                                    <td>{{__('setting.Software Version')}}</td>
                                    <td>{{(@getSetting()->system_version)}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('setting.Check update')}}</td>
                                    <td><a href="https://codecanyon.net/user/codethemes/portfolio" target="_blank"> <i
                                                class="ti-new-window"> </i> {{__('setting.Update')}} </a></td>
                                </tr>
                                <tr>
                                    <td> {{__('setting.PHP Version')}}</td>
                                    <td>{{phpversion() }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('setting.Curl Enable')}}</td>
                                    <td>@php
                                            if  (in_array  ('curl', get_loaded_extensions())) {
                                                echo 'enable';
                                            }
                                            else {
                                                echo 'disable';
                                            }
                                        @endphp</td>
                                </tr>


                                <tr>
                                    <td>{{__('setting.Purchase code')}}</td>
                                    <td>
                                        {{__('Verified')}}
                                        @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                                            @includeIf('service::license.revoke')
                                        @endif
                                    </td>
                                </tr>


                                <tr>
                                    <td>{{__('setting.Install Domain')}}</td>
                                    <td>{{@getSetting()->system_domain}}</td>
                                </tr>

                                <tr>
                                    <td>{{__('setting.System Activated Date')}}</td>
                                    <td>{{@getSetting()->system_activated_date}}</td>
                                </tr>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection




