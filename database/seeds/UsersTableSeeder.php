<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superUser = new User();
        $superUser->name = 'Anis Abdellatif';
        $superUser->email = 'super@'.config('app.url');
        $superUser->password = bcrypt('password');
        $superUser->address = '31 resideance Ennaser, Mnihla, 2094';
        $superUser->phone = '56133606';
        $superUser->country = 'Tunisia';
        $superUser->save();
        $superUser->roles()->attach(Role::All());
        $superUser->permissions()->attach(Permission::All());

        $volunteer = new User();
        $volunteer->name = 'Volunteer';
        $volunteer->email = 'volunteer@'.config('app.url');
        $volunteer->password = bcrypt('password');
        $volunteer->address = '31 resideance Ennaser, Mnihla, 2094';
        $volunteer->phone = '56133606';
        $volunteer->country = 'Algeria';
        $volunteer->save();
        $volunteer->roles()->attach(Role::where('name', 'volunteer')->get());
    }
}
