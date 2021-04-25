<div class="container-fluid no-gutters">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="header_iner d-flex justify-content-between align-items-center">
                @php
                    $path =asset(getSetting()->logo);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                try {
                $data = file_get_contents($path);

 }catch (\Exception $e){
                    $data='';
 }

                @endphp
                <input type="hidden" id="logo_img" value="{{base64_encode($data)}}">
                <input type="hidden" id="logo_title" value="{{getSetting()->company_name}}">
                <div class="small_logo_crm d-lg-none">
                    <a href="{{url('/')}}"> <img src="{{asset(getSetting()->logo)}}" alt=""></a>
                </div>
                <div id="sidebarCollapse" class="sidebar_icon  d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="collaspe_icon open_miniSide">
                    <i class="ti-menu"></i>
                </div>
                <div class="serach_field-area ml-40">
                    <div class="search_inner">
                        <form action="#">
                            <div class="search_field">
                                <input type="text" class="form-control primary-input input-left-icon"
                                       placeholder="Search" id="search" onkeyup="showResult(this.value)">
                            </div>
                            <button type="submit"><i class="ti-search"></i></button>
                        </form>
                    </div>
                    <div id="livesearch" style="display: none;"></div>
                </div>

                <div class="header_middle d-none d-md-block">
                    <ul class="nav navbar-nav mr-auto nav-buttons flex-sm-row">

                        <li class="nav-item">
                            <a target="_blank" class="primary-btn white mr-10" href="{{url('/')}}">{{__('common.Website')}}</a>
                        </li>


                    </ul>
                </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="select_style d-flex">
                        <select name="code" id="language_code" class="nice_Select bgLess mb-0"
                                onchange="location = this.value;">
                            @foreach (getSetting()->language::where('status', 1)->get() as $key => $language)
                                <option value="{{route('changeLanguage',$language->code)}}"
                                        @if (\Illuminate\Support\Facades\Auth::user()->userLanguage->code == $language->code) selected @endif>{{ $language->name }}</option>

                            @endforeach
                        </select>
                    </div>
                    <ul class="header_notification_warp d-flex align-items-center">
                        <li class="scroll_notification_list">
                            <a class="pulse theme_color bell_notification_clicker"
                               href="{{ route('communication.PrivateMessage') }}">
                                <!-- bell   -->
                                <i class="far fa-comment"></i>
                                <span class="notification_count">{{totalUnreadMessages()}}  </span>
                                <span class="pulse-ring notification_count_pulse"></span>
                            </a>
                    </ul>
                    <div class="profile_info">
                        <div class="profileThumb"
                             style="background-image: url('{{getProfileImage(Auth::user()->image)}}')"></div>

                        <div class="profile_info_iner">
                            <div class="use_info d-flex align-items-center">
                                <div class="thumb"
                                     style="background-image: url('{{getProfileImage(Auth::user()->image)}}')">

                                </div>
                                <div class="user_text">
                                    <p>{{__('common.Welcome')}}</p>
                                    <span>{{@Auth::user()->name}} </span>
                                </div>
                            </div>

                            <div class="profile_info_details">
                                <a href="{{route('updatePassword')}}">
                                    <i class="ti-settings"></i> <span>{{ __('common.View Profile') }} </span>
                                </a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    <i class="ti-shift-left"></i> <span>{{__('dashboard.Logout')}}</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

