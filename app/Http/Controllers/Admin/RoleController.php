<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::All();
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
            'description' => ['required', 'string'],
            'permissions' => ['array'],
        ]);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $role->permissions()->attach(Permission::whereIn('name', $request->permissions)->get());

        return back()->withSuccess("Role '$role->name' has been successfully created.");
    }

    public function update(Request $request, $lang, $id)
    {
        $role = Role::findOrFail($id);
        $oldName = $role->name;
        $role ->name = $request->name;
        $role ->description = $request->description;
        $role->save();
        $role->permissions()->detach();
        if ($request->permissions) {
            $role->permissions()->attach(Permission::whereIn('name', $request->permissions)->get());
        }
        return back()->withSuccess("Role '$oldName' has been successfully edited.");
    }

    public function destroy($lang, $id)
    {
        Role::destroy($id);
        return back()->withSuccess("Role has been successfully deleted.");
    }
}
