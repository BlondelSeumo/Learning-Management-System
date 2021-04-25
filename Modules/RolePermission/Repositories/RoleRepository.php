<?php

namespace Modules\RolePermission\Repositories;

use Modules\RolePermission\Entities\Role;
use Modules\RolePermission\Entities\Permission;
use Auth;
use Modules\RolePermission\Repositories\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        return Role::orderBy('id', 'desc')->get();
    }

    public function create(array $data)
    {
        $role = new Role();
        $role->name = $data['name'];
        $role->type = 'User Defined';
        $role->save();
    }

    public function find($id)
    {
        //
    }

    public function update(array $data, $id)
    {
        return Role::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        Role::findOrFail($id)->delete();
    }
}
