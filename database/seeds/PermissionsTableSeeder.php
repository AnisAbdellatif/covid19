<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accessAdminPanel = new Permission();
        $accessAdminPanel->name = 'access-admin-page';
        $accessAdminPanel->description = 'User can access admin page';
        $accessAdminPanel->save();

        $accessAuthPanel = new Permission();
        $accessAuthPanel->name = 'access-auth-panel';
        $accessAuthPanel->description = 'User can access auth panel in the dashboard';
        $accessAuthPanel->save();

        $accessDemandsPage = new Permission();
        $accessDemandsPage->name = 'access-demands-page';
        $accessDemandsPage->description = 'User can access demands page';
        $accessDemandsPage->save();

        $makeDemand = new Permission();
        $makeDemand->name = 'make-demand';
        $makeDemand->description = 'User can make a new order';
        $makeDemand->save();

        $deleteDemand = new Permission();
        $deleteDemand->name = 'delete-demand';
        $deleteDemand->description = 'User can Delete orders';
        $deleteDemand->save();
    }
}
