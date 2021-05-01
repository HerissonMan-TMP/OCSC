@extends('layouts.app')

@section('title', 'Convoys')

@section('content')
    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ config('app.default_banner') }}');">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-calendar-alt fa-fw"></i>Convoys</h1>
        </div>
    </div>

    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
        <div class="my-4 p-4 rounded-md bg-blue-500 text-sm">
            <i class="fas fa-info-circle fa-fw"></i>
            Convoys data is updated thanks to the <span class="font-bold">TruckersMP API</span> every 5 minutes.
        </div>

        <div class="grid grid-cols-3 gap-20">
            @forelse($convoys as $convoy)
                @if(!$convoy['error'])
                    <div class="col-span-full md:col-span-1 bg-gray-900 rounded-md overflow-hidden @if(\Carbon\Carbon::parse($convoy['response']['start_at'])->isPast()) transition duration-200 opacity-50 hover:opacity-100 @endif">
                        <div class="h-24 text-sm mb-6 bg-cover bg-center" style="background-image: url({{ $convoy['response']['banner'] ?? 'https://static.truckersmp.com/images/bg/ets.jpg' }});">
                        </div>

                        <div class="h-20 mx-6">
                            <h3 class="font-semibold text-xl m-0 text-gray-200">
                                {{ $convoy['response']['name'] }}
                            </h3>
                        </div>

                        <div class="mx-6 mb-6">
                            <div class="flex justify-between">
                                <div>
                                    <i class="fas fa-map-marker-alt fa-fw fa-sm"></i> <span class="ml-2 text-sm">{{ $convoy['response']['departure']['city'] }}</span>
                                </div>
                                <div>
                                    <span class="mr-2 text-sm">{{ $convoy['response']['arrive']['city'] }}</span> <i class="fas fa-map-marker-alt fa-fw fa-sm"></i>
                                </div>
                            </div>
                            <div>
                                @if($convoy['response']['server']['name'] === 'Event Server')
                                    <i class="fas fa-server fa-fw fa-sm"></i> <span class="ml-2 text-sm text-primary font-bold uppercase">Event server</span>
                                @else
                                    <i class="fas fa-server fa-fw fa-sm"></i> <span class="ml-2 text-sm @if($convoy['response']['server']['name'] === 'To be determined') italic @endif">{{ $convoy['response']['server']['name'] }}</span>
                                @endif
                            </div>
                            <div>
                                <i class="fas fa-calendar fa-fw fa-sm"></i> <span class="ml-2 text-sm capitalize">{{ \Carbon\Carbon::parse($convoy['response']['start_at'])->diffForHumans(['options' => \Carbon\Carbon::ONE_DAY_WORDS]) }} ({{ \Carbon\Carbon::parse($convoy['response']['start_at'])->format('d M H:i') }} UTC)</span>
                            </div>
                            <a href="{{ 'https://truckersmp.com/events/' . $convoy['response']['id'] }}" target="_blank" class="mt-4 transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                                Register on TruckersMP
                            </a>
                        </div>
                    </div>
                @endif
            @empty
                <span class="text-sm italic text-gray-300">No upcoming convoys yet...</span>
            @endforelse
        </div>

        {{ $convoys->onEachSide(1)->withQueryString()->links() }}
    </div>
@endsection
