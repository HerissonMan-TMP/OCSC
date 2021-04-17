@extends('layouts.staff')

@section('title', 'Subscribers - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Subscribers</h2>
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
                            Email address
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Subscribed at (UTC)
                        </th>
                        <th scope="col" class="border-none relative px-6 py-3">
                            <span class="sr-only">Delete</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800">
                @forelse($subscribers as $subscriber)
                    <tr class="@if($subscriber->status === 'read') text-gray-500 @endif">
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $subscriber->id }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $subscriber->email }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $subscriber->created_at->format('d M H:i') }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('staff.subscribers.destroy', $subscriber) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="transition duration-200 text-red-500 hover:text-red-600">Unsubscribe</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border-none px-6 py-4 whitespace-nowrap text-sm italic text-gray-300">No subscribers yet...</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $subscribers->onEachSide(1)->links() }}
    </div>
@endsection
