@extends('layouts.app')

@section('title', 'Upcoming Convoys')

@section('breadcrumb', 'Upcoming Convoys')

@section('content')
<div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
    <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <div class="flex justify-center items-center mt-2 mb-10">
            <i class="inline-block fas fa-calendar-alt fa-fw fa-2x mr-2"></i>
            <h3 class="inline-block font-bold text-3xl text-gray-300">Upcoming Convoys</h3>
        </div>
        <div class="grid grid-cols-3 gap-16 md:gap-20">
            @forelse($events as $event)
                <div class="col-span-full md:col-span-1 rounded-md bg-gray-900 w-full h-full">
                    <div>
                        <img class="rounded-t-md w-full h-full" src="{{ $event['banner'] ?? 'https://static.truckersmp.com/images/bg/ets.jpg' }}" alt="">
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold text-xl mb-4">
                            <a href="{{ 'https://truckersmp.com' . $event['url'] }}" target="_blank" class="transition duration-200 hover:opacity-80">{{ $event['name'] }}</a>
                        </h3>
                        <div>
                            <div class="flex justify-between">
                                <div>
                                    <i class="fas fa-map-marker-alt fa-fw fa-sm"></i> <span class="ml-2 text-sm">{{ $event['departure']['city'] }}</span>
                                </div>
                                <div>
                                    <span class="mr-2 text-sm">{{ $event['arrive']['city'] }}</span> <i class="fas fa-map-marker-alt fa-fw fa-sm"></i>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-route fa-fw fa-sm"></i> @if($event['distance'] !== null) <span class="ml-2 text-sm"> {{ $event['distance'] }} km</span> @else <span class="ml-2 text-sm italic"> Not set yet</span> @endif
                            </div>
                            <div>
                                @if(str_contains($event['server']['name'], 'OPEN'))
                                    <i class="fas fa-server fa-fw fa-sm"></i> <span class="ml-2 text-sm text-primary font-bold uppercase">Event server</span>
                                @else
                                    <i class="fas fa-server fa-fw fa-sm"></i> <span class="ml-2 text-sm @if($event['server']['name'] === null) italic @endif">{{ $event['server']['name'] ?? 'To be determined' }}</span>
                                @endif
                            </div>
                            <div>
                                <i class="fas fa-calendar fa-fw fa-sm"></i> <span class="ml-2 text-sm">{{ $event['start_at'] }} UTC</span>
                            </div>
                            <a href="{{ 'https://truckersmp.com' . $event['url'] }}" target="_blank" class="mt-4 transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                                Register on TruckersMP
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <span class="text-sm italic text-gray-300">No upcoming convoys...</span>
            @endforelse
        </div>
    </div>
</div>
@endsection
