@extends('layouts.staff')

@section('title', 'Convoys - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Convoys</h2>
        </div>

        <div class="my-4 p-4 rounded-md bg-blue-500 text-sm">
            <i class="fas fa-info-circle fa-fw"></i>
            Convoys data is updated thanks to the <span class="font-bold">TruckersMP API</span> every 10 minutes.
        </div>

        <div class="grid grid-cols-4 gap-10">
            @forelse($convoys as $convoy)
                <div class="col-span-full md:col-span-1 rounded-md bg-gray-800 overflow-hidden @if(\Carbon\Carbon::parse($convoy['response']['start_at'])->isPast()) transition duration-200 opacity-50 hover:opacity-100 @endif">
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
                        <div class="grid grid-cols-6 gap-2 mt-4">
                            <div class="col-span-5">
                                <a href="{{ 'https://truckersmp.com/events/' . $convoy['response']['id'] }}" target="_blank" class="h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark focus:outline-none">
                                    See on TruckersMP
                                </a>
                            </div>
                            @can('manage-convoys')
                                <form action="{{ route('staff.convoys.destroy', $convoy['response']['id']) }}" method="POST" class="col-span-1">
                                    @csrf
                                    @method('DELETE')

                                    <button type="Submit" class="h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-200 bg-red-500 hover:text-gray-300 hover:bg-red-600 focus:outline-none"><i class="fas fa-trash-alt fa-fw fa-md"></i></button>
                                </form>
                            @endcan
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
