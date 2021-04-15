@extends('layouts.staff')

@section('title', 'Staff Members - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Staff Members</h2>
        </div>

        <div class="mb-10 p-6 bg-gray-800 rounded-md italic">
            Filter and sort features coming soon...
        </div>

        <div class="shadow overflow-hidden rounded-lg">
            <table class="min-w-full divide-y divide-gray-700 border-none">
                <thead class="bg-gray-700">
                    <tr>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Email address
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Has temporary password
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Role
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800">
                @forelse($users as $user)
                    <tr>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $user->id }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            <a href="{{ route('staff.users.show', $user) }}" class="text-gray-300 hover:text-gray-400">{{ $user->name }}</a>
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $user->email }}
                        </td>
                        @can('see-temporary-password-of-new-staff-members')
                            @if($user->has_temporary_password)
                                <td class="border-none px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-300">
                                    Yes ({{ $user->temporary_password_without_hash }})
                                </td>
                            @else
                                <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    No
                                </td>
                            @endif
                        @else
                            <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                ***
                            </td>
                        @endcan
                        <td style="color: {{ $user->roles->first()->color }}" class="border-none px-6 py-4 whitespace-nowrap text-sm capitalize">
                            {{ $user->roles->first()->name }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border-none px-6 py-4 whitespace-nowrap text-sm italic text-gray-300">No Staff Members yet...</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
