@extends('layouts.staff')

@section('title', 'Create a user - Staff Members - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Staff Members <span class="font-light">/ Create a user</span></h2>
        </div>

        <form action="{{ route('staff.users.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full">
                    <label for="email" class="block text-sm font-medium text-gray-300">Email <span class="text-red-500 font-bold">*</span></label>
                    <input type="email" name="email" id="email" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" placeholder="myemail@example.com" value="{{ old('email', request()->email) }}" required>
                    @error('email')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="name" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="name" id="name" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" placeholder="MyUsername" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="temporary_password" class="block text-sm font-medium text-gray-300">Password <span class="text-red-500 font-bold">*</span> <span class="text-blue-500 italic">Give this temporary password to the person you are creating the account for. He will then be able to change it.</span></label>
                    <input type="text" disabled id="temporary_password" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $temporaryPassword }}" required>
                    <input type="hidden" name="temporary_password" value="{{ $temporaryPassword }}">
                    @error('temporary_password')
                    <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-full">
                    <label for="role_id" class="block text-sm font-medium text-gray-300">Role <span class="text-red-500 font-bold">*</span></label>
                    <select id="role_id" name="role_id" class="text-gray-300 bg-gray-800 mt-1 block w-full py-2 px-3 border border-gray-700 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm" required>
                        @foreach($roles as $role)
                            @can('assign-role', $role)
                                <option @if($role->id == request()->role_id || old('role_id') == $role->id) selected @endif value="{{ $role->id }}" style="color: {{ $role->color }}">{{ $role->name }}</option>
                            @endcan
                        @endforeach
                    </select>
                    @error('role_id')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">Create</button>
            </div>
        </form>
    </div>
@endsection
