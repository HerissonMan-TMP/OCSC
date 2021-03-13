@extends('layouts.staff')

@section('title', 'Register a Convoy')

@section('breadcrumb', 'Staff - Register a Convoy')

@section('content-staff')
    <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <form action="{{ route('staff.convoys.store') }}" method="POST">
            @csrf
            <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Register a Convoy</h3>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-2">
                    <label for="truckersmp_event_id" class="block text-sm font-medium text-gray-300">TruckersMP Event ID <span class="text-red-500 font-bold">*</span></label>
                    <input id="truckersmp_event_id" type="text" name="truckersmp_event_id" class="text-gray-300 bg-gray-700 font-bold uppercase mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ old('truckersmp_event_id') }}" required maxlength="8">
                    @error('truckersmp_event_id')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="col-span-full md:col-span-2">
                    <label for="distance" class="block text-sm font-medium text-gray-300">Distance (km)</label>
                    <input type="text" name="distance" id="distance" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ old('distance') }}">
                    @error('distance')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="col-span-full md:col-span-2">
                    <label for="meetup_date" class="block text-sm font-medium text-gray-300">Meetup Date (UTC) <span class="text-red-500 font-bold">*</span></label>
                    <input type="datetime-local" name="meetup_date" id="meetup_date" class="flatpickr text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ old('meetup_date') }}" required>
                    @error('meetup_date')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mt-6 bg-gray-800 text-right">
                <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Publish
                </button>
            </div>
        </form>
    </div>
@endsection
