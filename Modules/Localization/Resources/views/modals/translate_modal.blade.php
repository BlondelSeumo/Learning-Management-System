<div class="white_box_30px" id="translate_modal">
    <form class="" action="{{ route('languages.key_value_store') }}" method="post">
        @csrf
        <div class="">
            <input type="hidden" name="id" value="{{ $language->id }}">
            <input type="hidden" name="translatable_file_name" value="{{ $translatable_file_name }}">
            <div class="col-lg-12 mb-2">
                <div class="d-flex">
                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg"id="save_button_parent"><i class="ti-check"></i>{{ __('common.Save') }}</button>
                </div>
            </div>
        </div>
        <div class="common_QA_section QA_section_heading_custom th_padding_l0">
            <div class="QA_table ">
                <!-- table-responsive -->
                <div class="">
                    <table class="table Crm_table_active2 pt-0 shadow_none pt-0 pb-0">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('common.ID') }}</th>
                                <th scope="col">{{ __('setting.Key') }}</th>
                                <th scope="col">{{ __('setting.Value') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($languages as $key => $value)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $key }}</td>
                                    <td>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" style="width:100%" name="key[{{ $key }}]" @isset($value)
                                                value="{{ $value }}"
                                            @endisset>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
