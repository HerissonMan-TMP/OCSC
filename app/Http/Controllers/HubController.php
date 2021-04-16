<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Convoy;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class HubController
 * @package App\Http\Controllers
 */
class HubController extends Controller
{
    public function show()
    {
        $counters['convoys'] = Convoy::count();
        $counters['articles'] = Article::count();
        $counters['users'] = User::count();

        return view('hub')
                ->with(compact('counters'));
    }
}
