@extends('backend.master')
@php
    $table_name='front_pages'
@endphp
@section('table'){{$table_name}}@stop
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('frontendmanage.Pages')}}</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                    <a href="{{ route('frontend.page.index')}}">{{__('frontendmanage.Pages')}}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-end mb-5 pr-4">
                <a href="{{ route('frontend.page.create') }}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus"></span>
                    {{__('common.Add')}}
                </a>
            </div>
            <h4 class="pl-4 mb-3">{{__('frontendmanage.Pages')}}</h4>
            <div class="col-lg-12">
                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table">
                        <!-- table-responsive -->
                        <div class="">
                            <table id="lms_table" class="table Crm_table_active3">
                                <thead>

                                <tr>
                                    <th width="15%">{{__('frontendmanage.Title')}}</th>
                                    <th width="15%">{{__('frontendmanage.Slug')}}</th>
{{--                                    <th width="15%">{{__('common.Type')}}</th>--}}
                                    <th width="15%">{{__('common.Status')}}</th>
                                    <th width="15%">{{__('common.Action')}}</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($frontPages as $value)

                                    <tr>

                                        <td> {{ Str::limit($value->title,30) }}</td>
                                        <td> {{ Str::limit($value->slug,30) }}</td>
{{--                                        <td> {{$value->is_static==0?'User Created':'System' }}</td>--}}
                                        <td>
                                            <label class="switch_toggle"
                                                   for="active_checkbox{{@$value->id }}">
                                                <input type="checkbox"
                                                       class=" status_enable_disable"
                                                       id="active_checkbox{{@$value->id }}"
                                                       @if (@$value->status == 1) checked
                                                       @endif value="{{@$value->id }}">
                                                <i class="slider round"></i>
                                            </label>
                                        </td>
                                        <td>


                                            <div class="dropdown CRM_dropdown">
                                                <button class="btn btn-secondary dropdown-toggle"
                                                        type="button"
                                                        id="dropdownMenu2" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    {{ __('common.Select') }}
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenu2">
                                                    <a class="dropdown-item" target="_blank"
                                                       href="{{ url('pages/'.$value->id.'/'.$value->slug)}}"> {{__('common.View')}}</a>
                                                    <a class="dropdown-item"
                                                       href="{{ route('frontend.page.edit',$value->id)}}"> {{__('common.Edit')}}</a>
                                                    @if($value->is_static!=1)
                                                        <a class="dropdown-item" data-toggle="modal"
                                                           data-target="#deleteItem_{{@$value->id}}">{{__('common.Delete')}}</a>
                                                    @endif
                                                </div>
                                            </div>


                                        </td>


                                    </tr>

                                    <div class="modal fade admin-query" id="deleteItem_{{@$value->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('common.Delete')}} {{__('frontendmanage.Page')}}</h4>
                                                    <button type="button" class="close"
                                                            data-dismiss="modal" style="color: #000">
                                                        &times;
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>{{__('footer.Are you sure')}}?</h4>
                                                    </div>
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal">{{__('footer.Cancel')}}
                                                        </button>
                                                        <form action="{{ route('frontend.page.destroy',$value->id)}}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit" class="primary-btn fix-gr-bg"
                                                                   value="Delete"/>
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
    </section>


@endsection

@push('scripts')





@endpush
