@extends('layouts.staff')

@section('title', 'Roles - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Roles</h2>
        </div>

        <div class="grid grid-flow-row gap-6">
            @foreach($groups as $group)
                <div>
                    <h3>{{ $group->name }}</h3>

                    <div class="grid grid-cols-4 gap-6">
                        @foreach($group->roles as $role)
                            <div class="col-span-1">
                                <div class="border rounded-md overflow-hidden" style="border-color: {{ $role->color }};">
                                    <div class="p-4 font-bold" style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }};">
                                        <i class="{{ $role->icon_name }} fa-fw"></i> {{ $role->name }}
                                    </div>

                                    <div class="p-4 text-sm text-gray-300">
                                        {{ $role->description }}
                                    </div>

                                    <div class="flex justify-center">
                                        @can('update-roles')
                                            <a href="{{ route('staff.roles.edit', $role) }}" class="w-full transition duration-200 text-left py-2 px-4 border border-transparent shadow-sm text-sm font-bold hover:opacity-80 focus:outline-none" style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }};">
                                                <i class="fas fa-user-tag fa-fw"></i> Edit role
                                            </a>
                                        @else
                                            <a class="w-full transition duration-200 text-left py-2 px-4 border border-transparent shadow-sm text-sm font-bold cursor-not-allowed select-none opacity-40" style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }};">
                                                <i class="fas fa-user-tag fa-fw"></i> Edit role
                                            </a>
                                        @endcan

                                        @can('update-permissions-of-role', $role)
                                            <a href="{{ route('staff.roles.permissions.edit', $role) }}" class="w-full transition duration-200 text-right py-2 px-4 border border-transparent shadow-sm text-sm font-bold hover:opacity-80 focus:outline-none" style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }};">
                                                <i class="fas fa-shield-alt fa-fw"></i> Edit permissions
                                            </a>
                                        @else
                                            <a class="w-full transition duration-200 text-left py-2 px-4 border border-transparent shadow-sm text-sm font-bold cursor-not-allowed select-none opacity-40" style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }};">
                                                <i class="fas fa-user-tag fa-fw"></i> Edit permissions
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
