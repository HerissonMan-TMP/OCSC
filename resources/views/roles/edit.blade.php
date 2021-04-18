@extends('layouts.staff')

@section('title', "Edit #{$role->id} - Roles - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Roles <span class="font-light">/ Edit <span style="color: {{ $role->color }};">{{ $role->name }} <i class="{{ $role->icon_name }} fa-fw"></i></span></span></h2>
        </div>

        <form action="{{ route('staff.roles.update', $role) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-3">
                    <label for="name-field" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="name" id="name-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('name') ?? $role->name }}">
                    @error('name')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="icon-name-field" class="block text-sm font-medium text-gray-300">Icon name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="icon_name" id="icon-name-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('icon_name') ?? $role->icon_name }}">
                    @error('icon_name')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="color-field" class="block text-sm font-medium text-gray-300">Color <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="color" id="color-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('color') ?? $role->color }}">
                    @error('color')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="contrast-color-field" class="block text-sm font-medium text-gray-300">Contrast color <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="contrast_color" id="contrast-color-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('contrast_color') ?? $role->contrast_color }}">
                    @error('contrast_color')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="description-field" class="block text-sm font-medium text-gray-300">Description <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="description" id="description-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('description') ?? $role->description }}">
                    @error('description')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <input type="hidden" name="recruitment_enabled" value="0">
                    <input type="checkbox" value="1" id="recruitment-enabled-field" name="recruitment_enabled" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-pointer" @if(old('recruitment_enabled') || $role->recruitment_enabled) checked @endif>
                    <label for="recruitment-enabled-field" class="text-sm">Is this role recruitable?</label>
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md hover:opacity-80 focus:outline-none" style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }};">
                    Edit
                </button>
            </div>
        </form>
    </div>
@endsection
