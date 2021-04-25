<li>
    <a href="#" class="has-arrow" aria-expanded="false">
        <div class="nav_icon_small"><span class="fas fa-images"></span></div>
        <div class="nav_title"><span>{{__('imagegallery.Image Gallery')}}</span></div>
    </a>
    <ul>
        @if (permissionCheck('imagegallery.list'))
            <li><a href="{{ route('imagegallery.list') }}">   {{ __('imagegallery.Manage Gallery') }}</a></li>
        @endif
    </ul>
</li>
