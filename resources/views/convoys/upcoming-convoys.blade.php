@extends('layouts.app')

@section('title', 'Upcoming Convoys')

@section('breadcrumb', 'Upcoming Convoys')

@section('content')
<div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
    <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <div class="flex justify-center items-center mt-2 mb-10">
            <i class="inline-block fas fa-calendar-alt fa-fw fa-2x mr-2"></i>
            <h3 class="m-0 inline-block font-bold text-3xl text-gray-300">Upcoming Convoys</h3>
        </div>
        <div class="grid grid-cols-3 gap-16 md:gap-20">
            @forelse($convoys as $convoy)
                <div class="col-span-full md:col-span-1 rounded-md bg-gray-900 w-full h-full flex flex-col justify-between @if($convoy->meetup_date < now()) transition duration-200 opacity-50 hover:opacity-100 @endif">
                    <div>
                        <img class="rounded-t-md w-full h-full" src="{{ $convoy->banner_url ?? 'https://static.truckersmp.com/images/bg/ets.jpg' }}" alt="">
                    </div>
                    <h3 class="pt-6 px-6 font-semibold text-xl m-0">
                        {{ $convoy->title }}
                    </h3>
                    <div class="p-6">
                        <div class="flex justify-between">
                            <div>
                                <i class="fas fa-map-marker-alt fa-fw fa-sm"></i> <span class="ml-2 text-sm">{{ $convoy->location }}</span>
                            </div>
                            <div>
                                <span class="mr-2 text-sm">{{ $convoy->destination }}</span> <i class="fas fa-map-marker-alt fa-fw fa-sm"></i>
                            </div>
                        </div>
                        <div>
                            <i class="fas fa-route fa-fw fa-sm"></i> @if($convoy->distance !== null) <span class="ml-2 text-sm"> {{ $convoy->distance }} km</span> @else <span class="ml-2 text-sm italic"> Not set yet</span> @endif
                        </div>
                        <div>
                            @if($convoy->server === 'Event Server')
                                <i class="fas fa-server fa-fw fa-sm"></i> <span class="ml-2 text-sm text-primary font-bold uppercase">Event server</span>
                            @else
                                <i class="fas fa-server fa-fw fa-sm"></i> <span class="ml-2 text-sm @if($convoy->server === 'To be determined') italic @endif">{{ $convoy->server }}</span>
                            @endif
                        </div>
                        <div>
                            <i class="fas fa-calendar fa-fw fa-sm"></i> <span class="ml-2 text-sm">{{ $convoy->meetup_date }} UTC</span>
                        </div>
                        <a href="{{ 'https://truckersmp.com/events/' . $convoy->truckersmp_event_id }}" target="_blank" class="mt-4 transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                            Register on TruckersMP
                        </a>
                    </div>
                </div>
            @empty
                <span class="text-sm italic text-gray-300">No upcoming convoys...</span>
            @endforelse
        </div>
    </div>
</div>
@endsection
