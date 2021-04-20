@extends('layouts.staff')

@section('title', 'Create - News Articles - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>News Articles <span class="font-light">/ Create</span></h2>
        </div>

        <form action="{{ route('staff.articles.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full">
                    <label class="block text-sm font-medium text-gray-300">Posted By</label>
                    <input type="text" disabled style="color: {{ $authUser->roles->first()->color }}" class="text-gray-300 bg-gray-800 font-bold mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $authUser->name }} (you)">
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="title" class="block text-sm font-medium text-gray-300">Title <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="title" id="title" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('title') }}">
                    @error('title')
                    <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="banner_url" class="block text-sm font-medium text-gray-300">Banner URL</label>
                    <input type="text" name="banner_url" id="banner_url" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('banner_url') }}">
                    @error('banner_url')
                    <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="content" class="block text-sm font-medium text-gray-300">Content <span class="text-red-500 font-bold">*</span> <i class="ml-1 flex-shrink-0 fab fa-markdown fa-fw"></i></label>
                    <textarea name="content" id="content" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" cols="30" rows="20">{{ old('content') }}</textarea>
                    @error('content')
                    <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Post
                </button>
            </div>
        </form>
    </div>
@endsection
