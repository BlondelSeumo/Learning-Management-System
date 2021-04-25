@extends('backend.master')
@php
    $table_name='email_templates'
@endphp
@section('table'){{$table_name}}@stop
@section('mainContent')

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid p-0">

            <div class="row justify-content-between">
                <h1>{{__('setting.Email Template')}}</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                    <a href="{{ route('EmailTemp') }}">{{__('setting.Email Template')}}</a>
                </div>
            </div>

        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-end mb-5 pr-4">

            </div>
            <h4 class="pl-4 mb-3">{{__('setting.Email Template')}}</h4>
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
                                    <th scope="col">{{__('dashboard.Subjects')}}</th>
                                    <th scope="col">{{__('common.Status')}}</th>
                                    <th scope="col">{{__('common.Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($templates as $key=> $template)

                                    <tr>

                                        <th>{{$key+1}}</th>
                                        <td class="nowrap">{{@$template->name}}

                                        </td>
                                        <td class="nowrap">{{@$template->subj}}</td>
                                        <td class="nowrap">
                                            <label class="switch_toggle"
                                                   for="active_checkbox{{@$template->id }}">
                                                <input type="checkbox"
                                                       class=" status_enable_disable"
                                                       id="active_checkbox{{@$template->id }}"
                                                       @if (@$template->status == 1) checked
                                                       @endif value="{{@$template->id }}">
                                                <i class="slider round"></i>
                                            </label>
                                        </td>
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
                                                    @if (permissionCheck('updateEmailTemp'))
                                                        <a class="dropdown-item" type="button" href="#"
                                                           data-toggle="modal"
                                                           data-target="#editEmail{{@$template->id}}"
                                                           class="dropdown-item"
                                                           type="button">{{__('common.Edit')}} </a>


                                                    @endif

                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Add Modal New_Expenditure -->
                                    <div class="modal fade admin-query" id="editEmail{{@$template->id}}">
                                        <div class="modal-dialog modal_800px modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('common.Update')}} {{__('setting.Email Template')}}</h4>
                                                    <button type="button" class="close " data-dismiss="modal">
                                                        <i class="ti-close "></i>
                                                    </button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="row">

                                                        <div class="col-xl-12">
                                                            @php
                                                                $codes= json_decode($template->shortcodes,true);
                                                            @endphp


                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for=""><strong>{{__('communication.Field Name')}}</strong></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="primary_input mb-25">
                                                                        <label class="primary_input_label"
                                                                               for=""><strong>{{__('communication.Short Code')}}</strong></label>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                @if(is_array($codes))

                                                                    @foreach ($codes as $key=> $code)


                                                                        <div class="col-xl-6">
                                                                            <div class="primary_input mb-25">
                                                                                <label class="primary_input_label"
                                                                                       for="">{{$code}}</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-6">
                                                                            <div class="primary_input mb-25">
                                                                                <label class="primary_input_label"
                                                                                       style="text-transform: lowercase;"
                                                                                       for="">{{"{{".$key}}}}</label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <hr>

                                                        </div>
                                                        <form action="{{route('updateEmailTemp')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                   value="{{@$template->id}}">
                                                            <div class="col-xl-12">
                                                                <div class="primary_input mb-25">
                                                                    <label class="primary_input_label"
                                                                           for="">{{__('setting.Subject')}}</label>
                                                                    <input class="primary_input_field"
                                                                           value="{{$template->subj}}" name="subj"
                                                                           placeholder="-" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12">
                                                                <div class="primary_input mb-35">
                                                                    <label class="primary_input_label"
                                                                           for="">{{__('setting.Email Body')}} </label>
                                                                    <textarea class="lms_summernote2"
                                                                              name="email_body" id="" cols="30"
                                                                              rows="20">
                                                                        {{$template->email_body}}

                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 text-center pt_15">
                                                                <div class="d-flex justify-content-center">
                                                                    <button
                                                                        class="primary-btn semi_large  fix-gr-bg"
                                                                        type="submit"><i
                                                                            class="ti-check"></i> {{__('common.Update')}}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
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
            </div>
        </div>


    </section>

@endsection
