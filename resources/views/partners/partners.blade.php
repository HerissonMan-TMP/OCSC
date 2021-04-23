@extends("layouts.app")

@section("title", "Partners")

@section("content")

    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center px-2 md:px-0 py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.imgur.com/kZ3YjwR.png');">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-handshake fa-fw"></i> Partners</h1>
        </div>
    </div>

    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
        <div class="grid grid-flow-row gap-16 bg-gray-800 p-6 rounded-md">
            @foreach($partnerCategories as $category)
                <div class="col-span-full flex flex-col items-center text-center">
                    <h2>{{ $category->name }}</h2>
                    <div class="grid grid-cols-4 gap-6 mt-5 w-full">
                        @forelse($category->partners as $partner)
                            <div class="col-span-full md:col-span-1 text-center">
                                <img width="200" height="200" src="{{ $partner->logo }}" alt="{{ $partner->name }} Logo" class="rounded-full p-4 mx-auto">

                                <span class="font-bold">{{ $partner->name }}</span>

                                <div class="mt-2">
                                    @isset($partner->truckersmp_link)
                                    <a href="{{ $partner->truckersmp_link }}" target="_blank">
                                        <i class="fas fa-truck fa-fw"></i>
                                    </a>
                                    @endisset
                                    @isset($partner->trucksbook_link)
                                        <a href="{{ $partner->trucksbook_link }}" target="_blank">
                                            <i class="fas fa-shipping-fast fa-fw"></i>
                                        </a>
                                    @endisset
                                    @isset($partner->website_link)
                                        <a href="{{ $partner->website_link }}" target="_blank">
                                            <i class="fas fa-globe fa-fw"></i>
                                        </a>
                                    @endisset
                                    @isset($partner->twitter_link)
                                        <a href="{{ $partner->twitter_link }}" target="_blank">
                                            <i class="fab fa-twitter fa-fw"></i>
                                        </a>
                                    @endisset
                                    @isset($partner->instagram_link)
                                        <a href="{{ $partner->instagram_link }}" target="_blank">
                                            <i class="fab fa-instagram fa-fw"></i>
                                        </a>
                                    @endisset
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full mt-5 text-center">
                                <span class="text-sm italic text-gray-300">No partners for this category yet...</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

        <hr class="my-16">

        <div>
            <h2 class="mb-10 text-center">Want to be partner?</h2>

            <div class="flex flex-wrap justify-center gap-6">
                @foreach($partnerCategories as $category)
                    <div class="w-full flex flex-col justify-between md:w-1/3 text-center rounded-md bg-gray-800">
                        <div class="p-6">
                            <h4 class="m-0">{{ $category->name }}</h4>

                            <p class="text-sm mt-6">{{ $category->description }}</p>
                        </div>

                        <div class="p-6 rounded-b-md @if($category->opening_at && $category->opening_at < now()) bg-green-500 @else bg-red-500 @endif">
                            @if($category->opening_at && $category->opening_at < now())
                                <span class="font-bold uppercase text-2xl text-green-800">Open</span>
                                <span class="block text-xs text-gray-800">Contact us on Discord.</span>
                            @else
                                <span class="font-bold uppercase text-2xl text-red-800">Closed</span>
                                @isset($category->opening_at)
                                    <span class="block text-xs text-gray-800">Opens {{ $category->opening_at->format('d M, Y') }}.</span>
                                @else
                                    <span class="block text-xs text-gray-800">No opening planned yet.</span>
                                @endisset
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="my-20 text-center text-sm">
                Being a partner of OCSC Event means opting for a serious and committed relationship. <br>
                We are therefore looking for reliable partners, having for values, trust and respect.
            </p>

            <div class="p-6 rounded-md bg-gray-800">
                <h2 class="m-0 text-center">Partnership conditions & information</h2>

                <div class="mt-10">
                    @isset($partnershipConditions)
                        @markdown($partnershipConditions->content)
                    @else
                        <span class="text-sm text-gray-300 italic">No partnership conditions & information yet...</span>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
