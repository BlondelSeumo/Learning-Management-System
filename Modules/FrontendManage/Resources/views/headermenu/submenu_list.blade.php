@if(count(@$menus)>0)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div id="accordion" class="dd">
                        <ol class="dd-list">
                            @foreach($menus as $key => $element)
                                <li class="dd-item" data-id="{{$element->id}}">
                                    <div class="card accordion_card" id="accordion_{{$element->id}}">
                                        <div class="card-header item_header" id="heading_{{$element->id}}">
                                            <div class="dd-handle">
                                                <div class="float-left">
                                                    {{$element->title}} ( {{$element->type}} )
                                                </div>
                                            </div>
                                            <div class="float-right btn_div">
                                                <a href="javascript:void(0);" onclick="" data-toggle="collapse"
                                                   data-target="#collapse_{{$element->id}}" aria-expanded="false"
                                                   aria-controls="collapse_{{$element->id}}"
                                                   class="primary-btn small fix-gr-bg text-center button panel-title">
                                                    <i class="ti-settings settingBtn"></i>
                                                    <span class="collapge_arrow_normal"></span>
                                                </a>
                                                <a href="javascript:void(0);" onclick="elementDelete({{$element->id}})"
                                                   class="primary-btn small fix-gr-bg text-center button">
                                                    <i class="ti-close"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div id="collapse_{{$element->id}}" class="collapse"
                                             aria-labelledby="heading_{{$element->id}}"
                                             data-parent="#accordion_{{$element->id}}">
                                            <div class="card-body">
                                                <form enctype="multipart/form-data" class="elementEditForm">
                                                    <div class="row">
                                                        <input type="hidden" name="id" class="id"
                                                               value="{{$element->id}}">
                                                        <input type="hidden" name="type" class="type"
                                                               value="{{$element->type}}">
                                                        <div class="col-lg-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="title">
                                                                    {{__('Navigation Label')}} <span
                                                                        class="text-danger">*</span></label>
                                                                <input class="primary-input form-control title"
                                                                       type="text" name="title" autocomplete="off"
                                                                       value="{{$element->title}}"
                                                                       placeholder="{{__('Navigation Label')}}"
                                                                       {{$element->type =='tag'?'readonly':'' }} required>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="primary_input mb-25">
                                                                <label class="primary_input_label" for="link">
                                                                    Link
                                                                </label>
                                                                <input class="primary-input form-control link"
                                                                       type="text" name="link" autocomplete="off"
                                                                       value="{{$element->link}}" placeholder="Link">
                                                            </div>
                                                        </div>


                                                        <div class="col-xl-12">
                                                            <div class="primary_input">
                                                                <label class="primary_input_label"
                                                                       for="">{{ __('Show') }}</label>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div
                                                                            class="input-effect custom-transfer-account">
                                                                            <input type="radio" name="from_bank_name"
                                                                                   id="from_bank_{{$element->id}}"
                                                                                   value="1"
                                                                                   {{$element->show == 1?'checked':''}} class="common-radio ">
                                                                            <label
                                                                                for="from_bank_{{$element->id}}">{{ __('Left') }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div
                                                                            class="input-effect custom-transfer-account">
                                                                            <input type="radio" name="from_bank_name"
                                                                                   id="from_bank2_{{$element->id}}"
                                                                                   value="0"
                                                                                   {{$element->show == 0?'checked':''}} class="common-radio">
                                                                            <label
                                                                                for="from_bank2_{{$element->id}}">{{ __('Right') }}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 mt-30">
                                                            <div class="primary_input">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <input type="checkbox" name="is_newtab"
                                                                               id="is_newtab_{{$element->id}}"
                                                                               class="common-checkbox is_newtab  form-control"
                                                                               value="1" {{$element->is_newtab == 1? 'checked':''}}>
                                                                        <label
                                                                            for="is_newtab_{{$element->id}}">{{ __('Open link in a new tab') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 text-center">
                                                            <div class="d-flex justify-content-center pt_20">
                                                                <button type="button"
                                                                        class="editBtn primary-btn fix-gr-bg"><i
                                                                        class="ti-check"></i>
                                                                    {{ __('update') }}
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <ol class="dd-list">
                                        @foreach($element->childs as $key => $element)
                                            <li class="dd-item" data-id="{{$element->id}}">
                                                <div class="card accordion_card" id="accordion_{{$element->id}}">
                                                    <div class="card-header item_header" id="heading_{{$element->id}}">
                                                        <div class="dd-handle">
                                                            <div class="float-left">
                                                                {{$element->title}} ( {{$element->type}} )
                                                            </div>
                                                        </div>
                                                        <div class="float-right btn_div">
                                                            <a href="javascript:void(0);" onclick=""
                                                               data-toggle="collapse"
                                                               data-target="#collapse_{{$element->id}}"
                                                               aria-expanded="false"
                                                               aria-controls="collapse_{{$element->id}}"
                                                               class="primary-btn small fix-gr-bg text-center button panel-title ">
                                                                <i class="ti-settings settingBtn"></i>
                                                                <span
                                                                    class="collapge_arrow_normal"></span></a>
                                                            <a href="javascript:void(0);"
                                                               onclick="elementDelete({{$element->id}})"
                                                               class="primary-btn small fix-gr-bg text-center button"><i
                                                                    class="ti-close"></i></a>
                                                        </div>
                                                    </div>
                                                    <div id="collapse_{{$element->id}}" class="collapse"
                                                         aria-labelledby="heading_{{$element->id}}"
                                                         data-parent="#accordion_{{$element->id}}">
                                                        <div class="card-body">
                                                            <form enctype="multipart/form-data" class="elementEditForm">
                                                                <div class="row">
                                                                    <input type="hidden" name="id" class="id"
                                                                           value="{{$element->id}}">
                                                                    <input type="hidden" name="type" class="type"
                                                                           value="{{$element->type}}">
                                                                    <div class="col-lg-6">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for="title">
                                                                                {{__('Navigation Label')}} <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input
                                                                                class="primary-input form-control title"
                                                                                type="text" name="title"
                                                                                autocomplete="off"
                                                                                value="{{$element->title}}"
                                                                                placeholder="{{__('Navigation Label')}}"
                                                                                {{$element->type =='tag'?'readonly':'' }} required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="primary_input mb-25">
                                                                            <label class="primary_input_label"
                                                                                   for="link">
                                                                                Link
                                                                            </label>
                                                                            <input
                                                                                class="primary-input form-control link"
                                                                                type="text" name="link"
                                                                                autocomplete="off"
                                                                                value="{{$element->link}}"
                                                                                placeholder="Link">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-xl-12">
                                                                        <div class="primary_input">
                                                                            <label class="primary_input_label"
                                                                                   for="">{{ __('Show') }}</label>
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <div
                                                                                        class="input-effect custom-transfer-account">
                                                                                        <input type="radio"
                                                                                               name="from_bank_name"
                                                                                               id="from_bank_{{$element->id}}"
                                                                                               value="1"
                                                                                               {{$element->show == 1?'checked':''}} class="common-radio ">
                                                                                        <label
                                                                                            for="from_bank_{{$element->id}}">{{ __('Left') }}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div
                                                                                        class="input-effect custom-transfer-account">
                                                                                        <input type="radio"
                                                                                               name="from_bank_name"
                                                                                               id="from_bank2_{{$element->id}}"
                                                                                               value="0"
                                                                                               {{$element->show == 0?'checked':''}} class="common-radio">
                                                                                        <label
                                                                                            for="from_bank2_{{$element->id}}">{{ __('Right') }}</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12 mt-30">
                                                                        <div class="primary_input">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <input type="checkbox" name="is_newtab"
                                                                                           id="is_newtab_{{$element->id}}"
                                                                                           class="common-checkbox is_newtab  form-control"
                                                                                           value="1" {{$element->is_newtab == 1? 'checked':''}}>
                                                                                    <label
                                                                                        for="is_newtab_{{$element->id}}">{{ __('Open link in a new tab') }}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-12 text-center">
                                                                        <div
                                                                            class="d-flex justify-content-center pt_20">
                                                                            <button type="button"
                                                                                    class="editBtn primary-btn fix-gr-bg">
                                                                                <i
                                                                                    class="ti-check"></i>
                                                                                {{ __('update') }}
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        <ol class="dd-list">
                                            @foreach($element->childs as $key => $element)
                                                <li class="dd-item" data-id="{{$element->id}}">
                                                    <div class="card accordion_card" id="accordion_{{$element->id}}">
                                                        <div class="card-header item_header"
                                                             id="heading_{{$element->id}}">
                                                            <div class="dd-handle">
                                                                <div class="float-left">
                                                                    {{$element->title}} ( {{$element->type}} )
                                                                </div>
                                                            </div>
                                                            <div class="float-right btn_div">
                                                                <a href="javascript:void(0);" onclick=""
                                                                   data-toggle="collapse"
                                                                   data-target="#collapse_{{$element->id}}"
                                                                   aria-expanded="false"
                                                                   aria-controls="collapse_{{$element->id}}"
                                                                   class="primary-btn small fix-gr-bg text-center button panel-title">
                                                                    <i class="ti-settings settingBtn"></i>
                                                                    <span
                                                                        class="collapge_arrow_normal"></span></a>
                                                                <a href="javascript:void(0);"
                                                                   onclick="elementDelete({{$element->id}})"
                                                                   class="primary-btn small fix-gr-bg text-center button"><i
                                                                        class="ti-close"></i></a>
                                                            </div>
                                                        </div>
                                                        <div id="collapse_{{$element->id}}" class="collapse"
                                                             aria-labelledby="heading_{{$element->id}}"
                                                             data-parent="#accordion_{{$element->id}}">
                                                            <div class="card-body">
                                                                <form enctype="multipart/form-data"
                                                                      class="elementEditForm">
                                                                    <div class="row">
                                                                        <input type="hidden" name="id" class="id"
                                                                               value="{{$element->id}}">
                                                                        <input type="hidden" name="type" class="type"
                                                                               value="{{$element->type}}">
                                                                        <div class="col-lg-6">
                                                                            <div class="primary_input mb-25">
                                                                                <label class="primary_input_label"
                                                                                       for="title">
                                                                                    {{__('Navigation Label')}} <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input
                                                                                    class="primary-input form-control title"
                                                                                    type="text" name="title"
                                                                                    autocomplete="off"
                                                                                    value="{{$element->title}}"
                                                                                    placeholder="{{__('Navigation Label')}}"
                                                                                    {{$element->type =='tag'?'readonly':'' }} required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="primary_input mb-25">
                                                                                <label class="primary_input_label"
                                                                                       for="link">
                                                                                    Link
                                                                                </label>
                                                                                <input
                                                                                    class="primary-input form-control link"
                                                                                    type="text" name="link"
                                                                                    autocomplete="off"
                                                                                    value="{{$element->link}}"
                                                                                    placeholder="Link">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-xl-12">
                                                                            <div class="primary_input">
                                                                                <label class="primary_input_label"
                                                                                       for="">{{ __('Show') }}</label>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <div
                                                                                            class="input-effect custom-transfer-account">
                                                                                            <input type="radio"
                                                                                                   name="from_bank_name"
                                                                                                   id="from_bank_{{$element->id}}"
                                                                                                   value="1"
                                                                                                   {{$element->show == 1?'checked':''}} class="common-radio ">
                                                                                            <label
                                                                                                for="from_bank_{{$element->id}}">{{ __('Left') }}</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div
                                                                                            class="input-effect custom-transfer-account">
                                                                                            <input type="radio"
                                                                                                   name="from_bank_name"
                                                                                                   id="from_bank2_{{$element->id}}"
                                                                                                   value="0"
                                                                                                   {{$element->show == 0?'checked':''}} class="common-radio">
                                                                                            <label
                                                                                                for="from_bank2_{{$element->id}}">{{ __('Right') }}</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-12 mt-30">
                                                                            <div class="primary_input">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <input type="checkbox" name="is_newtab"
                                                                                               id="is_newtab_{{$element->id}}"
                                                                                               class="common-checkbox is_newtab  form-control"
                                                                                               value="1" {{$element->is_newtab == 1? 'checked':''}}>
                                                                                        <label
                                                                                            for="is_newtab_{{$element->id}}">{{ __('Open link in a new tab') }}</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-12 text-center">
                                                                            <div
                                                                                class="d-flex justify-content-center pt_20">
                                                                                <button type="button"
                                                                                        class="editBtn primary-btn fix-gr-bg">
                                                                                    <i
                                                                                        class="ti-check"></i>
                                                                                    {{ __('update') }}
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </ol>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="card">
        <div class="card-body text-center">
            @lang('frontendmanage.Not Found Data')
        </div>
    </div>
@endif
