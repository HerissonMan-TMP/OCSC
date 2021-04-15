@extends('layouts.staff')

@section('title', 'Create - Pictures - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Pictures <span class="font-light">/ Create</span></h2>
        </div>

        <form action="{{ route('staff.pictures.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full">
                    <label class="block text-sm font-medium text-gray-300">
                        Picture <span class="text-red-500 font-bold">*</span>
                    </label>
                    <div id="picture_file_box" class="mt-1 flex justify-center py-12 border-2 border-gray-300 border-dashed rounded-md bg-gray-800 bg-cover bg-center">
                        <div class="flex flex-col items-center text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="text-sm text-gray-600">
                                <label for="picture_file" class="relative cursor-pointer font-medium text-primary focus:outline-none">
                                    <span>Upload a file</span>
                                    <input id="picture_file" name="picture_file" type="file" class="sr-only">
                                </label>
                            </div>
                            <p id="picture_file_name" class="mt-4 mb-4 text-sm">
                            </p>
                            <p class="text-xs text-gray-500">
                                PNG, JPG, JPEG, JPE up to 10MB
                            </p>
                        </div>
                    </div>
                    <img id="picture_file_preview" src="" alt="">
                    @error('picture_file')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-300">Picture name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="name" id="name" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('name') }}">
                    @error('name')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="description" class="block text-sm font-medium text-gray-300">Short description <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="description" id="description" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('description') }}">
                    @error('description')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label class="block text-sm font-medium text-gray-300">Uploaded By</label>
                    <input type="text" disabled style="color: {{ $authUser->roles->first()->color }}" class="text-gray-300 bg-gray-800 font-bold mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $authUser->name }} (you)">
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Send
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Set the uploaded picture as background of the file input.
        $('#picture_file').change(function () {
            $('#picture_file_name').text(this.files[0].name);
            $('#picture_file_box').css('background-image', "linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(" + URL.createObjectURL(this.files[0]) + ")");
        });
    </script>
@endpush
