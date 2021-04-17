@extends('layouts.staff')

@section('title', 'Profile Settings - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Profile Settings</h2>
        </div>

        <div>
            <form action="{{ route('staff.users.name.update', Auth::user()) }}" method="POST" class="grid grid-cols-5 gap-5 items-end">
                @csrf
                @method('PATCH')

                <div class="col-span-full md:col-span-4">
                    <label for="name-field" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="name" id="name-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('name') ?? $authUser->name }}" required>
                </div>

                <div class="col-span-full md:col-span-1">
                    <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                        Edit
                    </button>
                </div>
            </form>
            @error('name')
            <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror

            <hr>

            <form action="{{ route('staff.users.email.update', Auth::user()) }}" method="POST" class="grid grid-cols-5 gap-5 items-end">
                @csrf
                @method('PATCH')

                <div class="col-span-full md:col-span-4">
                    <label for="email-field" class="block text-sm font-medium text-gray-300">Email <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="email" id="email-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('email') ?? $authUser->email }}" required>
                </div>

                <div class="col-span-full md:col-span-1">
                    <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                        Edit
                    </button>
                </div>
            </form>
            @error('email')
            <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror

            <hr>

            <form action="{{ route('staff.users.password.update', Auth::user()) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-5 gap-5 items-end">
                    <div class="col-span-full md:col-span-2">
                        <label for="password-field" class="block text-sm font-medium text-gray-300">New password <span class="text-red-500 font-bold">*</span></label>
                        <input type="password" name="password" id="password-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" required>
                    </div>

                    <div class="col-span-full md:col-span-2">
                        <label for="password-confirmation-field" class="block text-sm font-medium text-gray-300">Confirm new password <span class="text-red-500 font-bold">*</span></label>
                        <input type="password" name="password_confirmation" id="password-confirmation-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" required>
                    </div>

                    <div class="col-span-full md:col-span-1">
                        <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
            @error('password')
            <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror

            <hr>

            <div class="my-4 p-4 rounded-md bg-red-500 text-sm">
                <i class="fas fa-exclamation-circle fa-fw"></i>
                If you want to delete your account, please contact an Administrator.
            </div>
        </div>
    </div>
@endsection
