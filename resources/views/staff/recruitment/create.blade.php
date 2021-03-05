@extends('layouts.staff')

@section('title', 'Recruitment Management')

@section('breadcrumb', 'Staff - Create a Recruitment')

@section('content-staff')
<div class="mt-6 bg-gray-800 rounded-md px-4 py-5 bg-gray-800 sm:p-6 shadow overflow-hidden">
    <form action="{{ route('staff.recruitments.store') }}" method="POST">
        @csrf
        <div class="shadow overflow-hidden rounded-md">
            <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Create a new Recruitment</h3>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-300">Opened By</label>
                    <input type="text" disabled style="color: {{ $authUser->roles->first()->color }}" class="text-gray-300 bg-gray-700 font-bold mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" value="{{ $authUser->name }}">
                </div>

                <div class="col-span-full sm:col-span-full">
                    <label for="role_id" class="block text-sm font-medium text-gray-300">Role <span class="text-red-500 font-bold">*</span></label>
                    <select id="role_id" name="role_id" class="text-gray-300 bg-gray-700 mt-1 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm" required>
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

                <div class="col-span-full sm:col-span-3">
                    <label for="start_date" class="block text-sm font-medium text-gray-300">Start Date (UTC) <span class="text-red-500 font-bold">*</span></label>
                    <input id="" type="datetime-local" name="start_datetime" id="start_date" class="flatpickr text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" value="{{ old('start_datetime') }}" required>
                    @error('start_datetime')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full sm:col-span-3">
                    <label for="end_date" class="block text-sm font-medium text-gray-300">End Date (UTC) <span class="text-red-500 font-bold">*</span></label>
                    <input id="" type="datetime-local" name="end_datetime" id="end_date" class="flatpickr text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" value="{{ old('end_datetime') }}" required>
                    @error('end_datetime')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="note" class="block text-sm font-medium text-gray-300">Additional Note</label>
                    <textarea name="note" id="note" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" cols="30" rows="3">{{ old('note') }}</textarea>
                    @error('note')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mt-6 bg-gray-800 text-right">
            <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                Send
            </button>
        </div>
    </form>
</div>
@endsection
