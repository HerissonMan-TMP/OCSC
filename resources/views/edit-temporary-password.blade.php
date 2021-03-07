@extends('layouts.staff')

@section('title', 'Recruitment Management')

@section('breadcrumb', "Staff - Edit your temporary password")

@section('content-staff')
<form action="{{ route('staff.temporary-password.update') }}" method="POST">
    @csrf
    <div class="mt-6 px-4 py-5 sm:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <h3 class="font-bold text-2xl text-gray-300 text-center mt-2 mb-6">Edit your temporary password</h3>
        <div class="grid grid-cols-6">
            <div class="col-span-0 md:col-span-2"></div>
            <div class="col-span-full md:col-span-2">
                <div class="col-span-full mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300">New password <span class="text-red-500 font-bold">*</span></label>
                    <input type="password" name="password" id="password" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" required>
                </div>
                <div class="col-span-full">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm New password <span class="text-red-500 font-bold">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" required>
                    @error('password')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <button type="submit" class="mt-6 w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Update
                </button>
            </div>
            <div class="col-span-0 md:col-span-2"></div>
        </div>
    </div>
</form>
@endsection
