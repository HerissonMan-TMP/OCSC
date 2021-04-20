@extends('layouts.staff')

@section('title', "Applications - {$recruitment->role->name} Recruitment - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Recruitment for <span style="color: {{ $recruitment->role->color }};">{{ $recruitment->role->name }}</span> <span class="font-light">/ Applications</span></h2>
        </div>

        <form action="" method="GET" class="mb-10 p-6 bg-gray-800 rounded-md grid grid-cols-10 gap-4">
            <div class="col-span-full md:col-span-2">
                <input type="text" name="discord" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Discord username" value="{{ request('discord') }}">
            </div>

            <div class="col-span-full md:col-span-2">
                <input type="text" name="email" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Email" value="{{ request('email') }}">
            </div>

            <div class="col-span-full md:col-span-1">
                <select name="sortByCreatedAt" class="capitalize text-gray-300 bg-gray-700 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option @if(request('sortByCreatedAt') === 'desc') selected @endif value="desc">Latest</option>
                    <option @if(request('sortByCreatedAt') === 'asc') selected @endif value="asc">Oldest</option>
                </select>
            </div>

            <div class="col-span-full md:col-span-1">
                <select name="status" class="capitalize text-gray-300 bg-gray-700 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option @if(request('status') === 'all') selected @endif value="all" class="capitalize">all</option>
                    <option @if(request('status') === 'new') selected @endif value="new" class="capitalize">new</option>
                    <option @if(request('status') === 'accepted') selected @endif value="accepted" class="capitalize">accepted</option>
                    <option @if(request('status') === 'declined') selected @endif value="declined" class="capitalize">declined</option>
                </select>
            </div>

            <div class="col-span-full md:col-span-1">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    OK
                </button>
            </div>
        </form>

        <div class="shadow overflow-x-auto rounded-lg">
            <table class="min-w-full border-none">
                <thead class="bg-gray-700">
                <tr>
                    <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Discord username
                    </th>
                    <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Email address
                    </th>
                    <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Sent at
                    </th>
                    <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="border-none relative px-6 py-3">
                        <span class="sr-only">View</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-gray-800">
                @forelse($applications as $application)
                    <tr>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $application->id }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $application->discord }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $application->email }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $application->created_at->format('d M H:i') }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm capitalize @switch($application->status) @case('new') text-blue-600 @break @case('declined') text-red-600 @break @case('accepted') text-green-600 @break @endswitch">
                            {{ $application->status }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('staff.applications.show', $application) }}" class="transition duration-200 text-primary hover:text-primary-dark">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border-none px-6 py-4 whitespace-nowrap text-sm italic text-gray-300">No applications received yet...</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
