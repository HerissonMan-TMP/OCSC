@extends('layouts.staff')

@section('title', "Applications - {$recruitment->role->name} Recruitment - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Recruitment for <span style="color: {{ $recruitment->role->color }};">{{ $recruitment->role->name }}</span> <span class="font-light">/ Applications</span></h2>
        </div>

        <div class="mb-10 p-6 bg-gray-800 rounded-md italic">
            Filter and sort features coming soon...
        </div>

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
