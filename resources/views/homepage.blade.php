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
        <div class="col-span-full md:col-span-1 w-full">
            <div class="bg-gray-800 rounded-md">
                <div>
                    <img class="rounded-t-md" src="https://cdn.discordapp.com/attachments/785605081449103371/801489516585156678/Second_Affiinity_Photos_Edits.png" alt="">
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-xl mb-6">
                        <a href="" class="transition duration-200 hover:opacity-80">Anonymous Truckers ITA Convoy</a>
                    </h3>
                    <div class="flex justify-between">
                        <div>
                            <i class="fas fa-map-marker-alt fa-fw fa-sm"></i><span class="ml-2 text-sm">Munich</span>
                        </div>
                        <div>
                            <span class="ml-2 text-sm opacity-60">1176 km</span>
                        </div>
                        <div>
                            <span class="mr-2 text-sm">Wroclaw</span><i class="fas fa-map-marker-alt fa-fw fa-sm"></i>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-server fa-fw fa-sm"></i><span class="ml-2 text-sm">Simulation 2</span>
                    </div>
                    <div>
                        <i class="fas fa-calendar fa-fw fa-sm"></i><span class="ml-2 text-sm">21/03/2021 - 20:30 UTC</span>
                    </div>
                    <a href="{{ route('staff.hub') }}" class="mt-4 transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                        Register on TruckersMP
                    </a>
                </div>
            </div>
        </div>
        <div class="col-span-full md:col-span-1 w-full">
            <div class="bg-gray-800 rounded-md">
                <div>
                    <img class="rounded-t-md" src="https://cdn.discordapp.com/attachments/785605081449103371/801489516585156678/Second_Affiinity_Photos_Edits.png" alt="">
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-xl mb-6">
                        <a href="" class="transition duration-200 hover:opacity-80">Monthly April - MEGA</a>
                    </h3>
                    <div class="flex justify-between">
                        <div>
                            <i class="fas fa-map-marker-alt fa-fw fa-sm"></i><span class="ml-2 text-sm">Paris</span>
                        </div>
                        <div>
                            <span class="ml-2 text-sm opacity-60">1281 km</span>
                        </div>
                        <div>
                            <span class="mr-2 text-sm">Bastia</span><i class="fas fa-map-marker-alt fa-fw fa-sm"></i>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-server fa-fw fa-sm"></i><span class="ml-2 text-sm text-primary font-bold">Event Server</span>
                    </div>
                    <div>
                        <i class="fas fa-calendar fa-fw fa-sm"></i><span class="ml-2 text-sm">17/04/2021 - 18:00 UTC</span>
                    </div>
                    <a href="{{ route('staff.hub') }}" class="mt-4 transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                        Register on TruckersMP
                    </a>
                </div>
            </div>
        </div>
        <div class="col-span-full md:col-span-1 w-full">
            <div class="bg-gray-800 rounded-md">
                <div>
                    <img class="rounded-t-md" src="https://cdn.discordapp.com/attachments/785605081449103371/801489516585156678/Second_Affiinity_Photos_Edits.png" alt="">
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-xl mb-6">
                        <a href="" class="transition duration-200 hover:opacity-80">TTFR Convoy</a>
                    </h3>
                    <div class="flex justify-between">
                        <div>
                            <i class="fas fa-map-marker-alt fa-fw fa-sm"></i><span class="ml-2 text-sm">Dusseldorf</span>
                        </div>
                        <div>
                            <span class="ml-2 text-sm opacity-60">920 km</span>
                        </div>
                        <div>
                            <span class="mr-2 text-sm">Prague</span><i class="fas fa-map-marker-alt fa-fw fa-sm"></i>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-server fa-fw fa-sm"></i><span class="ml-2 text-sm">Promods</span>
                    </div>
                    <div>
                        <i class="fas fa-calendar fa-fw fa-sm"></i><span class="ml-2 text-sm">05/05/2021 - 20:00 UTC</span>
                    </div>
                    <a href="{{ route('staff.hub') }}" class="mt-4 transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                        Register on TruckersMP
                    </a>
                </div>
            </div>
        </div>
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
