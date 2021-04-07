<?php

namespace App\Http\Controllers;

use App\Http\Requests\Picture\DestroyManyPicturesRequest;
use App\Http\Requests\Picture\StorePictureRequest;
use App\Http\Requests\Picture\UpdatePictureRequest;
use App\Models\Picture;
use Auth;
use Gate;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    protected $picture;

    public function __construct(Picture $picture)
    {
        $this->picture = $picture;
    }

    public function gallery()
    {
        $pictures = Picture::with('user.roles')->latest()->paginate(12);

        return view('pictures.gallery')
                ->with(compact('pictures'));
    }

    public function index()
    {
        Gate::authorize('see-gallery');

        $pictures = Picture::with('user.roles')->latest()->paginate(12);

        return view('pictures.index')
            ->with(compact('pictures'));
    }

    public function create()
    {
        Gate::authorize('add-pictures-to-gallery');

        return view('pictures.create');
    }

    public function store(StorePictureRequest $request)
    {
        Gate::authorize('add-pictures-to-gallery');

        $this->picture->name = $request->name;
        $this->picture->description = $request->description;
        $this->picture->user()->associate(Auth::user()->id);
        $path = $request->picture_file->store('gallery');
        $this->picture->path = basename($path);
        $this->picture->save();

        return redirect()->route('staff.pictures.index');
    }

    public function edit(Picture $picture)
    {
        Gate::authorize('manage-picture', $picture);

        return view('pictures.edit')
                ->with(compact('picture'));
    }

    public function update(UpdatePictureRequest $request, Picture $picture)
    {
        Gate::authorize('manage-picture', $picture);

        $picture->update($request->validated());

        return redirect()->route('staff.pictures.index');
    }

    public function destroy(Picture $picture)
    {
        Gate::authorize('manage-picture', $picture);

        $picture->delete();

        return redirect()->route('staff.pictures.index');
    }

    public function destroyMany(DestroyManyPicturesRequest $request)
    {
        foreach ($request->pictures ?? [] as $pictureId) {
            $response = Gate::inspect('manage-picture', Picture::find($pictureId));

            if (!$response->allowed()) {
                return back()->withErrors(['select_mode' => 'You selected some pictures you cannot manage.']);
            }
        }

        Picture::destroy($request->pictures);

        return redirect()->route('staff.pictures.index');
    }
}
