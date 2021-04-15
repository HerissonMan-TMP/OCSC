@extends('layouts.staff')

@section('title', 'Privacy Policy - Website Settings - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Website Settings <span class="font-light">/ Privacy Policy</span></h2>
        </div>

        <div class="my-4 p-4 rounded-md bg-blue-500 text-sm">
            <i class="fas fa-info-circle fa-fw"></i>
            A new version of the privacy policy is created everytime you change it, which means that the previous versions are saved.
        </div>

        <form action="{{ route('staff.website-settings.privacy-policy.store') }}" method="POST">
            @csrf

            <label for="privacy-policy-input" class="block text-sm font-medium text-gray-300">Privacy Policy <span class="text-red-500 font-bold">*</span> <i class="ml-1 flex-shrink-0 fab fa-markdown fa-fw"></i></label>
            <textarea name="content" id="privacy-policy-input" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" cols="30" rows="30">{{ old('content') ?? $privacyPolicy?->content }}</textarea>
            @error('content')
            <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">Update the Privacy Policy</button>
            </div>
        </form>
    </div>
@endsection
