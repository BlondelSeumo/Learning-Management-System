@extends('backend.master')
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between w-100">
                            <h3 class="mb-0 mr-30">{{ __('setting.Upload Theme') }}</h3>

                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="white_box_50px box_shadow_white text-center">
                        <div style="padding:50px; " class="card mt-25">
                            <form action="{{ route('appearance.themes.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row mt-50">
                                    <div class="col-xl-6">
                                        <div class="primary_input mb-35">
                                            <div class="primary_file_uploader">

                                                <label for="placeholderFileOneName" class="d-none"></label>
                                                <input class="primary-input" type="text" id="placeholderFileOneName"
                                                                                                   placeholder="{{ __('setting.Browse Zip') }}" readonly="">
                                                <button class="" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="document_file_1">{{ __('common.Browse') }}</label>
                                                    <input type="file" class="d-none" name="themeZip"
                                                           id="document_file_1"
                                                           onchange="nameChange(this.value)">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding-top: 6px;" class="col-xl-6">
                                        <button id="submitBtn" type="submit" disabled
                                                class="btn primary_btn_2">{{ __('setting.Install Now') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script src="{{asset('Modules/Appearance/resources/assets/js/script.js')}}"></script>
@endpush
