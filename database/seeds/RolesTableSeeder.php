<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_role = new Role();
        $super_role->name = 'superadmin';
        $super_role->description = 'Super Admin: Controlls everything';
        $super_role->save();
        $super_role->permissions()->attach(Permission::All());

        $admin_role = new Role();
        $admin_role->name = 'admin';
        $admin_role->description = 'Normal Admin';
        $admin_role->save();
        $admin_role->permissions()->attach(Permission::whereIn('name', ['access-admin-page', 'make-demand', 'delete-demand'])->get());
//
        $volunteer_role = new Role();
        $volunteer_role->name = 'volunteer';
        $volunteer_role->description = 'Helps people';
        $volunteer_role->save();
        $volunteer_role->permissions()->attach(Permission::whereIn('name', ['access-demands-page', 'make-demand', 'delete-demand'])->get());
//
        $doctor_role = new Role();
        $doctor_role->name = 'doctor';
        $doctor_role->description = 'Helps people';
        $doctor_role->save();
        $doctor_role->permissions()->attach(Permission::whereIn('name', ['access-demands-page', 'make-demand', 'delete-demand'])->get());
//
        $default_role = new Role();
        $default_role->name = 'default';
        $default_role->description = 'Normal User';
        $default_role->save();
        $default_role->permissions()->attach(Permission::whereIn('name', ['make-demand'])->get());
    }
}
