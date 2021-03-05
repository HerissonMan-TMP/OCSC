@extends('layouts.staff')

@section('title', "Contact Message #{$contactMessage->id}")

@section('breadcrumb', "Staff - Contact Message #{$contactMessage->id}")

@section('content-staff')
    <div class="mt-6 px-4 py-5 sm:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <div class="mb-6">
            <h3 class="inline font-bold text-2xl text-gray-300 mr-4">Contact Message #{{ $contactMessage->id }}</h3>
            @if($contactMessage->status === 'read')
            <div class="inline px-2 py-1 rounded-md bg-gray-500">
                <span class="font-bold text-gray-200 text-sm">Already read</span>
            </div>
            @endif
        </div>

        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-full sm:col-span-3">
                <label for="truckersmp_id" class="block text-sm font-medium text-gray-300">TruckersMP ID <span class="text-red-500 font-bold">*</span></label>
                <input type="text" disabled id="truckersmp_id" class="text-gray-300 bg-gray-700 font-bold uppercase mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" value="{{ $contactMessage->truckersmp_id }}">
            </div>

            <div class="col-span-full sm:col-span-3">
                <label for="vtc" class="block text-sm font-medium text-gray-300">VTC</label>
                <input type="text" disabled id="vtc" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" value="{{ $contactMessage->vtc }}">
            </div>

            <div class="col-span-full sm:col-span-full">
                <label for="category" class="block text-sm font-medium text-gray-300">Category <span class="text-red-500 font-bold">*</span></label>
                <select id="category" disabled class="text-gray-300 bg-gray-700 mt-1 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                    <option>{{ $contactMessage->category->name }}</option>
                </select>
            </div>

            <div class="col-span-full sm:col-span-3">
                <label for="discord" class="block text-sm font-medium text-gray-300">Discord username</label>
                <input type="text" disabled id="discord" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" value="{{ $contactMessage->discord }}">
            </div>

            <div class="col-span-full sm:col-span-3">
                <label for="email" class="block text-sm font-medium text-gray-300">Email address</label>
                <input type="email" disabled id="email" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" value="{{ $contactMessage->email }}">
            </div>

            <div class="col-span-full">
                <label for="message" class="block text-sm font-medium text-gray-300">Message <span class="text-red-500 font-bold">*</span></label>
                <textarea disabled id="message" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md resize-none">{{ $contactMessage->message }}</textarea>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-6 mt-10">
            <div class="sm:col-span-4"></div>
            @if($contactMessage->status === 'read')
            <form class="col-span-full sm:col-span-1" action="{{ route('staff.contact-messages.mark-as-unread', $contactMessage) }}" method="POST">
                @csrf
                <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-blue-200 bg-blue-700 hover:text-blue-300 hover:bg-blue-800 focus:outline-none">
                    Mark as "Unread"
                </button>
            </form>
            @else
            <form class="col-span-full sm:col-span-1" action="{{ route('staff.contact-messages.mark-as-read', $contactMessage) }}" method="POST">
                @csrf
                <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-blue-200 bg-blue-700 hover:text-blue-300 hover:bg-blue-800 focus:outline-none">
                    Mark as "Read"
                </button>
            </form>
            @endif
            <form class="col-span-full sm:col-span-1" action="{{ route('staff.contact-messages.destroy', $contactMessage) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-red-200 bg-red-700 hover:text-red-300 hover:bg-red-800 focus:outline-none">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection
