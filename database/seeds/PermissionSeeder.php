<?php

use Illuminate\Database\Seeder;
use Junges\ACL\Exceptions\PermissionAlreadyExistsException;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->newPermission('Acess Admin page', 'access-admin-page', 'User is able to access the admin page.');
        $this->newPermission('Acess Auth panel', 'access-auth-panel', 'User can access auth panel in the dashboard.');
        $this->newPermission('Edit Users panel', 'edit-users-panel', 'User can edit other users in the auth panel.');
        $this->newPermission('Acess Demands page', 'access-demands-page', 'User can access demands page.');
        $this->newPermission('Make Demands', 'make-demands', 'User can make a new order.');
        $this->newPermission('Delete Demands', 'delete-demands', 'User can Delete orders.');
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
                return $permissionModel->create([
                    'name'        => $name,
                    'slug'        => $slug,
                    'description' => $description,
                ]);
            } catch (\Exception $exception) {
                return;
            }
        } catch (\Exception $exception) {
            return;
        }
    }
}
