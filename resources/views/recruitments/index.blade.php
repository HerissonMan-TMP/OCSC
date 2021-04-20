@extends('layouts.staff')

@section('title', 'Recruitments - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Recruitments</h2>
        </div>

        <div class="shadow overflow-x-auto rounded-lg">
            <table class="min-w-full divide-y divide-gray-700 border-none">
                <thead class="bg-gray-700">
                    <tr>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Start datetime (UTC)
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            End datetime (UTC)
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Opened by
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Applications sent
                        </th>
                        <th scope="col" class="border-none relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800">
                @forelse($recruitments as $recruitment)
                    <tr>
                        <td class="border-none px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center">
                                    <i style="color: {{ $recruitment->role->color }}" class="flex-shrink-0 fas fa-{{ $recruitment->role->icon_name }} fa-fw fa-2x"></i>
                                </div>
                                <div style="color: {{ $recruitment->role->color }}" class="ml-4 text-sm text-gray-300 font-bold">
                                    {{ $recruitment->role->name }}
                                </div>
                            </div>
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap">
                            @if($recruitment->is_open)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-400 text-green-900">
                                    Open
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-400 text-red-900">
                                    Closed
                                </span>
                            @endif
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $recruitment->start_at->format('d M H:i') }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $recruitment->end_at->format('d M H:i') }}
                        </td>
                        <td style="color: {{ $recruitment->user?->roles->first()->color }}" class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $recruitment->user?->name ?? 'Anonymous' }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            <a href="{{ route('staff.recruitments.applications.index', $recruitment) }}" class="text-gray-300 hover:text-gray-400">See applications</a> ({{ $recruitment->applications_count }})
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('staff.recruitments.edit', $recruitment) }}" class="transition duration-200 text-primary hover:text-primary-dark">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border-none px-6 py-4 whitespace-nowrap text-sm italic text-gray-300">No recruitment sessions stored yet...</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
