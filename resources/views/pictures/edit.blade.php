@extends('layouts.staff')

@section('title', "Edit #{$picture->id} - Pictures - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Pictures <span class="font-light">/ Edit "{{ $picture->name }}"</span></h2>
        </div>

        <form action="{{ route('staff.pictures.update', $picture) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-300">Picture name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="name" id="name" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('name') ?? $picture->name }}">
                    @error('name')
                    <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="description" class="block text-sm font-medium text-gray-300">Short description <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="description" id="description" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('description') ?? $picture->description }}">
                    @error('description')
                    <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label class="block text-sm font-medium text-gray-300">Uploaded By</label>
                    <input type="text" disabled style="color: {{ $picture->user->roles->first()->color }}" class="text-gray-300 bg-gray-800 font-bold mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $picture->user->name }}">
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Edit
                </button>
            </div>
        </form>
    </div>
@endsection
