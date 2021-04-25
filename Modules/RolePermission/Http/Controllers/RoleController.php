<?php

namespace Modules\RolePermission\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\RolePermission\Entities\Permission;
use Modules\RolePermission\Entities\Role;
use Modules\RolePermission\Http\Requests\RoleFormRequest;
use Modules\RolePermission\Repositories\RoleRepositoryInterface;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->middleware(['auth']);
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {

        $PermissionList = Permission::where('status', 1)->get();
        $role = Role::with('permissions')->find(2);
        $data['role'] = $role;
        $data['MainMenuList'] = $PermissionList->where('type', 1);
        $data['SubMenuList'] = $PermissionList->where('type', 2);
        $data['ActionList'] = $PermissionList->where('type', 3);
        $data['PermissionList'] = $PermissionList;
        return view('rolepermission::permission', $data);

//        $data['RoleList'] = $this->roleRepository->all();
//        return view('rolepermission::role', $data);
    }

    public function create()
    {
        return view('rolepermission::create');
    }

    public function store(RoleFormRequest $request)
    {
        try {
            $this->roleRepository->create($request->except("_token"));
            \LogActivity::successLog('New Role - (' . $request->name . ') has been created.');
            return redirect()->route('permission.roles.index');
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage() . ' - Error has been detected for Role creation');
            return back();
        }
    }

    public function show($id)
    {
        return view('rolepermission::show');
    }


    public function edit(Role $role)
    {
        try {
            $RoleList = $this->roleRepository->all();
            return view('rolepermission::role', compact('RoleList', 'role'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function update(RoleFormRequest $request, $id)
    {
        try {
            $role = $this->roleRepository->update($request->except("_token"), $id);
            \LogActivity::successLog($request->name . '- has been updated.');
            return redirect()->back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage() . ' - Error has been detected for Role update');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $role = $this->roleRepository->delete($id);
            \LogActivity::successLog('A Role has been destroyed.');
            return redirect()->back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage() . ' - Error has been detected for Role Destroy');
            return redirect()->back();
        }
    }
}
