<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::All();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions'],
            'description' => ['required', 'string'],
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return back()->withSuccess("Permission '$permission->name' has been successfully created.");
    }

    public function update(Request $request, $lang, $id)
    {
        $permission = Permission::findOrFail($id);
        $oldName = $permission->name;
        $permission ->name = $request->name;
        $permission ->description = $request->description;
        $permission->save();
        return back()->withSuccess("Permission '$oldName' has been successfully edited.");
    }

    public function destroy($lang, $id)
    {
        Permission::destroy($id);
        return back()->withSuccess("Permission has been successfully deleted.");
    }
}
