@extends('layouts.staff')

@section('title', "Role & Permission Management")

@section('breadcrumb', "Staff - Role & Permission Management")

@section('content-staff')
    <div class="mt-6 px-4 py-5 sm:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <h3 class="inline font-bold text-2xl text-gray-300 mr-4">Role & Permission Management</h3>

        <div class="grid grid-cols-1 gap-6 mt-10">
            @foreach($roles->sortBy('order') as $role)
            @php($roleHasAdminRights = $role->hasPermission('has-admin-rights'))
            <div class="overflow-hidden rounded-t-md">
                <div class="p-4 flex items-center border" style="background-color: {{ $role->color }}; border-color: {{ $role->color }}">
                    <i class="flex-shrink-0 fas fa-{{ $role->icon_name }} fa-fw fa-lg mr-2"></i>
                    <h2 class="text-lg font-bold">{{ $role->name }}</h2>
                </div>
                <div class="p-4 border-b border-l border-r rounded-b-md" style="border-color: {{ $role->color }}">
                    @if($roleHasAdminRights)
                    <p class="opacity-50 mb-6 text-sm">You cannot update permissions for a role with Admin Rights. Please contact the website developer.</p>
                    @endif
                    <form action="{{ route('staff.roles.permissions.update', $role) }}" method="POST">
                        @if($roleHasAdminRights)
                        <fieldset class="opacity-50" disabled>
                        @endif
                        @csrf
                        @method('PATCH')
                        @foreach($permissions as $permission)
                            <div class="flex">
                                <div class="mr-2">
                                    <input type="checkbox" id="{{ $role->name }}-{{ $permission->slug }}" name="permissions[]" value="{{ $permission->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none cursor-pointer focus:ring-offset-0 focus:ring-0 @if($roleHasAdminRights) cursor-not-allowed @endif" @if($role->hasPermission($permission)) checked @endif>
                                </div>
                                <label for="{{ $role->name }}-{{ $permission->slug }}" class="@if($permission->slug === 'has-admin-rights') text-red-500 @endif">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                        <div class="text-right mt-6">
                            <button type="submit" style="background-color: {{ $role->color }}" class="w-full md:w-auto @if($roleHasAdminRights) cursor-not-allowed @endif transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md focus:outline-none">
                                Update Permissions
                            </button>
                        </div>
                        @if($roleHasAdminRights)
                        </fieldset>
                        @endif
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
