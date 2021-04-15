@extends('layouts.staff')

@section('title', 'Create - Recruitments - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Recruitments <span class="font-light">/ Create</span></h2>
        </div>

        <form action="{{ route('staff.recruitments.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-3">
                    <label class="block text-sm font-medium text-gray-300">Opened By</label>
                    <input type="text" disabled style="color: {{ $authUser->roles->first()->color }}" class="text-gray-300 bg-gray-800 font-bold mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $authUser->name }}">
                </div>

                <div class="col-span-full md:col-span-full">
                    <label for="role_id" class="block text-sm font-medium text-gray-300">Role <span class="text-red-500 font-bold">*</span></label>
                    <select id="role_id" name="role_id" class="text-gray-300 bg-gray-800 mt-1 block w-full py-2 px-3 border border-gray-700 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm" required>
                        @foreach($recruitableRolesNotCurrentlyRecruiting->sortBy('order') as $role)
                            <option value="{{ $role->id }}" @if(old('role_id') == $role->id) selected @endif style="color: {{ $role->color }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                    <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="start_date" class="block text-sm font-medium text-gray-300">Start Date (UTC) <span class="text-red-500 font-bold">*</span></label>
                    <input type="datetime-local" name="start_at" id="start_date" class="flatpickr text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('start_datetime') }}" required>
                    @error('start_at')
                    <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="end_date" class="block text-sm font-medium text-gray-300">End Date (UTC) <span class="text-red-500 font-bold">*</span></label>
                    <input type="datetime-local" name="end_at" id="end_date" class="flatpickr text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('end_datetime') }}" required>
                    @error('end_at')
                    <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="note" class="block text-sm font-medium text-gray-300">Additional Note</label>
                    <textarea name="note" id="note" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" cols="30" rows="3">{{ old('note') }}</textarea>
                    @error('note')
                    <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="specific_requirements" class="block text-sm font-medium text-gray-300">Specific Requirements <i class="ml-1 flex-shrink-0 fab fa-markdown fa-fw"></i></label>
                    <textarea name="specific_requirements" id="specific_requirements" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" cols="30" rows="10">{{ old('specific_requirements') }}</textarea>
                    @error('specific_requirements')
                    <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
                    @enderror
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Send
                </button>
            </div>
        </form>
    </div>
@endsection
