<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage roles');
    }

    public function index() {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create() {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create(['name' => $request->name]);
        
        if ($request->has('permissions') && !empty($request->permissions)) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

    public function edit($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);
        
        if ($request->has('permissions') && !empty($request->permissions)) {
            $role->permissions()->sync($request->permissions);
        } else {
            $role->permissions()->sync([]);
        }

        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id) {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role deleted successfully.');
    }
}

