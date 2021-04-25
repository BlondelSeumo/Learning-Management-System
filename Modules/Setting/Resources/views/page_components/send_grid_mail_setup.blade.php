<!-- SMTP form  -->
@if (permissionCheck('setting.email_credentials_update'))
    <form action="{{ route('updateEmailSetting') }}" method="post">
        @endif
        @csrf
        <input type="hidden" name="id" value="3" id="">
        <div class="row">
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.From Name') }}*</label>
                    <input class="primary_input_field" placeholder=""
                           {{ $errors->has('from_name') ? ' autofocus' : '' }} type="text" name="from_name"
                           value="{{@$send_grid_mail_setting->from_name}}">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.From Mail') }}*</label>
                    <input class="primary_input_field"
                           {{ $errors->has('from_email') ? ' autofocus' : '' }} placeholder="" type="text"
                           name="from_email" value="{{@$send_grid_mail_setting->from_email}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.API Key') }}*</label>
                    <input class="primary_input_field"
                           {{ $errors->has('api_key') ? ' autofocus' : '' }} placeholder="API Key" type="text"
                           name="api_key" value="{{@$send_grid_mail_setting->api_key}}">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="primary_input">
                    <label class="primary_input_label"
                           for="">{{ __('common.Active') }} {{ __('common.Status') }}</label>
                    <select name="active_status" class="primary_select mb-25">
                        <option value="1"
                                @if ($send_grid_mail_setting->active_status==1) selected @endif>{{ __('common.Active') }}</option>
                        <option value="0"
                                @if ($send_grid_mail_setting->active_status==0) selected @endif>{{ __('common.Deactive') }}</option>
                    </select>
                </div>
            </div>

            @php
                $tooltip = "";
                if(permissionCheck('setting.email_credentials_update')){
                    $tooltip = "";
                }else{
                    $tooltip = "You have no permission to Update";
                }
            @endphp
            <div class="col-12 mb-45 pt_15">
                <div class="submit_btn text-center">
                    <button class="primary_btn_large" data-toggle="tooltip" title="{{$tooltip}}" type="submit"><i
                            class="ti-check"></i> {{ __('common.Save') }}</button>
                </div>
                <span>{{__('setting.For Details')}}
                    <a href="https://sendgrid.com/docs/ui/account-and-settings/api-keys/"
                       target="_blank">{{__('setting.Click Here')}}</a>
                </span>
            </div>
        </div>
    </form>
