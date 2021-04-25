<li>
    <a href="#" class="has-arrow" aria-expanded="false">
        <div class="nav_icon_small">
            <i class="fas fa-vr-cardboard"></i>
        </div>
        <div class="nav_title">
            <span>{{__('zoom.Zoom')}}</span>
        </div>
    </a>
    <ul>
        @if (permissionCheck('zoom.meetings'))
            <li>
                <a href="{{ route('zoom.meetings') }}">  {{__('zoom.Zoom Class')}}</a>
            </li>
        @endif
        @if (permissionCheck('zoom.settings'))
            <li>
                <a href="{{ route('zoom.settings') }}">  {{__('zoom.Zoom Settings')}}</a>
            </li>
        @endif
    </ul>
</li>
