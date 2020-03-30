<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Junges\ACL\Http\Models\Group;
use App\User;
use App\Request as RoleRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $requests = RoleRequest::where('finished', 0)->paginate(10);
        return view('admin.requests.index', compact('requests'));
    }

    public function update(Request $request, $lang, $id)
    {
        $userRequest = RoleRequest::findOrFail($id);
        $userRequest->finished = true;
        $userRequest->save();

        if(\Illuminate\Support\Facades\Request::get('action') == 'accept')
        {
            $user = User::findOrFail($userRequest->user_id);
            $user->assignGroup($userRequest->wanted);
        }


        return back()->withSuccess("Request has been successfully updated.");
    }

    public function destroy()
    {
        return;
    }
}
