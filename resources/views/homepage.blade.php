@extends("layouts.app")

@section("content")
<div class="bg-fixed w-full h-screen overflow-hidden" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset('img/background_placeholder.png') }});">
    <div class="w-full h-full text-center text-gray-300 flex flex-col justify-center items-center">
        <div class="font-semibold text-6xl">
            OCSC Event
        </div>
        <a href="#our-services" class="mt-20 bg-transparent text-primary border border-primary py-4 px-6 flex justify-center items-center rounded-full">
            <span class="mr-2">Discover Us</span>
            <i class="flex-shrink-0 text-primary fas fa-angle-down fa-fw mt-0.5"></i>
        </a>
    </div>
</div>

<section id="our-services" class="w-full py-28">
    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto grid grid-cols-3 gap-16 md:gap-20">
        <div class="col-span-full md:col-span-1 text-justify">
            <h3 class="text-xl font-bold text-primary uppercase">Creation of Convoys</h3>
            <p class="mt-6">
                We create your convoy from A to Z; we choose the appropriate route, we deal with convoy advertisement, and more.
            </p>
        </div>
        <div class="col-span-full md:col-span-1 text-justify">
            <h3 class="text-xl font-bold text-primary uppercase">VTC & Parking Management</h3>
            <p class="mt-6">
                We carry out the placement of the VTCs and choose the best order of departure.
            </p>
        </div>
        <div class="col-span-full md:col-span-1 text-justify">
            <h3 class="text-xl font-bold text-primary uppercase">Supervision</h3>
            <p class="mt-6">
                Thanks to our several saves, we can supervise your convoy efficiently, with professionalism.
            </p>
        </div>
    </div>
</section>

<div class="bg-fixed bg-cover py-20" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://cdn.discordapp.com/attachments/785605081449103371/801489516585156678/Second_Affiinity_Photos_Edits.png');">
    <div class="text-center uppercase text-4xl font-bold">
        Next convoys
    </div>
</div>
<section id="next-convoys" class="w-full h-1/4">
    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16 grid grid-cols-3 gap-16 md:gap-20">
        @forelse($events as $event)
        <div class="col-span-full md:col-span-1 bg-gray-800 rounded-md w-full h-full">
            <div class="h-1/4">
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
        <span class="text-sm italic text-gray-300">No convoys registered on the website yet...</span>
        @endforelse
    </div>
</section>

<div class="bg-fixed bg-cover py-20" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://i.imgur.com/7DyEQdi.jpeg');">
    <div class="text-center uppercase text-4xl font-bold">
        Our partners
    </div>
</div>
<section id="partners" class="w-full h-1/4">
    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16 grid grid-cols-3 gap-16 md:gap-20">
        <div class="col-span-full md:col-span-1 mx-auto">
            <img width="200" height="200" src="{{ asset('img/ocsc_logo.png') }}" alt="" class="rounded-full">
        </div>
        <div class="col-span-full md:col-span-1 mx-auto">
            <img width="200" height="200" src="{{ asset('img/ocsc_logo.png') }}" alt="" class="rounded-full">
        </div>
        <div class="col-span-full md:col-span-1 mx-auto">
            <img width="200" height="200" src="{{ asset('img/ocsc_logo.png') }}" alt="" class="rounded-full">
        </div>
    </div>
</section>
@endsection
