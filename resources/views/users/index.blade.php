@extends('layouts.staff')

@section('title', 'Staff Members - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Staff Members</h2>
        </div>

        <form action="" method="GET" class="mb-10 p-6 bg-gray-800 rounded-md grid grid-cols-10 gap-4">
            <div class="col-span-2">
                <input type="text" name="name" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Name" value="{{ request('name') }}">
            </div>

            <div class="col-span-2">
                <input type="text" name="email" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Email" value="{{ request('email') }}">
            </div>

            <div class="col-span-2">
                <select name="role" class="capitalize text-gray-300 bg-gray-700 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option @if(request('role') === 'all') selected @endif value="all">All</option>
                    @foreach($roles as $role)
                        <option @if(request('role') === $role->name) selected @endif value="{{ $role->name }}" style="color: {{ $role->color }};">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-1">
                <select name="sortByCreatedAt" class="capitalize text-gray-300 bg-gray-700 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option @if(request('sortByCreatedAt') === 'desc') selected @endif value="desc">Latest</option>
                    <option @if(request('sortByCreatedAt') === 'asc') selected @endif value="asc">Oldest</option>
                </select>
            </div>

            <div class="col-span-1">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    OK
                </button>
            </div>
        </form>

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

        {{ $users->onEachSide(1)->withQueryString()->links() }}
    </div>
@endsection
