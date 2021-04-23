<!doctype html>
<html lang="en" class="c_darkmode" style="scroll-behavior: smooth;">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="icon" type="image/png" href="{{ asset("img/ocsc_logo.png") }}">
        <link rel="stylesheet" href="{{ asset("css/app.css") }}">

        @stack('stylesheets')

        <!-- Fontawesome icons -->
        <script src="https://kit.fontawesome.com/6cbe367b1a.js" crossorigin="anonymous" defer></script>

        <!-- Flatpickr calendar -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- Swiper slider -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

        <!-- Cookie Consent custom -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.2/dist/cookieconsent.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.2/dist/cookieconsent.js"></script>

        <title>@hasSection('title') @yield("title") - @endif {{ config("app.name") }}</title>
    </head>
    <body class="bg-gray-700">

        <!-- Cookie preferences widget -->
        <a href="javascript:void(0);" aria-label="View cookie settings" data-cc="c-settings">
            <div id="cookie-preferences-widget" class="fixed top-0 left-5 z-50 bg-gray-100 rounded-b-lg text-primary-dark">
                <div class="m-3">
                    <i class="fas fa-fingerprint text-xl"></i>
                    <span id="cookie-preferences-widget-label" class="ml-2" style="display: none;">Cookie preferences</span>
                </div>
            </div>
        </a>

        @include('flash::message')

        <!-- Header -->
        <header>
            <div class="bg-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6">
                    <div class="flex justify-between items-center py-6 lg:justify-start lg:space-x-10">
                        <!-- Logo -->
                        <div class="flex justify-start lg:w-0 lg:flex-1">
                            <a href="{{ route('homepage') }}">
                                <span class="sr-only">{{ config('app.name') }}</span>
                                <img class="max-h-16 hidden lg:block rounded-lg" src="{{ asset('img/ocsc_extended_logo.png') }}" alt="">
                                <img class="max-h-16 block lg:hidden rounded-lg" src="{{ asset('img/ocsc_logo.png') }}" alt="">
                            </a>
                        </div>

                        <!-- Responsive open nav button -->
                        <div class="-mr-2 -my-2 lg:hidden">
                            <button id="responsive-button-open-nav" type="button" class="rounded-md p-2 inline-flex items-center justify-center text-gray-300 hover:text-gray-400 focus:outline-none" aria-expanded="false">
                                <span class="sr-only">Open menu</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>

                        <!-- Navbar -->
                        <nav class="hidden lg:flex space-x-10">

                            <div id="ocsc-event" class="relative">
                                <button id="ocsc-event-dropdown" type="button" class="text-gray-200 group rounded-md inline-flex items-center text-base font-medium hover:text-gray-300 focus:outline-none" aria-expanded="false">
                                    <span>{{ config("app.name") }}</span>
                                    <svg class="text-gray-200 ml-2 h-5 w-5 group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div id="ocsc-event-dropdown-content" class="hidden absolute z-10 left-1/2 transform -translate-x-1/2 pt-3 px-2 w-screen max-w-md sm:px-0">
                                    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                        <div class="relative grid gap-6 bg-gray-700 px-5 py-6 sm:gap-8 sm:p-8">
                                            <a href="{{ route('homepage') }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <i class="flex-shrink-0 text-primary fas fa-home fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="mb-0 text-base font-medium text-gray-200">
                                                        Home
                                                    </p>
                                                    <p class="mb-0 mt-1 text-sm text-gray-400">
                                                        Homepage of our website, and services we provide.
                                                    </p>
                                                </div>
                                            </a>

                                            <a href="https://forum.ocsc.fr" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <i class="flex-shrink-0 text-primary fas fa-comments fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="mb-0 text-base font-medium text-gray-200">
                                                        Forum
                                                    </p>
                                                    <p class="mb-0 mt-1 text-sm text-gray-400">
                                                        Forum of {{ config('app.name') }}.
                                                    </p>
                                                </div>
                                            </a>

                                            <a href="https://truckersmp.com/vtc/39908" target="_blank" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <i class="flex-shrink-0 text-primary fas fa-truck fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="mb-0 text-base font-medium text-gray-200">
                                                        OCSC VTC
                                                    </p>
                                                    <p class="mb-0 mt-1 text-sm text-gray-400">
                                                        Our official TruckersMP VTC page.
                                                    </p>
                                                </div>
                                            </a>

                                            <a href="{{ route('news') }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <i class="flex-shrink-0 text-primary fas fa-newspaper fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="mb-0 text-base font-medium text-gray-200">
                                                        News
                                                    </p>
                                                    <p class="mb-0 mt-1 text-sm text-gray-400">
                                                        General news regarding our group.
                                                    </p>
                                                </div>
                                            </a>

                                            <a href="{{ route('partners') }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <i class="flex-shrink-0 text-primary fas fa-handshake fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="mb-0 text-base font-medium text-gray-200">
                                                        Partnership
                                                    </p>
                                                    <p class="mb-0 mt-1 text-sm text-gray-400">
                                                        All of OCSC's partners. We are very proud to have them and we are looking forward to work with them.
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="px-5 py-5 bg-gray-800 sm:px-8 sm:py-8">
                                            <div>
                                                <h3 class="m-0 text-sm tracking-wide font-medium text-gray-400 uppercase">
                                                    Latest Articles
                                                </h3>
                                                <ul class="mt-4 space-y-4">
                                                    @forelse($latestArticles as $latestArticle)
                                                    <li class="list-none text-base truncate text-gray-300">
                                                        <a href="{{ route('articles.show', $latestArticle) }}" class="transition duration-200 font-medium text-gray-300 hover:text-gray-400 capitalize">
                                                            {{ $latestArticle->title }}
                                                        </a>
                                                    </li>
                                                    @empty
                                                        <span class="text-sm italic text-gray-300">No news articles yet...</span>
                                                    @endforelse
                                                </ul>
                                            </div>
                                            <div class="mt-5 text-sm">
                                                <a href="{{ route('news') }}" class="transition duration-200 font-medium text-primary hover:text-primary-dark"> View all news articles <span aria-hidden="true">&rarr;</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="convoys" class="relative">
                                <button id="convoys-dropdown" type="button" class="text-gray-200 group rounded-md inline-flex items-center text-base font-medium hover:text-gray-300 focus:outline-none" aria-expanded="false">
                                    <span>Convoys</span>
                                    <svg class="text-gray-200 ml-2 h-5 w-5 group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div id="convoys-dropdown-content" class="hidden absolute z-10 left-1/2 transform -translate-x-1/2 pt-3 px-2 w-screen max-w-md sm:px-0">
                                    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                        <div class="relative grid gap-6 bg-gray-700 px-5 py-6 sm:gap-8 sm:p-8">
                                            <a href="{{ route('convoys', ['date' => 'upcoming', 'sortByMeetupDate' => 'asc']) }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <i class="flex-shrink-0 text-primary fas fa-calendar-alt fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="mb-0 text-base font-medium text-gray-200">
                                                        Upcoming Convoys
                                                    </p>
                                                    <p class="mb-0 mt-1 text-sm text-gray-400">
                                                        See our future convoys and events.
                                                    </p>
                                                </div>
                                            </a>

                                            <a href="{{ route('convoy-rules.show') }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <i class="flex-shrink-0 text-primary fas fa-list-alt fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="mb-0 text-base font-medium text-gray-200">
                                                        Convoy Rules
                                                    </p>
                                                    <p class="mb-0 mt-1 text-sm text-gray-400">
                                                        Understand our convoy rules so that everyone can have a safe, real, and enjoyable trucking experience.
                                                    </p>
                                                </div>
                                            </a>

                                            <a href="{{ route('gallery') }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <i class="flex-shrink-0 text-primary fas fa-images fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="mb-0 text-base font-medium text-gray-200">
                                                        Gallery
                                                    </p>
                                                    <p class="mb-0 mt-1 text-sm text-gray-400">
                                                        Photos and videos made by OCSC Event during our convoys and events. Take a look!
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="recruitment" class="relative">
                                <button id="recruitment-dropdown" type="button" class="text-gray-200 group rounded-md inline-flex items-center text-base font-medium hover:text-gray-300 focus:outline-none" aria-expanded="false">
                                    <span>Recruitment</span>

                                    <svg class="text-gray-200 ml-2 h-5 w-5 group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div id="recruitment-dropdown-content" class="hidden absolute z-10 -ml-4 pt-3 transform px-2 w-screen max-w-md sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2">
                                    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                        <div class="relative grid gap-6 bg-gray-700 px-5 py-6 sm:gap-8 sm:p-8">
                                            @forelse($recruitableRoles->sortBy('order') as $role)
                                            <a @if($role->isRecruiting()) href="{{ route('recruitments.show', $role->getOpenRecruitment()) }}" @endif class="@if(!$role->isRecruiting()) select-none @endif transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <!-- Heroicon name: outline/chart-bar -->
                                                <i class="flex-shrink-0 text-primary fas fa-{{ $role->icon_name }} fa-fw fa-lg mt-2" style="color: {{ $role->color }};"></i>
                                                <div class="w-full ml-4">
                                                    <div class="flex justify-between">
                                                        <p class="mb-0 text-base font-bold" style="color: {{ $role->color }};">
                                                            {{ $role->name }}
                                                        </p>
                                                        @if($role->isRecruiting())
                                                        <p class="mb-0 rounded px-2 text-sm font-bold text-gray-200 bg-green-500 uppercase">
                                                            Open
                                                        </p>
                                                        @else
                                                        <p class="mb-0 rounded px-2 text-sm font-bold text-gray-200 bg-red-500 uppercase">
                                                            Closed
                                                        </p>
                                                        @endif
                                                    </div>
                                                    <p class="mb-0 mt-1 text-sm text-gray-400">
                                                        {{ $role->description }}
                                                    </p>
                                                </div>
                                            </a>
                                            @empty
                                            <span class="text-sm italic text-gray-300">No recruitable roles yet...</span>
                                            @endforelse
                                        </div>
                                        <div class="p-2 bg-gray-800 sm:flex sm:px-8">
                                            <div class="w-full">
                                                <a href="{{ route('global-requirements.show') }}" class="transition duration-200 p-3 flex justify-center items-center rounded-md text-base font-medium text-gray-300 hover:bg-gray-900">
                                                    <i class="flex-shrink-0 text-primary-dark fas fa-tasks fa-fw fa-lg"></i>
                                                    <span class="ml-3 text-sm">Global requirements</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('contact-messages.create') }}" class="text-base font-medium text-gray-200 hover:text-gray-300">
                                Contact
                            </a>
                        </nav>

                        <!-- Staff Hub button -->
                        <div class="hidden lg:flex items-center justify-end lg:flex-1 xl:w-0">
                            <a href="{{ route('staff.hub') }}" class="transition duration-200 ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-gray-700 font-bold bg-primary hover:text-gray-800 hover:bg-primary-dark">
                                Staff Hub
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu -->
                <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right lg:hidden z-10">
                    <div id="responsive-menu" class="hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-gray-800">
                        <div class="py-5">
                            <div class="flex items-center justify-between px-5">
                                <div>
                                    <img class="h-8 w-auto rounded-lg" src="{{ asset('img/ocsc_logo.png') }}" alt="Workflow">
                                </div>
                                <div class="-mr-2">
                                    <button id="responsive-button-close-nav" type="button" class="rounded-md p-2 inline-flex items-center justify-center text-gray-300 hover:text-gray-400 focus:outline-none">
                                        <span class="sr-only">Close menu</span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-6">
                                <nav class="grid">
                                    <!-- OCSC Event (responsive) -->
                                    <button id="ocsc-event-dropdown-responsive" type="button" class="my-4 px-5 flex justify-between items-center rounded-md font-medium text-base text-gray-200 hover:text-gray-300 focus:outline-none">
                                        <span>OCSC Event</span>
                                        <i class="fas fa-angle-down"></i>
                                    </button>
                                    <div id="ocsc-event-dropdown-content-responsive" class="w-full" style="display: none;">
                                        <div class="pb-4 shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                            <div class="relative grid gap-6 bg-gray-800 px-5">
                                                <a href="{{ route('homepage') }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                    <i class="flex-shrink-0 text-primary fas fa-home fa-fw fa-lg mt-2"></i>
                                                    <div class="w-full ml-4">
                                                        <p class="mb-0 text-base font-medium text-gray-200">
                                                            Home
                                                        </p>
                                                        <p class="mb-0 mt-1 text-sm text-gray-400">
                                                            Homepage of our website, and services we provide.
                                                        </p>
                                                    </div>
                                                </a>

                                                <a href="https://forum.ocsc.fr" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                    <i class="flex-shrink-0 text-primary fas fa-comments fa-fw fa-lg mt-2"></i>
                                                    <div class="w-full ml-4">
                                                        <p class="mb-0 text-base font-medium text-gray-200">
                                                            Forum
                                                        </p>
                                                        <p class="mb-0 mt-1 text-sm text-gray-400">
                                                            Forum of {{ config('app.name') }}.
                                                        </p>
                                                    </div>
                                                </a>

                                                <a href="https://truckersmp.com/vtc/39908" target="_blank" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                    <i class="flex-shrink-0 text-primary fas fa-truck fa-fw fa-lg mt-2"></i>
                                                    <div class="w-full ml-4">
                                                        <p class="mb-0 text-base font-medium text-gray-200">
                                                            OCSC VTC
                                                        </p>
                                                        <p class="mb-0 mt-1 text-sm text-gray-400">
                                                            Our official TruckersMP VTC page.
                                                        </p>
                                                    </div>
                                                </a>

                                                <a href="{{ route('news') }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                    <i class="flex-shrink-0 text-primary fas fa-newspaper fa-fw fa-lg mt-2"></i>
                                                    <div class="w-full ml-4">
                                                        <p class="mb-0 text-base font-medium text-gray-200">
                                                            News
                                                        </p>
                                                        <p class="mb-0 mt-1 text-sm text-gray-400">
                                                            General news regarding our group.
                                                        </p>
                                                    </div>
                                                </a>

                                                <a href="{{ route('partners') }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                    <i class="flex-shrink-0 text-primary fas fa-handshake fa-fw fa-lg mt-2"></i>
                                                    <div class="w-full ml-4">
                                                        <p class="mb-0 text-base font-medium text-gray-200">
                                                            Partnership
                                                        </p>
                                                        <p class="mb-0 mt-1 text-sm text-gray-400">
                                                            All of OCSC's partners. We are very proud to have them and we are looking forward to work with them.
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Convoys (responsive) -->
                                    <button id="convoys-dropdown-responsive" type="button" class="my-4 px-5 flex justify-between items-center rounded-md font-medium text-base text-gray-200 hover:text-gray-300 focus:outline-none">
                                        <span>Convoys</span>
                                        <i class="fas fa-angle-down"></i>
                                    </button>
                                    <div id="convoys-dropdown-content-responsive" class="w-full" style="display: none;">
                                        <div class="pb-4 shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                            <div class="relative grid gap-6 bg-gray-800 px-5">
                                                <a href="{{ route('convoys', ['date' => 'upcoming', 'sortByMeetupDate' => 'asc']) }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                    <i class="flex-shrink-0 text-primary fas fa-calendar-alt fa-fw fa-lg mt-2"></i>
                                                    <div class="w-full ml-4">
                                                        <p class="mb-0 text-base font-medium text-gray-200">
                                                            Upcoming Convoys
                                                        </p>
                                                        <p class="mb-0 mt-1 text-sm text-gray-400">
                                                            See our future convoys and events.
                                                        </p>
                                                    </div>
                                                </a>

                                                <a href="{{ route('convoy-rules.show') }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                    <i class="flex-shrink-0 text-primary fas fa-list-alt fa-fw fa-lg mt-2"></i>
                                                    <div class="w-full ml-4">
                                                        <p class="mb-0 text-base font-medium text-gray-200">
                                                            Convoy Rules
                                                        </p>
                                                        <p class="mb-0 mt-1 text-sm text-gray-400">
                                                            Understand our convoy rules so that everyone can have a safe, real, and enjoyable trucking experience.
                                                        </p>
                                                    </div>
                                                </a>

                                                <a href="{{ route('gallery') }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                    <i class="flex-shrink-0 text-primary fas fa-images fa-fw fa-lg mt-2"></i>
                                                    <div class="w-full ml-4">
                                                        <p class="mb-0 text-base font-medium text-gray-200">
                                                            Gallery
                                                        </p>
                                                        <p class="mb-0 mt-1 text-sm text-gray-400">
                                                            Photos and videos made by OCSC Event during our convoys and events. Take a look!
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Recruitment (responsive) -->
                                    <button id="recruitment-dropdown-responsive" type="button" class="my-4 px-5 flex justify-between items-center rounded-md font-medium text-base text-gray-200 hover:text-gray-300 focus:outline-none">
                                        <span>Recruitment</span>
                                        <i class="fas fa-angle-down"></i>
                                    </button>
                                    <div id="recruitment-dropdown-content-responsive" class="w-full" style="display: none;">
                                        <div class="pb-4 shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                            <div class="relative grid gap-6 bg-gray-800 px-5">
                                                @forelse($recruitableRoles->sortBy('order') as $role)
                                                    <a @if($role->isRecruiting()) href="{{ route('recruitments.show', $role->getOpenRecruitment()) }}" @endif class="@if(!$role->isRecruiting()) select-none @endif transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                        <!-- Heroicon name: outline/chart-bar -->
                                                        <i class="flex-shrink-0 text-primary fas fa-{{ $role->icon_name }} fa-fw fa-lg mt-2" style="color: {{ $role->color }};"></i>
                                                        <div class="w-full ml-4">
                                                            <div class="flex justify-between">
                                                                <p class="mb-0 text-base font-bold" style="color: {{ $role->color }};">
                                                                    {{ $role->name }}
                                                                </p>
                                                                <div>
                                                                    @if($role->isRecruiting())
                                                                        <p class="mb-0 rounded px-2 text-sm font-bold text-gray-200 bg-green-500 uppercase">
                                                                            Open
                                                                        </p>
                                                                    @else
                                                                        <p class="mb-0 rounded px-2 text-sm font-bold text-gray-200 bg-red-500 uppercase">
                                                                            Closed
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <p class="mb-0 mt-1 text-sm text-gray-400">
                                                                {{ $role->description }}
                                                            </p>
                                                        </div>
                                                    </a>
                                                @empty
                                                    <span class="text-sm italic text-gray-300">No recruitable roles yet...</span>
                                                @endforelse
                                            </div>
                                            <div class="p-2 bg-gray-800 sm:flex sm:px-8">
                                                <div class="w-full">
                                                    <a href="{{ route('global-requirements.show') }}" class="transition duration-200 p-3 flex justify-center items-center rounded-md text-base font-medium text-gray-300 hover:bg-gray-900">
                                                        <i class="flex-shrink-0 text-primary-dark fas fa-tasks fa-fw fa-lg"></i>
                                                        <span class="ml-3 text-sm">Global requirements</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contact (responsive) -->
                                    <a href="{{ route('contact-messages.create') }}" class="px-5 flex items-center rounded-md hover:bg-gray-800">
                                        <span class="my-6 text-base font-medium text-gray-200">
                                            Contact
                                        </span>
                                    </a>
                                </nav>
                            </div>
                        </div>

                        <div class="pb-6 px-5 space-y-6">
                            <a href="{{ route('staff.hub') }}" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-bold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                                Staff Hub
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Stream Bar -->
                <div class="bg-gray-900 text-gray-300">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6">

                        <!-- Twitch Stream status -->
                        <div>
                            <span class="block font-bold uppercase">
                                <i class="fab fa-twitch"></i>
                                <i id="twitch-dot" class="fas fa-circle"></i>
                                <span id="twitch-text"></span>
                            </span>
                            <a id="see-stream" role="button" tabindex="0" class="link" style="display: none;">
                                See the Stream <i class="fas fa-angle-down"></i>
                            </a>
                        </div>

                        <!-- Embed Twitch Stream -->
                        <div id="stream-box" class="py-10" style="display: none;">
                            <div id="twitch-iframe-box" class="aspect-w-16 aspect-h-9">
                                <p class="text-sm">Enable Functionality Cookies to see the stream.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main content -->
        <main class="text-gray-200">
            @yield("content")
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 py-20">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-3 gap-16 md:gap-20 text-gray-300 text-sm">

                    <!-- About Us -->
                    <div class="col-span-full md:col-span-1">
                        <h4 class="mt-0 mb-1 font-bold">About Us</h4>
                        <p class="mb-4 text-justify">
                            We offer a full range of services to help VTCs better manage their convoys.
                            These services range from the complete creation of a convoy with supervision by our standards of excellence services, to just supervision of your convoy, an essential asset when you want to see your projects succeed in a few weeks rather than a few months.
                            We can combine all our products and services to create an offer tailored to your convoy.
                        </p>
                    </div>

                    <!-- Logo -->
                    <div class="col-span-full md:col-span-1">
                        <img class="scroll-to-top cursor-pointer mx-auto" width="50%" src="{{ asset('img/ocsc_logo.png') }}" alt="">
                    </div>

                    <!-- Discord Server -->
                    <div class="col-span-full md:col-span-1">
                        <h4 class="mt-0 mb-1 font-bold">Our Discord server</h4>
                        <p class="mb-4 text-justify">
                            We have a Discord server which is the main place for us to be in touch with the community.
                            If you are not on the server yet, feel free to join us!
                        </p>
                        <a href="https://discord.gg/abB2wCm8Ed" target="_blank" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-bold text-gray-300 bg-discord hover:text-gray-300 hover:bg-discord-dark">
                            <i class="fab fa-discord mr-2"></i> Join our Discord server
                        </a>
                    </div>
                </div>

                <!-- Mentions & Legal -->
                <div class="text-center mt-16 text-gray-300 text-sm">
                    ©2021 by {{ config('app.name') }}. All rights reserved.
                    <div class="mt-2">
                        <a href="{{ route('legal-notice.show') }}" class="underline">Legal Notice</a>
                        <a href="{{ route('privacy-policy.show') }}" class="underline">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </footer>

        <script src="{{ asset('js/app.js') }}"></script>

        <script>
            $(function () {

                //Cookie Consent Management
                var cookieconsent = initCookieConsent();

                cookieconsent.run({
                    current_lang : 'en',
                    cookie_expiration: 182,
                    auto_language: true,
                    onAccept : function(){
                        if (cookieconsent.allowedCategory('functionality_cookies')) {
                            $('#twitch-iframe-box').append('<iframe src="https://player.twitch.tv/?channel={{ config('twitch.channel_name') }}&parent={{ request()->getHost() }}" allowfullscreen></iframe>');
                        } else {
                            $('#twitch-iframe-box iframe').remove();
                        }
                    },

                    languages : {
                        en : {
                            consent_modal : {
                                title :  "We use cookies",
                                description :  'We and selected partners use cookies or similar technologies as specified in the cookie policy (click on the Settings button to read it). By clicking on "Accept", you also confirm having read and accepted our Legal Notice: {{ route('legal-notice.show') }}.',
                                primary_btn: {
                                    text: 'Accept',
                                    role: 'accept_all'  //'accept_selected' or 'accept_all'
                                },
                                secondary_btn: {
                                    text : 'Settings',
                                    role : 'settings'   //'settings' or 'accept_necessary'
                                }
                            },
                            settings_modal : {
                                title : 'Cookie settings',
                                save_settings_btn : "Save settings",
                                accept_all_btn : "Accept all",
                                blocks : [
                                    {
                                        title : "Cookie Policy",
                                        description: "<iframe allowtransparency='true' src='{{ asset('cookie-policy.txt') }}' width='100%' style='background-color: #F3F4F6;'></iframe><p style='margin-top: 2em; font-weight: bold;'>Please refresh the page after updating the cookie preferences.</p>"
                                    },{
                                        title : "Necessary cookies",
                                        description: 'These trackers are used for activities that are strictly necessary to operate or deliver the service you requested from us and, therefore, do not require you to consent.',
                                        toggle : {
                                            value : 'necessary_cookies',
                                            enabled : true,
                                            readonly: true
                                        }
                                    },{
                                        title : "Functionality cookies",
                                        description: 'These trackers help us to provide a personalized user experience by improving the quality of your preference management options, and by enabling the interaction with external networks and platforms.',
                                        toggle : {
                                            value : 'functionality_cookies',
                                            enabled : false,
                                            readonly: false
                                        }
                                    },
                                    {
                                        title : "Analytical cookies",
                                        description: 'These cookies enable us and third-party services to collect aggregated data for statistical purposes on how our visitors use the website. These cookies do not contain personal information such as names and email addresses and are used to help us improve your user experience of the website.',
                                        toggle : {
                                            value : 'analytical_cookies',
                                            enabled : false,
                                            readonly: false
                                        }
                                    }
                                ]
                            }
                        }
                    }
                });

                $('#cookie-preferences-widget').on('mouseenter', function () {
                    $('#cookie-preferences-widget-label').show();
                }).on('mouseleave', function () {
                    $('#cookie-preferences-widget-label').hide();
                });

                //Flash notifications
                $('.alert').fadeIn(350);
                $('.alert').not('.alert-important').delay(5000).fadeOut(350);

                $('.alert-close').click(function () {
                    $('.alert').fadeOut(350);
                });

                //Twitch Stream
                function blinkTwitchStatus() {
                    $('#twitch-text').fadeOut(500).fadeIn(500);
                }

                $.ajax({
                    url: "{{ route('api.twitch.stream', config('twitch.channel_name')) }}"
                }).done(function(data) {
                    if (data['stream'] === null) {
                        $('#twitch-dot').addClass('text-red-500');
                        $('#twitch-text').html('Live offline');
                    } else {
                        $('#twitch-dot').addClass('text-green-500');
                        $('#twitch-text').html('Live online');

                        setInterval(blinkTwitchStatus, 1000);

                        $('#see-stream').show();
                        $('#see-stream').click(function () {
                            $('#stream-box').slideToggle();
                            $(this).children('i').eq(0).toggleClass('fa-angle-down fa-angle-up');
                        });
                    }
                });

                //Scroll to top
                $('.scroll-to-top').click(function () {
                    document.body.scrollTop = 0; // For Safari
                    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
                });

            });
        </script>

        @stack('scripts')
    </body>
</html>
