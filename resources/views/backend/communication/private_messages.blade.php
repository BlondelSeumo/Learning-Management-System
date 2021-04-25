@extends('backend.master')
@push('styles')
    <link rel="stylesheet" href="{{asset('public/backend/css/communication.css')}}"/>
@endpush
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('communication.Private Messages')}}</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">{{__('dashboard.Dashboard')}}</a>
                    <a href="#">{{__('communication.Communication')}}</a>
                    <a href="#">{{__('communication.Private Messages')}}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid plr_30">
            <div class="row justify-content-center">
                <div class="col-lg-12 p-0">
                    <div class="messages_box_area">
                        <div class="messages_list">
                            <div class="white_box ">
                                <div class="white_box_tittle list_header">
                                    <h4>{{__('communication.Message List')}}</h4>
                                </div>
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form active="#">
                                            <div class="search_field">
                                                <input type="text" id="search_input" onkeyup="searchReceiver()"
                                                       placeholder="{{__('communication.Search content here')}}...">
                                            </div>
                                            <button type="submit"><i class="ti-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <ul id="receiver_list">
                                    @foreach ($users as $user)
                                        <li>
                                            <a href="#" id="user{{$user->id}}" class="user_list"
                                               onClick="getMessage({{$user->id}})">
                                                <div class="message_pre_left">
                                                    <div class="message_preview_thumb profile_info">
                                                        <div class="profileThumb"
                                                             style="background-image: url('{{getProfileImage($user->image)}}')">

                                                        </div>
{{--                                                        <img src="{{url($user->image)}}" alt="">--}}
                                                    </div>
                                                    <div class="messges_info">
                                                        <h4 id="receiver_name{{$user->id}}">{{$user->name}}</h4>
                                                        <p id="last_mesg{{$user->id}}">{{@$user->reciever->message}}</p>
                                                    </div>
                                                </div>
                                                <div class="messge_time">
                                                    <span> {{@$user->reciever->messageFormat}} </span>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="messages_chat ">
                            <div class="white_box ">
                                <div class="message_box_heading"><h3
                                        id="receiver_name">{{@$singleMessage->reciever->name}}</h3></div>
                                <div id="all_massages">{!! getConversations($messages ) !!}</div>

                                <div class="message_send_field">
                                    @if (permissionCheck('communication.send'))
                                        <form action="{{route('communication.StorePrivateMessage')}}" name="submitForm"
                                              id="submitForm" method="POST" style="display: contents;">
                                            @endif
                                            @csrf
                                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                            <input type="hidden" name="reciever_id" id="reciever_id"
                                                   value="{{@$singleMessage->reciever_id}}">
                                            <input type="text" name="message"
                                                   placeholder="{{__('communication.Write your message')}}" value=""
                                                   id="message">
                                            @php
                                                $tooltip = "";
                                                if(permissionCheck('communication.send')){
                                                      $tooltip = "";
                                                  }else{
                                                      $tooltip = "You have no permission to Send";
                                                  }
                                            @endphp
                                            <button class="btn_1" type="submit" id="submitMessage" data-toggle="tooltip"
                                                    title="{{$tooltip}}">{{__('common.Send')}}</button>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" name="store_message" class="store_message"
           value="{{route('communication.StorePrivateMessage')}}">
    <input type="hidden" name="get_messages" class="get_messages"
           value="{{route('communication.getMessage')}}">

@endsection
@push('scripts')
    <script src="{{asset('public/backend/js/communication.js')}}"></script>
@endpush
