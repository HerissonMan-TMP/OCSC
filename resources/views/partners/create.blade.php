@extends('layouts.staff')

@section('title', 'Add - Supporters - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Supporters <span class="font-light">/ Add</span></h2>
        </div>

        <form action="{{ route('staff.partners.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-3">
                    <label for="name-field" class="block text-sm font-medium text-gray-300">Supporter name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="name" id="name-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('name') }}">
                    @error('name')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="logo-field" class="block text-sm font-medium text-gray-300">Logo link <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="logo" id="logo-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('logo') }}">
                    @error('logo')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="category-field" class="block text-sm font-medium text-gray-300">Category <span class="text-red-500 font-bold">*</span></label>
                    <select name="category_id" id="category-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md">
                        @foreach($partnerCategories as $category)
                            <option value="{{ $category->id }}" class="capitalize">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="truckersmp-link-field" class="block text-sm font-medium text-gray-300"><i class="fas fa-link fa-fw"></i> TruckersMP link</label>
                    <input type="text" name="truckersmp_link" id="truckersmp-link-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('truckersmp_link') }}">
                    @error('truckersmp_link')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="trucksbook-link-field" class="block text-sm font-medium text-gray-300"><i class="fas fa-link fa-fw"></i> Trucksbook link</label>
                    <input type="text" name="trucksbook_link" id="trucksbook-link-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('trucksbook_link') }}">
                    @error('trucksbook_link')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="website-link-field" class="block text-sm font-medium text-gray-300"><i class="fas fa-globe fa-fw"></i> Website link</label>
                    <input type="text" name="website_link" id="website-link-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('website_link') }}">
                    @error('website_link')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="twitter-link-field" class="block text-sm font-medium text-gray-300"><i class="fab fa-twitter fa-fw"></i> Twitter link</label>
                    <input type="text" name="twitter_link" id="twitter-link-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('twitter_link') }}">
                    @error('twitter_link')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="instagram-link-field" class="block text-sm font-medium text-gray-300"><i class="fab fa-instagram fa-fw"></i> Instagram link</label>
                    <input type="text" name="instagram_link" id="instagram-link-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('instagram_link') }}">
                    @error('instagram_link')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Add
                </button>
            </div>
        </form>
    </div>
@endsection
