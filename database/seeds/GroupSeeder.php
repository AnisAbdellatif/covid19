<?php

use Illuminate\Database\Seeder;
use Junges\ACL\Http\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->newGroup('Super Admin', 'superadmin', 'Access to everything.');
        Group::where('slug', 'superadmin')->first()->assignAllPermissions();

        $admin = $this->newGroup('Admin', 'admin', 'Normal Admin.');
        Group::where('slug', 'admin')->first()->assignPermissions('access-admin-page', 'access-auth-panel', 'access-demands-page');

        $volunteer = $this->newGroup('Volunteer', 'volunteer', 'Helps people.');
        Group::where('slug', 'volunteer')->first()->assignPermissions('access-demands-page', 'make-demands', 'delete-demands');

        $doctor = $this->newGroup('Doctor', 'doctor', 'Helps people.');
        Group::where('slug', 'doctor')->first()->assignPermissions('access-demands-page', 'make-demands', 'delete-demands');

        $default = $this->newGroup('Default', 'default', 'Default User.');
        Group::where('slug', 'default')->first()->assignPermissions('make-demands', 'delete-demands');
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
