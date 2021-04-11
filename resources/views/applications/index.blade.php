@extends('layouts.staff')

@section('title', "Applications - {$recruitment->role->name} Recruitment")

@section('breadcrumb', "Staff - Recruitment #{$recruitment->id} - Applications")

@section('content-staff')
<div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
    <div class="flex justify-between items-center mt-2 mb-6">
        <h3 class="m-0 font-bold text-2xl text-gray-300">Recruitment #{{ $recruitment->id }} - Applications for <span style="color: {{ $recruitment->role->color }}">{{ $recruitment->role->name }}</span></h3>
        <i style="color: {{ $recruitment->role->color }}" class="flex-shrink-0 text-primary fas fa-{{ $recruitment->role->icon_name }} fa-fw fa-2x"></i>
    </div>

    <div class="shadow overflow-x-auto border-b border-gray-700 rounded-lg">
        <table class="min-w-full border-none">
            <thead class="bg-gray-900">
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
            <tbody class="bg-gray-700">
            @forelse($recruitment->applications->sortByDesc('created_at') as $application)
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
