<?php

namespace studiobarg\RolePermission\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepo
{
    public static function all()
    {
        return Role::all();
    }//End Method

    public static function create($request)
    {
        return Role::create(['name' => $request->name])->syncPermissions($request->permissions);
    }//End Method

    public static function findById($id)
    {
        return Role::findOrFail($id);
    }//End Method

    public function update($id, $request)
    {
         $role = Role::findOrFail($id);
        return $role->syncPermissions($request->permissions)->update(['name' => $request->name]);
    }

    public function delete($id){
        Role::where('id', $id)->delete();
    }
}
