<?php

namespace App\Http\Controllers;

use App\Filters\ErrorFilters;
use App\Models\Error;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index(ErrorFilters $filters)
    {
        $errors = Error::filter($filters)->paginate(20);

        return view('website-settings.error-logs')
                ->with(compact('errors'));
    }
}
