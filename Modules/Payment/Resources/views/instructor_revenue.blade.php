@extends('backend.master')
@section('mainContent')
    @include("backend.partials.alertMessage")

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1> {{__('payment.Revenue')}} {{__('common.List')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('common.Dashboard')}}</a>
                    <a href="#">{{__('payment.Payment')}}</a>
                    <a class="active" href="#"> {{__('payment.Revenue')}} {{__('common.List')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-20">{{__('payment.Revenue')}} {{__('common.List')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.ID') }}</th>
                                        <th scope="col">{{ __('coupons.Title') }}</th>
                                        <th scope="col">{{ __('courses.Category') }}</th>
                                        <th scope="col">{{ __('courses.Enrollment') }}</th>
                                        <th scope="col">{{ __('courses.Revenue') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($enrolls as $key => $course)
                                            <tr>
                                                <th>{{ $key+1 }}</th>
                                                <td>{{@$course->title }}</td>
                                                <td>{{@$course->subcategory->name }}</td>
                                                <td>{{@$course->enrolls->count()}}</td>
                                                <td>
                                                    {{@$course->total_enrolled * @$user->currency->conversion_rate}} {{@$user->currency->symbol}}

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
        </div>
    </section>
    <div id="edit_form">

    </div>
    <div id="view_details">

    </div>

@include('backend.partials.delete_modal')
@endsection
@push('scripts')

@endpush
