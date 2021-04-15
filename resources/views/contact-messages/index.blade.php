@extends('layouts.staff')

@section('title', 'Contact Messages - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Contact Messages</h2>
        </div>

        <div class="mb-10 p-6 bg-gray-800 rounded-md italic">
            Filter and sort features coming soon...
        </div>

        <div class="shadow overflow-x-auto rounded-lg">
            <table class="min-w-full divide-y divide-gray-800 border-none">
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
                            Sent at (UTC)
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
                @forelse($contactMessages as $contactMessage)
                    <tr class="@if($contactMessage->status === 'read') text-gray-500 @endif">
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $contactMessage->id }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $contactMessage->discord }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $contactMessage->email }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $contactMessage->created_at->format('d M H:i') }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm capitalize @if($contactMessage->status === 'unread') font-bold text-blue-500 @endif">
                            {{ $contactMessage->status }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('staff.contact-messages.show', $contactMessage) }}" class="transition duration-200 text-primary hover:text-primary-dark">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border-none px-6 py-4 whitespace-nowrap text-sm italic text-gray-300">No contact messages received yet...</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
