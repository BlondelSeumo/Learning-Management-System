<!-- sidebar part here -->
<nav id="sidebar" class="sidebar ">

    <div class="sidebar-header update_sidebar">
        <a class="large_logo" href="{{route('index')}}">
            <img src="{{getCourseImage(getSetting()->logo)}}" alt="">
        </a>
        <a class="mini_logo" href="{{route('index')}}">
            <img src="{{getCourseImage(getSetting()->logo)}}" alt="">
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>
    </div>
    <ul id="sidebar_menu">
        @if (permissionCheck('dashboard'))
            <li>
                <a class="active" href="{{url('/dashboard')}}" aria-expanded="false">
                    <div class="nav_icon_small">
                        <span class="fas fa-th"></span>
                    </div>
                    <div class="nav_title">
                        <span>{{__('common.Dashboard')}}</span>
                    </div>
                </a>
            </li>
        @endif


        @if (permissionCheck('students'))
            @include('studentsetting::menu')
        @endif

        @if (permissionCheck('instructors'))
            @include('systemsetting::menu')
        @endif


        @if (permissionCheck('courses'))
            <li>
                <a href="#" class="has-arrow" aria-expanded="false">
                    <div class="nav_icon_small">
                        <span class="fas fa-cubes"></span>
                    </div>
                    <div class="nav_title">
                        <span> {{ __('courses.Courses') }}</span>
                    </div>
                </a>
                <ul>
                    @if (permissionCheck('course.category'))
                        <li><a href="{{ route('course.category') }}">{{ __('courses.Categories') }}</a></li>
                    @endif
                    @if (permissionCheck('course.subcategory'))
                        <li><a href="{{ route('course.subcategory') }}">{{ __('courses.Subcategories') }}</a></li>
                    @endif

                    @if (permissionCheck('getAllCourse'))
                        <li>
                            <a href="{{ route('getAllCourse') }}">{{ __('courses.All') }} {{ __('courses.Courses') }}</a>
                        </li>
                    @endif
                    @if (permissionCheck('getActiveCourse'))
                        <li>
                            <a href="{{ route('getActiveCourse') }}">{{ __('courses.Active') }} {{ __('courses.Courses') }}</a>
                        </li>
                    @endif
                    @if (permissionCheck('getPendingCourse'))
                        <li>
                            <a href="{{ route('getPendingCourse') }}">{{ __('courses.Pending') }} {{ __('courses.Courses') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif



        @if (permissionCheck('coupons'))
            @include('coupons::menu')
        @endif


        @if (permissionCheck('quiz'))
            @include('quiz::menu')
        @endif

        @if (permissionCheck('communications'))
            <li>
                <a href="#" class="has-arrow" aria-expanded="false">
                    <div class="nav_icon_small">
                        <span class="fas fa-comments"></span>
                    </div>
                    <div class="nav_title">
                        <span>{{__('communication.Communication')}}</span>
                    </div>
                </a>
                <ul>
                    @if (permissionCheck('communication.PrivateMessage'))
                        <li>
                            <a href="{{ route('communication.PrivateMessage') }}">{{__('communication.Private Messages')}}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (permissionCheck('payments'))
            @include('payment::menu')
        @endif

        @if (permissionCheck('reports'))
            <li>
                <a href="#" class="has-arrow" aria-expanded="false">
                    <div class="nav_icon_small">
                        <span class="fas fa-calculator"></span>
                    </div>
                    <div class="nav_title">
                        <span>{{__('setting.Reports')}}</span>
                    </div>
                </a>
                <ul>
                    @if (permissionCheck('admin.reveuneList'))
                        <li>
                            <a href="{{ route('admin.reveuneList') }}">{{__('courses.Admin Revenue')}}</a>
                        </li>
                    @endif
                    @if (permissionCheck('admin.reveuneListInstructor'))
                        <li>
                            <a href="{{ route('admin.reveuneListInstructor') }}">{{__('instructor.Instructors')}} {{__('payment.Revenue')}}</a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif

        @if (permissionCheck('certificate.index'))
            @include('certificate::menu')
        @endif




        @if (permissionCheck('frontend_CMS'))
            @include('frontendmanage::menu')
        @endif




        @if (permissionCheck('image_gallery'))
            {{--            @include('imagegallery::menu')--}}
        @endif





        @if (permissionCheck('zoom'))
            @include('zoom::menu')
        @endif


        @if(moduleStatusCheck("BBB"))
            @if (permissionCheck('bbb'))
                @include('bbb::menu')
            @endif
        @endif

        @if(moduleStatusCheck("Jitsi"))
            @if (permissionCheck('Jitsi'))
                @include('jitsi::menu')
            @endif
        @endif


        @if (permissionCheck('virtual-class'))
            @include('virtualclass::menu')
        @endif


        @if (permissionCheck('blog'))
            @include('blog::menu')
        @endif
        @if(moduleStatusCheck('Subscription'))
            @if (permissionCheck('Subscription'))
                @include('subscription::menu')
            @endif
        @endif

        @if(permissionCheck('appearance.themes.index'))
            <li>
                <a href="#" class="has-arrow" aria-expanded="false">
                    <div class="nav_icon_small">
                        <span class="fas fa-cogs"></span>
                    </div>
                    <div class="nav_title">
                        <span>{{ __('setting.Appearance') }}</span>
                    </div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('appearance.themes.index') }}">{{ __('setting.Themes') }}</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (permissionCheck('settings'))
            <li>
                <a href="#" class="has-arrow" aria-expanded="false">
                    <div class="nav_icon_small">
                        <span class="fas fa-cogs"></span>
                    </div>
                    <div class="nav_title">
                        <span>{{ __('setting.System Setting') }}</span>
                    </div>
                </a>

                <ul>
                    @if (permissionCheck('setting.activation'))
                        <li>
                            <a href="{{ route('setting.activation') }}">{{ __('setting.Activation') }}</a>
                        </li>
                    @endif



                    @if (permissionCheck('setting.general_settings'))
                        <li>
                            <a href="{{ route('setting.general_settings') }}">{{ __('setting.General Settings') }}</a>
                        </li>
                    @endif
                    @if (permissionCheck('setting.setCommission'))
                        <li>
                            <a href="{{ route('setting.setCommission') }}">{{__('setting.Commission')}}</a>
                        </li>
                    @endif


                    @if (permissionCheck('setting.email_setup'))
                        <li>
                            <a href="{{ route('setting.email_setup') }}">{{ __('setting.Email Configuration') }}</a>
                        </li>
                    @endif
                    @if (permissionCheck('paymentmethodsetting.payment_method_setting'))
                        <li>
                            <a href="{{ route('paymentmethodsetting.payment_method_setting') }}">{{ __('setting.Payment Method Settings') }}</a>
                        </li>
                    @endif
                    @if (permissionCheck('paymentmethodsetting.payment_method_setting'))
                        <li>
                            <a href="{{ route('api.setting') }}">{{ __('setting.Api Settings') }}</a>
                        </li>
                    @endif
                    @if (permissionCheck('vimeosetting.index'))
                        <li>
                            <a href="{{ route('vimeosetting.index') }}">{{ __('setting.Vimeo Configuration') }}</a>
                        </li>
                    @endif

                    @if (permissionCheck('setting.seo_setting'))
                        <li>
                            <a href="{{ route('setting.seo_setting') }}">{{ __('setting.Homepage SEO Setup') }}</a>
                        </li>
                    @endif

                    @if (permissionCheck('permission.roles.index'))
                        <li>
                            <a href="{{ route('permission.roles.index') }}">{{ __('role.Instructor Role') }}</a>
                        </li>
                    @endif


                    @if (permissionCheck('EmailTemp'))
                        <li>
                            <a href="{{ route('EmailTemp') }}">{{ __('setting.Email Template') }}</a>
                        </li>
                    @endif
                    @if (permissionCheck('languages.index'))
                        <li>
                            <a href="{{ route('languages.index') }}">{{ __('common.Language') }}</a>
                        </li>
                    @endif

                    @if (permissionCheck('currencies.index'))
                        <li>
                            <a href="{{ route('currencies.index') }}">{{ __('common.Currency') }}</a>
                        </li>
                    @endif

                    @if (permissionCheck('modulemanager.index'))
                        <li>
                            <a href="{{ route('modulemanager.index') }}">{{ __('common.Module Manager') }}</a>
                        </li>
                    @endif

                    @if(moduleStatusCheck("AmazonS3"))
                        <li>
                            <a href="{{ route('AwsS3Setting') }}">{{ __('common.Aws S3 Setting') }}</a>
                        </li>
                    @endif




                    @if(permissionCheck('setting.aboutSystem'))
                        <li>
                            <a href="{{ route('setting.aboutSystem') }}">{{ __('setting.About') }}</a>
                        </li>
                    @endif

                    @if(permissionCheck('setting.updateSystem'))
                        <li>
                            <a href="{{ route('setting.updateSystem') }}">{{ __('setting.Update') }}</a>
                        </li>
                    @endif

                    @if(permissionCheck('ipBlock.index'))
                        <li>
                            <a href="{{ route('ipBlock.index') }}">{{ __('setting.IP Block') }}</a>
                        </li>
                    @endif

                    @if(permissionCheck('ipBlock.index'))
                        <li>
                            <a href="{{ route('setting.geoLocation') }}">{{ __('setting.Geo Location') }}</a>
                        </li>
                    @endif

                    @if(permissionCheck('setting.index'))
                        <li>
                            <a href="{{ route('setting.cookieSetting') }}">{{__('setting.Cookies settings')}}</a>
                        </li>
                    @endif


                    @if(permissionCheck('cronJob.index'))
                        <li>
                            <a href="{{ route('setting.cronJob') }}">Cron Job</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
    </ul>

</nav>
<!-- sidebar part end -->
