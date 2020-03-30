<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Anis Abdellatif',
            'email' => 'super@mriguel.org',
            'password' => Hash::make('password'),
            'address' => '31 resideance Ennaser, Mnihla, 2094',
            'phone' => '56133606',
            'country' => 'Tunisia',
        ]);
        $superadmin->assignAllGroups();
        $superadmin->assignAllPermissions();

        $admin = User::create([
            'name' => 'Test',
            'email' => 'test@mriguel.org',
            'password' => Hash::make('password'),
            'address' => '31 resideance Ennaser, Mnihla, 2094',
            'phone' => '56133606',
            'country' => 'Tunisia',
        ]);
        $admin->assignGroup('default', 'volunteer');

    }
}
