@extends('layouts.app')

@section('title', 'Login')

@section('breadcrumb')
    Login
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 mt-16">
    <form action="{{ route('login.authenticate') }}" method="POST">
        @csrf
        <div class="mx-auto w-2/5 shadow overflow-hidden rounded-md">
            <div class="px-4 py-5 bg-gray-800 sm:p-6">
                <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Login to access Staff Hub</h3>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-full">
                        <label for="email" class="block text-sm font-medium text-gray-300">Email <span class="text-red-500 font-bold">*</span></label>
                        <input type="email" name="email" id="email" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" placeholder="myemail@example.com" required>
                    </div>

                    <div class="col-span-full">
                        <label for="password" class="block text-sm font-medium text-gray-300">Password <span class="text-red-500 font-bold">*</span></label>
                        <input type="password" name="password" id="password" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" required>
                    </div>
                </div>
                @error('email')
                <div class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="px-4 py-3 bg-gray-800 text-right sm:px-6">
                <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Login
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
