<li>
    <a href="#" class="has-arrow" aria-expanded="false">
        <div class="nav_icon_small">
            <i class="fas fa-money-bill-alt"></i>
        </div>
        <div class="nav_title">
            <span>{{__('payment.Payment')}}</span>
        </div>
    </a>
    <ul>
        @if (permissionCheck('onlineLog'))
            <li>
                <a href="{{ route('onlineLog') }}">{{__('payment.Payment Received Online')}}</a>
            </li>
        @endif

        @if (permissionCheck('offlinePayment'))
            <li>
                <a href="{{ route('offlinePayment') }}">{{__('payment.Offline Payment')}}</a>
            </li>
        @endif

        @if (permissionCheck('bankPayment.index'))
            <li>
                <a href="{{ route('bankPayment.index') }}">{{__('payment.Bank Payment')}}</a>
            </li>
        @endif
    </ul>
</li>
