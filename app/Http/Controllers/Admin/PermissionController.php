<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Junges\ACL\Http\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('groups:superadmin')->except('index');
    }

    public function index()
    {
        $permissions = auth()->user()->getAllPermissions();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:permissions'],
            'description' => ['required', 'string'],
        ]);

        $this->newPermission($request->name, $request->slug, $request->description);

        return back()->withSuccess("Permission '$request->name' has been successfully created.");
    }

    public function update(Request $request, $lang, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);
        $permission = Permission::findOrFail($id);
        $oldName = $permission->name;
        $permission->name = $request->name;
        $permission->slug = $request->slug;
        $permission->description = $request->description;
        $permission->save();
        return back()->withSuccess("Permission '$oldName' has been successfully edited.");
    }

    public function destroy($lang, $id)
    {
        Permission::destroy($id);
        return back()->withSuccess("Permission has been successfully deleted.");
    }

    private function newPermission($name, $slug, $description)
    {
        try {
            $permissionModel = app(config('acl.models.permission'));

            try {
                $permission = $permissionModel->where('slug', $slug)
                    ->orWhere('name', $name)
                    ->first();
                if (! is_null($permission)) {
                    return;
                }
                $permissionModel->create([
                    'name'        => $name,
                    'slug'        => $slug,
                    'description' => $description,
                ]);
                return;
            } catch (\Exception $exception) {
                return;
            }
        } catch (\Exception $exception) {
            return;
        }
    }
}
