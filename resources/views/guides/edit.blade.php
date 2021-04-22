@extends('layouts.staff')

@section('title', "Edit #{$guide->id} - Guides - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Guides <span class="font-light">/ Edit "{{ $guide->title }}"</span></h2>
        </div>

        <form action="{{ route('staff.guides.update', $guide) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-5 grid grid-cols-6 gap-6 items-end">
                <div class="col-span-full md:col-span-3">
                    <label for="title-field" class="block text-sm font-medium text-gray-300">Title <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="title" id="title-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('title') ?? $guide->title }}" required>
                    @error('title')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="banner-url-field" class="block text-sm font-medium text-gray-300">Banner URL <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="banner_url" id="banner-url-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('banner_url') ?? $guide->banner_url }}" required>
                    @error('banner_url')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="content-input" class="block text-sm font-medium text-gray-300">Content <span class="text-red-500 font-bold">*</span> <i class="ml-1 flex-shrink-0 fab fa-markdown fa-fw"></i></label>
                    <textarea name="content" id="content-input" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" cols="30" rows="30">{{ old('content') ?? $guide->content }}</textarea>
                    @error('content')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="roles" class="mb-2 block text-sm font-medium text-gray-300">Roles that can see this guide <span class="text-red-500 font-bold">*</span></label>
                    @foreach($roles as $role)
                        <div>
                            <input type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-pointer" @if(in_array($role->id, $guide->roles->pluck('id')->toArray()) || in_array($role->id, old('roles') ?? [])) checked @endif>
                            <label for="role-{{ $role->id }}" style="color: {{ $role->color }}">{{ $role->name }}</label>
                        </div>
                    @endforeach
                    @error('roles')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
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
