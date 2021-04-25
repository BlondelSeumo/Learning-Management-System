@extends('backend.master')

@push('styles')
    <link rel="stylesheet" href="{{asset('public/backend/css/theme.css')}}"/>
@endpush
@section('mainContent')
    <!--suppress Annotator -->
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between w-100">
                            <h3 class="mb-0 mr-30">{{ __('Theme Details') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div style="padding-bottom: 80px;" class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <div class="img_div">
                                        <img style="width: 100%" src="{{ asset($theme->image) }}" alt="">
                                    </div>
                                </div>
                                <div class="col-5">
                                    @if ($theme->is_active == 1)
                                        <span class="badge badge-info">{{ __('setting.Current Theme') }}</span>
                                    @endif
                                    <div class="name_info_div">
                                        <h2 style="display: inline">{{ $theme->title }}</h2>
                                        <p style="display: inline">{{ __('setting.Version') }}:
                                            {{ $theme->version }}</p>
                                    </div>
                                    <div class="theme_description_div">
                                        <p>{{ $theme->description }}</p>
                                    </div>

                                    <div class="tag_div">
                                        <span><strong>{{ __('setting.Tags') }}: </strong>
                                            {{ $theme->tags }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <div class="row">
                                <div class="offset-md-4 col-md-8 col-sm-12">
                                    <div class="row">
                                        @if ($theme->is_active != 1)

                                            <div class="col-md-1">
                                                <form action="{{ route('appearance.themes.active') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $theme->id }}">
                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-secondary Active_btn">{{ __('common.Active') }}</button>
                                                </form>
                                            </div>
                                        @endif
                                            @if ($theme->is_active != 1)
                                        <div class="col-md-1">
                                            <a class="primary-btn fix-gr-bg Active_btn" target="_blank"
                                               href="{{ $theme->live_link }}">{{ __('setting.Live Preview') }}</a>
                                        </div>
                                            <div class="col-md-10">
                                                <a class="btn btn-sm btn-outline-secondary Active_btn pull-right"
                                                   onclick="DeleteTheme({{ $theme->id }})"
                                                   href="javascript:void(0)">{{ __('common.Delete') }}</a>
                                            </div>
                                        @endif

                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="deleteItemModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('common.Delete') Theme </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4>@lang('common.Are you sure to delete ?')</h4>
                    </div>
                    <div class="mt-40 d-flex justify-content-between">
                        <button type="button" class="primary-btn tr-bg"
                                data-dismiss="modal">@lang('common.Cancel')</button>
                        <form id="item_delete_form" method="POST" action="{{route('appearance.themes.delete')}}">
                            @csrf
                            <input type="hidden" name="id" id="delete_item_id">
                            <button type="submit" class="primary-btn fix-gr-bg">Delete</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('Modules/Appearance/resources/assets/js/script.js')}}"></script>
@endpush
