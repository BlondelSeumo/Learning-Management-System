<?php

namespace Modules\RolePermission\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\RolePermission\Entities\Permission;
use Modules\RolePermission\Entities\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth:admin', 'permission']);
    }


    public function index(Request $request)
    {
        $role_id = $request['id'];
        if ($role_id == null || $role_id == 1) {
            return redirect(route('permission.roles.index'));
        }
        $PermissionList = Permission::where('status', 1)->get();
        $role = Role::with('permissions')->find($role_id);
        $data['role'] = $role;
        $data['MainMenuList'] = $PermissionList->where('type', 1);
        $data['SubMenuList'] = $PermissionList->where('type', 2);
        $data['ActionList'] = $PermissionList->where('type', 3);
        $data['PermissionList'] = $PermissionList;
        return view('rolepermission::permission', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => "required",
            'module_id' => "required|array"
        ]);

        if ($validator->fails()) {
            Toastr::error('Please Select Minimum one Permission', 'Failed');
            return redirect()->back();
        }

        try {
            DB::beginTransaction();
            $role = Role::findOrFail($request->role_id);
            $role->permissions()->detach();
            $role->permissions()->attach(array_unique($request->module_id));
            DB::commit();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
}
