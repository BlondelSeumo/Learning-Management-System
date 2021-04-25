<!-- SMTP form  -->
@if (permissionCheck('setting.email_credentials_update'))
    <form action="{{ route('updateEmailSetting') }}" method="post">
        @endif
        @csrf
        <input type="hidden" name="id" value="2" id="">
        <div class="row">
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.From Name') }}*</label>
                    <input class="primary_input_field"
                           {{ $errors->has('from_name') ? ' autofocus' : '' }} placeholder="" type="text"
                           name="from_name" value="{{@$smtp_mail_setting->from_name}}">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.From Mail') }}*</label>
                    <input class="primary_input_field"
                           {{ $errors->has('from_email') ? ' autofocus' : '' }} placeholder="" type="email"
                           name="from_email" value="{{@$smtp_mail_setting->from_email}}">
                </div>
            </div>
        </div>
        <div class="row" id="smtp">
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Driver') }}*</label>
                    <input class="primary_input_field"
                           {{ $errors->has('mail_driver') ? ' autofocus' : '' }} placeholder="" type="text"
                           name="mail_driver" value="{{@$smtp_mail_setting->email_engine_type}}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Host') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="mail_host"
                           value="{{@$smtp_mail_setting->mail_host}}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Port') }}*</label>
                    <input class="primary_input_field"
                           {{ $errors->has('mail_port') ? ' autofocus' : '' }} placeholder="" type="text"
                           name="mail_port" value="{{@$smtp_mail_setting->mail_port}}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Username') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="mail_username"
                           value="{{@$smtp_mail_setting->mail_username}}">
                </div>
            </div>


            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    {{-- <input type="hidden" name="types[]" value="MAIL_PASSWORD"> --}}
                    <label class="primary_input_label" for="">{{ __('setting.Mail Password') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="mail_password"
                           value="{{@$smtp_mail_setting->mail_password}}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Encryption') }}</label>
                    <select name="mail_encryption" class="primary_select mb-25">
                        <option value="ssl" @if ($smtp_mail_setting->mail_encryption == "ssl") selected @endif>SSL
                        </option>
                        <option value="tls" @if ($smtp_mail_setting->mail_encryption == "tls") selected @endif>TLS
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="primary_input">
                    <label class="primary_input_label"
                           for="">{{ __('common.Active') }} {{ __('common.Status') }}</label>
                    <select name="active_status" class="primary_select mb-25">
                        <option value="1"
                                @if ($smtp_mail_setting->active_status==1) selected @endif>{{ __('common.Active') }}</option>
                        <option value="0"
                                @if ($smtp_mail_setting->active_status==0) selected @endif>{{ __('common.Deactive') }}</option>
                    </select>
                </div>
            </div>


        </div>

        <div class="row">
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
            </div>
        </div>
    </form>

        <!--/ SMTP_form  -->
