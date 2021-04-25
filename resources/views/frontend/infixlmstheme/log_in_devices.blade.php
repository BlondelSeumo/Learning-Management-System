@extends('frontend.infixlmstheme.layouts.dashboard_master')
@section('title'){{getSetting()->site_title ? getSetting()->site_title : 'Infix LMS'}} | {{__('frontend.Logged In Devices')}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')
    <div class="main_content_iner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="purchase_history_wrapper">
                        <div class="row">
                            <div class="col-12">
                                <div class="section__title3 mb_40">
                                    <h3 class="mb-0">{{__('frontend.Logged In Devices')}}</h3>
                                    <h4></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive">
                                    <table class="table custom_table3 mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">{{__('common.SL')}}</th>
                                            <th scope="col">{{__('common.Date')}}</th>
                                            <th scope="col">{{__('frontend.OS')}}</th>
                                            <th scope="col">{{__('frontend.Browser')}}</th>
                                            <th scope="col">{{__('frontend.LogOut Date')}}</th>
                                            <th scope="col">{{__('common.Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($logins))
                                            @foreach ($logins as $key=> $login)
                                                <tr>
                                                    <td scope="row">{{$key+1}}</td>
                                                    <td>{{ date(getSetting()->date_format->format, strtotime($login->login_at)) }}</td>
                                                    <td>{{$login->os}}</td>
                                                    <td>{{$login->browser}}</td>
                                                    <td>{{ $login->logout_at ? date(getSetting()->date_format->format, strtotime($login->logout_at)) : trans('common.Active') }}</td>
                                                    <td>
                                                        @php
                                                            $ip = request()->ip();
                                                            $browser = Browser::browserName();
                                                            $os = Browser::platformName();
                                                        @endphp
                                                        @if(($login->os != $os && $login->browser != $browser && $login->ip != $ip) || $login->token != session()->get('login_token'))
                                                            <a href="#" data-toggle="modal"
                                                               data-target="#logOut{{$login->id}}"
                                                               class="link_value theme_btn small_btn4">{{__('frontend.LogOut')}}</a>
                                                        @endif
                                                    </td>
                                                    <div class="modal fade" id="logOut{{$login->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        {{__('frontend.Enter Your Password To Continue')}}</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{route('log.out.device')}}"
                                                                      method="post">@csrf
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id"
                                                                               value="{{$login->id}}">
                                                                        <div class="col-12">
                                                                            <div
                                                                                class="input-group custom_group_field mb_25">
                                                                                <div class="input-group-prepend">
                                                                            <span class="input-group-text"
                                                                                  id="basic-addon4">
                                                                                <!-- svg -->
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                     width="10.697" height="14.039"
                                                                                     viewBox="0 0 10.697 14.039">
                                                                                <path id="Path_46" data-name="Path 46"
                                                                                      d="M9.348,11.7A1.337,1.337,0,1,0,8.011,10.36,1.341,1.341,0,0,0,9.348,11.7ZM13.36,5.68h-.669V4.343a3.343,3.343,0,0,0-6.685,0h1.27a2.072,2.072,0,0,1,4.145,0V5.68H5.337A1.341,1.341,0,0,0,4,7.017V13.7a1.341,1.341,0,0,0,1.337,1.337H13.36A1.341,1.341,0,0,0,14.7,13.7V7.017A1.341,1.341,0,0,0,13.36,5.68Zm0,8.022H5.337V7.017H13.36Z"
                                                                                      transform="translate(-4 -1)"
                                                                                      fill="#687083"/>
                                                                                </svg>
                                                                                <!-- svg -->
                                                                            </span>
                                                                                </div>
                                                                                <input type="password" name="password"
                                                                                       class="form-control"
                                                                                       placeholder="{{__('common.Enter Password')}}"
                                                                                       aria-label="password"
                                                                                       aria-describedby="basic-addon4">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">{{__('common.Close')}}
                                                                        </button>
                                                                        <button type="submit"
                                                                                class="link_value theme_btn small_btn4">{{__('frontend.LogOut')}}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            @endforeach
                                        @endif
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
@endsection
