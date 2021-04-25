@extends('setting::layouts.master')

@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('setting.Geo Location')}} </h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}} </a>
                    <a href="#">{{__('setting.Settings')}} </a>
                    <a href="#">{{__('setting.Geo Location')}}</a>
                </div>
            </div>
        </div>
    </section>
    @include("backend.partials.alertMessage")

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">

            <h4 class="pl-4 mb-3">{{__('setting.Geo Location')}}</h4>
            <div class="col-lg-12">
                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table id="lms_table" class="table Crm_table_active3">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('common.SL')}} </th>
                                    <th scope="col"> {{__('common.Name')}} </th>
                                    <th scope="col">{{__('setting.IP Address')}}</th>
                                    <th scope="col">{{__('setting.Country')}}</th>
                                    <th scope="col">{{__('setting.Region')}}</th>
                                    <th scope="col">{{__('setting.City')}}</th>
                                    <th scope="col">{{__('setting.Zip Code')}}</th>
                                    <th scope="col">{{__('setting.Latitude')}}</th>
                                    <th scope="col">{{__('setting.Longitude')}}</th>
                                    <th scope="col">{{__('setting.Login At')}}</th>
                                    <th scope="col">{{__('common.Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($logins as $key=> $login)

                                    <tr>

                                        <th>{{$key+1}}</th>
                                        <td class="nowrap">{{@$login->user->name??''}}</td>
                                        <td class="nowrap">{{@$login->location->ip}}</td>
                                        <td class="nowrap">{{@$login->location->countryName}}</td>
                                        <td class="nowrap">{{@$login->location->regionName}}</td>
                                        <td class="nowrap">{{@$login->location->cityName}}</td>
                                        <td class="nowrap">{{@$login->location->zipCode}}</td>
                                        <td class="nowrap">{{@$login->location->latitude}}</td>
                                        <td class="nowrap">{{@$login->location->longitude}}</td>
                                        <td class="nowrap">{{@$login->created_at->diffForHumans()}}</td>

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
                                                    <a class="dropdown-item geoLocation"
                                                       data-id="{{$login->id}}"
                                                       type="button"
                                                       type="button">{{__('common.Delete')}} </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>


    <div class="modal fade admin-query" id="geoLocation">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('common.Delete')}} </h4>
                    <button type="button" class="close" data-dismiss="modal"><i
                            class="ti-close "></i></button>
                </div>

                <div class="modal-body">
                    <form action="{{route('setting.geoLocation.delete')}}" method="post">
                        @csrf

                        <div class="text-center">

                            <h4>{{__('common.Are you sure to delete ?')}} </h4>
                        </div>
                        <input type="hidden" name="id" value="" id="ipDeleteId">
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg"
                                    data-dismiss="modal">{{__('common.Cancel')}}</button>

                            <button class="primary-btn fix-gr-bg"
                                    type="submit">{{__('common.Delete')}}</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade admin-query" id="add_new_ip">
        <div class="modal-dialog modal_1000px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('setting.Add IP')}}</h4>
                    <button type="button" class="close " data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{route('ipBlock.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{__('setting.IP Address')}} <strong
                                            class="text-danger">*</strong></label>
                                    <input class="primary_input_field" name="ip_address" placeholder="000.000.000.000"
                                           type="text" required
                                           value="{{ old('ip_address') }}" {{$errors->first('ip_address') ? 'autofocus' : ''}}>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{__('common.Block Reason')}} </label>
                                    <input class="primary_input_field" name="reason"
                                           placeholder="Why You want to block this Ip?"
                                           type="text"
                                           value="{{ old('reason') }}" {{$errors->first('reason') ? 'autofocus' : ''}}>
                                </div>
                            </div>


                        </div>

                        <div class="col-lg-12 text-center pt_15">
                            <div class="d-flex justify-content-center">
                                <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent"
                                        type="submit"><i
                                        class="ti-check"></i> {{__('common.Save')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        $(document).on('click', '.geoLocation', function () {

            let id = $(this).data('id');
            $('#ipDeleteId').val(id);
            $("#geoLocation").modal('show');
        })

    </script>
@endpush
