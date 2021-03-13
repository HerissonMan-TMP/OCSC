<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WebsiteSettingController extends Controller
{
    public function update(WebsiteSetting $websiteSetting, Request $request)
    {
        Gate::authorize('has-admin-rights');

        $websiteSetting->value = $request->value;
        $websiteSetting->save();

        return back();
    }
}
