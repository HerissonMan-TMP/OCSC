<?php

namespace App\Http\Controllers;

use App\Http\Requests\Download\StoreDownloadRequest;
use App\Http\Requests\Download\UpdateDownloadRequest;
use App\Models\ActivityType;
use App\Models\Download;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

/**
 * Class DownloadController
 * @package App\Http\Controllers
 */
class DownloadController extends Controller
{
    /**
     * Display all the available downloads for the authenticated user.
     */
    public function index()
    {
        $downloads = Download::accessible()->get();

        return view('downloads.index')
                ->with(compact('downloads'));
    }

    /**
     * Download a file.
     *
     * @param Download $download
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function download(Download $download)
    {
        Gate::authorize('download-file', $download);

        return Storage::download('downloads/' . $download->path, $download->original_file_name);
    }

    /**
     * Display the form to add a new download.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        Gate::authorize('manage-downloads');

        $roles = Role::orderBy('order')->get();

        return view('downloads.create')
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

        $download = new Download();
        $download->name = $request->name;
        $download->original_file_name = $request->file->getClientOriginalName();

        $path = $request->file->store('downloads');
        $download->path = basename($path);

        $download->save();
        $download->roles()->attach($request->roles);

        activity(ActivityType::CREATED)
            ->subject('fas fa-download', "Download #{$download->id}")
            ->description("Name: {$download->name}")
            ->log();

        flash("You have successfully added a new download!")->success();

        return redirect()->route('staff.downloads.index');
    }

    /**
     * Display the form to edit the given download.
     *
     * @param Download $download
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Download $download)
    {
        Gate::authorize('manage-downloads');

        $roles = Role::orderBy('order')->get();

        return view('downloads.edit')
            ->with(compact('download'))
            ->with(compact('roles'));
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

        activity(ActivityType::UPDATED)
            ->subject('fas fa-download', "Download #{$download->id}")
            ->description("Name: {$download->name}")
            ->log();

        flash("You have successfully updated the download '{$download->name}'!")->success();

        return redirect()->route('staff.downloads.index');
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
        Storage::delete('downloads/' . $download->path);

        activity(ActivityType::DELETED)
            ->subject('fas fa-download', "Download #{$download->id}")
            ->description("Name: {$download->name}")
            ->log();

        flash("You have successfully deleted the download '{$download->name}'!")->success();

        return redirect()->route('staff.downloads.index');
    }
}
