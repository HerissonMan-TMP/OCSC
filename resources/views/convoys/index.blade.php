@extends('layouts.staff')

@section('title', 'Convoys - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Convoys</h2>
        </div>

        <form action="" method="GET" class="mb-10 p-6 bg-gray-800 rounded-md grid grid-cols-12 gap-4">
            <div class="col-span-1">
                <input type="text" name="truckersmpEventId" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="TMP ID" value="{{ request('truckersmpEventId') }}">
            </div>

            <div class="col-span-2">
                <input type="text" name="title" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Title" value="{{ request('title') }}">
            </div>

            <div class="col-span-1">
                <input type="text" name="location" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Location" value="{{ request('location') }}">
            </div>

            <div class="col-span-1">
                <input type="text" name="destination" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Destination" value="{{ request('destination') }}">
            </div>

            <div class="col-span-2">
                <input type="text" name="distanceMoreThan" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Distance more than (km)" value="{{ request('distanceMoreThan') }}">
            </div>

            <div class="col-span-2">
                <input type="text" name="distanceLessThan" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Distance less than (km)" value="{{ request('distanceLessThan') }}">
            </div>

            <div class="col-span-1">
                <select name="sortByMeetupDate" class="capitalize text-gray-300 bg-gray-700 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option @if(request('sortByMeetupDate') === 'desc') selected @endif value="desc">Descending</option>
                    <option @if(request('sortByMeetupDate') === 'asc') selected @endif value="asc">Ascending</option>
                </select>
            </div>

            <div class="col-span-1">
                <select name="date" class="capitalize text-gray-300 bg-gray-700 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option @if(request('date') === 'all') selected @endif value="all" class="capitalize">all</option>
                    <option @if(request('date') === 'upcoming') selected @endif value="upcoming" class="capitalize">upcoming</option>
                    <option @if(request('date') === 'past') selected @endif value="past" class="capitalize">past</option>
                </select>
            </div>

            <div class="col-span-1">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    OK
                </button>
            </div>
        </form>

        <div class="grid grid-cols-4 gap-10">
            @forelse($convoys as $convoy)
                <div class="rounded-md bg-gray-800 overflow-hidden @if($convoy->meetup_date->isPast()) transition duration-200 opacity-50 hover:opacity-100 @endif">
                    <div class="h-24 text-sm mb-6 bg-cover bg-center" style="background-image: url({{ $convoy->banner_url ?? 'https://static.truckersmp.com/images/bg/ets.jpg' }});">
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

        {{ $convoys->onEachSide(1)->withQueryString()->links() }}
    </div>
@endsection
