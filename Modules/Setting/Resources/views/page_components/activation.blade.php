<div class="QA_section QA_section_heading_custom check_box_table">
    <div class="QA_table ">
        <!-- table-responsive -->
        <div class="">
            <table id="lms_table" class="table Crm_table_active3">
                <thead>
                <tr>
                    <th scope="col">{{__('common.SL')}}</th>
                    <th scope="col">{{ __('setting.Type') }}</th>
                    <th scope="col">{{ __('setting.Activate') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($business_settings as $key => $business_setting)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ strtoupper(str_replace("_"," ",$business_setting->type)) }}</td>
                        <td>
                            <label class="switch_toggle" for="checkbox{{ $business_setting->id }}">
                                <input type="checkbox" id="checkbox{{ $business_setting->id }}"
                                       @if ($business_setting->status == 1) checked
                                       @endif @if (!permissionCheck('ChangeActivationStatus')) disabled
                                       @endif  value="{{ $business_setting->id }}"
                                       onchange="update_active_status(this)">
                                <i class="slider round"></i>
                            </label>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
