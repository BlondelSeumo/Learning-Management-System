<div class="login_wrapper_right">
    <div class="login_main_info">
        <h4>

            {{$page->title??'Welcome to Infix Learning Management System'}}
        </h4>
        <div class="thumb">
            <img src="{{asset($page->banner??'public/frontend/infixlmstheme/img/banner/global.png')}}" alt="">
        </div>
        <div class="other_links">
            <span>{{$page->slogans1?? 'Excellence.'}} </span>
            <span>{{$page->slogans2?? 'Community.'}} </span>
            <span>{{$page->slogans3?? 'Diversity.'}} </span>
        </div>
    </div>
</div>
