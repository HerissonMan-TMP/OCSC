@extends('layouts.staff')

@section('title', 'Available Downloads')

@section('breadcrumb', "Staff - Available Downloads")

@section('content-staff')
    <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <h3 class="font-bold text-gray-300 m-0 mb-4">Available Downloads</h3>

        <div>
            <ul class="mt-10 mb-20">
                @forelse($downloads as $download)
                <li>
                    <span class="font-bold">{{ $download->name }}:</span>
                    <a href="{{ $download->link }}" target="_blank">
                        Download
                        <i class="flex-shrink-0 fas fa-download fa-fw"></i>
                    </a>
                    @can('manage-downloads')
                    <form action="{{ route('staff.downloads.destroy', $download) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600">
                            Delete
                            <i class="flex-shrink-0 fas fa-trash-alt fa-fw"></i>
                        </button>
                    </form>
                    @endcan
                </li>
                @empty
                <span class="text-sm italic text-gray-300">No downloads available for you yet...</span>
                @endforelse
            </ul>
            @can('manage-downloads')
            <form action="{{ route('staff.downloads.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-full md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                            <input type="text" name="name" id="name" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" required value="{{ old('name') }}">
                        </div>

                        <div class="col-span-full md:col-span-4">
                            <label for="link" class="block text-sm font-medium text-gray-300">Link <span class="text-red-500 font-bold">*</span></label>
                            <input type="text" name="link" id="link" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" required value="{{ old('link') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-full md:col-span-2">
                            @error('name')
                            <span class="pt-2 text-sm text-red-500">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-full md:col-span-4">
                            @error('link')
                            <span class="pt-2 text-sm text-red-500">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="roles" class="mb-2 block text-sm font-medium text-gray-300">Roles that can see this download <span class="text-red-500 font-bold">*</span></label>
                    @foreach($roles as $role)
                        <div>
                            <input type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-pointer" @if(in_array($role->id, old('roles') ?? [])) checked @endif>
                            <label for="role-{{ $role->id }}" style="color: {{ $role->color }}">{{ $role->name }}</label>
                        </div>
                    @endforeach
                    @error('roles')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mt-6 text-right">
                    <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                        Add a download
                    </button>
                </div>
            </form>
            @endcan
        </div>
    </div>
@endsection
