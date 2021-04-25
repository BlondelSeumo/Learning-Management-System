@extends('backend.master')
@section('mainContent')


    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('role.role_permission')}}</h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                    <a href="#">{{__('setting.System Settings')}}</a>
                    <a href="#">{{__('role.role_permission')}}</a>
                </div>
            </div>
        </div>
    </section>


    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">{{__('common.Role')}} {{__('common.List')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="QA_section QA_section_heading_custom check_box_table">
                                <div class="QA_table ">
                                    <!-- table-responsive -->
                                    <div class="mt-30">
                                        <table class="table Crm_table_active">
                                            <thead>
                                            @include('backend.partials.alertMessagePageLevelAll')
                                            <tr>
                                                <th width="30%">{{__('role.Role')}}</th>
                                                <th width="30%">{{__('common.Type')}}</th>
                                                <th width="40%">{{__('common.Action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($RoleList as $role)
                                                <tr>
                                                    <td>{{@$role->name}}</td>
                                                    <td>{{@$role->type}}</td>
                                                    <td>
                                                        @if(@$role->id == 2)
                                                            @if (permissionCheck('permission.permissions.store'))
                                                                <a href="{{ route('permission.permissions.index', [ 'id' => @$role->id])}}"
                                                                   class="">
                                                                    <button type="button"
                                                                            class="primary-btn small fix-gr-bg"> {{__('role.assign_permission')}} </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    {{-- Error modal message --}}
                                                    @include('backend.partials.deleteModalMessage',[
                                                        'item_id' => @$role->id,
                                                        'item_name' => 'Role',
                                                        'route_url' => route('permission.roles.destroy',$role->id)])
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
            </div>
        </div>
    </section>
@endsection
