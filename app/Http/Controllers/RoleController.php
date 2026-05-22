<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Roles',
            'role' => Role::with('permissions')->get(),
        ];

        return view('content.role.index', $data);
    }

    public function create()
    {
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
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('master-data.roles.index')->with('success', 'Role created successfully.');
    }

    public function show($id)
    {
        // 
    }

    public function edit($id)
    {
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
        $id = decrypt($id);
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
            'permissions' => 'array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('master-data.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $id = decrypt($id);
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('master-data.roles.index')->with('success', 'Role deleted successfully.');
    }
}
