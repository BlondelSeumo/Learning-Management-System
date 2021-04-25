@extends('service::layouts.app_install', ['title' => __('service::install.admin_setup')])

@section('content')
<div class="single-report-admit">
    <div class="card-header">
        <h2 class="text-center text-uppercase" style="color: whitesmoke">{{ __('service::install.admin_setup') }}
        </h2>

    </div>
</div>

<div class="card-body">
    <div class="requirements">
        <div class="row">

            <div class="col-md-12">
                <form method="post" action="{{ route('service.user') }}" id="content_form">
                    <div class="form-group">
                        <label class="required" for="email">{{ __('service::install.email') }}</label>
                        <input type="email" class="form-control" name="email" id="email" required="required" placeholder="{{ __('service::install.email') }}">
                    </div>
                   
                    <div class="form-group">
                        <label class="required" for="password">{{ __('service::install.password') }}</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="{{ __('service::install.password') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="required" for="password_confirmation">{{ __('service::install.password_confirmation') }}</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required placeholder="{{ __('service::install.password_confirmation') }}" data-parsley-equalto="#password">
                    </div>

                    @if(env('APP_SYNC'))
                    <div class="form-group">
                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12 ">
                            <input name="seed" type="checkbox">
                            <span class="checkmark"></span>
                            <span class="ml-2">Install With Demo Data</span>
                        </label>
                    </div>
                    @endif

                   <button type="submit" class="offset-3 col-sm-6 primary-btn fix-gr-bg mt-40 submit" style="background-color: rebeccapurple;color: whitesmoke">{{ __('service::install.ready_to_go') }}</button>
                   <button type="button" class="offset-3 col-sm-6 primary-btn fix-gr-bg mt-40 submitting" disabled style="background-color: rebeccapurple;color: whitesmoke; display:none">{{ __('service::install.submitting') }}</button>
                </form>
            </div>

        </div>
    </div>
</div>
@stop

@push('js')
    <script>
        _formValidation('content_form');
        $(document).ready(function(){
            setTimeout(function(){
                $('.preloader h2').html('We are installing your system. <br> This may take some time. Be patient. Please do not refresh or close the browser')
            }, 2000);
        })
    </script>
@endpush
