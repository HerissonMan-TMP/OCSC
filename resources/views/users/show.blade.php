@extends('layouts.staff')

@section('title', "{$user->name}'s Profile")

@section('breadcrumb', "Staff - {$user->name}'s profile")

@section('content-staff')
<div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
    <div class="flex items-center flex-wrap">
        <h3 class="inline-block flex-shrink-0 font-bold text-2xl text-gray-300 m-0 mr-4">{{ $user->name }}</h3>
        <div>
            @foreach($user->roles->sortBy('order') as $role)
            <div style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }};" class="inline-block px-2 py-1 rounded-md leading-3 mr-2 my-2">
                <span class="font-bold text-sm">{{ $role->name }}</span>
            </div>
            @endforeach
        </div>
    </div>
    <div class="mt-6 grid grid-cols-3 gap-6">
        <div class="col-span-full md:col-span-1 bg-gray-700 rounded-md px-4 py-5 md:p-6 shadow overflow-hidden">
            <h4 class="font-bold text-2xl text-gray-300 mt-0 mb-6"><i class="fas fa-id-card fa-fw"></i> User Information</h4>
            <div class="flex flex-col">
                <div class="flex">
                    <div class="mr-1">
                        <i class="fas fa-hashtag fa-fw fa-sm"></i>
                    </div>
                    <div>
                        <span class="text-gray-300 text-sm">{{ $user->id }}</span>
                    </div>
                </div>
                <div class="flex">
                    <div class="mr-1">
                        <i class="fas fa-user fa-fw fa-sm"></i>
                    </div>
                    <div>
                        <span class="text-gray-300 text-sm">{{ $user->name }}</span>
                    </div>
                </div>
                <div class="flex">
                    <div class="mr-1">
                        <i class="fas fa-at fa-fw fa-sm"></i>
                    </div>
                    <div>
                        <span class="text-gray-300 text-sm">{{ $user->email }}</span>
                    </div>
                </div>
                @if($user->has_temporary_password)
                @can('see-temporary-password-of-new-staff-members')
                <div class="flex">
                    <div class="mr-1">
                        <i class="fas fa-lock fa-fw fa-sm"></i>
                    </div>
                    <div>
                        <span class="text-gray-300 text-sm font-bold">Password is temporary ({{ $user->temporary_password_without_hash }})</span>
                    </div>
                </div>
                @endcan
                @endif
                <div class="mb-6"></div>
                <div class="flex">
                    <div class="mr-1">
                        <i class="fas fa-clock fa-fw fa-sm"></i>
                    </div>
                    <div>
                        <span class="text-gray-300 text-sm">{{ $user->created_at }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-full md:col-span-2 bg-gray-700 rounded-md px-4 py-5 md:p-6 shadow overflow-hidden">
            <h4 class="font-bold text-2xl text-gray-300 mt-0 mb-6"><i class="fas fa-wrench fa-fw"></i> Activity</h4>
            <div class="text-gray-300 italic">
                Feature planned in the future...
            </div>
        </div>
        <div class="col-span-full bg-gray-700 rounded-md px-4 py-5 md:p-6 shadow overflow-hidden">
            <h4 class="font-bold text-2xl text-gray-300 mt-0 mb-6"><i class="fas fa-user-shield fa-fw"></i> Administration</h4>
            @cannot('assign-roles-to-user', $user)
            <form>
                <fieldset class="opacity-50" disabled>
                    <label for="roles" class="mb-2 block text-sm font-medium text-gray-300">Roles <span class="text-red-500 font-bold">*</span></label>
                    @foreach($roles->sortBy('order') as $role)
                        <div>
                            <input type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-not-allowed" @if($user->hasRole($role)) checked @endif>
                            <label for="role-{{ $role->id }}" style="color: {{ $role->color }}">{{ $role->name }}</label>
                        </div>
                    @endforeach
                    <div class="flex justify-between flex-wrap md:flex-nowrap items-end mt-6">
                        <div class="mb-2 md:mb-0">
                        </div>
                        <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary focus:outline-none cursor-not-allowed">
                            Update the roles
                        </button>
                    </div>
                </fieldset>
            </form>
            @else
            <form action="{{ route('staff.users.roles.update', $user) }}" method="POST">
                @csrf
                @method('PATCH')
                <label for="roles" class="mb-2 block text-sm font-medium text-gray-300">Roles <span class="text-red-500 font-bold">*</span></label>
                @foreach($roles as $role)
                    <div>
                    @cannot('assign-role-to-user', [$user, $role])
                        <input type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 opacity-50 cursor-not-allowed" disabled @if($user->hasRole($role)) checked @endif>
                        <label for="role-{{ $role->id }}" style="color: {{ $role->color }}" class="opacity-50">{{ $role->name }}</label>
                    @else
                        <input type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-pointer" @if($user->hasRole($role)) checked @endif>
                        <label for="role-{{ $role->id }}" style="color: {{ $role->color }}">{{ $role->name }}</label>
                    @endcannot
                    </div>
                @endforeach
                <div class="flex justify-between flex-wrap md:flex-nowrap items-end mt-6">
                    <div class="mb-2 md:mb-0">
                    @error('roles')
                        <span class="text-sm text-red-500">
                        {{ $message }}
                        </span>
                    @enderror
                    </div>
                    <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary focus:outline-none @cannot('assign-roles', $user) cursor-not-allowed @else cursor-pointer hover:text-gray-700 hover:bg-primary-dark @endcannot">
                        Update the roles
                    </button>
                </div>
            </form>
            @endcannot
            <div class="mt-6 w-full bg-gray-700 rounded-md border border-red-500">
                <div class="p-4 bg-red-500">
                    <h3 class="font-semibold text-2xl text-ged-200 m-0">Danger Zone</h3>
                </div>
                <div class="p-4">
                    @can('delete-user', $user)
                    <form action="{{ route('staff.users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-200 bg-red-500 hover:bg-red-700 focus:outline-none">
                            Delete the user
                        </button>
                    </form>
                    @else
                    <form>
                        <fieldset class="opacity-50" disabled>
                            <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-200 bg-red-500 focus:outline-none cursor-not-allowed">
                                Delete the user
                            </button>
                        </fieldset>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
