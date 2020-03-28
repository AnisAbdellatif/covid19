<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Role;
use \Illuminate\Support\Facades\Request;
use App\User;
use \App\Request as RoleRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @return string
     * @var string
     */
    public function redirectTo()
    {
        return route('home');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:8'],
            'description' => [Request::get('type') != 'default' ? 'required' : '', 'string', 'max:255'],
            'link' => [Request::get('type') != 'default' ? 'required' : '', 'url',],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return void
     */
    protected function create(array $data)
    {
        $name = $data['firstname']." ".$data['lastname'];
        $user = User::create([
            'name' => $name,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'phone' => $data['phone'],
            'country' => geoip()->getLocation(geoip()->getClientIP())->country,
        ]);

        $user->roles()->attach(Role::where('name', 'default')->get());
        if (in_array(Request::get('type'), array('volunteer', 'doctor'))) {
            RoleRequest::create([
                'user_id' => $user->id,
                'wanted' => Request::get('type'),
                'description' => $data['description'],
                'link' => $data['link'],
            ]);
            session(['status' => 'Thanks! Your submission was sent and we will reply soon, please check your Facebook/Instagram for updates! <3']);
        }
        return $user;
    }
}
