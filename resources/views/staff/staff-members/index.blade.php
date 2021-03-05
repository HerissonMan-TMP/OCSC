@extends('layouts.staff')

@section('title', 'Recruitment Management')

@section('breadcrumb', "Staff - Staff Members Management")

@section('content-staff')
    <div class="mt-6 px-4 py-5 sm:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Staff Members List</h3>
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-700 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-900">
                        <thead class="bg-gray-900">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                Discord username
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                Email address
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                Has temporary password
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                Role
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-gray-700 divide-y divide-gray-700">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $user->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $user->email }}
                                </td>
                                @can('see-temporary-password-of-new-staff-members')
                                @if($user->has_temporary_password)
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-300">
                                    Yes ({{ $user->temporary_password_without_hash }})
                                </td>
                                @else
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    No
                                </td>
                                @endif
                                @else
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    ***
                                </td>
                                @endcan
                                <td style="color: {{ $user->roles->first()->color }}" class="px-6 py-4 whitespace-nowrap text-sm capitalize">
                                    {{ $user->roles->first()->name }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm italic text-gray-300">No Staff Members yet...</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
