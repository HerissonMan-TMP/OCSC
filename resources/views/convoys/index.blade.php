@extends('layouts.staff')

@section('title', 'All Registered Convoys')

@section('breadcrumb', 'Staff - All Registered Convoys')

@section('content-staff')
    <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <div class="flex justify-between items-center mt-2 mb-6">
            <div>
                <h3 class="m-0 font-bold text-2xl text-gray-300">All Registered Convoys</h3>
            </div>
            <div>
                <a href="{{ route('staff.convoys.create') }}" class="transition duration-200 ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-gray-700 font-bold bg-primary hover:text-gray-800 hover:bg-primary-dark">
                    Register a new convoy
                </a>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-16 md:gap-20">
        @forelse($convoys as $convoy)
            <div class="col-span-full md:col-span-1 rounded-md bg-gray-900 w-full h-full flex flex-col justify-between @if($convoy->meetup_date < now()) transition duration-200 opacity-50 hover:opacity-100 @endif">
                <div>
                    <img class="rounded-t-md w-full h-full" src="{{ $convoy->banner_url ?? 'https://static.truckersmp.com/images/bg/ets.jpg' }}" alt="">
                </div>
                <h3 class="pt-6 px-6 font-semibold text-xl m-0">
                    <a href="{{ 'https://truckersmp.com/events/' . $convoy->truckersmp_event_id }}" target="_blank" class="text-gray-200 font-semibold transition duration-200 hover:text-gray-400">{{ $convoy->title }}</a>
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
                        <div class="grid grid-cols-3 gap-6 mt-4">
                            <div class="col-span-2">
                                <a href="{{ route('staff.convoys.edit', $convoy) }}" class="transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                                    Edit
                                </a>
                            </div>
                            <form action="{{ route('staff.convoys.destroy', $convoy) }}" method="POST" class="col-span-1">
                                @csrf
                                @method('DELETE')
                                <button type="Submit" class="h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-200 bg-red-500 hover:text-gray-300 hover:bg-red-600"><i class="fas fa-trash-alt fa-fw fa-md"></i></button>
                            </form>
                        </div>
                </div>
            </div>
        @empty
            <span class="text-sm italic text-gray-300">No convoys registered on the website yet...</span>
        @endforelse
        </div>

        <div class="mt-10">
            <h3 class="font-bold text-2xl text-gray-300">Convoy Rules</h3>
            <form action="{{ route('staff.convoy-rules.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <label for="convoy_rules" class="block text-sm font-medium text-gray-300">Convoy Rules <span class="text-red-500 font-bold">*</span></label>
                <textarea name="convoy_rules" id="convoy_rules" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" cols="30" rows="30">{{ old('convoy_rules') ?? setting('convoy-rules') }}</textarea>
                @error('convoy_rules')
                <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
                @enderror
                <div class="mt-6 text-right">
                    <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">Update the rules</button>
                </div>
            </form>
        </div>
    </div>
@endsection
