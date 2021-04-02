@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.imgur.com/kZ3YjwR.png');">
    <div class="text-center grid gap-4">
        <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-envelope fa-fw"></i> Contact</h1>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 md:px-6 my-16">
    <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <form action="{{ route('contact-messages.store') }}" method="POST">
            @csrf

            <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-10">Anything you want to tell us ? Contact us below !</h3>

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-3">
                    <label for="truckersmp_id" class="block text-sm font-medium text-gray-300">TruckersMP ID <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="truckersmp_id" id="truckersmp_id" class="text-gray-300 bg-gray-700 font-bold uppercase mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="900597" required maxlength="8" value="{{ old('truckersmp_id') }}">
                    @error('truckersmp_id')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="vtc" class="block text-sm font-medium text-gray-300">Your VTC</label>
                    <input type="text" name="vtc" id="vtc" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Forza Trucking" maxlength="30" value="{{ old('vtc') }}">
                    @error('vtc')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-full">
                    <label for="category" class="block text-sm font-medium text-gray-300">Category <span class="text-red-500 font-bold">*</span></label>
                    <select id="category" name="category_id" class="text-gray-300 bg-gray-700 mt-1 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
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

                <div class="col-span-full md:col-span-3">
                    <label for="discord" class="block text-sm font-medium text-gray-300">Discord username <span class="italic text-xs text-gray-400">(required if you didn't fill the Email address input)</span></label>
                    <input type="text" name="discord" id="discord" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="MyUsername#1234" maxlength="50" value="{{ old('discord') }}">
                    @error('discord')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="email" class="block text-sm font-medium text-gray-300">Email address <span class="italic text-xs text-gray-400">(required if you didn't fill the Discord Username input)</span></label>
                    <input type="email" name="email" id="email" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="myemail@example.com" maxlength="300" value="{{ old('email') }}">
                    @error('email')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="message" class="block text-sm font-medium text-gray-300">Message <span class="text-red-500 font-bold">*</span></label>
                    <textarea name="message" id="message" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" cols="30" rows="10" maxlength="5000">{{ old('message') }}</textarea>
                    @error('message')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Send
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
