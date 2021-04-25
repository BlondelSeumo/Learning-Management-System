@if (permissionCheck('setting.setting.social_login_setup_update'))
    <form class="" action="{{ route('socialCreditional') }}" method="post">
@endif
    @csrf
    <div class="main-title mb-26">
        <h3 class="mb-0">{{__('setting.Social Login Setting')}}</h3>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <div class="primary_input">
                <label class="primary_input_label" for="">{{ __('common.Status') }}</label>
                <select class="primary_select mb-25" name="googleLogin" id="googleLogin">
                   <option value="1"@if ($setting->googleLogin==1) selected @endif>{{ __('common.Enable') }}</option>
                   <option value="0"@if ($setting->googleLogin==0) selected @endif>{{ __('common.Disable') }}</option>
                </select>
            </div>
        </div>
         <div class="col-xl-5">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.Google Client ID') }} *</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="google_client" value="{{@$setting->google_client }}">
                </div>
            </div>
         <div class="col-xl-5">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.Google Secret Key') }} *</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="google_secret" value="{{@$setting->google_secret }}">
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <div class="primary_input">
                <label class="primary_input_label" for="">{{ __('common.Status') }}</label>
                <select class="primary_select mb-25" name="fbLogin" id="fbLogin">
                   <option value="1"@if ($setting->fbLogin==1) selected @endif>{{ __('common.Enable') }}</option>
                   <option value="0"@if ($setting->fbLogin==0) selected @endif>{{ __('common.Disable') }}</option>
                </select>
            </div>
        </div>
         <div class="col-xl-5">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.Facebook Client ID') }} *</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="facebook_client" value="{{@$setting->facebook_client }}">
                </div>
            </div>
         <div class="col-xl-5">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('setting.Facebook Secret Key') }} *</label>
                    <input class="primary_input_field" placeholder="-" type="text" name="facebook_secret" value="{{@$setting->facebook_secret }}">
                </div>
            </div>
    </div>
  
    <div id="TexttoLocal_Settings" class="sms_ption" >
        <!-- content  -->
        @php 
            $tooltip = "";
            if(permissionCheck('setting.setting.social_login_setup_update')){
                $tooltip = "";
            }else{
                $tooltip = "You have no permission to Update";
            }
        @endphp
        <div class="submit_btn text-center mb-100 pt_15">
            <button class="primary_btn_large" data-toggle="tooltip" title="{{$tooltip}}" type="submit"> <i class="ti-check"></i> {{ __('common.Save') }}</button>
        </div>
        <!-- content  -->
    </div>
</form>
