@extends('layouts.staff')

@section('title', 'Staff Hub')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Staff Hub</h2>
        </div>

        <div class="rounded-md" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset('https://cdn.discordapp.com/attachments/824978783051448340/835188402495291392/ets2_20210320_231822_00.png') }});">
            <div class="rounded-md" style="backdrop-filter: blur(5px);">
                <div class="grid grid-cols-8 grid-flow-5 gap-6 rounded-md p-4">
                    <div class="col-span-full md:col-span-3 row-span-1">
                        <div class="p-4 rounded-md bg-gray-800">
                            <h3 class="mt-0 mb-8">Basic Statistics</h3>

                            <div class="self-center">
                                <div class="grid grid-cols-3 gap-6 text-center">
                                    <div class="text-4xl font-bold">
                                        {{ $counters['convoys'] }}
                                    </div>
                                    <div class="text-4xl font-bold">
                                        {{ $counters['articles'] }}
                                    </div>
                                    <div class="text-4xl font-bold">
                                        {{ $counters['users'] }}
                                    </div>
                                </div>
                                <div class="mt-2 grid grid-cols-3 gap-6 text-center text-sm">
                                    <div>
                                        Convoys Published
                                    </div>
                                    <div>
                                        Articles Posted
                                    </div>
                                    <div>
                                        Staff Members
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full md:col-span-5 row-span-2">
                        <div class="h-full p-4 rounded-md bg-gray-800">
                            <div class="mb-8">
                                <h3 class="mt-0 mb-2">Website Changelog</h3>
                                <span class="text-sm text-gray-400">Latest changelog: <span class="font-bold">01/06/2021 07:55 UTC</span></span>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div class="col-span-full md:col-span-1 flex items-center gap-4">
                                    <div class="w-10 h-10 p-4 bg-green-500 rounded-md flex items-center justify-center">
                                        <i class="fas fa-thumbs-up fa-fw"></i>
                                    </div>

                                    <span class="text-sm">Changing the text displayed when a partnership category is open.</span>
                                </div>

                                <div class="col-span-full md:col-span-1 flex items-center gap-4">
                                    <div class="w-10 h-10 p-4 bg-green-500 rounded-md flex items-center justify-center">
                                        <i class="fas fa-thumbs-up fa-fw"></i>
                                    </div>

                                    <span class="text-sm">Displaying only upcoming convoys on the public Convoys page.</span>
                                </div>

                                <div class="col-span-full md:col-span-1 flex items-center gap-4">
                                    <div class="w-10 h-10 p-4 bg-green-500 rounded-md flex items-center justify-center">
                                        <i class="fas fa-thumbs-up fa-fw"></i>
                                    </div>

                                    <span class="text-sm">Fixing displaying the global requirements on every recruitment page.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full md:col-span-3 row-span-4">
                        <div class="p-4 rounded-md bg-gray-800">
                            <h3 class="mt-0 mb-8">Latest News</h3>

                            @isset($latestArticle)
                                <div class="col-span-full md:col-span-1 rounded-md bg-gray-900 overflow-hidden">
                                    <div class="h-40 text-sm mb-6 bg-cover bg-center" style="background-image: url({{ $latestArticle->banner_url ?? 'https://static.truckersmp.com/images/bg/ets.jpg' }});">
                                    </div>

                                    <div class="h-16 mx-6">
                                        <h3 class="font-semibold text-xl m-0 text-gray-200">
                                            {{ $latestArticle->title }}
                                        </h3>
                                    </div>

                                    <div class="mx-6 mb-6">
                                        <div class="flex justify-between">
                                            <span class="text-sm italic text-gray-300">
                                                <i class="fas fa-user fa-fw fa-md"></i>
                                                @if($latestArticle->postedByUser)
                                                    <span class="font-bold" style="color: {{ $latestArticle->postedByUser->roles->first()->color }}">{{ $latestArticle->postedByUser->name }}</span>
                                                @else
                                                    <span>Anonymous</span>
                                                @endif
                                            </span>
                                            <span class="ml-4 text-sm italic text-gray-300"><i class="fas fa-clock fa-fw fa-md"></i> {{ $latestArticle->created_at->format('d M H:i') }}</span>
                                        </div>
                                        <a href="{{ route('articles.show', $latestArticle) }}" class="mt-4 transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                                            Read
                                        </a>
                                    </div>
                                </div>
                            @else
                                <span class="text-sm italic text-gray-300">No news articles yet...</span>
                            @endisset
                        </div>
                    </div>

                    <div class="col-span-full md:col-span-5 row-span-3">
                        <div class="p-4 rounded-md bg-gray-800">
                            <h3 class="mt-0 mb-8">2 Next Convoys</h3>

                            <div class="grid grid-cols-2 gap-4">
                                @forelse($convoys as $convoy)
                                    <div class="col-span-full md:col-span-1 bg-gray-900 rounded-md overflow-hidden">
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
                                @empty
                                    <span class="text-sm italic text-gray-300">No convoys registered on the website yet...</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
