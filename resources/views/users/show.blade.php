@extends('layouts.staff')

@section('title', "{$user->name} - Staff Members - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Staff Members <span class="font-light">/ {{ $user->name }}</span></h2>
        </div>

        <div class="flex items-center flex-wrap">
            @foreach($user->roles->sortBy('order') as $role)
                <div style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }};" class="inline-block px-2 py-1 rounded-md leading-3 mr-2 my-2">
                    <span class="font-bold text-sm">{{ $role->name }}</span>
                </div>
            @endforeach
        </div>

        <div class="mt-6 grid grid-cols-3 gap-6">
            <div class="col-span-full md:col-span-1 bg-gray-800 rounded-md px-4 py-5 md:p-6 shadow overflow-hidden">
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
                    @can('see-email-address-of-staff-members')
                        <div class="flex">
                            <div class="mr-1">
                                <i class="fas fa-at fa-fw fa-sm"></i>
                            </div>
                            <div>
                                <span class="text-gray-300 text-sm">{{ $user->email }}</span>
                            </div>
                        </div>
                    @endcan
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
                            <span class="text-gray-300 text-sm">{{ $user->created_at->format('d M H:i') }} UTC</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-full md:col-span-2 bg-gray-800 rounded-md px-4 py-5 md:p-6 shadow overflow-hidden">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h4 class="font-bold text-2xl text-gray-300 m-0"><i class="fas fa-wrench fa-fw"></i>Latest Activities</h4>
                    </div>

                    <div>
                        <a href="{{ route('staff.website-settings.activity', ['by' => $user->name]) }}" class="hidden md:block w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                            See more
                        </a>
                    </div>
                </div>

                <div class="grid grid-flow-row gap-2">
                    @can('see-activity')
                        @forelse($latestActivities as $activity)
                            <div class="grid grid-flow-col md:grid-cols-8 auto-cols-max md:auto-cols-auto gap-6 p-4 overflow-x-auto rounded-full bg-gray-200 text-sm text-gray-800 items-center">
                                <div class="md:col-span-1">
                                    <i class="fas fa-user fa-fw"></i>
                                    @if($activity->causer)
                                        <span class="font-bold">{{ $activity->causer->name }}</span>
                                    @else
                                        <span>Anonymous</span>
                                    @endif
                                </div>
                                <div class="md:col-span-2 font-bold">
                                    <span class="inline-block w-full p-2 rounded-md capitalize {{ $activity->type->color }} text-gray-200 text-center"><i class="{{ $activity->type->icon }} fa-fw"></i> {{ $activity->type->name }}</span>
                                </div>
                                <div class="md:col-span-2 font-bold">
                                    @if($activity->subject)
                                        <i class="{{ $activity->subject_icon }} fa-fw"></i> {{ $activity->subject }}
                                    @endif
                                </div>
                                <div class="md:col-span-2">
                                    @if($activity->description)
                                        <i class="fas fa-comment-dots fa-fw"></i> {{ $activity->description }}
                                    @else
                                        <i class="fas fa-comment-dots fa-fw"></i> <span class="italic">No description.</span>
                                    @endif
                                </div>
                                <div class="md:col-span-1 text-right">
                                    <i class="fas fa-clock fa-fw"></i> {{ $activity->created_at->format('d M H:i') }}
                                </div>
                            </div>
                        @empty
                            <span class="text-sm italic text-gray-300">No logged activity yet.</span>
                        @endforelse
                    @else
                        <div class="my-4 p-4 rounded-md bg-yellow-500 text-sm">
                            <i class="fas fa-exclamation-triangle fa-fw"></i>
                            You cannot see the staff members' activity.
                        </div>
                    @endcan
                </div>

                <a href="{{ route('staff.website-settings.activity', ['by' => $user->name]) }}" class="block md:hidden mt-4 w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    See more
                </a>
            </div>

            <div class="col-span-full bg-gray-800 rounded-md px-4 py-5 md:p-6 shadow overflow-hidden">
                <h4 class="font-bold text-2xl text-gray-300 mt-0 mb-6"><i class="fas fa-user-shield fa-fw"></i> Administration</h4>
                @can('assign-roles-to-user', $user)
                    <form action="{{ route('staff.users.roles.update', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <label for="roles" class="mb-2 block text-sm font-medium text-gray-300">Roles <span class="text-red-500 font-bold">*</span></label>
                        @foreach($roles as $role)
                            <div>
                                <input type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}" style="color: {{ $role->color }}" class="form-checkbox rounded-full border-none focus:ring-offset-0 focus:ring-0 cursor-pointer" @if($user->hasRole($role)) checked @endif>
                                <label for="role-{{ $role->id }}" style="color: {{ $role->color }}">{{ $role->name }}</label>
                            </div>
                        @endforeach
                        <div class="flex justify-between flex-wrap md:flex-nowrap items-end mt-6">
                            <div class="mb-2 md:mb-0">
                                @error('roles')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary focus:outline-none cursor-pointer hover:text-gray-700 hover:bg-primary-dark">
                                Update the roles
                            </button>
                        </div>
                    </form>
                @else
                    <div class="my-4 p-4 rounded-md bg-yellow-500 text-sm">
                        <i class="fas fa-exclamation-triangle fa-fw"></i>
                        The roles of this user cannot be updated.
                    </div>
                @endcan

                <div class="mt-6 w-full rounded-md border border-red-500">
                    <div class="p-4 bg-red-500">
                        <h3 class="font-semibold text-2xl text-ged-200 m-0">Danger Zone</h3>
                    </div>
                    <div class="p-4">
                        @can('update-name-of-user', $user)
                            <form action="{{ route('staff.users.name.update', Auth::user()) }}" method="POST" class="grid grid-cols-5 gap-5 items-end mb-4">
                                @csrf
                                @method('PATCH')

                                <div class="col-span-full md:col-span-4">
                                    <label for="name-field" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                                    <input type="text" name="name" id="name-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('name') ?? $user->name }}" required>
                                </div>

                                <div class="col-span-full md:col-span-1">
                                    <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                                        Edit
                                    </button>
                                </div>
                            </form>
                            @error('name')
                            <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        @else
                            <div class="my-4 p-4 rounded-md bg-yellow-500 text-sm">
                                <i class="fas fa-exclamation-triangle fa-fw"></i>
                                You cannot edit the name of this user.
                            </div>
                        @endcan

                        @can('update-email-of-user', $user)
                            <form action="{{ route('staff.users.email.update', Auth::user()) }}" method="POST" class="grid grid-cols-5 gap-5 items-end mb-4">
                                @csrf
                                @method('PATCH')

                                <div class="col-span-full md:col-span-4">
                                    <label for="email-field" class="block text-sm font-medium text-gray-300">Email <span class="text-red-500 font-bold">*</span></label>
                                    <input type="text" name="email" id="email-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('email') ?? $user->email }}" required>
                                </div>

                                <div class="col-span-full md:col-span-1">
                                    <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:bg-primary-dark focus:outline-none">
                                        Edit
                                    </button>
                                </div>
                            </form>
                            @error('email')
                            <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        @else
                            <div class="my-4 p-4 rounded-md bg-yellow-500 text-sm">
                                <i class="fas fa-exclamation-triangle fa-fw"></i>
                                You cannot edit the email of this user.
                            </div>
                        @endcan

                        @can('reset-temporary-password-of-user', $user)
                            <form action="{{ route('staff.users.temporary-password.reset', $user) }}" method="POST" class="mb-4">
                                @csrf

                                <input type="hidden" name="password" value="{{ $temporaryPassword }}">
                                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:bg-primary-dark focus:outline-none">
                                    Reset temporary password
                                </button>
                                @error('password')
                                <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </form>
                        @else
                            <div class="my-4 p-4 rounded-md bg-yellow-500 text-sm">
                                <i class="fas fa-exclamation-triangle fa-fw"></i>
                                You cannot reset the password to a temporary one for this user.
                            </div>
                        @endcan

                        @can('delete-user', $user)
                            <form action="{{ route('staff.users.destroy', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-200 bg-red-500 hover:bg-red-600 focus:outline-none">
                                    Delete the user
                                </button>
                            </form>
                        @else
                            <div class="my-4 p-4 rounded-md bg-yellow-500 text-sm">
                                <i class="fas fa-exclamation-triangle fa-fw"></i>
                                You cannot delete this user.
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
