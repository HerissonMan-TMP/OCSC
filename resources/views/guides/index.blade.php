@extends('layouts.staff')

@section('title', 'Guides - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Guides</h2>
        </div>

        <div class="shadow overflow-x-auto rounded-lg">
            <table class="min-w-full divide-y divide-gray-800 border-none">
                <thead class="bg-gray-700">
                    <tr>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Title
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Read
                        </th>
                        <th scope="col" class="border-none relative px-6 py-3">
                            <span class="sr-only">Edit or delete</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800">
                    @forelse($guides as $guide)
                        <tr>
                            <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                                {{ $guide->id }}
                            </td>
                            <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                                {{ $guide->title }}
                            </td>
                            <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('staff.guides.show', $guide) }}" class="transition duration-200 text-primary hover:text-primary-dark focus:outline-none">
                                    Read
                                </a>
                            </td>
                            @can('manage-downloads')
                                <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-right">
                                    <a href="{{ route('staff.guides.edit', $guide) }}" class="mr-4 transition duration-200 text-primary hover:text-primary-dark focus:outline-none">
                                        <i class="flex-shrink-0 fas fa-pen fa-fw"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('staff.guides.destroy', $guide) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="transition duration-200 font-bold text-red-500 hover:text-red-600 focus:outline-none">
                                            <i class="flex-shrink-0 fas fa-trash-alt fa-fw"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            @else
                                <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-right italic">You cannot manage the guides</td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="border-none px-6 py-4 whitespace-nowrap text-sm italic text-gray-300">No available guides yet...</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
