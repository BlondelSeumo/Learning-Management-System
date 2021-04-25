@extends('service::layouts.app', ['title' => __('service::install.update')])

@section('content')

<div class="single-report-admit">
    <div class="card-header">
        <h2 class="text-center text-uppercase" style="color: whitesmoke">{{ __('service::install.welcome_title') }}
        </h2>

    </div>
</div>

<div class="card-body">
    @if(gv($product, 'current_version') == gv($product, 'next_release_version') && gv($product, 'name'))
  <div class="row">
      <div class="col-md-12">
        <div class="text-center">
            <p class="alert alert-danger">
                No update available! Please check later.
            </p>
            <p>
                <a href="{{ url('/') }}" class="primary-btn fix-gr-bg" > Back To Home </a>
            </p>

        </div>

      </div>
  </div>


    @else
    <div class="row">
        <div class="col md 12">
            {!! $update_tips !!}
        </div>

        <div class="col-md-12">
            @if(gv($product, 'name'))
            <div class="table-responsive">
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th>Current Installed Version</th>
                            <td>{{ gv($product, 'current_version') }}</td>
                        </tr>
                        <tr>
                            <th>Version Available for Upgrade</th>
                            <td>{{ gv($product, 'next_release_version') }}</td>
                        </tr>
                        <tr>
                            <th>Date of Release</th>
                            <td>{{ gv($product, 'next_release_date') }}</td>
                        </tr>
                        <tr>
                            <th>Update Size</th>

                            <td>{{bytesToSize(gv($product, 'next_release_size'))}}</td>
                        </tr>
                        <tr>
                            <th colspan="2">
                                {!! gv($product, 'next_release_change_log') !!}
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center" id="download_buttons">
                @if(!$is_downloaded)
                <button type="button" class="primary-btn fix-gr-bg" id="download"  data-href="{{ route('service.delete') }}">Download</button>
                @else
                <button type="button" class="primary-btn fix-gr-bg" id="direct_update" data-href="{{ route('service.update') }}" data-build="{{ gv($product, 'next_release_build') }}" data-version="{{ gv($product, 'next_release_version') }}" >Update</button>
                @endif

            </div>
            @endif
        </div>

        <div class="col-md-12" id="on_progress" style="display: none;">
            <p class="text-center alert alert-danger">Don't perform any action till we are performing update!</p>
            @if(!$is_downloaded)
            <p class="text-center" id="downloading">Update Size ({{ bytesToSize(gv($product, 'next_release_size', 0)) }}) - Downloading.....</p>
            @else
            <p class="text-center" id="downloading">Update Size ({{ bytesToSize(gv($product, 'next_release_size', 0)) }}) - Updating.....</p>
            @endif
        </div>
    </div>
    @endif

@stop
