@extends('layouts.staff')

@section('title', "Edit #{$partnerCategory->id} - Partner Categories - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Partner Categories <span class="font-light">/ Edit "{{ $partnerCategory->name }}"</span></h2>
        </div>

        <form action="{{ route('staff.partner-categories.update', $partnerCategory) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-5 grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="name" id="name" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('name') ?? $partnerCategory->name }}" required>
                    @error('name')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="opening-at-field" class="block text-sm font-medium text-gray-300">Opening at (UTC) <span class="font-normal">/ Current: {{ $partnerCategory->opening_at->format('d M Y H:i') }}</span></label>
                    <input type="datetime-local" name="opening_at" id="opening-at-field" class="flatpickr text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" required>
                    @error('opening_at')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-1 self-end">
                    <button type="button" id="set-null-button" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                        Set null
                    </button>
                </div>

                <div class="col-span-full">
                    <label for="description-field" class="block text-sm font-medium text-gray-300">Description <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="description" id="description-field" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('description') ?? $partnerCategory->description }}" required>
                    @error('description')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Edit
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $('#set-null-button').click(function () {
            $('#opening-at-field').val('');
        });
    </script>
@endpush
