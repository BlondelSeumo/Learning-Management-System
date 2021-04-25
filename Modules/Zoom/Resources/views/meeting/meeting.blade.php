@extends('backend.master')

@push('css')
    <link rel="stylesheet" href="{{asset('public/backend/css/zoom.css')}}"/>
@endpush

@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('zoom.Zoom')}} {{__('zoom.Classes')}} {{__('zoom.Manage')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                    <a href="#">{{__('zoom.Classes')}}</a>
                    <a href="#">{{__('zoom.List')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                @include('zoom::meeting.includes.form')
                @include('zoom::meeting.includes.list')
            </div>
        </div>
    </section>
    <input type="hidden" name="get_user" class="get_user" value="{{ url('get-user-by-role') }}">

@endsection

@push('scripts')
    <script src="{{asset('public/backend/js/zoom.js')}}"></script>
@endpush
