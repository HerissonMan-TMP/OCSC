@extends('layouts.app')

@section('title', 'Upcoming Convoys')

@section('content')
    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.imgur.com/kZ3YjwR.png');">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-calendar-alt fa-fw"></i> Upcoming Convoys</h1>
        </div>
    </div>

    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
        <div class="grid grid-cols-3 gap-20">
            @forelse($convoys as $convoy)
                <div class="col-span-full md:col-span-1 bg-gray-900 rounded-md overflow-hidden">
                    <div class="text-sm mb-6">
                        <img class="max-w-full h-auto" src="{{ $convoy->banner_url ?? 'https://static.truckersmp.com/images/bg/ets.jpg' }}" alt="Convoy Banner">
                    </div>

                    <div class="h-16 mx-6">
                        <h3 class="font-semibold text-xl m-0 text-gray-200">
                            {{ $convoy->title }}
                        </h3>
                    </div>

                    <div class="mx-6 mb-6">
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
                            <i class="fas fa-calendar fa-fw fa-sm"></i> <span class="ml-2 text-sm capitalize">{{ $convoy->meetup_date->diffForHumans(['options' => \Carbon\Carbon::ONE_DAY_WORDS]) }} ({{ $convoy->meetup_date->format('d M H:i') }} UTC)</span>
                        </div>
                        <a href="{{ 'https://truckersmp.com/events/' . $convoy->truckersmp_event_id }}" target="_blank" class="mt-4 transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                            Register on TruckersMP
                        </a>
                    </div>
                </div>
            @empty
                <span class="text-sm italic text-gray-300">No upcoming convoys yet...</span>
            @endforelse
        </div>

        {{ $convoys->onEachSide(1)->links() }}
    </div>
@endsection
