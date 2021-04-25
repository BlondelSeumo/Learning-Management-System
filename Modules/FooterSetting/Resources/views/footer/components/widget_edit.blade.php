<div class="modal fade admin-query" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('footer.Edit Link')}}</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
            </div>
            <form method="POST" action="{{route('footerSetting.footer.widget-update')}}">
                @csrf
                @method('POST')
                <input type="hidden" name="id" id="widgetEditId">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-30">
                            <div class="input-effect">
                                <input class="primary-input name form-control" type="text" name="name" id="widget_name"
                                       autocomplete="off" value="">

                                <label>{{__('footer.Page Name')}} <span>*</span> </label>
                                <span class="focus-border"></span>
                            </div>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div id="editCategoryFieldDiv" class="col-lg-12 mt-30">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb category form-control" name="category"
                                        id="editCategory">
                                    <option data-display="{{__('footer.Widget Title')}}- *" value="">
                                        --{{__('footer.Widget Title')}}--
                                    </option>
                                    <option value="1">{{ $FooterContent->footer_section_one_title }}</option>
                                    <option value="2">{{ $FooterContent->footer_section_two_title }}</option>
                                    <option value="3">{{ $FooterContent->footer_section_three_title }}</option>
                                </select>
                                <span class="focus-border"></span>
                            </div>
                            @error('category')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{--  <div class="col-md-12">
                              <textarea name="description" class="lms_summernote" id="widget_description"></textarea>
                          </div>
                          --}}


                        <div id="editPageFieldDiv" class="col-lg-12 mt-30">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb category form-control" name="page"
                                        id="editPage">
                                    <option data-display="Page *" value="">--{{__('footer.Select Page')}}--</option>

                                    @foreach($staticPageList as $page)
                                        <option
                                            value="{{ $page->slug }}">{{ $page->title }}</option>
                                    @endforeach
                                </select>
                                <span class="focus-border"></span>
                            </div>
                            @error('page')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="primary-btn tr-bg mr-10"
                                    data-dismiss="modal">{{__('common.Cancel')}}</button>
                            <div class="tooltip-wrapper" data-title="" data-original-title="" title="">
                                <button type="submit" class="primary-btn fix-gr-bg tooltip-wrapper "
                                        data-original-title="" title="">
                                    <span class="ti-check"></span>
                                    {{__('common.Update')}} </button>
                            </div>

                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
