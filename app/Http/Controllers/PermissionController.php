<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Permissions',
            'permission' => Permission::all(),
        ];
        return view('content.permission.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Permissions',
        ];
        return view('content.permission.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('master-data.permissions.index')->with('success', 'Permission created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = [
            'title' => 'Permissions',
            'permission' => Permission::findOrFail($id),
        ];

        return view('content.permission.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $id,
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update([
            'name' => $request->name,
        ]);

        return redirect()->route('master-data.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy($id)
    {
        $id = decrypt($id);
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('master-data.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
