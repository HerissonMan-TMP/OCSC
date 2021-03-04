<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $roles = Role::recruitable()->with(['recruitments' => function ($query) {
            return $query->open();
        }])->get();
        View::share('recruitableRoles', $roles);
    }
}
