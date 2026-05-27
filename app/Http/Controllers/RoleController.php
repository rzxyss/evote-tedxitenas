<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        checkingPermission('role_view');
        $data = [
            'title' => 'Roles',
            'role' => Role::with('permissions')->get(),
        ];

        return view('content.role.index', $data);
    }

    public function create()
    {
        checkingPermission('role_create');
        $data = [
            'title' => 'Roles',
            'permissions' => Permission::orderBy('name')->get()
                ->groupBy(function ($permission) {
                    return explode('_', $permission->name)[0];
                }),
        ];

        return view('content.role.create', $data);
    }

    public function store(Request $request)
    {
        checkingPermission('role_create');
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        try {
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($request->permissions ?? []);

            return redirect()->route('master-data.roles.index')->with('success', 'Role created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create role: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        // 
    }

    public function edit($id)
    {
        checkingPermission('role_update');
        $id = decrypt($id);

        $role = Role::with('permissions')->findOrFail($id);

        $data = [
            'title' => 'Roles',
            'role' => $role,

            'permissions' => Permission::orderBy('name')->get()
                ->groupBy(function ($permission) {
                    return explode('_', $permission->name)[0];
                }),

            'rolePermissions' => $role->permissions->pluck('name')->toArray(),
        ];

        return view('content.role.edit', $data);
    }

    public function update(Request $request, $id)
    {
        checkingPermission('role_update');
        $id = decrypt($id);
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
            'permissions' => 'array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        try {
            $role = Role::findOrFail($id);
            $role->update([
                'name' => $request->name,
            ]);

            $role->syncPermissions($request->permissions ?? []);

            return redirect()->route('master-data.roles.index')->with('success', 'Role updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update role: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        checkingPermission('role_delete');
        $id = decrypt($id);
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->route('master-data.roles.index')->with('success', 'Role deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to delete role: ' . $e->getMessage()]);
        }
    }
}
