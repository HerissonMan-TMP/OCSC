<?php

namespace App\Http\Controllers;

use App\Http\Requests\Picture\DestroyManyPicturesRequest;
use App\Http\Requests\Picture\StorePictureRequest;
use App\Http\Requests\Picture\UpdatePictureRequest;
use App\Models\Picture;
use Auth;
use Gate;

/**
 * Class PictureController
 * @package App\Http\Controllers
 */
class PictureController extends Controller
{
    /**
     * Display all the pictures in the gallery.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function gallery()
    {
        $pictures = Picture::with('user.roles')->latest()->paginate(12);

        return view('pictures.gallery')
                ->with(compact('pictures'));
    }

    /**
     * Display all the pictures (with options to manage them).
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        Gate::authorize('see-gallery');

        $pictures = Picture::with('user.roles')->latest()->paginate(12);

        return view('pictures.index')
            ->with(compact('pictures'));
    }

    /**
     * Display the form to add a new picture.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        Gate::authorize('add-pictures-to-gallery');

        return view('pictures.create');
    }

    /**
     * Store a new picture in the database and the storage.
     *
     * @param StorePictureRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StorePictureRequest $request)
    {
        Gate::authorize('add-pictures-to-gallery');

        $picture = new Picture;

        $picture->name = $request->name;
        $picture->description = $request->description;

        $picture->user()->associate(Auth::user()->id);

        $path = $request->picture_file->store('gallery');
        $picture->path = basename($path);

        $picture->save();

        return redirect()->route('staff.pictures.index');
    }

    /**
     * Display the form to edit the given picture.
     *
     * @param Picture $picture
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Picture $picture)
    {
        Gate::authorize('manage-picture', $picture);

        return view('pictures.edit')
                ->with(compact('picture'));
    }

    /**
     * Update the given picture.
     *
     * @param UpdatePictureRequest $request
     * @param Picture $picture
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdatePictureRequest $request, Picture $picture)
    {
        Gate::authorize('manage-picture', $picture);

        $picture->update($request->validated());

        return redirect()->route('staff.pictures.index');
    }

    /**
     * Delete the given picture.
     *
     * @param Picture $picture
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Picture $picture)
    {
        Gate::authorize('manage-picture', $picture);

        $picture->delete();

        return redirect()->route('staff.pictures.index');
    }

    /**
     * Delete many given pictures.
     *
     * @param DestroyManyPicturesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyMany(DestroyManyPicturesRequest $request)
    {
        foreach ((array) $request->pictures as $pictureId) {
            $response = Gate::inspect('manage-picture', Picture::find($pictureId));

            if (!$response->allowed()) {
                return back()->withErrors(['select_mode' => 'You selected some pictures you cannot manage.']);
            }
        }

        Picture::destroy($request->pictures);

        return redirect()->route('staff.pictures.index');
    }
}
