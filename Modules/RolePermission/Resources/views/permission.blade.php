@extends('backend.master')
@push('styles')
    <link rel="stylesheet" href="{{asset('public/backend/css/role_module_style.css')}}">
@endpush
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{ __('role.Instructor Role') }} </h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                    <a href="#">{{__('setting.System Settings')}}</a>
                    <a href="#">{{ __('role.Instructor Role') }}</a>
                </div>
            </div>
        </div>
    </section>

    <div class="role_permission_wrap">
        <div class="permission_title">
            <h4>{{__('role.assign_permission')}} </h4>
        </div>
    </div>
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'permission.permissions.store','method' => 'POST']) }}
    <div class="erp_role_permission_area ">
        <!-- single_permission  -->
        <input type="hidden" name="role_id" value="{{@$role->id}}">
        <div class="mesonary_role_header">
            @foreach ($MainMenuList as $key => $Module)
                @include('rolepermission::page-components.permissionModule',[ 'key' =>$key, 'Module' =>$Module ])
            @endforeach
        </div>


        <div class="row mt-40">
            <div class="col-lg-12 text-center">
                <button class="primary-btn fix-gr-bg">
                    <span class="ti-check"></span>
                    {{__('common.Submit')}}
                </button>
            </div>
        </div>

    </div>
    {{ Form::close() }}
@endsection
@push('scripts')
    <script src="{{asset('public/backend/js/permission.js')}}"></script>
@endpush
