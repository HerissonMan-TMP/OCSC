@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center px-2 md:px-0 py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ config('app.default_banner') }}');">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-images fa-fw"></i> Gallery</h1>
        </div>
    </div>

    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
        <form action="" method="GET" class="mb-10 p-6 bg-gray-800 rounded-md grid grid-cols-10 gap-4">
            <div class="col-span-full md:col-span-1">
                <input type="text" name="by" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="By" value="{{ request('by') }}">
            </div>

            <div class="col-span-full md:col-span-2">
                <input type="text" name="name" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Picture name" value="{{ request('name') }}">
            </div>

            <div class="col-span-full md:col-span-2">
                <input type="text" name="description" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Picture description" value="{{ request('description') }}">
            </div>

            <div class="col-span-full md:col-span-1">
                <select name="sortByCreatedAt" class="capitalize text-gray-300 bg-gray-700 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option @if(request('sortByCreatedAt') === 'desc') selected @endif value="desc">Latest</option>
                    <option @if(request('sortByCreatedAt') === 'asc') selected @endif value="asc">Oldest</option>
                </select>
            </div>

            <div class="col-span-full md:col-span-1">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    OK
                </button>
            </div>
        </form>

        <div class="grid grid-cols-3 gap-6">
            @forelse($pictures as $picture)
            <div class="col-span-full md:col-span-1">
                <div class="gallery-img-wrapper relative">
                    <img src="{{ Storage::url('gallery/' . $picture->path) }}" alt="{{ $picture->name }}" class="rounded-lg">
                    <div class="gallery-img-overlay space-y-6 absolute p-6 flex flex-col justify-center items-center top-0 w-full h-full text-sm text-center rounded-lg cursor-pointer" style="display: none; background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8));">
                        <span class="text-base font-bold">{{ $picture->name }}</span>
                        <div class="w-full flex justify-between">
                        <span class="text-sm italic text-gray-300">
                            <i class="fas fa-user fa-fw fa-md"></i>
                            @if($picture->user)
                                <span class="font-bold" style="color: {{ $picture->user->roles->first()->color }}">{{ $picture->user->name }}</span>
                            @else
                                <span>Anonymous</span>
                            @endif
                        </span>
                            <span>
                            <i class="fas fa-clock fa-fw fa-md"></i>
                            {{ $picture->created_at->format('d M H:i') }}
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <span class="text-sm italic text-gray-300">No pictures in the gallery yet...</span>
            @endforelse
        </div>

        {{ $pictures->onEachSide(1)->withQueryString()->links() }}
    </div>

    <div id="gallery-img-extended" class="fixed p-4 md:p-0 w-full h-full top-0 left-0 right-0 bottom-0 flex justify-center items-center cursor-pointer z-2" style="display: none; background-color: rgba(0,0,0,0.5);">
        <img src="" alt="" class="w-full md:w-1/2 rounded-md">
    </div>
@endsection

@push('scripts')
    <script>
        $('.gallery-img-wrapper').mouseenter(function () {
            var index = $('.gallery-img-wrapper').index(this);
            $('.gallery-img-wrapper .gallery-img-overlay').eq(index).fadeIn(200);
        }).mouseleave(function () {
            var index = $('.gallery-img-wrapper').index(this);
            $('.gallery-img-wrapper .gallery-img-overlay').eq(index).fadeOut(200);
        }).click(function () {
            var index = $('.gallery-img-wrapper').index(this);
            $('#gallery-img-extended img').attr('src', $(this).find('img').attr('src'));
            $('#gallery-img-extended').fadeIn(200);
        });

        $('#gallery-img-extended').click(function () {
            $('#gallery-img-extended').fadeOut(200);
        });
    </script>
@endpush
