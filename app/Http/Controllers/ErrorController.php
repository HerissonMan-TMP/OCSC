<?php

namespace App\Http\Controllers;

use App\Filters\ErrorFilters;
use App\Models\Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ErrorController extends Controller
{
    public function index(ErrorFilters $filters)
    {
        Gate::authorize('see-error-logs');

        $errors = Error::filter($filters)->paginate(20);

        return view('website-settings.error-logs')
                ->with(compact('errors'));
    }
}
