@extends('backend.master')
@section('mainContent')
<style>
    .propertiesname{
        text-transform: uppercase;
        font-weight:bold;
    }
    </style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.virtual_class')  @lang('lang.details')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                <a href="#">@lang('lang.virtual_class')</a>
                <a href="#">@lang('lang.details')</a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-10">
                <h3 class="mb-30"> @lang('lang.topic') : {{@$results['topic']}}</h3>
            </div>
            <div class="col-md-2 pull-right  text-right">
                @if(userPermission(557))
                    <a href="{{ route('zoom.meetings.edit', $localMeetingData->id) }}" class="primary-btn small fix-gr-bg "> <span class="ti-pencil-alt"></span> @lang('lang.edit') </a>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <table id="" class="display school-table school-table-style w-100" >

                            <tr>
                                <th>{{__('common.SL')}}</th>
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.status')</th>
                            </tr>

                            @php $sl = 1 @endphp
                            <tr>
                                <td>{{ $sl++ }} </td> <td class="propertiesname">@lang('lang.topic')</td> <td>{{@$results['topic']}}</td>
                            </tr>
                            <tr>
                                <td>{{ $sl++ }} </td> <td class="propertiesname">@lang('lang.participants')</td> <td> {{ $localMeetingData->participatesName }}  </td>
                            </tr>
                            @if($localMeetingData->attached_file)
                                <tr>
                                    <td>{{ $sl++ }} </td> <td class="propertiesname"> @lang('lang.attached_file') </td> <td> <a href="{{ asset($localMeetingData->attached_file) }}" download="" ><i class="fa fa-download mr-1"></i> Download</a>  </td>
                                </tr>
                            @endif
                            <tr>
                                <td> {{ $sl++ }} </td> <td class="propertiesname">@lang('lang.start_date_time')</td> <td>{{ $localMeetingData->MeetingDateTime }}</td>
                            </tr>
                            <tr>
                                <td> {{ $sl++ }} </td> <td class="propertiesname">@lang('lang.meeting_id')</td> <td>{{ @$results['id'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ $sl++ }} </td> <td class="propertiesname">@lang('lang.password')</td> <td>{{@$results['password']}}</td>
                            </tr>
                            @if(userPermission(559) )
                                <tr>
                                    <td>{{ $sl++ }} </td> <td class="propertiesname">@lang('lang.zoom_start_join')</td> <td>
                                        @if(@$results['status'] == 'started')
                                            <a class="primary-btn small bg-success text-white border-0" href="{{ route('zoom.meeting.join', $localMeetingData->meeting_id) }}" target="_blank" >
                                                @if (Auth::user()->role_id == 1 || Auth::user()->id == $localMeetingData->created_by)
                                                    @lang('lang.start')
                                                @else
                                                    @lang('lang.join')
                                                @endif
                                            </a>
                                        @elseif(@$results['status'] == 'waiting')
                                            <a href="#" class="primary-btn small bg-warning text-white border-0">@lang('lang.not_yet_start')</a>
                                        @else
                                            <a href="#" class="primary-btn small bg-warning text-white border-0">>@lang('lang.closed')</a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>{{ $sl++ }} </td> <td class="propertiesname">@lang('lang.host_id')</td> <td>{{@$results['host_id']}}</td>
                            </tr>

                            <tr>
                                <td>{{ $sl++ }} </td> <td class="propertiesname">@lang('lang.description')</td> <td> {{ $localMeetingData->description }}  </td>
                            </tr>

                            <tr>
                                <td>{{ $sl++ }} </td> <td class="propertiesname">@lang('lang.status')</td> <td>{{@$results['status']}}</td>
                            </tr>

                            <tr>
                                <td>{{ $sl++ }} </td> <td class="propertiesname">@lang('lang.timezone')</td> <td>{{@$results['timezone']}}</td>
                            </tr>

                            <tr>
                                <td>{{ $sl++ }} </td> <td class="propertiesname">@lang('lang.created_at') </td> <td>{{Carbon\Carbon::parse(@$results['created_at'])->format('m-d-Y')}}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
