@extends('backend.master')
@section('mainContent')

    <style>     svg {
            width: 100px;
            height: 100px;
            margin: 20px;
            display: inline-block;
        }


    </style>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="box_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0">{{ $language->name }} {{ __('common.Translation') }} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 mb_30 col-md-4">

                    <div class="white-box">
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" name="id" id="id" value="{{ $language->id }}">
                                <div class="primary_input mb_15">
                                    <label class="primary_input_label" for=""> {{ __('common.Choose File') }}</label>
                                    <select name="file_name" id="file_name"
                                            class="niceSelect w-100 bb form-control  mb-15"
                                            onchange="get_translate_file()">
                                        <option>{{__('setting.Select Translatable File')}}</option>
                                        @foreach (scandir(base_path('resources/lang/default/')) as $key => $value)
                                            @if ($key>1)
                                                <option value="{{ $value }}"
                                                        @if ($key == 2) selected @endif>{{ substr($value, 0, -4) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8" id="" style="min-height: 500px">
                    <div id="translate_form"></div>
                    <div class="row justify-content-center mt-30 demo_wait" style="display: none">
                        <svg version="1.1" id="L4" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
  <circle fill="#7c32ff" stroke="none" cx="6" cy="50" r="6">
      <animate
          attributeName="opacity"
          dur="1s"
          values="0;1;0"
          repeatCount="indefinite"
          begin="0.1"/>
  </circle>
                            <circle fill="#7c32ff" stroke="none" cx="26" cy="50" r="6">
                                <animate
                                    attributeName="opacity"
                                    dur="1s"
                                    values="0;1;0"
                                    repeatCount="indefinite"
                                    begin="0.2"/>
                            </circle>
                            <circle fill="#7c32ff" stroke="none" cx="46" cy="50" r="6">
                                <animate
                                    attributeName="opacity"
                                    dur="1s"
                                    values="0;1;0"
                                    repeatCount="indefinite"
                                    begin="0.3"/>
                            </circle>
</svg>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <input type="hidden" name="translate_file" class="translate_file"
           value="{{ route('language.get_translate_file') }}">
@endsection
@push('scripts')
    <script src="{{asset('public/backend/js/language.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.demo_wait').show();
            get_translate_file();
        });

        function get_translate_file() {
            $('#translate_form').empty();
            $('.demo_wait').show();
            var file_name = $('#file_name').val();
            var id = $('#id').val();
            $.post('{{ route('language.get_translate_file') }}', {
                _token: '{{ csrf_token() }}',
                file_name: file_name,
                id: id
            }, function (data) {
                $('#translate_form').html(data);
                $('.demo_wait').hide();
            });
        }
    </script>
@endpush
