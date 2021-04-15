@extends('layouts.staff')

@section('title', "Edit #{$download->id} - Downloads - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Downloads <span class="font-light">/ Edit "{{ $download->name }}"</span></h2>
        </div>

        @if ($errors->any())
            <div class="my-10 p-6 text-gray-200 font-bold bg-red-500 rounded-md">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            @can('manage-downloads')
                <form action="{{ route('staff.downloads.store') }}" method="POST">
                    @csrf
                    <div class="mb-5 grid grid-cols-6 gap-6">
                        <div class="col-span-full md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                            <input type="text" name="name" id="name" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" required value="{{ old('name') ?? $download->name }}">
                        </div>

                        <div class="col-span-full md:col-span-4">
                            <label for="link" class="block text-sm font-medium text-gray-300">Link <span class="text-red-500 font-bold">*</span></label>
                            <input type="text" name="link" id="link" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" required value="{{ old('link') ?? $download->link }}">
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
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                            Edit
                        </button>
                    </div>
                </form>
            @endcan
        </div>
    </div>
@endsection
