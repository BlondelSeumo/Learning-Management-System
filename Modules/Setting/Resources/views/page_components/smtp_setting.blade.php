<div class="tab-pane fade white_box_30px mt-20" id="SMTP" role="tabpanel" aria-labelledby="SMTP-tab">
    <!-- SMTP form  -->
    <div class="main-title mb-25">
        <h3 class="mb-0">{{ __('setting.SMTP Settings') }}</h3>
    </div>
    <form action="{{ route('smtp_gateway_credentials_update') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                <div class="primary_input">
                    <input type="hidden" name="types[]" value="MAIL_MAILER">
                    <label class="primary_input_label" for="">{{ __('setting.Email Protocol') }}</label>
                    <select class="primary_select mb-25" name="mail_protocol" onchange="smtp_form()" id="mail_mailer">
                        <option value="smtp"@if (getSetting()->mail_protocol == "smtp") selected @endif>SMTP</option>
                        <option value="sendmail"@if (getSetting()->mail_protocol == "sendmail") selected @endif>Send Mail</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row" id="smtp">
            <div class="col-xl-6">
                <div class="primary_input">
                    <input type="hidden" name="types[]" value="MAIL_ENGINE">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Engine') }}</label>
                    <select name="MAIL_ENGINE" class="primary_select mb-25">
                        <option value="mail_engine">PHPMailer</option>
                        <option value="mail_engine2">PHPMailer 2</option>
                    </select>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                    <label class="primary_input_label" for="">{{ __('setting.From Name') }}*</label>
                    <input class="primary_input_field" placeholder="Infix CRM" type="text" name="MAIL_FROM_NAME" value="{{ env('MAIL_FROM_NAME') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                    <label class="primary_input_label" for="">{{ __('setting.From Mail') }}*</label>
                    <input class="primary_input_field" placeholder="demo@infix.com" type="email" name="MAIL_FROM_ADDRESS" value="{{ env('MAIL_FROM_ADDRESS') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_HOST">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Host') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="MAIL_HOST" value="{{ env('MAIL_HOST') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_PORT">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Port') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="MAIL_PORT" value="{{ env('MAIL_PORT') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_USERNAME">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Username') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="MAIL_USERNAME" value="{{ env('MAIL_USERNAME') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Password') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input">
                    <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                    <label class="primary_input_label" for="">{{ __('setting.Mail Encryption') }}</label>
                    <select name="MAIL_ENCRYPTION" class="primary_select mb-25">
                        <option value="ssl" @if (env('MAIL_ENCRYPTION') == "ssl") selected @endif>SSL</option>
                        <option value="tls" @if (env('MAIL_ENCRYPTION') == "tls") selected @endif>TLS</option>
                    </select>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="MAIL_CHARSET">
                    <label class="primary_input_label" for="">{{ __('setting.Email Charset') }}</label>
                    <input class="primary_input_field" placeholder="Utf-8" type="text" name="MAIL_CHARSET" value="{{ env('MAIL_CHARSET') }}">
                </div>
            </div>
        </div>
        <div class="row" id="sendmail">

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="SENDER_NAME">
                    <label class="primary_input_label" for="">{{ __('setting.Sender Name') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="SENDER_NAME" value="{{ env('SENDER_NAME') }}">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <input type="hidden" name="types[]" value="SENDER_MAIL">
                    <label class="primary_input_label" for="">{{ __('setting.Sender Email') }}</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="SENDER_MAIL" value="{{ env('SENDER_MAIL') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.Email Signature') }}</label>
                    <textarea name="mail_signature"  class="primary_textarea height_128" placeholder="" >{{ getSetting()->mail_signature }}</textarea>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.Predefined Header') }}</label>
                    <textarea name="mail_header" class="primary_textarea" placeholder="{company_name}{address}{city} {state}{country_code} {zip_code}{vat_number_with_label}" >{{ getSetting()->mail_header }}
                    </textarea>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.Predefined Footer') }}</label>
                    <textarea name="mail_footer" class="primary_textarea" placeholder="{company_name}
                        {address}{city}
                        {state}{country_code}
                        {zip_code}
                        {vat_number_with_label}">{{ getSetting()->mail_footer }}
                    </textarea>
                </div>
            </div>

            <div class="col-12 mb-45 pt_15">
                <div class="submit_btn text-center">
                    <button class="primary_btn_large" type="submit"> <i class="ti-check"></i> {{ __('common.Save') }}</button>
                </div>
            </div>
        </div>
    </form>

    <form class="" action="{{ route('test_mail.send') }}" method="post">
        @csrf
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for="">{{ __('setting.Send a Test Email to') }} {{ env('MAIL_USERNAME') }}</label>
                <div class="email_test">
                    <input class="primary_input_field" placeholder="-" type="text" name="content" required>
                    <button class="primary_btn_2" type="submit">{{ __('setting.Send Test Mail') }}</button>
                </div>

            </div>
        </div>
    </form>
    <!--/ SMTP_form  -->
</div>
