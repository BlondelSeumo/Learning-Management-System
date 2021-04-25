<li>
    <a href="#" class="has-arrow" aria-expanded="false">
        <div class="nav_icon_small">
            <i class="fas fa-award"></i>
        </div>
        <div class="nav_title">
            <span>{{ __('certificate.Certificates') }}</span>
        </div>
    </a>

    <ul>

        @if (permissionCheck('certificate.index'))
            <li>
                <a href="{{ route('certificate.index') }}">{{ __('certificate.Certificates') }}</a>
            </li>
        @endif
        @if (permissionCheck('certificate.create'))
            <li>
                <a href="{{ route('certificate.create') }}">{{ __('certificate.New Certificate') }}</a>
            </li>
        @endif
    </ul>
</li>
