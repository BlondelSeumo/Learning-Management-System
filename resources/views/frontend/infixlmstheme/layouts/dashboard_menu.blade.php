<div class="header_iner d-flex justify-content-between align-items-center">
    <div class="sidebar_icon d-lg-none">
        <i class="ti-menu"></i>
    </div>
    <div class="category_search d-flex category_box_iner">

        <div class="input-group-prepend2">
            <a href="#" class="categories_menu">
                <i class="fas fa-th"></i>
                {{__('courses.Category')}}
            </a>
            <div class="menu_dropdown">
                <ul>
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <li class="mega_menu_dropdown active_menu_item">
                                <a href="{{route('courses')}}?category={{$category->id}}">{{$category->name}}</a>
                                <ul>
                                    <li>
                                        <div class="menu_dropdown_iner d-flex">
                                            <div class="single_menu_dropdown">
                                                <h4>{{__('courses.Sub Category')}}</h4>
                                                <ul>
                                                    @if(isset($category->subcategories))
                                                        @foreach( $category->subcategories as $subcategory)
                                                            <li>
                                                                <a href="{{route('courses')}}?category={{$category->id}}">{{$subcategory->name}}</a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    @endif

                </ul>
            </div>
        </div>
        <form action="{{route('search')}}">
            <div class="input-group theme_search_field ">
                <div class="input-group-prepend">
                    <button class="btn" type="button" id="button-addon1"><i
                            class="ti-search"></i>
                    </button>
                </div>

                <input type="text" class="form-control" name="query"
                       placeholder="{{__('frontend.Search for course, skills and Videos')}}"
                       onfocus="this.placeholder = ''"
                       onblur="this.placeholder = '{{__('frontend.Search for course, skills and Videos')}}'">

            </div>
        </form>
    </div>
    <div class="d-flex align-items-center">
        <div class="notification_wrapper">
            <ul>
                <li>
                    <a href="{{route('myWishlists')}}">
                        <div class="notify_icon">
                            <img src="{{asset('/public/frontend/infixlmstheme/')}}/img/svg/heart.svg" alt="">
                        </div>
                        <span class="notify_count">{{@totalWhiteList()}}</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="cart_store">
                        <div class="notify_icon">
                            <img class="" src="{{asset('/public/frontend/infixlmstheme/')}}/img/svg/cart.svg" alt="">
                        </div>
                        <span class="notify_count ">{{@cartItem()}}</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="profile_info collaps_part">
            <div class="profile_img collaps_icon     d-flex align-items-center">
                <div class="studentProfileThumb"
                     style="background-image: url('{{getProfileImage(Auth::user()->image)}}')"></div>
                {{--                <img src="{{getProfileImage(Auth::user()->image)}}" alt="#">--}}
                <span class="">{{Auth::user()->name}}
                    <br style="display: block">
          <small>
                        @if(Auth::user()->balance==0)
                  {{getSetting()->currency->symbol??'৳'}} 0
              @else
                  {{getPriceFormat(Auth::user()->balance)}}
              @endif
          </small>

                </span>

            </div>
            <div class="profile_info_iner collaps_part_content">
                <a href="{{url('/')}}">{{__('frontendmanage.Home')}}</a>
                <a href="{{route('myProfile')}}">{{__('frontendmanage.My Profile')}}</a>
                <a href="{{route('myAccount')}}">{{__('frontend.Account Settings')}}</a>
                <a href="{{route('logout')}}">{{__('frontend.Log Out')}}</a>
            </div>
        </div>
    </div>
</div>
