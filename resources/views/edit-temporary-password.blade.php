@extends('layouts.app')

@section('title', 'Edit Temporary Password')

@section('content')
    <hr class="m-0">

    <div class="py-16 bg-gray-900">
        <form action="{{ route('staff.temporary-password.update') }}" method="POST">
            @csrf

            <div class="mx-auto w-1/4 shadow overflow-hidden rounded-md">
                <div class="px-4 py-5 bg-gray-800 md:p-6">

                    <div class="my-10 text-center">
                        <h2>Edit your temporary password</h2>
                        <span class="text-gray-400 text-sm">This step is required before accessing the Staff Hub.</span>
                    </div>

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-full">
                            <label for="password" class="block text-sm font-medium text-gray-300">New password <span class="text-red-500 font-bold">*</span></label>
                            <input type="password" name="password" id="password" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" required>
                        </div>

                        <div class="col-span-full">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm New password <span class="text-red-500 font-bold">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" required>
                        </div>
                    </div>
                    @error('password')
                    <div class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="px-4 py-3 bg-gray-800 text-right md:px-6">
                    <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
