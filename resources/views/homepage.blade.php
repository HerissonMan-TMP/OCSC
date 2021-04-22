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
        Upcoming convoys
    </div>
</div>
<section id="next-convoys" class="w-full h-1/4">
    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16 grid grid-cols-3 gap-16 md:gap-20">
        @forelse($convoys as $convoy)
        <div class="col-span-full md:col-span-1 bg-gray-800 rounded-md overflow-hidden">
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
    <div class="max-w-7xl px-4 py-5 p-6 mx-auto my-16 swiper-container">
        @if($partners->isNotEmpty())
        <div class="items-center swiper-wrapper">
            @foreach($partners as $partner)
                <div class="swiper-slide">
                    <a href="{{ $partner->website_link }}" target="_blank">
                        <img width="200" height="200" src="{{ $partner->logo }}" alt="{{ $partner->name }} Logo" class="rounded-full mx-auto">
                    </a>
                </div>
            @endforeach
        </div>
        @else
            <span class="text-sm text-gray-300 italic">No partners yet...</span>
        @endif
    </div>
</section>
@endsection

@push('scripts')
    <script>
        $(function () {
            //Partners slider
            var swiper =new Swiper('.swiper-container', {
                spaceBetween: 50,
                slidesPerView: 3,
                centeredSlides: true,
                loop: true,
                slideNextClass:'eswiper-slide-next',
                slidePrevClass:'eswiper-slide-prev',
            });

            setInterval(function() {
                swiper.slideNext(500);
            }, 2000);
        });
    </script>
@endpush
