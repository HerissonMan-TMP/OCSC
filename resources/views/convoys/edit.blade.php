@extends('layouts.staff')

@section('title', "Edit #{$convoy->id} - Convoys - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Convoys <span class="font-light">/ Edit "{{ $convoy->title }}"</span></h2>
        </div>

        <form action="{{ route('staff.convoys.update', $convoy) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-10 gap-6">
                <div class="col-span-full md:col-span-2">
                    <label for="truckersmp_event_id" class="block text-sm font-medium text-gray-300">TruckersMP Event ID <span class="text-red-500 font-bold">*</span></label>
                    <input id="truckersmp_event_id" type="text" name="truckersmp_event_id" class="text-gray-300 bg-gray-800 font-bold uppercase mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('truckersmp_event_id') ?? $convoy->truckersmp_event_id }}" required maxlength="8">
                    @error('truckersmp_event_id')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="col-span-full md:col-span-2 self-end">
                    <button type="button" class="button-load-data w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                        Load data
                    </button>
                </div>
                <div class="hidden md:block md:col-span-6"></div>

                <div class="col-span-full md:col-span-5">
                    <label for="title" class="block text-sm font-medium text-gray-300">Title <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="title" id="title" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('title') ?? $convoy->title }}" required>
                    @error('title')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-5">
                    <label for="banner_url" class="block text-sm font-medium text-gray-300">Banner URL</label>
                    <input type="text" name="banner_url" id="banner_url" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('banner_url') ?? $convoy->banner_url }}">
                    @error('banner_url')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-4">
                    <label for="location" class="block text-sm font-medium text-gray-300">Location <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="location" id="location" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('location') ?? $convoy->location }}" required>
                    @error('location')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-2">
                    <label for="distance" class="block text-sm font-medium text-gray-300">Distance (km)</label>
                    <input type="text" name="distance" id="distance" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('distance') ?? $convoy->distance }}">
                    @error('distance')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-4">
                    <label for="destination" class="block text-sm font-medium text-gray-300">Destination <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="destination" id="destination" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('destination') ?? $convoy->destination }}" required>
                    @error('destination')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="col-span-full md:col-span-2">
                    <label for="server" class="block text-sm font-medium text-gray-300">Server <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="server" id="server" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('server') ?? $convoy->server }}" required>
                    @error('server')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="col-span-full md:col-span-2">
                    <label for="meetup_date" class="block text-sm font-medium text-gray-300">Meetup Date (UTC) <span class="text-red-500 font-bold">*</span></label>
                    <input type="datetime-local" name="meetup_date" id="meetup_date" class="flatpickr text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('meetup_date') ?? $convoy->meetup_date }}" required>
                    @error('meetup_date')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Edit
                </button>
            </div>
        </form>
    </div>
@endsection
