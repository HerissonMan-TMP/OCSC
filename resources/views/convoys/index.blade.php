@extends('layouts.staff')

@section('title', 'Convoys - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Convoys</h2>
        </div>

        <div class="mb-10 p-6 bg-gray-800 rounded-md italic">
            Filter and sort features coming soon...
        </div>

        <div class="grid grid-cols-4 gap-10">
            @forelse($convoys as $convoy)
                <div class="col-span-full md:col-span-1 rounded-md bg-gray-800 overflow-hidden @if($convoy->meetup_date->isPast()) transition duration-200 opacity-50 hover:opacity-100 @endif">
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
                        <div class="grid grid-cols-6 gap-2 mt-4">
                            <div class="col-span-4">
                                <a href="{{ 'https://truckersmp.com/events/' . $convoy->truckersmp_event_id }}" target="_blank" class="h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark focus:outline-none">
                                    See on TruckersMP
                                </a>
                            </div>
                            <div class="col-span-1">
                                <a href="{{ route('staff.convoys.edit', $convoy) }}" class="h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark focus:outline-none">
                                    <i class="fas fa-pen fa-fw fa-md"></i>
                                </a>
                            </div>
                            <form action="{{ route('staff.convoys.destroy', $convoy) }}" method="POST" class="col-span-1">
                                @csrf
                                @method('DELETE')
                                <button type="Submit" class="h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-200 bg-red-500 hover:text-gray-300 hover:bg-red-600 focus:outline-none"><i class="fas fa-trash-alt fa-fw fa-md"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <span class="text-sm italic text-gray-300">No convoys registered on the website yet...</span>
            @endforelse
        </div>
    </div>
@endsection
