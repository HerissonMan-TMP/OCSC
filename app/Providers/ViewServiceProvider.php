<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
     * @return void
     */
    public function boot()
    {
        //"if" statements to prevent errors on initial setup of the project.
        if (Schema::hasTable('articles')) {
            //3 latest news articles
            $latestArticles = Article::latest()->take(3)->get();
            View::share('latestArticles', $latestArticles);
        }

        if (Schema::hasTable('roles')) {
            //Roles that can recruit people.
            $roles = Role::recruitable()->with(['recruitments' => function ($query) {
                return $query->open();
            }])->get();
            View::share('recruitableRoles', $roles);
        }

        View::composer(['*'], function ($view) {
            if (Auth::check()) {
                $view->with('authUser', Auth::user()->load('roles'));
            }
        });

        View::composer(['layouts/staff'], function ($view) {
            $view->with('contactMessagesCount', ContactMessage::where('status', ContactMessage::UNREAD)->count());
            $view->with('applicationsCount', Application::where('status', Application::NEW)->count());
        });
    }
}
