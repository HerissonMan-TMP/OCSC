@extends('layouts.app')

@section('content')
    <hr class="m-0">

    <div class="grid grid-cols-10">
        <div class="col-span-2">
            <div class="bg-gray-900 py-10 h-full">
                <div class="pb-10 text-center">
                    <div class="font-bold">
                        {{ $authUser->name }}
                    </div>
                    <div class="py-3">
                        @foreach($authUser->roles as $role)
                            <div class="inline-block px-2 py-1 rounded-md text-sm font-bold" style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }}">{{ $role->name }}</div>
                        @endforeach
                    </div>
                    <div class="text-sm">
                        <a href="{{ route('staff.profile-settings') }}" class="underline">Profile settings</a>
                        |
                        <form action="{{ route('staff.logout') }}" method="POST" class="inline">
                            @csrf

                            <button type="submit" class="link underline">Log out</button>
                        </form>
                    </div>
                </div>

                <div id="staff-menu">
                    <a class="staff-menu-item" href="{{ route('staff.hub') }}">
                        <span>
                            <i class="fas fa-home fa-fw"></i> Hub
                        </span>
                    </a>

                    <div class="staff-menu-item staff-menu-dropdown">
                        <span>
                            <i class="fas fa-truck-moving fa-fw"></i> Convoys
                        </span>
                        <span>
                            <i class="fas fa-chevron-down fa-fw text-sm"></i>
                        </span>
                    </div>
                    <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                        <div class="py-1">
                            <a href="{{ route('staff.convoys.index') }}" class="transition duration-200 hover:text-primary">All convoys</a>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.convoys.create') }}" class="transition duration-200 hover:text-primary">Post a new convoy</a>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.convoy-rules.create') }}" class="transition duration-200 hover:text-primary">Convoy rules</a>
                        </div>
                    </div>

                    <div class="staff-menu-item staff-menu-dropdown">
                        <span>
                            <i class="fas fa-newspaper fa-fw"></i> News Articles
                        </span>
                        <span>
                            <i class="fas fa-chevron-down fa-fw text-sm"></i>
                        </span>
                    </div>
                    <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                        <div class="py-1">
                            <a href="{{ route('staff.articles.index') }}" class="transition duration-200 hover:text-primary">All news articles</a>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.articles.create') }}" class="transition duration-200 hover:text-primary">Post a new article</a>
                        </div>
                    </div>

                    <div class="staff-menu-item staff-menu-dropdown">
                        <span>
                            <i class="fas fa-handshake fa-fw"></i> Partnership
                        </span>
                        <span>
                            <i class="fas fa-chevron-down fa-fw text-sm"></i>
                        </span>
                    </div>
                    <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                        <div class="py-1">
                            <a href="" class="transition duration-200 hover:text-primary">All partners</a>
                        </div>
                        <div class="py-1">
                            <a href="" class="transition duration-200 hover:text-primary">Add a new partner</a>
                        </div>
                    </div>

                    <div class="staff-menu-item staff-menu-dropdown">
                        <span>
                            <i class="fas fa-images fa-fw"></i> Gallery
                        </span>
                        <span>
                            <i class="fas fa-chevron-down fa-fw text-sm"></i>
                        </span>
                    </div>
                    <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                        <div class="py-1">
                            <a href="{{ route('staff.pictures.index') }}" class="transition duration-200 hover:text-primary">All pictures</a>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.pictures.create') }}" class="transition duration-200 hover:text-primary">Upload a new picture</a>
                        </div>
                    </div>

                    <div class="staff-menu-item staff-menu-dropdown">
                        <span>
                            <i class="fas fa-download fa-fw"></i> Downloads
                        </span>
                        <span>
                            <i class="fas fa-chevron-down fa-fw text-sm"></i>
                        </span>
                    </div>
                    <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                        <div class="py-1">
                            <a href="{{ route('staff.downloads.index') }}" class="transition duration-200 hover:text-primary">All available downloads</a>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.downloads.create') }}" class="transition duration-200 hover:text-primary">Add a new download</a>
                        </div>
                    </div>

                    <a class="staff-menu-item" href="{{ route('staff.contact-messages.index') }}">
                        <span>
                            <i class="fas fa-envelope fa-fw"></i> Contact Messages
                        </span>
                    </a>

                    <a class="staff-menu-item" href="{{ route('staff.contact-messages.index') }}">
                        <span>
                            <i class="fas fa-paper-plane fa-fw"></i> Subscribers
                        </span>
                    </a>

                    <div class="staff-menu-item staff-menu-dropdown">
                        <span>
                            <i class="fas fa-briefcase fa-fw"></i> Recruitments
                        </span>
                        <span>
                            <i class="fas fa-chevron-down fa-fw text-sm"></i>
                        </span>
                    </div>
                    <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                        <div class="py-1">
                            <a href="{{ route('staff.recruitments.index') }}" class="transition duration-200 hover:text-primary">All recruitment sessions</a>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.recruitments.create') }}" class="transition duration-200 hover:text-primary">Create a new recruitment session</a>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.global-requirements.create') }}" class="transition duration-200 hover:text-primary">Global requirements</a>
                        </div>
                    </div>

                    <div class="staff-menu-item staff-menu-dropdown">
                        <span>
                            <i class="fas fa-users fa-fw"></i> Staff Members
                        </span>
                        <span>
                            <i class="fas fa-chevron-down fa-fw text-sm"></i>
                        </span>
                    </div>
                    <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                        <div class="py-1">
                            <a href="{{ route('staff.users.index') }}" class="transition duration-200 hover:text-primary">All staff members</a>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.users.create') }}" class="transition duration-200 hover:text-primary">Add a new staff member</a>
                        </div>
                    </div>

                    <a class="staff-menu-item" href="{{ route('staff.roles.index') }}">
                        <span>
                            <i class="fas fa-shield-alt fa-fw"></i> Roles & Permissions
                        </span>
                    </a>

                    <div class="staff-menu-item staff-menu-dropdown">
                        <span>
                            <i class="fas fa-globe fa-fw"></i> Website Settings
                        </span>
                        <span>
                            <i class="fas fa-chevron-down fa-fw text-sm"></i>
                        </span>
                    </div>
                    <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                        <div class="py-1">
                            <a href="{{ route('staff.website-settings.legal-notice.create') }}" class="transition duration-200 hover:text-primary">Legal Notice</a>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.website-settings.privacy-policy.create') }}" class="transition duration-200 hover:text-primary">Privacy Policy</a>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.website-settings.statistics') }}" class="transition duration-200 hover:text-primary">Statistics</a>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.website-settings.maintenance-mode') }}" class="transition duration-200 hover:text-primary">Maintenance Mode</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-8 bg-gray-900">
            <div class="p-10">
                @yield('content-staff')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.staff-menu-dropdown').click(function () {
            $(this).next('.staff-menu-dropdown-items').slideToggle();
            $(this).children('span').eq(1).find('i').toggleClass('fa-chevron-down fa-chevron-up');
        });
    </script>
@endpush
