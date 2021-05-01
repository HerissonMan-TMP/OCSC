@extends("layouts.app")

@section("content")
<div class="bg-fixed bg-cover bg-center w-full h-screen overflow-hidden" style="background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url({{ asset('https://cdn.discordapp.com/attachments/824978783051448340/835188402495291392/ets2_20210320_231822_00.png') }});">
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

<div class="bg-fixed bg-cover py-20" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://cdn.discordapp.com/attachments/824978783051448340/835160092910551080/ets2_20210417_214902_00.png');">
    <div class="text-center uppercase text-4xl font-bold">
        Upcoming convoys
    </div>
</div>
<section id="next-convoys" class="w-full h-1/4">
    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16 grid grid-cols-3 gap-16 md:gap-20">
        @forelse($convoys as $convoy)
            @if(!$convoy['error'])
                <div class="col-span-full md:col-span-1 bg-gray-800 rounded-md overflow-hidden">
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
            <span class="text-sm italic text-gray-300">No convoys registered on the website yet...</span>
        @endforelse
    </div>
</section>

<div class="bg-fixed bg-cover py-20" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://cdn.discordapp.com/attachments/824978783051448340/835160193813184552/ets2_20210417_214810_00.png');">
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
                    <a @isset($partner->website_link) href="{{ $partner->website_link }}" @endisset target="_blank">
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
