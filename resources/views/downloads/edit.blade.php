@extends('layouts.staff')

@section('title', "Edit #{$download->id} - Downloads - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Downloads <span class="font-light">/ Edit "{{ $download->name }}"</span></h2>
        </div>

        <form action="{{ route('staff.downloads.update', $download) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-5 grid grid-cols-6 gap-6">
                <div class="col-span-full">
                    <label for="name" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="name" id="name" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" required value="{{ old('name') ?? $download->name }}">
                    @error('name')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-span-full">
                <label for="roles" class="mb-2 block text-sm font-medium text-gray-300">Roles that can see this download <span class="text-red-500 font-bold">*</span></label>
                @foreach($roles as $role)
                    <div>
                        <input type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-pointer" @if(in_array($role->id, $download->roles->pluck('id')->toArray()) || in_array($role->id, old('roles') ?? [])) checked @endif>
                        <label for="role-{{ $role->id }}" style="color: {{ $role->color }}">{{ $role->name }}</label>
                    </div>
                @endforeach
                @error('roles')
                    <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Edit
                </button>
            </div>
        </form>
    </div>
@endsection
