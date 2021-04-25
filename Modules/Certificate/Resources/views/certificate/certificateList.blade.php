<div class="QA_section QA_section_heading_custom check_box_table">
    <div class="QA_table">
        <!-- table-responsive -->
        <div class="">
            <table id="lms_table" class="table Crm_table_active3">
                <thead>
                @if(session()->has('message-success-delete') != "" ||
                session()->get('message-danger-delete') != "")
                    <tr>
                        <td colspan="5">
                            @if(session()->has('message-success-delete'))
                                <div class="alert alert-success">
                                    {{ session()->get('message-success-delete') }}
                                </div>
                            @elseif(session()->has('message-danger-delete'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message-danger-delete') }}
                                </div>
                            @endif
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>{{__('common.SL')}}</th>
                    <th>{{__('certificate.Title')}}</th>
                    <th>{{__('certificate.Body')}}</th>
                    <th>{{__('certificate.Default For')}}</th>
                    <th>{{__('common.Action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($certificates as $key=>$certificate)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$certificate->title}} </td>
                        <td>{{$certificate->body}}</td>
                        <td>
                            <button type="button" class="primary-btn small fix-gr-bg">
                                @if($certificate->for_course == 1)
                                    {{__('certificate.Course')}}
                                @elseif($certificate->for_quiz == 1)
                                    {{__('certificate.Quiz')}} @endif
                            </button>
                        </td>

                        <td>
                            <div class="dropdown CRM_dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenu2" data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                    {{ __('common.Select') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right"
                                     aria-labelledby="dropdownMenu2">
                                    <a class="dropdown-item edit_brand" target="_blank"
                                       href="{{route('certificate.view',$certificate->id)}}">{{__('common.View')}}</a>
                                    <a class="dropdown-item edit_brand"
                                       href="{{route('certificate.download',$certificate->id)}}">{{__('common.Download')}}</a>
                                    @if($certificate->for_course == 0)
                                        <a class="dropdown-item" data-toggle="modal"
                                           data-target="#course_certificate{{$certificate->id}}"
                                           href="#">{{__('certificate.Make Default')}}
                                            ({{__('certificate.Course')}})</a>
                                    @endif
                                    @if($certificate->for_quiz == 0)
                                        <a class="dropdown-item" data-toggle="modal"
                                           data-target="#quiz_certificate{{$certificate->id}}"
                                           href="#">{{__('certificate.Make Default')}}
                                            ({{__('certificate.Quiz')}})</a>
                                    @endif
                                    @if (permissionCheck('certificate.edit'))
                                        <a class="dropdown-item edit_brand"
                                           href="{{route('certificate.edit', [$certificate->id])}}">{{__('common.Edit')}}</a>
                                    @endif
                                    @if (permissionCheck('certificate.delete'))
                                        <a class="dropdown-item" data-toggle="modal"
                                           data-target="#certificate_delete{{$certificate->id}}"
                                           href="#">{{__('common.Delete')}}</a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade admin-query"
                         id="certificate_delete{{$certificate->id}}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__('common.Delete')}} {{__('certificate.Certificate')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal"><i
                                            class="ti-close "></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <h4> {{__('common.Are you sure to delete ?')}}</h4>
                                    </div>
                                    <div class="mt-40 d-flex justify-content-between">
                                        <button type="button" class="primary-btn tr-bg"
                                                data-dismiss="modal">{{__('common.Cancel')}}</button>
                                        {{ Form::open(['route' => array('certificate.destroy',$certificate->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                        <button class="primary-btn fix-gr-bg"
                                                type="submit">{{__('common.Delete')}}</button>
                                        {{ Form::close() }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade admin-query"
                         id="course_certificate{{$certificate->id}}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__('certificate.Default for Course')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal"><i
                                            class="ti-close "></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <h4> {{__('certificate.Are you sure')}}?</h4>
                                    </div>
                                    <div class="mt-40 d-flex justify-content-between">
                                        <button type="button" class="primary-btn tr-bg"
                                                data-dismiss="modal">{{__('common.Cancel')}}</button>
                                        {{ Form::open(['route' => array('course.certificate.update',$certificate->id), 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                        <button class="primary-btn fix-gr-bg"
                                                type="submit">{{__('certificate.Make Default')}}</button>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade admin-query"
                         id="quiz_certificate{{$certificate->id}}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__('certificate.Default for Quiz')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal"><i
                                            class="ti-close "></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <h4> {{__('certificate.Are you sure')}}?</h4>
                                    </div>
                                    <div class="mt-40 d-flex justify-content-between">
                                        <button type="button" class="primary-btn tr-bg"
                                                data-dismiss="modal">{{__('common.Cancel')}}</button>
                                        {{ Form::open(['route' => array('quiz.certificate.update',$certificate->id), 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                        <button class="primary-btn fix-gr-bg"
                                                type="submit">{{__('certificate.Make Default')}}</button>
                                        {{ Form::close() }}
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
