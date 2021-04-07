@inject("carbon", "\Carbon\Carbon")

@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.imgur.com/kZ3YjwR.png');">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-images fa-fw"></i> Gallery</h1>
        </div>
    </div>

    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
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
                                <span>Unkown User</span>
                            @endif
                        </span>
                            <span>
                            <i class="fas fa-clock fa-fw fa-md"></i>
                            {{ $carbon->parse($picture->created_at)->format('d M H:i') }}
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <span class="text-sm italic text-gray-300">No pictures in the gallery yet...</span>
            @endforelse
        </div>

        {{ $pictures->onEachSide(1)->links() }}
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
