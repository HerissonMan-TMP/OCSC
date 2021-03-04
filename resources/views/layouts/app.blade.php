<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="{{ asset("css/app.css") }}">
        <script src="https://kit.fontawesome.com/6cbe367b1a.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <title>@yield("title") - {{ config("app.name") }}</title>
    </head>
    <body class="bg-gray-700">
        <header>
            <div class="relative bg-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6">
                    <div class="flex justify-between items-center py-6 lg:justify-start lg:space-x-10">
                        <div class="flex justify-start lg:w-0 lg:flex-1">
                            <a href="{{ route('homepage') }}">
                                <span class="sr-only">{{ config('app.name') }}</span>
                                <img class="max-h-16 hidden lg:block rounded-lg" src="{{ asset('img/ocsc_extended_logo.png') }}" alt="">
                                <img class="max-h-16 block lg:hidden rounded-lg" src="{{ asset('img/ocsc_logo.png') }}" alt="">
                            </a>
                        </div>
                        <div class="-mr-2 -my-2 lg:hidden">
                            <button id="responsive-button-open-nav" type="button" class="rounded-md p-2 inline-flex items-center justify-center text-gray-300 hover:text-gray-400 focus:outline-none" aria-expanded="false">
                                <span class="sr-only">Open menu</span>
                                <!-- Heroicon name: outline/menu -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                        <nav class="hidden lg:flex space-x-10">
                            <div id="ocsc-event" class="relative">
                                <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
                                <button id="ocsc-event-dropdown" type="button" class="text-gray-200 group rounded-md inline-flex items-center text-base font-medium hover:text-gray-300 focus:outline-none" aria-expanded="false">
                                    <span>OCSC Event</span>
                                    <!--
                                      Heroicon name: solid/chevron-down

                                      Item active: "text-gray-600", Item inactive: "text-gray-400"
                                    -->
                                    <svg class="text-gray-200 ml-2 h-5 w-5 group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!--
                                  'More' flyout menu, show/hide based on flyout menu state.

                                  Entering: "transition ease-out duration-200"
                                    From: "opacity-0 translate-y-1"
                                    To: "opacity-100 translate-y-0"
                                  Leaving: "transition ease-in duration-150"
                                    From: "opacity-100 translate-y-0"
                                    To: "opacity-0 translate-y-1"
                                -->
                                <div id="ocsc-event-dropdown-content" class="hidden absolute z-10 left-1/2 transform -translate-x-1/2 pt-3 px-2 w-screen max-w-md sm:px-0">
                                    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                        <div class="relative grid gap-6 bg-gray-700 px-5 py-6 sm:gap-8 sm:p-8">
                                            <a href="{{ route('homepage') }}" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <!-- Heroicon name: outline/calendar -->
                                                <i class="flex-shrink-0 text-primary fas fa-home fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="text-base font-medium text-gray-200">
                                                        Home
                                                    </p>
                                                    <p class="mt-1 text-sm text-gray-400">
                                                        Homepage of our website, and services we provide.
                                                    </p>
                                                </div>
                                            </a>

                                            <a href="#" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <!-- Heroicon name: outline/shield-check -->
                                                <i class="flex-shrink-0 text-primary fas fa-newspaper fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="text-base font-medium text-gray-200">
                                                        News
                                                    </p>
                                                    <p class="mt-1 text-sm text-gray-400">
                                                        General news regarding our group.
                                                    </p>
                                                </div>
                                            </a>

                                            <a href="#" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <!-- Heroicon name: outline/shield-check -->
                                                <i class="flex-shrink-0 text-primary fas fa-handshake fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="text-base font-medium text-gray-200">
                                                        Partnership
                                                    </p>
                                                    <p class="mt-1 text-sm text-gray-400">
                                                        All of OCSC's partners. We are very proud to have them and we are looking forward to work with them.
                                                    </p>
                                                </div>
                                            </a>

                                            <a href="#" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <!-- Heroicon name: outline/shield-check -->
                                                <i class="flex-shrink-0 text-primary fas fa-images fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="text-base font-medium text-gray-200">
                                                        Gallery
                                                    </p>
                                                    <p class="mt-1 text-sm text-gray-400">
                                                        Photos and videos made by OCSC Event during our convoys and events. Take a look!
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="convoys" class="relative">
                                <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
                                <button id="convoys-dropdown" type="button" class="text-gray-200 group rounded-md inline-flex items-center text-base font-medium hover:text-gray-300 focus:outline-none" aria-expanded="false">
                                    <span>Convoys</span>
                                    <!--
                                      Heroicon name: solid/chevron-down

                                      Item active: "text-gray-600", Item inactive: "text-gray-400"
                                    -->
                                    <svg class="text-gray-200 ml-2 h-5 w-5 group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!--
                                  'More' flyout menu, show/hide based on flyout menu state.

                                  Entering: "transition ease-out duration-200"
                                    From: "opacity-0 translate-y-1"
                                    To: "opacity-100 translate-y-0"
                                  Leaving: "transition ease-in duration-150"
                                    From: "opacity-100 translate-y-0"
                                    To: "opacity-0 translate-y-1"
                                -->
                                <div id="convoys-dropdown-content" class="hidden absolute z-10 left-1/2 transform -translate-x-1/2 pt-3 px-2 w-screen max-w-md sm:px-0">
                                    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                        <div class="relative grid gap-6 bg-gray-700 px-5 py-6 sm:gap-8 sm:p-8">
                                            <a href="#" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <!-- Heroicon name: outline/calendar -->
                                                <i class="flex-shrink-0 text-primary fas fa-calendar-alt fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="text-base font-medium text-gray-200">
                                                        Upcoming Convoys
                                                    </p>
                                                    <p class="mt-1 text-sm text-gray-400">
                                                        See our future convoys and events.
                                                    </p>
                                                </div>
                                            </a>

                                            <a href="#" class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <!-- Heroicon name: outline/shield-check -->
                                                <i class="flex-shrink-0 text-primary fas fa-list-alt fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <p class="text-base font-medium text-gray-200">
                                                        Convoy Rules
                                                    </p>
                                                    <p class="mt-1 text-sm text-gray-400">
                                                        Understand our convoy rules so that everyone can have a safe, real, and enjoyable trucking experience.
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="px-5 py-5 bg-gray-800 sm:px-8 sm:py-8">
                                            <div>
                                                <h3 class="text-sm tracking-wide font-medium text-gray-400 uppercase">
                                                    Convoy News
                                                </h3>
                                                <ul class="mt-4 space-y-4">
                                                    <li class="text-base truncate">
                                                        <a href="#" class="transition duration-200 font-medium text-gray-300 hover:text-gray-400 capitalize">
                                                            AT Convoy (23/02/2021) - Thank you for your attendance!
                                                        </a>
                                                    </li>

                                                    <li class="text-base truncate">
                                                        <a href="#" class="transition duration-200 font-medium text-gray-300 hover:text-gray-400 capitalize">
                                                            What's new in our convoy rules ?
                                                        </a>
                                                    </li>

                                                    <li class="text-base truncate">
                                                        <a href="#" class="transition duration-200 font-medium text-gray-300 hover:text-gray-400 capitalize">
                                                            Answer our OCSC Community Survey
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="mt-5 text-sm">
                                                <a href="#" class="transition duration-200 font-medium text-primary hover:text-primary-dark"> View all Convoy News <span aria-hidden="true">&rarr;</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="recruitment" class="relative">
                                <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
                                <button id="recruitment-dropdown" type="button" class="text-gray-200 group rounded-md inline-flex items-center text-base font-medium hover:text-gray-300 focus:outline-none" aria-expanded="false">
                                    <span>Recruitment</span>
                                    <!--
                                      Heroicon name: solid/chevron-down

                                      Item active: "text-gray-600", Item inactive: "text-gray-400"
                                    -->
                                    <svg class="text-gray-200 ml-2 h-5 w-5 group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!--
                                  'Solutions' flyout menu, show/hide based on flyout menu state.

                                  Entering: "transition ease-out duration-200"
                                    From: "opacity-0 translate-y-1"
                                    To: "opacity-100 translate-y-0"
                                  Leaving: "transition ease-in duration-150"
                                    From: "opacity-100 translate-y-0"
                                    To: "opacity-0 translate-y-1"
                                -->
                                <div id="recruitment-dropdown-content" class="hidden absolute z-10 -ml-4 pt-3 transform px-2 w-screen max-w-md sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2">
                                    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                        <div class="relative grid gap-6 bg-gray-700 px-5 py-6 sm:gap-8 sm:p-8">
                                            @foreach($recruitableRoles as $role)
                                            <a @if($role->recruitments->isNotEmpty()) href="{{ route('recruitments.show', $role->recruitments->first()) }}" @endif class="transition duration-200 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-800">
                                                <!-- Heroicon name: outline/chart-bar -->
                                                <i class="flex-shrink-0 text-primary fas fa-{{ $role->icon_name }} fa-fw fa-lg mt-2"></i>
                                                <div class="w-full ml-4">
                                                    <div class="flex justify-between">
                                                        <p class="text-base font-medium text-gray-200">
                                                            {{ $role->name }}
                                                        </p>
                                                        @if($role->recruitments->isNotEmpty())
                                                        <p class="rounded px-2 text-sm font-bold text-gray-200 bg-green-500 uppercase">
                                                            Open
                                                        </p>
                                                        @else
                                                        <p class="rounded px-2 text-sm font-bold text-gray-200 bg-red-500 uppercase">
                                                            Closed
                                                        </p>
                                                        @endif
                                                    </div>
                                                    <p class="mt-1 text-sm text-gray-400">
                                                        {{ $role->description }}
                                                    </p>
                                                </div>
                                            </a>
                                            @endforeach
                                        </div>
                                        <div class="px-5 py-5 bg-gray-800 space-y-6 sm:flex sm:space-y-0 sm:space-x-10 sm:px-8">
                                            <div class="flow-root">
                                                <a href="#" class="transition duration-200 -m-3 p-3 flex items-center rounded-md text-base font-medium text-gray-300 hover:bg-gray-900">
                                                    <!-- Heroicon name: outline/play -->
                                                    <i class="flex-shrink-0 text-primary-dark fas fa-tasks fa-fw fa-lg"></i>
                                                    <span class="ml-3 text-sm">Global requirements</span>
                                                </a>
                                            </div>

                                            <div class="flow-root">
                                                <a href="#" class="transition duration-200 -m-3 p-3 flex items-center rounded-md text-base font-medium text-gray-300 hover:bg-gray-900">
                                                    <!-- Heroicon name: outline/phone -->
                                                    <i class="flex-shrink-0 text-primary-dark fas fa-cog fa-fw fa-lg"></i>
                                                    <span class="ml-3 text-sm">Recruitment process</span>
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
                        <div class="hidden lg:flex items-center justify-end lg:flex-1 xl:w-0">
                            <a href="{{ route('staff.hub') }}" class="transition duration-200 ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-gray-700 font-bold bg-primary hover:text-gray-800 hover:bg-primary-dark">
                                Staff Hub
                            </a>
                        </div>
                    </div>
                </div>

                <!--
                  Mobile menu, show/hide based on mobile menu state.

                  Entering: "duration-200 ease-out"
                    From: "opacity-0 scale-95"
                    To: "opacity-100 scale-100"
                  Leaving: "duration-100 ease-in"
                    From: "opacity-100 scale-100"
                    To: "opacity-0 scale-95"
                -->
                <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right lg:hidden">
                    <div id="responsive-menu" class="hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-gray-700 divide-y divide-gray-200">
                        <div class="pt-5 pb-6 px-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <img class="h-8 w-auto rounded-lg" src="{{ asset('img/ocsc_logo.png') }}" alt="Workflow">
                                </div>
                                <div class="-mr-2">
                                    <button id="responsive-button-close-nav" type="button" class="rounded-md p-2 inline-flex items-center justify-center text-gray-300 hover:text-gray-400 focus:outline-none">
                                        <span class="sr-only">Close menu</span>
                                        <!-- Heroicon name: outline/x -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-6">
                                <nav class="grid gap-y-8">
                                    <a href="#" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-800">
                                        <!-- Heroicon name: outline/chart-bar -->
                                        <i class="flex-shrink-0 text-primary fas fa-home fa-fw fa-lg"></i>
                                        <span class="ml-3 text-base font-medium text-gray-200">
                                            Home
                                        </span>
                                    </a>

                                    <a href="#" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-800">
                                        <!-- Heroicon name: outline/cursor-click -->
                                        <i class="flex-shrink-0 text-primary fas fa-newspaper fa-fw fa-lg"></i>
                                        <span class="ml-3 text-base font-medium text-gray-200">
                                            News
                                        </span>
                                    </a>

                                    <a href="#" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-800">
                                        <!-- Heroicon name: outline/shield-check -->
                                        <i class="flex-shrink-0 text-primary fas fa-handshake fa-fw fa-lg"></i>
                                        <span class="ml-3 text-base font-medium text-gray-200">
                                            Partnership
                                        </span>
                                    </a>

                                    <a href="#" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-800">
                                        <!-- Heroicon name: outline/view-grid -->
                                        <i class="flex-shrink-0 text-primary fas fa-calendar-alt fa-fw fa-lg"></i>
                                        <span class="ml-3 text-base font-medium text-gray-200">
                                            Upcoming Convoys
                                        </span>
                                    </a>

                                    <a href="#" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-800">
                                        <!-- Heroicon name: outline/refresh -->
                                        <i class="flex-shrink-0 text-primary fas fa-briefcase fa-fw fa-lg"></i>
                                        <span class="ml-3 text-base font-medium text-gray-200">
                                            Recruitment
                                        </span>
                                    </a>
                                </nav>
                            </div>
                        </div>
                        <div class="py-6 px-5 space-y-6">
                            <div class="grid grid-cols-2 gap-y-4 gap-x-8">
                                <a href="#" class="text-base font-medium text-gray-200 hover:text-gray-300">
                                    Convoy Rules
                                </a>

                                <a href="#" class="text-base font-medium text-gray-200 hover:text-gray-300">
                                    Convoy News
                                </a>

                                <a href="#" class="text-base font-medium text-gray-200 hover:text-gray-300">
                                    Gallery
                                </a>

                                <a href="#" class="text-base font-medium text-gray-200 hover:text-gray-300">
                                    Contact
                                </a>
                            </div>
                            <div>
                                <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-bold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                                    Staff Hub
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="h-screen text-gray-200">
            @hasSection('breadcrumb')
            <div class="w-full bg-gray-800 py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 flex justify-between">
                    <h2 class="font-light text-2xl">@yield('breadcrumb')</h2>
                    @hasSection('breadcrumb-additional-content')
                    <div>
                        @yield('breadcrumb-additional-content')
                    </div>
                    @endif
                </div>
            </div>
            @endif

            @yield("content")
        </main>

        <footer>

        </footer>

        <script src="{{ asset('js/app.js') }}"></script>

        @stack('scripts')
    </body>
</html>
