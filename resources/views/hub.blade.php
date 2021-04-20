@extends('layouts.staff')

@section('title', 'Staff Hub')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Staff Hub</h2>
        </div>

        <div class="grid grid-cols-8 gap-6">
            <div class="col-span-full md:col-span-3">
                <div class="h-full p-4 rounded-md bg-gray-800">
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
                    <h3 class="mt-0 mb-8">Other...</h3>


                </div>
            </div>
        </div>
    </div>
@endsection
