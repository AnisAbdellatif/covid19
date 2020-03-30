<?php

namespace App\Http\Controllers\Admin;

use \App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Junges\ACL\Http\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('groups:superadmin')->except('index');
    }

    public function index()
    {
        $roles = auth()->user()->groups()->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:roles'],
            'description' => ['required', 'string'],
            'permissions' => ['array'],
        ]);

        $this->newGroup($request->name, $request->slug, $request->description);
        Group::where('slug', $request->slug)->first()->assignPermissions($request->permissions);

        return back()->withSuccess("Role '$request->name' has been successfully created.");
    }

    public function update(Request $request, $lang, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'permissions' => ['array'],
        ]);

        $role = Group::findOrFail($id);
        $oldName = $role->name;
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->save();

        auth()->user()->getAllPermissions()->each(function ($item, $key) use ($role)
        {
            $role->revokePermissions($item);
        });

        if (isset($request->permissions)) {
            $role->assignPermissions($request->permissions);
        }
        return back()->withSuccess("Role '$oldName' has been successfully edited.");
    }

    public function destroy($lang, $id)
    {
        Group::destroy($id);
        return back()->withSuccess("Role has been successfully deleted.");
    }

    private function newGroup($name, $slug, $description)
    {
        try {
            $groupModel = app(config('acl.models.group'));
            try {
                $group = $groupModel->where('slug', $slug)
                    ->orWhere('name', $name)
                    ->first();
                if (! is_null($group)) {
                    return;
                }
                $groupModel->create([
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
