<?php

namespace studiobarg\RolePermission\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use studiobarg\Common\Responses\AjaxResponses;
use studiobarg\RolePermission\Http\Requests\RoleRequest;
use studiobarg\RolePermission\Http\Requests\RoleUpdateRequest;
use studiobarg\RolePermission\Models\Role;
use studiobarg\RolePermission\Repositories\PermissionRepo;
use studiobarg\RolePermission\Repositories\RoleRepo;


class RolePermissionsController extends Controller
{
    use AuthorizesRequests;
    private RoleRepo $roleRepo;
    private PermissionRepo $permissionRepo;

    public function __construct(RoleRepo $roleRepo, PermissionRepo $permissionRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
    }

    public function index()
    {
        $this->authorize('index', Role::class);
        $roles = $this->roleRepo->all();
        $permissions = $this->permissionRepo->all();

        return view('RolePermissions::index', compact('roles', 'permissions'));
    }


    public function store(RoleRequest $request)
    {
        $this->authorize('create', Role::class);
        $this->roleRepo->create($request);
        return redirect(route('role-permissions.index'));
    }

    public function edit($roleId)
    {
        $this->authorize('edit', Role::class);
        $role = $this->roleRepo->findById($roleId);
        $permissions = $this->permissionRepo->all();
        if (!$role) {
            return redirect()->route('role-permissions.index')->with('error', 'نقش موردنظر یافت نشد.');
        }
        return view('RolePermissions::edit', compact('role', 'permissions'));
    }

    public function update($id, RoleUpdateRequest $request)
    {
        $this->authorize('edit', Role::class);
        $role = $this->roleRepo->findById($id);

        $this->roleRepo->update($id, $request);

        return redirect()->route('role-permissions.index')->with('success', 'نقش با موفقیت بروزرسانی شد.');
    }

    public function destroy($roleId)
    {
        $this->authorize('delete', Role::class);
        $this->roleRepo->delete($roleId);
        return AjaxResponses::successResponse();
    }

}
