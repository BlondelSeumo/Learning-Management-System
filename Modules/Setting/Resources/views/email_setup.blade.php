@extends('setting::layouts.master')

@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Email Configuration</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">Dashboard</a>
                <a href="#">Settings</a>
                <a href="#">Email Configuration</a>
            </div>
        </div>
    </div>
</section>
    @include("backend.partials.alertMessage")
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="box_header">
                            <div class="main-title d-flex">
                                {{-- <h3 class="mb-0 mr-30" >{{ __('setting.Settings') }}</h3> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="">
                            <div class="row">

                                <div class="col-lg-12">
                                    <!-- tab-content  -->
                                    <div class="tab-content " id="myTabContent">


                                        <!-- SMTP  -->
                                        @include('setting::page_components.smtp_setting')



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('setting::page_components.script')
