@extends('layouts.staff')

@section('title', 'Create - Downloads - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Downloads <span class="font-light">/ Create</span></h2>
        </div>

        <form action="{{ route('staff.downloads.store') }}" method="POST">
            @csrf
            <div class="mb-5 grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="name" id="name" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" required>
                    @error('name')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-4">
                    <label for="link" class="block text-sm font-medium text-gray-300">Link <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="link" id="link" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" required>
                    @error('link')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-span-full">
                <label for="roles" class="mb-2 block text-sm font-medium text-gray-300">Roles that can see this download <span class="text-red-500 font-bold">*</span></label>
                @foreach($roles as $role)
                    <div>
                        <input type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-pointer">
                        <label for="role-{{ $role->id }}" style="color: {{ $role->color }}">{{ $role->name }}</label>
                    </div>
                @endforeach
                @error('roles')
                    <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Add a download
                </button>
            </div>
        </form>
    </div>
@endsection
