<li>
    <a href="javascript:;" class="has-arrow" aria-expanded="false">
        <div class="nav_icon_small"><span class="fas fa-question-circle"></span></div>
        <div class="nav_title"><span>{{__('quiz.Quiz') }}</span></div>
    </a>
    <ul>
        @if (permissionCheck('question-group'))
            <li><a href="{{ route('question-group') }}">{{ __('quiz.Question Group') }}</a></li>
        @endif
        @if (permissionCheck('question-bank'))
            <li><a href="{{ route('question-bank') }}">{{ __('quiz.Question Bank') }}</a></li>
        @endif
        @if (permissionCheck('set-quiz.store'))
            <li><a href="{{ route('online-quiz') }}">{{ __('quiz.Set Quiz') }}</a></li>
        @endif
        @if (permissionCheck('quizSetup'))
            <li><a href="{{ route('quizSetup') }}">{{ __('quiz.Quiz Setup') }}</a></li>
        @endif
        @if (permissionCheck('quizResult'))
            <li><a href="{{ route('quizResult') }}"> {{ __('quiz.Quiz Report') }}</a></li>
        @endif

    </ul>
</li>
