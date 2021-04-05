@inject("carbon", "\Carbon\Carbon")

@extends('layouts.staff')

@section('title', 'Gallery - Staff')

@section('breadcrumb', 'Staff - Gallery')

@section('content-staff')
    <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">

        <div class="flex justify-between items-center mt-2 mb-6">
            <div>
                <h3 class="m-0 font-bold text-2xl text-gray-300">Gallery</h3>
            </div>
            <div>
                <a href="{{ route('staff.pictures.create') }}" class="transition duration-200 ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-gray-700 font-bold bg-primary hover:text-gray-800 hover:bg-primary-dark">
                    Add a new picture
                </a>
            </div>
        </div>

        <form action="" method="POST">
            @csrf
            @method('DELETE')
            <div class="mt-10 mb-6">
                <button type="button" id="enable-select-mode" class="transition duration-200 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-gray-700 font-bold bg-primary hover:text-gray-800 hover:bg-primary-dark focus:outline-none">
                    Enable select mode
                </button>
                <button type="button" id="disable-select-mode" class="transition duration-200 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-gray-200 font-bold bg-red-500 hover:text-gray-300 hover:bg-red-600 focus:outline-none" style="display: none;">
                    Disable select mode
                </button>
                <button type="submit" formaction="{{ route('staff.pictures.destroy-many') }}" id="select-mode-delete" class="transition duration-200 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-gray-200 font-bold bg-red-500 hover:text-gray-300 hover:bg-red-600 focus:outline-none" style="display: none;">
                    Delete
                </button>
            </div>

            @error('pictures')
            <span class="pt-2 text-sm text-red-500">
                {{ $message }}
            </span>
            @enderror

            <div class="grid grid-cols-3 gap-20">
                @forelse($pictures as $picture)
                <div class="col-span-full md:col-span-1">
                    <div class="gallery-img-wrapper relative">
                        <img src="{{ asset('storage/gallery/' . $picture->path) }}" alt="{{ $picture->name }}" class="rounded-lg">
                        <div class="absolute top-0 right-2">
                            <input type="checkbox" name="pictures[]" value="{{ $picture->id }}" class="select-mode-checkbox pointer-events-none rounded-full border-none text-primary cursor-pointer focus:ring-offset-0 focus:ring-0" style="display: none;">
                        </div>
                        <div class="gallery-img-overlay space-y-6 absolute p-6 flex flex-col justify-center items-center top-0 w-full h-full text-sm text-center rounded-lg" style="display: none; background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8));">
                            <div class="absolute top-2 right-2">
                                <a href="{{ route('staff.pictures.edit', $picture) }}" class="h-10 transition duration-200 w-10 flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark focus:outline-none">
                                    <i class="fas fa-pen fa-fw fa-md"></i>
                                </a>
                            </div>
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
                                <span><i class="fas fa-clock fa-fw fa-md"></i>{{ $carbon->parse($picture->created_at)->format('d M H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <span class="text-sm italic text-gray-300">No pictures in the gallery yet...</span>
                @endforelse
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        //Select mode
        var selectModeEnabled = false;

        $('#enable-select-mode').click(function () {
            $('#enable-select-mode').hide();
            $('#disable-select-mode').show();
            $('#select-mode-delete').show();
            $('.select-mode-checkbox').show();
            $('.gallery-img-wrapper img').css('filter', 'brightness(30%)');
            $('.gallery-img-wrapper').addClass('cursor-pointer');
            selectModeEnabled = true;
        });

        $('#disable-select-mode').click(function () {
            $('#disable-select-mode').hide();
            $('#select-mode-delete').hide();
            $('#enable-select-mode').show();
            $('.select-mode-checkbox').hide();
            $('.gallery-img-wrapper img').css('filter', '');
            $('.gallery-img-wrapper').removeClass('cursor-pointer');
            selectModeEnabled = false;
        });

        $('.gallery-img-wrapper').click(function () {
           if (selectModeEnabled) {
               var index = $('.gallery-img-wrapper').index(this);
               var checkbox = $('.select-mode-checkbox').eq(index);

               if (checkbox.prop('checked')) {
                   checkbox.prop('checked', false);
               } else {
                   checkbox.prop('checked', true);
               }
           }
        });

        //Pictures' overlay
        $('.gallery-img-wrapper').mouseenter(function () {
            if (!selectModeEnabled) {
                var index = $('.gallery-img-wrapper').index(this);

                $('.gallery-img-wrapper .gallery-img-overlay').eq(index).fadeIn(200);
            }
        }).mouseleave(function () {
            if (!selectModeEnabled) {
                var index = $('.gallery-img-wrapper').index(this);

                $('.gallery-img-wrapper .gallery-img-overlay').eq(index).fadeOut(200);
            }
        });
    </script>
@endpush
