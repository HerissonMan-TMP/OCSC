@extends('layouts.staff')

@section('title', 'Website Settings')

@section('breadcrumb', "Staff - Website Settings")

@section('content-staff')
<div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
    <div>
        <h3 class="font-bold text-2xl text-gray-300 m-0 mb-4">Legal Notice & Privacy Policy</h3>
        <div>
            <form action="{{ route('staff.legal-notice.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <label for="legal_notice" class="block text-sm font-medium text-gray-300">Legal Notice <span class="text-red-500 font-bold">*</span></label>
                <textarea name="legal_notice" id="legal_notice" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" cols="30" rows="10">{{ old('legal_notice') ?? setting('legal-notice') }}</textarea>
                @error('legal_notice')
                <span class="pt-2 text-sm text-red-500">
                {{ $message }}
            </span>
                @enderror
                <div class="mt-6 text-right">
                    <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">Update the Legal Notice</button>
                </div>
            </form>
        </div>
        <div class="mt-4">
            <form action="{{ route('staff.privacy-policy.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <label for="privacy_policy" class="block text-sm font-medium text-gray-300">Privacy Policy <span class="text-red-500 font-bold">*</span></label>
                <textarea name="privacy_policy" id="privacy_policy" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" cols="30" rows="10">{{ old('privacy_policy') ?? setting('privacy-policy') }}</textarea>
                @error('privacy_policy')
                <span class="pt-2 text-sm text-red-500">
                {{ $message }}
            </span>
                @enderror
                <div class="mt-6 text-right">
                    <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">Update the Privacy Policy</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
