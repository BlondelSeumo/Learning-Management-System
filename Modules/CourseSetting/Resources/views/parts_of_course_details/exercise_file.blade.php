             <div class="row mb-10">
           <div class="col-lg-8"></div>
           <div class="col-lg-4">

                <ul class="d-flex">
                        <li><a data-toggle="modal" data-target="#addFile" class="primary-btn radius_30px  fix-gr-bg" href="#"><i class="ti-plus"></i>Add File</a></li>
                    </ul>
        </div>
       </div>

                <div class="modal fade admin-query" id="addFile" >
                        <div class="modal-dialog  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Exercise File</h4>
                                <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                            </div>

                            <div class="modal-body">
                                <form action="{{route('saveFile')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{@$course->id}}">

                                            {{-- <label class="primary_input_label" for="">Exercise File</label> --}}
                                            <div class="primary_file_uploader">
                                                    <input class="primary-input" type="text" id="placeholderFileOneName" value="" placeholder="Browse Image file" readonly="">
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg" for="document_file_2">Browse</label>
                                                        <input type="file" class="d-none" name="exercise_file" id="document_file_2">
                                                    </button>
                                                </div>
                                    <div class="row">

                                            <div class="col-xl-12 mt-20">
                                                <div class="primary_input">
                                                    {{-- <label class="primary_input_label" for=""> {{__('common.Name')}} </label> --}}
                                                    <input class="primary_input_field" name="fileName" value="" placeholder="{{__('common.File')}} {{__('common.Name')}}" type="text">
                                                </div>
                                            </div>

                                        </div>
                                         <div class="row">

                                            <div class="col-xl-12 mt-25">
                                                <select class="primary_select" name="lock" id="">
                                                    <option data-display="{{__('common.Select')}} {{__('courses.Privacy')}}" value="">{{__('common.Select')}} {{__('courses.Privacy')}} </option>
                                                    <option value="1">{{__('courses.Locked')}}</option>
                                                    <option value="0" >{{__('courses.Unlock')}}</option>
                                                </select>
                                            </div>
                                           <div class="col-xl-12 mt-25">
                                                <select class="primary_select" name="status" id="">
                                                    <option data-display="{{__('common.Select')}} {{__('common.Status')}}" value="">{{__('common.Select')}} {{__('common.Status')}} </option>
                                                    <option value="1">{{__('courses.Active')}}</option>
                                                    <option value="0" >{{__('courses.Pending')}}</option>
                                                </select>
                                            </div>

                                        </div>

                                <div class="mt-40 d-flex justify-content-between">
                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"> {{__('common.Cancel')}} </button>
                                    <button class="primary-btn fix-gr-bg" type="submit">{{__('common.Add')}}</button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            <div class="QA_section QA_section_heading_custom check_box_table mt-60">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.ID') }}</th>
                                        <th scope="col">{{ __('coupons.Name') }}</th>
                                        <th scope="col">{{ __('common.Download') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($course_exercises as $key => $exercise_file)
                                            <tr>
                                                <th>{{ $key+1 }}</th>

                                        {{-- `user_id`, `title`, `code`, `type`, `status`, `value`, `min_purchase`, `max_discount`, `start_date`, `end_date` --}}
                                                <td>{{@$exercise_file->fileName }}</td>
                                                <td>

                                                    @if (file_exists($exercise_file->file))

                                                     <a href="{{route('download_course_file',[$exercise_file->id])}}">{{ __('common.Download') }}</a>
                                                    @else
                                                        {{__('common.File Not Found')}}
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- shortby  -->
                                                    <div class="dropdown CRM_dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenu2" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            {{ __('common.Select') }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                           <a class="dropdown-item" data-toggle="modal" data-target="#editFile{{$exercise_file->id}}" href="#">{{__('common.Edit')}}</a>
                                                           <a class="dropdown-item" data-toggle="modal" data-target="#deleteQuestionGroupModal{{$exercise_file->id}}" href="#">{{__('common.Delete')}}</a>
                                                        </div>
                                                    </div>
                                                    <!-- shortby  -->
                                                </td>
                                            </tr>
    <div class="modal fade admin-query" id="editFile{{$exercise_file->id}}" >
                        <div class="modal-dialog  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Exercise File</h4>
                                <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                            </div>

                            <div class="modal-body">
                                <form action="{{route('updateFile')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{@$exercise_file->id}}">

                                            {{-- <label class="primary_input_label" for="">Exercise File</label> --}}
                                            <div class="primary_file_uploader">
                                                    <input class="primary-input" type="text" id="placeholderFileOneName" value="" placeholder="{{showPicName(@$exercise_file->file)}}" readonly="">
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg" for="document_file_2">Browse</label>
                                                        <input type="file" class="d-none" name="exercise_file" id="document_file_2">
                                                    </button>
                                                </div>
                                    <div class="row">

                                            <div class="col-xl-12 mt-20">
                                                <div class="primary_input">
                                                    {{-- <label class="primary_input_label" for=""> {{__('common.Name')}} </label> --}}
                                                    <input class="primary_input_field" name="fileName" value="{{$exercise_file->fileName}}" placeholder="{{__('common.File')}} {{__('common.Name')}}" type="text">
                                                </div>
                                            </div>

                                        </div>
                                         <div class="row">

                                            <div class="col-xl-12 mt-25">
                                                <select class="primary_select" name="lock" id="">
                                                    <option data-display="{{__('common.Select')}} {{__('courses.Privacy')}}" value="">{{__('common.Select')}} {{__('courses.Privacy')}} </option>
                                                    <option value="1" @if ($exercise_file->lock==1) selected @endif>{{__('courses.Locked')}}</option>
                                                    <option value="0" @if ($exercise_file->lock==0) selected @endif>{{__('courses.Unlock')}}</option>
                                                </select>
                                            </div>
                                           <div class="col-xl-12 mt-25">
                                                <select class="primary_select" name="status" id="">
                                                    <option data-display="{{__('common.Select')}} {{__('common.Status')}}" value="">{{__('common.Select')}} {{__('common.Status')}} </option>
                                                    <option value="1" @if ($exercise_file->status==1) selected @endif>{{__('courses.Active')}}</option>
                                                    <option value="0" @if ($exercise_file->status==0) selected @endif>{{__('courses.Pending')}}</option>
                                                </select>
                                            </div>

                                        </div>

                                <div class="mt-40 d-flex justify-content-between">
                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"> {{__('common.Cancel')}} </button>
                                    <button class="primary-btn fix-gr-bg" type="submit">{{__('common.Update')}}</button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                                          <div class="modal fade admin-query" id="deleteQuestionGroupModal{{$exercise_file->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{__('common.Delete')}} {{__('quiz.Question Group')}}</h4>
                                                <button type="button" class="close" data-dismiss="modal"> <i class="ti-close "></i></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4> {{__('common.Are you sure to delete ?')}}</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                     {{ Form::open(['route' => 'deleteFile', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                                     <input type="hidden" name="id" value="{{$exercise_file->id}}">
                                                    <button class="primary-btn fix-gr-bg" type="submit">{{__('common.Delete')}}</button>
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
