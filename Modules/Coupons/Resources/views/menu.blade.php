
<li>
    <a href="javascript:;" class="has-arrow" aria-expanded="false">
        <div class="nav_icon_small"><span class="fas fa-gift"></span></div>
        <div class="nav_title"><span>{{__('coupons.Coupons') }}</span></div>
    </a>
    <ul>
        @if (permissionCheck('coupons.manage'))
            <li><a href="{{ route('coupons.manage') }}">{{__('coupons.Coupons List') }}</a></li>
        @endif
        @if (permissionCheck('coupons.common'))
            <li><a href="{{ route('coupons.common') }}">{{__('coupons.Common Coupons') }}</a></li>
        @endif
        @if (permissionCheck('coupons.single'))
            <li><a href="{{ route('coupons.single') }}">{{__('coupons.Single Coupons') }}</a></li>
        @endif
        @if (permissionCheck('coupons.personalized'))
            <li><a href="{{ route('coupons.personalized') }}">{{__('coupons.Personalized Coupons') }}</a></li>
        @endif
        @if (permissionCheck('coupons.invite_code'))
            <li><a href="{{ route('coupons.invite_code') }}">{{__('coupons.Invite By Code') }}</a></li>
        @endif
        @if (permissionCheck('coupons.inviteSettings'))
            <li><a href="{{ route('coupons.inviteSettings') }}">{{__('coupons.Invite Settings') }}</a></li>
        @endif
    </ul>
</li>
