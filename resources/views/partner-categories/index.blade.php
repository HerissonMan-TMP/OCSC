@extends('layouts.staff')

@section('title', 'Partner Categories - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Partner Categories</h2>
        </div>

        <div class="shadow overflow-x-auto rounded-lg">
            <table class="min-w-full divide-y divide-gray-700 border-none">
                <thead class="bg-gray-700">
                    <tr>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="border-none px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="border-none relative px-6 py-3">
                            <span class="sr-only">Edit or delete</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800">
                @forelse($partnerCategories as $category)
                    <tr>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $category->id }}
                        </td>
                        <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $category->name }}
                        </td>
                        @can('manage-partner-categories')
                            <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-right">
                                <a href="{{ route('staff.partner-categories.edit', $category) }}" class="mr-4 transition duration-200 text-primary hover:text-primary-dark focus:outline-none">
                                    <i class="flex-shrink-0 fas fa-pen fa-fw"></i>
                                    Edit
                                </a>
                                <form action="{{ route('staff.partner-categories.destroy', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="transition duration-200 font-bold text-red-500 hover:text-red-600 focus:outline-none">
                                        <i class="flex-shrink-0 fas fa-trash-alt fa-fw"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        @else
                            <td class="border-none px-6 py-4 whitespace-nowrap text-sm text-right italic">You cannot manage the partner categories</td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border-none px-6 py-4 whitespace-nowrap text-sm italic text-gray-300">No partner categories yet...</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @can('manage-partner-categories')
            <div class="mt-10">
                <h4>Create another partner category</h4>

                <form action="{{ route('staff.partner-categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-5 grid grid-cols-6 gap-6">
                        <div class="col-span-full md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                            <input type="text" name="name" id="name" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('name') }}" required>
                            @error('name')
                            <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-full md:col-span-3">
                            <label for="opening-at-field" class="block text-sm font-medium text-gray-300">Opening at (UTC)</label>
                            <input type="datetime-local" name="opening_at" id="opening-at-field" class="flatpickr text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('opening_at') }}" required>
                            @error('opening_at')
                            <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-full md:col-span-1 self-end">
                            <button type="button" id="set-null-button" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                                Set null
                            </button>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        @endcan
    </div>
@endsection

@push('scripts')
    <script>
        $('#set-null-button').click(function () {
            $('#opening-at-field').val('');
        });
    </script>
@endpush
