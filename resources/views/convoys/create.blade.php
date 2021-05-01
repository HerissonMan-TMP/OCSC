@extends('layouts.staff')

@section('title', 'Create - Convoys - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Convoys <span class="font-light">/ Create</span></h2>
        </div>

        <form action="{{ route('staff.convoys.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-10 gap-6">
                <div class="col-span-full md:col-span-3">
                    <label for="truckersmp_event_id" class="block text-sm font-medium text-gray-300">TruckersMP Event ID <span class="text-red-500 font-bold">*</span></label>
                    <input id="truckersmp_event_id" type="text" name="truckersmp_event_id" class="text-gray-300 bg-gray-800 font-bold uppercase mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ old('truckersmp_event_id') }}" required maxlength="8">
                    @error('truckersmp_event_id')
                        <span class="pt-2 text-sm text-red-500">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-span-full md:col-span-3 self-end">
                    <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
