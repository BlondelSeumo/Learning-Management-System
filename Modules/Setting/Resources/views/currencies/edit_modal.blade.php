<div class="modal fade admin-query" id="Item_Edit">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('setting.Edit Currency Info') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('currencies.update', $currency->id) }}" method="POST" id="currencyEditForm">
                    @csrf
                    @method('PATCH')
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('common.Name') }} <strong class="text-danger">*</strong></label>
                                <input name="name" class="primary_input_field name" value="{{ $currency->name }}" placeholder="Language Name" type="text" required>
                                <span class="text-danger">{{$errors->first("name")}}</span>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('setting.Code') }} <strong class="text-danger">*</strong></label>
                                <input name="code" class="primary_input_field name" value="{{ $currency->code }}" placeholder="Language Code" type="text" required>
                                <span class="text-danger">{{$errors->first("code")}}</span>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('setting.Symbol') }} <strong class="text-danger">*</strong></label>
                                <input name="symbol" class="primary_input_field name" value="{{ $currency->symbol }}" placeholder="$" type="text" required>
                                <span class="text-danger">{{$errors->first("symbol")}}</span>
                            </div>
                        </div>
                         <div class="col-xl-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('setting.Conversion Rate') }} <strong class="text-danger">*</strong></label>
                                        <input name="conversion_rate" class="primary_input_field name" placeholder="1" type="text" required>
                                    </div>
                                </div>
                        <div class="col-lg-12 text-center">
                            <div class="d-flex justify-content-center pt_20">
                                <button type="submit" class="primary-btn semi_large2 fix-gr-bg" id="save_button_parent"><i class="ti-check"></i>{{ __('common.Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
