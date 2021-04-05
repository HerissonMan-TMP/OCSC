@extends('layouts.staff')

@section('title', "Edit picture \"{$picture->name}\" - Gallery - Staff")

@section('breadcrumb', "Staff - Gallery - Edit picture \"{$picture->name}\"")

@section('content-staff')
    <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">

        <h3 class="mt-2 mb-10 font-bold text-2xl text-gray-300">Edit picture "{{ $picture->name }}" (#{{ $picture->id }})</h3>

        <form action="{{ route('staff.pictures.update', $picture) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-300">Picture name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="name" id="name" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ old('name') ?? $picture->name }}">
                    @error('name')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="description" class="block text-sm font-medium text-gray-300">Short description <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="description" id="description" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ old('description') ?? $picture->description }}">
                    @error('description')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label class="block text-sm font-medium text-gray-300">Uploaded By</label>
                    <input type="text" disabled style="color: {{ $picture->user->roles->first()->color }}" class="text-gray-300 bg-gray-700 font-bold mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ $picture->user->name }}">
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
