@extends('backend.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>{{__('communication.Questions & Answer')}}</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                <a href="#">{{__('communication.Communication')}}</a>
                <a href="#">{{__('communication.Questions & Answer')}}</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center mt-50">
            <div class="col-12">
                <div class="box_header common_table_header">
                    <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px" >{{__('communication.Questions & Answer')}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table ">
                        <!-- table-responsive -->
                        <div class="">
                            <table id="lms_table" class="table Crm_table_active3">
                                <thead>
                                    <tr>
                                        <th scope="col">{{__('common.SL')}} </th>
                                        <th scope="col">{{__('common.Comments')}} </th>
                                        <th scope="col">{{__('common.Course')}} </th>
                                        <th scope="col">{{__('common.Replies')}} </th>
                                        <th scope="col">{{__('common.Commented By')}} </th>
                                        <th scope="col">{{__('common.Submitted')}} </th>
                                        <th scope="col">{{__('common.Action')}} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $key => $comment)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{@$comment->comment}}</td>
                                        <td>{{@$enroll->course->name}}</td>
                                        <td>{{@$enroll->replies}}</td>
                                        <td>{{@$enroll->user->name}}</td>
                                        <td>{{@$enroll->user->name}}</td>
                                        <td>{{@$enroll->course->dateFormat}}</td>
                                        <td class="nowrap">
                                            @if (@$enroll->status==1)
                                                <a href="#" data-toggle="modal" data-target="#rejectEnroll{{@$enroll->id}}" class="dropdown-item" type="button">{{__('common.Reject')}}</a>
                                            @else
                                                <a href="#" data-toggle="modal" data-target="#enableEnroll{{@$enroll->id}}" class="dropdown-item" type="button">{{__('common.Enable')}}</a>

                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Modal Item_Details -->
            </div>
        </div>
    </div>
</section>

@endsection
