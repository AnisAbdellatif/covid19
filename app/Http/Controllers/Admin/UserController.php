<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:edit-auth-panel')->except('index');
    }

    public function index()
    {
        $superId = Role::where('name', 'superadmin')->first()->id;
        $superUsersIds = DB::table('role_user')
            ->where('role_id', $superId)
            ->pluck('user_id')
            ->toArray();
        $users = User::whereNotIn('id', $superUsersIds)->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'roles' => ['array'],
            'permissions' => ['array'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->roles) {
            $user->roles()->attach(Role::whereIn('name', $request->roles)->get());
        }
        if ($request->permissions) {
            $user->permissions()->attach(Permission::whereIn('name', $request->permissions)->get());
        }

        return back()->withSuccess("User '$user->name' has been successfully created.");
    }

    public function update(Request $request, $lang, $id)
    {
        $user = User::findOrFail($id);
        $oldName = $user->name;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->roles()->detach();
        $user->permissions()->detach();
        if (isset($request->roles)) {
            $user->roles()->attach(Role::whereIn('name', $request->roles)->get());
        }
        if (isset($request->permissions)) {
            $user->permissions()->attach(Permission::whereIn('name', $request->permissions)->get());
        }
        return back()->withSuccess("User '$oldName' has been successfully edited.");
    }

    public function search(Request $request) {
        $query = $request->get('query');
        $category = $request->get('category');

        $users = User::where($category, 'like', '%'.$query.'%')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->password = Hash::make($data['password']);
        $user->save();
        return route('home');
    }

    public function destroy($lang, $id)
    {
        User::destroy($id);
        return back()->withSuccess("User has been successfully deleted.");
    }
}
