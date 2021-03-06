@extends('layouts.staff')

@section('title', "Role & Permission Management")

@section('breadcrumb', "Staff - Role & Permission Management")

@section('content-staff')
    <div class="mt-6 px-4 py-5 sm:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <h3 class="inline font-bold text-2xl text-gray-300 mr-4">Role & Permission Management</h3>

        <div class="grid grid-cols-1 gap-6 mt-10">
            @error("permissions.*")
            <div class="text-red-200 bg-red-500 p-4 rounded-md">
                <span>
                    {{ $message }}
                </span>
            </div>
            @enderror
            @foreach($roles->sortBy('order') as $role)
            @php
                $cannotUpdatePermissions = $authUser->cannot('update-permissions-for-role', $role);
            @endphp
            <div class="overflow-hidden rounded-t-md">
                <div class="p-4 flex items-center border" style="background-color: {{ $role->color }}; border-color: {{ $role->color }}">
                    <i class="flex-shrink-0 fas fa-{{ $role->icon_name }} fa-fw fa-lg mr-2"></i>
                    <h2 class="text-lg font-bold">{{ $role->name }}</h2>
                </div>
                <div class="p-4 border-b border-l border-r rounded-b-md" style="border-color: {{ $role->color }}">
                    @if($cannotUpdatePermissions)
                    @if($role->hasPermission('has-admin-rights'))
                    <p class="opacity-50 mb-6 text-sm">You cannot update permissions for this role because this one has Admin rights. Please contact the website developer if you want to change its permissions.</p>
                    @else
                    <p class="opacity-50 mb-6 text-sm">You cannot update permissions for this role because your role is below this one.</p>
                    @endif
                    @endif
                    <form action="{{ route('staff.roles.permissions.update', $role) }}" method="POST">
                        @if($cannotUpdatePermissions)
                        <fieldset class="opacity-50" disabled>
                        @endif
                        @csrf
                        @method('PATCH')
                        @foreach($permissions as $permission)
                            <div class="flex">
                                <div class="mr-2">
                                    @if($permission->slug === 'has-admin-rights' && !$authUser->hasPermission('has-admin-rights'))
                                    <input type="checkbox" id="{{ $role->name }}-{{ $permission->slug }}" name="permissions[]" value="{{ $permission->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none cursor-pointer focus:ring-offset-0 focus:ring-0 opacity-50 cursor-not-allowed" disabled @if($role->hasPermission($permission)) checked @endif>
                                    <span class="opacity-50">
                                        <label for="{{ $role->name }}-{{ $permission->slug }}" class="text-red-500">{{ $permission->name }}</label>
                                    </span>
                                    @else
                                    <input type="checkbox" id="{{ $role->name }}-{{ $permission->slug }}" name="permissions[]" value="{{ $permission->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none cursor-pointer focus:ring-offset-0 focus:ring-0 @if($cannotUpdatePermissions) cursor-not-allowed @endif" @if($role->hasPermission($permission)) checked @endif>
                                    <label for="{{ $role->name }}-{{ $permission->slug }}" class="@if($permission->slug === 'has-admin-rights') text-red-500 @endif">{{ $permission->name }}</label>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="text-right mt-6">
                            <button type="submit" style="background-color: {{ $role->color }}" class="w-full md:w-auto @if($cannotUpdatePermissions) cursor-not-allowed @endif transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md focus:outline-none">
                                Update Permissions
                            </button>
                        </div>
                        @if($cannotUpdatePermissions)
                        </fieldset>
                        @endif
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
