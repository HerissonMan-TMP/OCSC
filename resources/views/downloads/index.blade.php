@extends('layouts.staff')

@section('title', 'Downloads - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Downloads</h2>
        </div>

        @if ($errors->any())
            <div class="my-10 p-6 text-gray-200 font-bold bg-red-500 rounded-md">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="shadow overflow-x-auto rounded-lg">
            <table class="min-w-full divide-y divide-gray-800 border-none">
                <thead class="bg-gray-700">
                <tr>
                    <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                        Download
                    </th>
                    <th scope="col" class="border-none relative px-6 py-3">
                        <span class="sr-only">Edit or delete</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-gray-800">
                @forelse($downloads as $download)
                    <tr>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $download->id }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            {{ $download->name }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ $download->link }}" class="transition duration-200 text-primary hover:text-primary-dark focus:outline-none">
                                Click to download
                            </a>
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-right">
                            <a href="{{ route('staff.downloads.edit', $download) }}" class="mr-4 transition duration-200 text-primary hover:text-primary-dark focus:outline-none">
                                <i class="flex-shrink-0 fas fa-pen fa-fw"></i>
                                Edit
                            </a>
                            <form action="{{ route('staff.downloads.destroy', $download) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="transition duration-200 font-bold text-red-500 hover:text-red-600 focus:outline-none">
                                    <i class="flex-shrink-0 fas fa-trash-alt fa-fw"></i>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border-none px-6 py-4 whitespace-nowrap text-sm italic text-gray-300">No available downloads yet...</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
