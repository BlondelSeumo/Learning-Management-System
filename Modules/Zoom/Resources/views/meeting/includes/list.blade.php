<div class="col-lg-9">
    <div class="main-title">
        <h3 class="mb-20">{{__('zoom.Class')}} {{__('zoom.List')}}</h3>
    </div>

    <div class="QA_section QA_section_heading_custom check_box_table">
        <div class="QA_table ">

            <div class="">
                <table id="lms_table" class="table Crm_table_active3">
                    <thead>
                    <tr>
                    <tr>
                        <th>{{__('common.SL')}}</th>
                        <th>   {{__('zoom.ID')}}</th>
                        <th>   {{__('zoom.Class')}}</th>
                        <th>   {{__('zoom.Instructor')}}</th>
                        <th>   {{__('zoom.Password')}}</th>
                        <th>   {{__('zoom.Topic')}}</th>
                        <th>   {{__('zoom.Date')}}</th>
                        <th>   {{__('zoom.Time')}}</th>
                        <th>   {{__('zoom.Duration')}}</th>
                        <th>   {{__('zoom.Start Join')}}</th>
                        <th>{{__('zoom.Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($meetings as $key => $meeting )

                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $meeting->meeting_id }}</td>
                            <td>{{ $meeting->class->title }}</td>
                            <td>{{ $meeting->instructor->name }}</td>
                            <td>{{ $meeting->password }}</td>
                            <td>{{ $meeting->topic }}</td>
                            <td>{{ $meeting->date_of_meeting }}</td>
                            <td>{{ $meeting->time_of_meeting }}</td>
                            <td>{{ $meeting->meeting_duration }} Min</td>
                            <td>
                                @if($meeting->currentStatus == 'started')

                                    <a class="primary-btn small fix-gr-bg small  text-white border-0"
                                       href="{{ route('zoom.meeting.join', $meeting->meeting_id) }}" target="_blank">
                                        @if (Auth::user()->role_id == 1 || Auth::user()->id == $meeting->instructor_id)
                                            {{__('zoom.Start')}}
                                        @else
                                            {{__('zoom.Join')}}
                                        @endif
                                    </a>

                                @elseif( $meeting->currentStatus == 'waiting')
                                    <a href="#"
                                       class="primary-btn small bg-info text-white border-0">Waiting</a>
                                @else
                                    <a href="#"
                                       class="primary-btn small bg-warning text-white border-0">Closed</a>
                                @endif
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
                                        <a class="dropdown-item"
                                           href="{{ route('zoom.meetings.show', $meeting->meeting_id) }}">{{__('zoom.View')}}</a>
                                        @if($meeting->created_by==$user->id)
                                            <a class="dropdown-item"
                                               href="{{ route('zoom.meetings.edit',$meeting->id )}}">{{__('zoom.Edit')}}</a>

                                            <a class="dropdown-item" data-toggle="modal"
                                               data-target="#d{{$meeting->id}}"
                                               href="#">{{__('zoom.Delete')}}</a>
                                        @endif

                                    </div>
                                </div>
                            </td>
                        </tr>


                        <div class="modal fade admin-query" id="d{{$meeting->id}}">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{__('zoom.Delete Class')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="text-center">
                                            <h4>{{__('common.Are you sure to delete ?')}}</h4>
                                        </div>

                                        <div class="mt-40 d-flex justify-content-between">
                                            <button type="button" class="primary-btn tr-bg"
                                                    data-dismiss="modal">{{__('zoom.Cancel')}}</button>
                                            <form class="" action="{{ route('zoom.meetings.destroy',$meeting->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="primary-btn fix-gr-bg"
                                                        type="submit">{{__('zoom.Delete')}}</button>
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
