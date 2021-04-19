@extends('layouts.staff')

@section('title', "Message #{$contactMessage->id} - Contact Messages - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Contact Messages <span class="font-light">/ Message from "{{ $contactMessage->discord ?? $contactMessage->email }}"</span></h2>
        </div>

        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-full md:col-span-3">
                <label for="truckersmp_id" class="block text-sm font-medium text-gray-300">TruckersMP ID <span class="text-red-500 font-bold">*</span></label>
                <input type="text" disabled id="truckersmp_id" class="text-gray-300 bg-gray-800 font-bold uppercase mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $contactMessage->truckersmp_id }}">
            </div>

            <div class="col-span-full md:col-span-3">
                <label for="vtc" class="block text-sm font-medium text-gray-300">VTC</label>
                <input type="text" disabled id="vtc" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $contactMessage->vtc }}">
            </div>

            <div class="col-span-full md:col-span-full">
                <label for="category" class="block text-sm font-medium text-gray-300">Category <span class="text-red-500 font-bold">*</span></label>
                <select id="category" disabled class="text-gray-300 bg-gray-800 mt-1 block w-full py-2 px-3 border border-gray-700 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option>{{ $contactMessage->category->name }}</option>
                </select>
            </div>

            <div class="col-span-full md:col-span-3">
                <label for="discord" class="block text-sm font-medium text-gray-300">Discord username</label>
                <input type="text" disabled id="discord" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $contactMessage->discord }}">
            </div>

            <div class="col-span-full md:col-span-3">
                <label for="email" class="block text-sm font-medium text-gray-300">Email address</label>
                <input type="email" disabled id="email" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $contactMessage->email }}">
            </div>

            <div class="col-span-full">
                <label for="message" class="block text-sm font-medium text-gray-300">Message <span class="text-red-500 font-bold">*</span></label>
                <textarea disabled id="message" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" cols="30" rows="8">{{ $contactMessage->message }}</textarea>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-6 mt-6">
            <div class="md:col-span-4"></div>

            @if($contactMessage->status === 'read')
                <form class="col-span-full md:col-span-1" action="{{ route('staff.contact-messages.mark-as-unread', $contactMessage) }}" method="POST">
                    @csrf

                    <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-blue-200 bg-blue-700 hover:text-blue-300 hover:bg-blue-800 focus:outline-none">
                        Mark as "Unread"
                    </button>
                </form>
            @else
                <form class="col-span-full md:col-span-1" action="{{ route('staff.contact-messages.mark-as-read', $contactMessage) }}" method="POST">
                    @csrf

                    <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-blue-200 bg-blue-700 hover:text-blue-300 hover:bg-blue-800 focus:outline-none">
                        Mark as "Read"
                    </button>
                </form>
            @endif

            <form class="col-span-full md:col-span-1" action="{{ route('staff.contact-messages.destroy', $contactMessage) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-red-200 bg-red-700 hover:text-red-300 hover:bg-red-800 focus:outline-none">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection
