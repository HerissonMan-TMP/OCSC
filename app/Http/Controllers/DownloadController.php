<?php

namespace App\Http\Controllers;

use App\Http\Requests\Download\StoreDownloadRequest;
use App\Models\Download;
use App\Models\Role;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Gate;

class DownloadController extends Controller
{
    /**
     * A Download instance.
     *
     * @var Download
     */
    protected $download;

    public function __construct(Download $download)
    {
        $this->download = $download;
    }

    /**
     * Display a listing of the available downloads.
     */
    public function index()
    {
        Gate::authorize('see-downloads');

        $downloads = Download::accessible()->with('roles')->get();
        $roles = Role::orderBy('order')->get();

        return view('downloads.index')
                ->with('downloads', $downloads)
                ->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDownloadRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreDownloadRequest $request)
    {
        Gate::authorize('manage-downloads');

        $this->download->name = $request->name;
        $this->download->link = $request->link;
        $this->download->save();

        $this->download->roles()->attach($request->roles);

        return back();
    }

    /**
     * Delete the given download.
     *
     * @param Download $download
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Download $download)
    {
        Gate::authorize('manage-downloads');

        $download->delete();

        return back();
    }
}
