<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage permissions');
    }

    public function index() {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create() {
        return view('admin.permissions.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        Permission::create($request->all());

        return redirect()->route('permission.index')->with('success', 'Permission created successfully.');
    }

    public function edit($id) {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

        return redirect()->route('permission.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy($id) {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('permission.index')->with('success', 'Permission deleted successfully.');
    }
}
// }
