<div class="modal fade" id="deleteItem_{{@$item_id}}" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('role.delete') {{ $item_name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('common.Are you sure to delete ?')</h4>
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('common.cancel')</button>
                    <form action="{{ $route_url }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="primary-btn fix-gr-bg" value="Delete"/>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{--

<div class="modal fade admin-query" id="deleteItem_{{@$item_id}}">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('common.Delete Confirmation') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <p>{{__('Delete confirmation message')}}</p>

                <div class="col-lg-12 text-center">
                    <div class="d-flex justify-content-center pt_20">
                        <a id="delete_link" class="primary-btn semi_large2 fix-gr-bg">{{__('Delete')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
