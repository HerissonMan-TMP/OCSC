<?php

namespace App\Http\Controllers;

use App\Filters\PictureFilters;
use App\Http\Requests\Picture\DestroyManyPicturesRequest;
use App\Http\Requests\Picture\StorePictureRequest;
use App\Http\Requests\Picture\UpdatePictureRequest;
use App\Models\ActivityType;
use App\Models\Picture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class PictureController
 * @package App\Http\Controllers
 */
class PictureController extends Controller
{
    /**
     * Display all the pictures in the gallery.
     *
     * @param PictureFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function gallery(PictureFilters $filters)
    {
        $pictures = Picture::filter($filters)->with('user.roles')->paginate(12);

        return view('pictures.gallery')
                ->with(compact('pictures'));
    }

    /**
     * Display all the pictures (with options to manage them).
     *
     * @param PictureFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(PictureFilters $filters)
    {
        $pictures = Picture::filter($filters)->with('user.roles')->latest()->paginate(12);

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

        $picture = new Picture();

        $picture->name = $request->name;
        $picture->description = $request->description;

        $picture->user()->associate(Auth::user()->id);

        $path = $request->picture_file->store('gallery');
        $picture->path = basename($path);

        $picture->save();

        activity(ActivityType::CREATED)
            ->subject("fas fa-image", "Picture #{$picture->id}")
            ->description("Name: {$picture->name}")
            ->log();

        flash("You have successfully uploaded a new picture!")->success();

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

        activity(ActivityType::UPDATED)
            ->subject("fas fa-image", "Picture #{$picture->id}")
            ->description("Name: {$picture->name}")
            ->log();

        flash("You have successfully updated the picture '{$picture->name}'!")->success();

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

        activity(ActivityType::DELETED)
            ->subject("fas fa-image", "Picture #{$picture->id}")
            ->description("Name: {$picture->name}")
            ->log();

        flash("You have successfully deleted the picture '{$picture->name}'!")->success();

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
                return redirect()->route('staff.pictures.index')
                    ->withErrors(['select_mode' => 'You selected some pictures you cannot manage.']);
            }
        }

        Picture::destroy($request->pictures);

        $deletedPicturesID = implode(', ', $request->pictures);
        activity(ActivityType::DELETED)
            ->subject("fas fa-images", "Pictures")
            ->description("Pictures' ID: {$deletedPicturesID}")
            ->log();

        flash("You have successfully deleted the selected pictures!")->success();

        return redirect()->route('staff.pictures.index');
    }
}
