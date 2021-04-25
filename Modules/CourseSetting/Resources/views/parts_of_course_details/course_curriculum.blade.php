       <div class="row">
           <div class="col-lg-6"></div>
           <div class="col-lg-6">

                <ul class="d-flex">
                        <li><a data-toggle="modal" data-target="#addChapter" class="primary-btn radius_30px mr-10 fix-gr-bg" href="#"><i class="ti-plus"></i>Add Chapter</a></li>
                        <li><a data-toggle="modal" data-target="#addLesson" class="primary-btn radius_30px  fix-gr-bg" href="#"><i class="ti-plus"></i>Add Lesson</a></li>
                    </ul>
        </div>
       </div>
       @foreach ($chapters as $chapter)
           {{-- <h3>{{$chapter->name}} </h3> --}}
            <div class="card text-center mt-25">
                <div class="card-header">
                    <h3>{{$chapter->name}} </h3>
                </div>
                <div class="card-body">

                    <table class="table table-striped">
                        @foreach ($chapter->lessons as $lesson)
                            {{-- @dd($lesson) --}}
                            <tr>
                                <td style="text-align: left">
                                    <h5> {{$lesson['name']}} </h5>
                                    <p>{{@$lesson['duration']}}</p>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#editLesson{{@$lesson->id}}" class="primary-btn radius_30px mr-10 fix-gr-bg" type="button">{{__('common.Edit')}}</a>
                                    <a href="#" data-toggle="modal" data-target="#deleteLesson{{@$lesson->id}}" class="primary-btn radius_30px mr-10 fix-gr-bg" type="button">{{__('common.Delete')}}</a>
                                </td>
                            </tr>
                                <div class="modal fade admin-query" id="deleteLesson{{@$lesson->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Lesson</h4>
                                                <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                                            </div>

                                            <div class="modal-body">
                                               <form action="{{route('deleteLesson')}}" method="post">
                                                   @csrf
                                                   <input type="hidden" name="id" value="{{@$lesson->id}}">

                                                    <div class="text-center">
                                                        <h4>{{__('common.Are you sure to delete ?')}} </h4>

                                                    </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">{{__('common.Cancel')}}</button>
                                                    <button class="primary-btn fix-gr-bg" type="submit">{{__('common.Delete')}}</button>
                                                </div>
                                               </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                    <div class="modal fade admin-query" id="editLesson{{@$lesson->id}}" >
                        <div class="modal-dialog modal_1000px  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Lesson</h4>
                                <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                            </div>

                            <div class="modal-body">
                                <form action="{{route('updateLesson')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{@$lesson->id}}">
                                    <input type="hidden" name="course_id" value="{{@$course->id}}">

                                    <div class="row">

                                        <div class="col-xl-4 mt-25">
                                              <select class="primary_select" name="chapter_id" id="">
                                                    <option data-display="{{__('common.Select')}} {{__('courses.Chapter')}}" value="">{{__('common.Select')}} {{__('courses.Chapter')}} </option>
                                                    @foreach($chapters as $chapter)
                                                            <option value="{{$chapter->id}}" @if ($chapter->id==$lesson->chapter_id) selected @endif>{{@$chapter->name}} </option>
                                                    @endforeach
                                            </select>
                                            </div>
                                            <div class="col-xl-4">
                                                 <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="">Lesson name</label>
                                                        <input class="primary_input_field" name="name" value="{{$lesson['name']}}" placeholder="-" type="text">
                                                 </div>
                                            </div>
                                            <div class="col-xl-4">
                                                 <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="">Duration</label>
                                                        <input class="primary_input_field" name="duration" value="{{$lesson['duration']}}" placeholder="-" type="text">
                                                 </div>
                                            </div>
                                        </div>
                                    <div class="row">

                                        <div class="col-xl-6 mt-25">
                                              <select class="primary_select" name="host" id="category_id">
                                                    <option data-display="{{__('common.Select')}} {{__('courses.Host')}}" value="">{{__('common.Select')}} {{__('courses.Host')}} </option>
                                                                    <option value="Youtube" @if ($lesson->host=='Youtube') Selected @endif >Youtube</option>
                                                                    <option value="Self" @if ($lesson->host=='Self') Selected @endif>Self</option>
                                                                    <option value="Vimeo" @if ($lesson->host=='Vimeo') Selected @endif>Vimeo</option>
                                                                    <option value="Dailmotion" @if ($lesson->host=='Dailmotion') Selected @endif>Dailmotion</option>
                                            </select>
                                            </div>
                                            <div class="col-xl-6">
                                                 <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="">Video URL</label>
                                                        <input class="primary_input_field" value="{{$lesson->video_url}}" name="video_url" placeholder="-" type="text">
                                                 </div>
                                            </div>

                                        </div>
                                    <div class="row">

                                            <div class="col-xl-6 mt-25">
                                                <select class="primary_select" name="is_lock" id="category_id">
                                                    <option data-display="{{__('common.Select')}} {{__('courses.Privacy')}}" value="">{{__('common.Select')}} {{__('courses.Privacy')}} </option>
                                                    <option value="1" @if ($lesson->is_lock==1) selected @endif >{{__('course.Locked')}}</option>
                                                    <option value="0" @if ($lesson->is_lock==0) selected @endif >{{__('course.Unlock')}}</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-6">
                                                 <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="">Description</label>
                                                        <input class="primary_input_field" value="{{@$lesson->description}}" name="description" placeholder="-" type="text">
                                                 </div>
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
                        @endforeach
                    </table>
                </div>
                </div>

       @endforeach

            <div class="modal fade admin-query" id="addChapter" >
                        <div class="modal-dialog  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add New Chapter</h4>
                                <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                            </div>

                            <div class="modal-body">
                                <form action="{{route('saveChapter')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{@$course->id}}">

                                    <div class="row">

                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for=""> {{__('common.Name')}} </label>
                                                    <input class="primary_input_field" name="chapter_name" value="" placeholder="-" type="text">
                                                </div>
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
            <div class="modal fade admin-query" id="addLesson" >
                        <div class="modal-dialog modal_1000px  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add New Lesson</h4>
                                <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
                            </div>

                            <div class="modal-body">
                                <form action="{{route('addLesson')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{@$course->id}}">

                                    <div class="row">

                                        <div class="col-xl-4 mt-25">
                                              <select class="primary_select" name="chapter_id" id="">
                                                    <option data-display="{{__('common.Select')}} {{__('courses.Chapter')}}" value="">{{__('common.Select')}} {{__('courses.Chapter')}} </option>
                                                    @foreach($chapters as $chapter)
                                                            <option value="{{$chapter->id}}">{{@$chapter->name}} </option>
                                                    @endforeach
                                            </select>
                                            </div>
                                            <div class="col-xl-4">
                                                 <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="">Lesson name</label>
                                                        <input class="primary_input_field" name="name" placeholder="-" type="text">
                                                 </div>
                                            </div>
                                            <div class="col-xl-4">
                                                 <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="">Duration</label>
                                                        <input class="primary_input_field" name="duration" placeholder="-" type="text">
                                                 </div>
                                            </div>
                                        </div>
                                    <div class="row">

                                        <div class="col-xl-6 mt-25">
                                              <select class="primary_select" name="host" id="category_id">
                                                    <option data-display="{{__('common.Select')}} {{__('courses.Host')}}" value="">{{__('common.Select')}} {{__('courses.Host')}} </option>
                                                                <option value="Youtube">Youtube</option>
                                                                    <option value="Self">Self</option>
                                                                    <option value="Vimeo">Vimeo</option>
                                                                    <option value="Dailmotion">Dailmotion</option>
                                            </select>
                                            </div>
                                            <div class="col-xl-6">
                                                 <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="">Video URL</label>
                                                        <input class="primary_input_field" name="video_url" placeholder="-" type="text">
                                                 </div>
                                            </div>

                                        </div>
                                    <div class="row">

                                        <div class="col-xl-6 mt-25">
                                              <select class="primary_select" name="is_lock" id="category_id">
                                                    <option data-display="{{__('common.Select')}} {{__('courses.Privacy')}}" value="">{{__('common.Select')}} {{__('courses.Privacy')}} </option>
                                                    <option value="1">{{__('courses.Locked')}}</option>
                                                    <option value="0">{{__('courses.Unlock')}}</option>
                                            </select>
                                            </div>
                                            <div class="col-xl-6">
                                                 <div class="primary_input mb-25">
                                                        <label class="primary_input_label" for="">{{__('courses.Description')}} </label>
                                                        <input class="primary_input_field" name="description" placeholder="-" type="text">
                                                 </div>
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
