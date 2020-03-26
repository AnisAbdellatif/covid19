<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return bool
     */
    public function boot()
    {
        Gate::before(function ($user) {
            if ($user->hasRole('superadmin')) {
                return true;
            }
        });

        try {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (\Exception $e) {
            report($e);
            return false;
        }

        //Blade directives
        Blade::if('role', function ($roles) {
            return auth()->user()->hasRole( ... (is_array($roles)) ? $roles : array($roles));
        });

        Blade::if('permission', function ($permission) {
            return auth()->user()->can($permission);
        });
    }
}
