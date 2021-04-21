@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <hr class="m-0">

    <div class="py-16 bg-gray-900">
        <form action="{{ route('login.authenticate') }}" method="POST">
            @csrf

            <div class="mx-auto w-3/4 md:w-1/4 shadow overflow-hidden rounded-md">
                <div class="bg-gray-800 p-6">

                    <div class="mb-10 text-center">
                        <h2>Login to access Staff Hub</h2>
                        <span class="text-gray-400 text-sm">Only Staff members are able to login.</span>
                    </div>

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-full">
                            <label for="email" class="block text-sm font-medium text-gray-300">Email <span class="text-red-500 font-bold">*</span></label>
                            <input type="email" name="email" id="email" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="myemail@example.com" required>
                        </div>

                        <div class="col-span-full">
                            <label for="password" class="block text-sm font-medium text-gray-300">Password <span class="text-red-500 font-bold">*</span></label>
                            <input type="password" name="password" id="password" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" required>
                        </div>
                    </div>
                    @error('email')
                    <div class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="bg-gray-800 text-right p-6">
                    <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
