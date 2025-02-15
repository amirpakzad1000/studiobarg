<?php

namespace studiobarg\RolePermission\Http\Controllers;

use App\Http\Controllers\Controller;
use studiobarg\Category\Responses\AjaxResponse;
use studiobarg\RolePermission\Http\Requests\RoleRequest;
use studiobarg\RolePermission\Http\Requests\RoleUpdateRequest;
use studiobarg\RolePermission\Repositories\PermissionRepo;
use studiobarg\RolePermission\Repositories\RoleRepo;


class RolePermissionsController extends Controller
{
    private RoleRepo $roleRepo;
    private PermissionRepo $permissionRepo;

    public function __construct(RoleRepo $roleRepo, PermissionRepo $permissionRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
    }

    public function index()
    {
        $roles = $this->roleRepo->all();
        $permissions = $this->permissionRepo->all();

        return view('RolePermissions::index', compact('roles', 'permissions'));
    }

    public function store(RoleRequest $request)
    {
        $this->roleRepo->create($request);
        return back();
    }

    public function edit($roleId)
    {
        $role = $this->roleRepo->findById($roleId);
        $permissions = $this->permissionRepo->all();
        if (!$role) {
            return redirect()->route('role-permissions.index')->with('error', 'نقش موردنظر یافت نشد.');
        }
        return view('RolePermissions::edit', compact('role', 'permissions'));
    }

    public function update($id, RoleUpdateRequest $request)
    {
        $role = $this->roleRepo->findById($id);

        $this->roleRepo->update($id, $request);

        return redirect()->route('role-permissions.index')->with('success', 'نقش با موفقیت بروزرسانی شد.');
    }

    public function destroy($roleId)
    {
        $this->roleRepo->delete($roleId);
        return AjaxResponse::successResponse();
    }

}
