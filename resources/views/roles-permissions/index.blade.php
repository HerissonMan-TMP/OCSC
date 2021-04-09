@extends('layouts.staff')

@section('title', 'Role & Permission Management')

@section('breadcrumb', 'Staff - Role & Permission Management')

@section('content-staff')
<div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">

    <h3 class="inline font-bold text-2xl text-gray-300 mr-4">Role & Permission Management</h3>

    <div class="grid grid-cols-1 gap-6 mt-10">
    @error("permissions.*")
        <div class="text-red-200 bg-red-500 p-4 rounded-md">
            <span>
                {{ $message }}
            </span>
        </div>
    @enderror

    @foreach($roles as $role)
    @php
        $cannotUpdatePermissions = $authUser->cannot('update-permissions-for-role', $role);
        $roleHasAdminRights = $role->hasPermission('has-admin-rights');
    @endphp
        <div class="overflow-hidden rounded-t-md">
            <div class="p-4 flex justify-between items-center border" style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }}; border-color: {{ $role->color }}">
                <div class="flex items-center">
                    <i class="flex-shrink-0 fas fa-{{ $role->icon_name }} fa-fw fa-lg mr-2"></i>
                    <h2 class="m-0 text-lg font-bold">{{ $role->name }}</h2>
                    <div class="text-lg font-bold">{{ $role->group_level }}</div>
                </div>

                @can('has-admin-rights')
                <div class="flex items-center space-x-5">
                    <form action="{{ route('staff.roles.update-colors', $role) }}" method="POST" class="flex space-x-2">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="color" id="color" class="text-gray-300 bg-gray-700 focus:ring-0 focus:border-transparent focus:outline-none w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Color" value="{{ $role->color }}">
                        <input type="text" name="contrast_color" id="contrast-color" class="text-gray-300 bg-gray-700 focus:ring-0 focus:border-transparent w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Contrast color" value="{{ $role->contrast_color }}">
                        <button type="submit" class="w-full md:w-auto transition duration-200 py-2 px-4 bg-gray-700 text-gray-300 border border-transparent shadow-sm text-sm font-bold rounded-md focus:outline-none">Update colors</button>
                    </form>
                </div>
                @endcan
            </div>
            <div class="p-4 border-b border-l border-r rounded-b-md" style="border-color: {{ $role->color }}">
            @if($cannotUpdatePermissions)
            @if($roleHasAdminRights)
                <p class="opacity-50 mb-6 text-sm">You cannot update permissions for this role because this one has Admin rights. Please contact the website developer if you want to change its permissions.</p>
            @else
                <p class="opacity-50 mb-6 text-sm">You cannot update permissions for this role because your role is below this one.</p>
            @endif
                <form>
                    <fieldset class="opacity-50" disabled>
                    @foreach($permissions as $permission)
                        <div class="flex">
                            <div class="mr-2">
                                <input type="checkbox" id="{{ $role->name }}-{{ $permission->slug }}" name="permissions[]" value="{{ $permission->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-not-allowed" @if($role->hasPermission($permission)) checked @endif>
                                <label for="{{ $role->name }}-{{ $permission->slug }}" class="@if($permission->slug === 'has-admin-rights') text-red-500 @endif">{{ $permission->name }}</label>
                            </div>
                        </div>
                    @endforeach

                        <div class="text-right mt-6">
                            <button type="submit" style="background-color: {{ $role->color }}" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md focus:outline-none cursor-not-allowed">
                                Update Permissions
                            </button>
                        </div>
                    </fieldset>
                </form>
            @else
                <form action="{{ route('staff.roles.permissions.update', $role) }}" method="POST">
                @csrf
                @method('PATCH')
                @foreach($permissions as $permission)
                    <div class="flex">
                        <div class="mr-2">
                        @if($authUser->cannot('update-permission-for-role', [$role, $permission]))
                            <input type="checkbox" id="{{ $role->name }}-{{ $permission->slug }}" name="permissions[]" value="{{ $permission->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 opacity-50 cursor-not-allowed" disabled @if($role->hasPermission($permission)) checked @endif>
                            <span class="opacity-50">
                                <label for="{{ $role->name }}-{{ $permission->slug }}" class="@if($permission->slug === 'has-admin-rights') text-red-500 @endif">{{ $permission->name }}</label>
                            </span>
                        @else
                            <input type="checkbox" id="{{ $role->name }}-{{ $permission->slug }}" name="permissions[]" value="{{ $permission->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-pointer" @if($role->hasPermission($permission)) checked @endif>
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
                </form>
            @endif
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection
