<div id="add_staff_modal">
    <div class="modal fade admin-query" id="staff_add">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('common.Add New') }} {{ __('common.Staff') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('staffs.store') }}" method="POST" id="staff_addForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Name') }}</label>
                                    <input name="name" class="primary_input_field name" placeholder="{{ __('common.Name') }}" type="text" required>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Staff Id') }}</label>
                                    <input name="employee_id" class="primary_input_field name" placeholder="{{ __('common.Staff Id') }}" type="text" required>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Email') }}</label>
                                    <input name="email" class="primary_input_field name" placeholder="{{ __('common.Email') }}" type="email" required>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Username') }}</label>
                                    <input name="username" class="primary_input_field name" placeholder="{{ __('common.Username') }}" type="text" required>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Password') }}</label>
                                    <input name="password" class="primary_input_field name" placeholder="{{ __('common.Password') }}" type="password" required>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Re-Password') }}</label>
                                    <input name="confirm_password" class="primary_input_field name" placeholder="{{ __('common.Re-Password') }}" type="password" required>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('department.Department') }}</label>
                                    <select class="primary_select mb-25" name="department_id" id="department_id" required>
                                        @foreach (\Modules\UserManage\Entities\Department::all() as $key => $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                        <option value="1">Department 1</option>
                                        <option value="2">Department 2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('inventory.Warehouse') }}</label>
                                    <select class="primary_select mb-25" name="warehouse_id" id="" >
                                        @foreach (\Modules\Inventory\Entities\Warehouse::all() as $key => $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('showroom.Showroom') }}</label>
                                    <select class="primary_select mb-25" name="showroom_id" id="showroom_id" required>
                                        <option value="1">Showroom 1</option>
                                        <option value="2">Showroom 2</option>
                                        <option value="3">Showroom 3</option>
                                        <option value="4">Showroom 4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('role.Role') }}</label>
                                    <select class="primary_select mb-25" name="role_id" id="role_id" required>
                                        @foreach (\Modules\RolePermission\Entities\Role::all() as $key => $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Phone') }}</label>
                                    <input name="phone" class="primary_input_field name" placeholder="{{ __('common.Phone') }}" type="tel" required>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">{{ __('common.Avatar') }}</label>
                                    <div class="primary_file_uploader">
                                        <input class="primary-input" type="text" id="placeholderFileOneName"
                                               placeholder="Browse file" readonly="">
                                        <button class="" type="button">
                                            <label class="primary-btn small fix-gr-bg"
                                                   for="document_file_1">{{ __('common.Browse') }}</label>
                                            <input type="file" class="d-none" name="photo" id="document_file_1">
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg" id="save_button_parent"><i class="ti-check"></i>{{ __('common.Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
