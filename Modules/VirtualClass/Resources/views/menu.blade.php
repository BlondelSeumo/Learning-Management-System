<li>
    <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
        <div class="nav_icon_small">
            <i class="fas fa-vr-cardboard"></i>
        </div>
        <div class="nav_title">
            <span>{{__('zoom.Virtual Class')}}</span>
        </div>
    </a>
    <ul>
        @if (permissionCheck('virtual-class.index'))
            <li><a href="{{ route('virtual-class.index') }}">  {{__('virtual-class.Class List')}}</a></li>
        @endif
        @if (permissionCheck('virtual-class.setting'))
            <li>
                <a href="{{ route('virtual-class.setting') }}">  {{__('virtual-class.Class Setting')}}</a>
            </li>
        @endif
    </ul>
</li>
