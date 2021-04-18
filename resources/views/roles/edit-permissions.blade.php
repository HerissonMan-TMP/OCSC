@extends('layouts.staff')

@section('title', "Edit Permissions - {$role->name} - Roles - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Roles / <span style="color: {{ $role->color }};">{{ $role->name }} <i class="{{ $role->icon_name }} fa-fw"></i></span> <span class="font-light">/ Edit Permissions</span></h2>
        </div>

        <form action="{{ route('staff.roles.permissions.update', $role) }}" method="POST">
            @csrf
            @method('PATCH')

            @foreach($permissions as $permission)
                <div class="flex">
                    <div class="mr-2">
                        <input type="checkbox" id="{{ $permission->slug }}-field" name="permissions[]" value="{{ $permission->id }}" style="color: {{ $role->color }};" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-pointer" @if($role->permissions->contains($permission)) checked @endif>
                        <label for="{{ $permission->slug }}-field" class="@if($permission->slug === 'has-admin-rights') text-red-500 @endif">{{ $permission->name }}</label>
                    </div>
                </div>
            @endforeach

            <div class="text-right mt-6">
                <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md hover:opacity-80 focus:outline-none" style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }};">
                    Update permissions
                </button>
            </div>
        </form>
    </div>
@endsection
