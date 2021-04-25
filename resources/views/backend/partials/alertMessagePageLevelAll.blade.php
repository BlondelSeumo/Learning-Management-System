@if(session()->has('message-success-delete') != "" ||
session()->get('message-danger-delete') != "")
    <tr>
        <td colspan="3">
            @if(session()->has('message-success-delete'))
                <div class="alert alert-success">
                    {{ session()->get('message-success-delete') }}
                </div>
                @elseif(session()->has('message-danger-delete'))
                <div class="alert alert-danger">
                    {{ session()->get('message-danger-delete') }}
                </div>
            @endif
        </td>
    </tr>
@endif
