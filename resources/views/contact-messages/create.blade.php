@extends('layouts.app')

@section('title', 'Contact')

@section('breadcrumb')
Contact
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 mt-16">
    <div class="md:col-span-2">
        <form action="{{ route('contact-messages.store') }}" method="POST">
            @csrf
            <div class="shadow overflow-hidden rounded-md">
                <div class="px-4 py-5 bg-gray-800 sm:p-6">
                    <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Anything you want to tell us ? Contact us below !</h3>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-full sm:col-span-3">
                            <label for="truckersmp_id" class="block text-sm font-medium text-gray-300">TruckersMP ID <span class="text-red-500 font-bold">*</span></label>
                            <input type="text" name="truckersmp_id" id="truckersmp_id" class="text-gray-300 bg-gray-700 font-bold uppercase mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" placeholder="900597" required maxlength="8" value="{{ old('truckersmp_id') }}">
                            @error('truckersmp_id')
                            <span class="pt-2 text-sm text-red-500">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-3">
                            <label for="vtc" class="block text-sm font-medium text-gray-300">Your VTC</label>
                            <input type="text" name="vtc" id="vtc" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" placeholder="Forza Trucking" maxlength="30" value="{{ old('vtc') }}">
                            @error('vtc')
                            <span class="pt-2 text-sm text-red-500">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-full">
                            <label for="category" class="block text-sm font-medium text-gray-300">Category <span class="text-red-500 font-bold">*</span></label>
                            <select id="category" name="category_id" class="text-gray-300 bg-gray-700 mt-1 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                                @foreach($categories as $category)
                                <option @if(old('category_id') == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="pt-2 text-sm text-red-500">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-3">
                            <label for="discord" class="block text-sm font-medium text-gray-300">Discord username <span class="italic text-xs text-gray-400">(required if you didn't fill the Email address input)</span></label>
                            <input type="text" name="discord" id="discord" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" placeholder="MyUsername#1234" maxlength="50" value="{{ old('discord') }}">
                            @error('discord')
                            <span class="pt-2 text-sm text-red-500">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-3">
                            <label for="email" class="block text-sm font-medium text-gray-300">Email address <span class="italic text-xs text-gray-400">(required if you didn't fill the Discord Username input)</span></label>
                            <input type="email" name="email" id="email" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" placeholder="myemail@example.com" maxlength="300" value="{{ old('email') }}">
                            @error('email')
                            <span class="pt-2 text-sm text-red-500">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-span-full">
                            <label for="message" class="block text-sm font-medium text-gray-300">Message <span class="text-red-500 font-bold">*</span></label>
                            <textarea name="message" id="message" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" cols="30" rows="10" maxlength="5000">{{ old('message') }}</textarea>
                            @error('message')
                            <span class="pt-2 text-sm text-red-500">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-800 text-right sm:px-6">
                    <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                        Send
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
