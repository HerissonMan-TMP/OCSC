<?php

namespace App\Http\Controllers;

use App\Filters\ErrorFilters;
use App\Models\Error;
use Illuminate\Support\Facades\Gate;

/**
 * Class ErrorController
 * @package App\Http\Controllers
 */
class ErrorController extends Controller
{
    /**
     * Display the error logs.
     *
     * @param ErrorFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(ErrorFilters $filters)
    {
        Gate::authorize('see-error-logs');

        $errors = Error::filter($filters)->paginate(20);

        return view('website-settings.error-logs')
                ->with(compact('errors'));
    }
}
