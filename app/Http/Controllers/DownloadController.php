<?php

namespace App\Http\Controllers;

use App\Http\Requests\Download\StoreDownloadRequest;
use App\Http\Requests\Download\UpdateDownloadRequest;
use App\Models\Download;
use App\Models\Role;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Gate;

/**
 * Class DownloadController
 * @package App\Http\Controllers
 */
class DownloadController extends Controller
{
    /**
     * Display all the available downloads for the authenticated user.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        Gate::authorize('see-downloads');

        $downloads = Download::accessible()->with('roles')->get();
        $roles = Role::orderBy('order')->get();

        return view('downloads.index')
                ->with(compact('downloads'))
                ->with(compact('roles'));
    }

    /**
     * Store a new download.
     *
     * @param StoreDownloadRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreDownloadRequest $request)
    {
        Gate::authorize('manage-downloads');

        $download = Download::create($request->validated());
        $download->roles()->attach($request->roles);

        return back();
    }

    /**
     * Update the given download.
     *
     * @param Download $download
     * @param UpdateDownloadRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Download $download, UpdateDownloadRequest $request)
    {
        Gate::authorize('manage-downloads');

        $download->update($request->validated());
        $download->roles()->sync($request->roles);

        return back();
    }

    /**
     * Delete the given download.
     *
     * @param Download $download
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Download $download)
    {
        Gate::authorize('manage-downloads');

        $download->delete();

        return back();
    }
}
