<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
        $this->app->bind('twitch', \App\Services\Twitch::class);

        $this->app->bind('activity', function ($app, $parameters) {
            return new \App\Services\Activity($parameters[0]);
        });

        $this->app->singleton('users', function ($app) {
            return User::with('roles.permissions')->get();
        });

        $this->app->singleton('roles', function ($app) {
            return Role::with('permissions')->get();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('whereLike', function ($columns, $search) {
            $this->where(function ($query) use ($columns, $search) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', "%{$search}%");
                }
            });
        });

        //3 latest news articles
        $latestArticles = Article::latest()->take(3)->get();
        View::share('latestArticles', $latestArticles);

        //Roles that can recruit people.
        $roles = Role::recruitable()->with(['recruitments' => function ($query) {
            return $query->open();
        }])->get();
        View::share('recruitableRoles', $roles);
    }
}
