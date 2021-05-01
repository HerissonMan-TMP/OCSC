@extends('layouts.staff')

@section('title', 'Staff Hub')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Staff Hub</h2>
        </div>

        <div class="grid grid-cols-8 gap-6">
            <div class="col-span-full md:col-span-3">
                <div class="p-4 rounded-md bg-gray-800">
                    <h3 class="mt-0 mb-8">Basic Statistics</h3>

                    <div class="self-center">
                        <div class="grid grid-cols-3 gap-6 text-center">
                            <div class="text-4xl font-bold">
                                {{ $counters['convoys'] }}
                            </div>
                            <div class="text-4xl font-bold">
                                {{ $counters['articles'] }}
                            </div>
                            <div class="text-4xl font-bold">
                                {{ $counters['users'] }}
                            </div>
                        </div>
                        <div class="mt-2 grid grid-cols-3 gap-6 text-center text-sm">
                            <div>
                                Convoys Published
                            </div>
                            <div>
                                Articles Posted
                            </div>
                            <div>
                                Staff Members
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-full md:col-span-5">
                <div class="p-4 rounded-md bg-gray-800">
                    <div class="mb-8">
                        <h3 class="mt-0 mb-2">Website Changelog</h3>
                        <span class="text-sm text-gray-400">Latest changelog: <span class="font-bold">01/05/2021 13:00</span></span>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-full md:col-span-1 flex items-center gap-4">
                            <div class="w-10 h-10 p-4 bg-yellow-500 rounded-md flex items-center justify-center">
                                <i class="fas fa-star fa-fw"></i>
                            </div>

                            <span class="text-sm">Convoys data is now directly fetched from to the TruckersMP API.</span>
                        </div>

                        <div class="col-span-full md:col-span-1 flex items-center gap-4">
                            <div class="w-10 h-10 p-4 bg-red-500 rounded-md flex items-center justify-center">
                                <i class="fas fa-bug fa-fw"></i>
                            </div>

                            <span class="text-sm">Fixing incorrect default values in some inputs when attempting to edit a user's name & email.</span>
                        </div>

                        <div class="col-span-full md:col-span-1 flex items-center gap-4">
                            <div class="w-10 h-10 p-4 bg-green-500 rounded-md flex items-center justify-center">
                                <i class="fas fa-thumbs-up fa-fw"></i>
                            </div>

                            <span class="text-sm">Adding a lot of feature tests (used for testing if the website features are working correctly).</span>
                        </div>

                        <div class="col-span-full md:col-span-1 flex items-center gap-4">
                            <div class="w-10 h-10 p-4 bg-green-500 rounded-md flex items-center justify-center">
                                <i class="fas fa-thumbs-up fa-fw"></i>
                            </div>

                            <span class="text-sm">Cleaning code.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
