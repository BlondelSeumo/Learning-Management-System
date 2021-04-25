<li>
    <a href="javascript:;" class="has-arrow" aria-expanded="false">
        <div class="nav_icon_small">
            <span class="fas fa-graduation-cap"></span>
        </div>
        <div class="nav_title">
            <span>{{__('student.Students')}}</span>
        </div>
    </a>
    <ul>

        @if (permissionCheck('student.student_list'))
            <li>
                <a href="{{ route('student.student_list') }}">{{__('student.Students List')}}</a>
            </li>
        @endif

        @if (permissionCheck('admin.enrollLogs'))
            <li>
                <a href="{{ route('admin.enrollLogs') }}">{{__('student.Enrolled Student')}}</a>
            </li>
        @endif

    </ul>
</li>
