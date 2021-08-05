@extends('layouts.app')

@section('content')
    <hr class="m-0">

    <div class="grid grid-cols-10">
        <div class="col-span-full md:col-span-2 hidden md:block">
            <div class="bg-gray-900 py-10 h-full">
                <div class="pb-10 text-center">
                    <div class="font-bold">
                        {{ $authUser->name }}
                    </div>
                    <div class="py-3">
                        @foreach($authUser->roles as $role)
                            <div class="inline-block px-2 py-1 rounded-md text-sm font-bold" style="background-color: {{ $role->color }}; color: {{ $role->contrast_color }}">
                                <i class="{{ $role->icon_name }} fa-fw"></i>
                                {{ $role->name }}
                            </div>
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
                            <i class="fas fa-truck fa-fw"></i> Convoys
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
                            @can('manage-convoys')
                                <a href="{{ route('staff.convoys.create') }}" class="transition duration-200 hover:text-primary">Post a new convoy</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Post a new convoy</a>
                            @endcan
                        </div>
                        <div class="py-1">
                            @can('edit-convoy-rules')
                                <a href="{{ route('staff.convoy-rules.create') }}" class="transition duration-200 hover:text-primary">Convoy rules</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Convoy rules</a>
                            @endcan
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
                            @can('manage-news-articles')
                                <a href="{{ route('staff.articles.create') }}" class="transition duration-200 hover:text-primary">Post a new article</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Post a new article</a>
                            @endcan
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
                            <a href="{{ route('staff.partners.index') }}" class="transition duration-200 hover:text-primary">All partners</a>
                        </div>
                        <div class="py-1">
                            @can('manage-partners')
                                <a href="{{ route('staff.partners.create') }}" class="transition duration-200 hover:text-primary">Add a new partner</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Add a new partner</a>
                            @endcan
                        </div>
                        <div class="py-1">
                            @can('edit-partnership-conditions-and-info')
                                <a href="{{ route('staff.partnership-conditions.create') }}" class="transition duration-200 hover:text-primary">Edit partnership conditions & info</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Edit partnership conditions & info</a>
                            @endcan
                        </div>
                        <div class="py-1">
                            <a href="{{ route('staff.partner-categories.index') }}" class="transition duration-200 hover:text-primary">Partner categories</a>
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
                            @can('add-pictures-to-gallery')
                                <a href="{{ route('staff.pictures.create') }}" class="transition duration-200 hover:text-primary">Upload a new picture</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Upload a new picture</a>
                            @endcan
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
                            @can('manage-downloads')
                                <a href="{{ route('staff.downloads.create') }}" class="transition duration-200 hover:text-primary">Add a new download</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Add a new download</a>
                            @endcan
                        </div>
                    </div>

                    <div class="staff-menu-item staff-menu-dropdown">
                        <span>
                            <i class="fas fa-book fa-fw"></i> Guides
                        </span>
                        <span>
                            <i class="fas fa-chevron-down fa-fw text-sm"></i>
                        </span>
                    </div>
                    <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                        <div class="py-1">
                            <a href="{{ route('staff.guides.index') }}" class="transition duration-200 hover:text-primary">All available guides</a>
                        </div>
                        <div class="py-1">
                            @can('manage-guides')
                                <a href="{{ route('staff.guides.create') }}" class="transition duration-200 hover:text-primary">Create a new guide</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Create a new guide</a>
                            @endcan
                        </div>
                    </div>

                    @can('manage-contact-messages')
                        <a class="staff-menu-item" href="{{ route('staff.contact-messages.index') }}">
                            <span>
                                <i class="fas fa-envelope fa-fw"></i> Contact Messages
                                @if($contactMessagesCount > 0)
                                    <span class="ml-2 p-1 bg-red-500 rounded-full text-xs text-gray-100 font-bold w-6 h-6 inline-flex justify-center">{{ $contactMessagesCount }}</span>
                                @endif
                            </span>
                        </a>
                    @else
                        <a class="staff-menu-item-disabled">
                            <span>
                                <i class="fas fa-envelope fa-fw"></i> Contact Messages
                            </span>
                        </a>
                    @endcan

                    <div class="staff-menu-item staff-menu-dropdown">
                        <span>
                            <i class="fas fa-briefcase fa-fw"></i> Recruitments
                            @if($applicationsCount > 0)
                                <span class="ml-2 p-1 bg-red-500 rounded-full text-xs text-gray-100 font-bold w-6 h-6 inline-flex justify-center">{{ $applicationsCount }}</span>
                            @endif
                        </span>
                        <span>
                            <i class="fas fa-chevron-down fa-fw text-sm"></i>
                        </span>
                    </div>
                    <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                        <div class="py-1">
                            @canany(['manage-recruitments', 'manage-applications'])
                                <a href="{{ route('staff.recruitments.index') }}" class="transition duration-200 hover:text-primary">All recruitment sessions</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">All recruitment sessions</a>
                            @endcanany
                        </div>
                        <div class="py-1">
                            @can('manage-recruitments')
                                <a href="{{ route('staff.recruitments.create') }}" class="transition duration-200 hover:text-primary">Create a new recruitment session</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Create a new recruitment session</a>
                            @endcan
                        </div>
                        <div class="py-1">
                            @can('edit-global-requirements')
                                <a href="{{ route('staff.global-requirements.create') }}" class="transition duration-200 hover:text-primary">Global requirements</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Global requirements</a>
                            @endcan
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
                            @can('add-staff-members')
                                <a href="{{ route('staff.users.create') }}" class="transition duration-200 hover:text-primary">Add a new staff member</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Add a new staff member</a>
                            @endcan
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
                            @can('see-activity')
                            <a href="{{ route('staff.website-settings.activity') }}" class="transition duration-200 hover:text-primary">Activity</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Activity</a>
                            @endcan
                        </div>
                        <div class="py-1">
                            @can('edit-legal-notice')
                                <a href="{{ route('staff.website-settings.legal-notice.create') }}" class="transition duration-200 hover:text-primary">Legal Notice</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Legal Notice</a>
                            @endcan
                        </div>
                        <div class="py-1">
                            @can('edit-privacy-policy')
                                <a href="{{ route('staff.website-settings.privacy-policy.create') }}" class="transition duration-200 hover:text-primary">Privacy Policy</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Privacy Policy</a>
                            @endcan
                        </div>
                        <div class="py-1">
                            @can('see-statistics')
                                <a href="{{ route('staff.website-settings.statistics') }}" class="transition duration-200 hover:text-primary">Statistics</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Statistics</a>
                            @endcan
                        </div>
                        <div class="py-1">
                            @can('see-error-logs')
                                <a href="{{ route('staff.website-settings.error-logs') }}" class="transition duration-200 hover:text-primary">Error logs</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Error logs</a>
                            @endcan
                        </div>
                        <div class="py-1">
                            @can('toggle-maintenance-mode')
                                <a href="{{ route('staff.website-settings.maintenance-mode') }}" class="transition duration-200 hover:text-primary">Maintenance Mode</a>
                            @else
                                <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Maintenance Mode</a>
                            @endcan
                        </div>
                    </div>

                    <div class="px-10">
                        <hr>
                    </div>

                    @can('has-admin-rights')
                        <a class="staff-menu-item" href="https://web41.lws-hosting.com/cpanel" target="_blank">
                            <span>
                                <i class="fab fa-cpanel fa-fw"></i> CPanel
                            </span>
                        </a>
                    @else
                        <a class="staff-menu-item-disabled">
                            <span>
                                <i class="fab fa-cpanel fa-fw"></i> CPanel
                            </span>
                        </a>
                    @endcan

                    @can('has-admin-rights')
                        <a class="staff-menu-item" href="https://dash.cloudflare.com/login" target="_blank">
                            <span>
                                <i class="fab fa-cloudflare fa-fw"></i> Cloudflare
                            </span>
                        </a>
                    @else
                        <a class="staff-menu-item-disabled">
                            <span>
                                <i class="fab fa-cloudflare fa-fw"></i> Cloudflare
                            </span>
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="col-span-full md:col-span-8 bg-gray-900">
            <div class="p-10">
                @yield('content-staff')
            </div>
        </div>
    </div>

    <!-- Responsive Staff menu -->
    <div id="responsive-staff-menu" class="fixed top-40 bottom-20 left-5 right-5 overflow-y-scroll z-50 bg-gray-900 border border-gray-800 rounded-md" style="display: none;">
        <div class="py-10 h-full">
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
                            <i class="fas fa-truck fa-fw"></i> Convoys
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
                        @can('manage-convoys')
                            <a href="{{ route('staff.convoys.create') }}" class="transition duration-200 hover:text-primary">Post a new convoy</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Post a new convoy</a>
                        @endcan
                    </div>
                    <div class="py-1">
                        @can('edit-convoy-rules')
                            <a href="{{ route('staff.convoy-rules.create') }}" class="transition duration-200 hover:text-primary">Convoy rules</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Convoy rules</a>
                        @endcan
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
                        @can('manage-news-articles')
                            <a href="{{ route('staff.articles.create') }}" class="transition duration-200 hover:text-primary">Post a new article</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Post a new article</a>
                        @endcan
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
                        <a href="{{ route('staff.partners.index') }}" class="transition duration-200 hover:text-primary">All partners</a>
                    </div>
                    <div class="py-1">
                        @can('manage-partners')
                            <a href="{{ route('staff.partners.create') }}" class="transition duration-200 hover:text-primary">Add a new partner</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Add a new partner</a>
                        @endcan
                    </div>
                    <div class="py-1">
                        @can('edit-partnership-conditions-and-info')
                            <a href="{{ route('staff.partnership-conditions.create') }}" class="transition duration-200 hover:text-primary">Edit partnership conditions & info</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Edit partnership conditions & info</a>
                        @endcan
                    </div>
                    <div class="py-1">
                        <a href="{{ route('staff.partner-categories.index') }}" class="transition duration-200 hover:text-primary">Partner categories</a>
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
                        @can('add-pictures-to-gallery')
                            <a href="{{ route('staff.pictures.create') }}" class="transition duration-200 hover:text-primary">Upload a new picture</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Upload a new picture</a>
                        @endcan
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
                        @can('manage-downloads')
                            <a href="{{ route('staff.downloads.create') }}" class="transition duration-200 hover:text-primary">Add a new download</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Add a new download</a>
                        @endcan
                    </div>
                </div>

                <div class="staff-menu-item staff-menu-dropdown">
                        <span>
                            <i class="fas fa-book fa-fw"></i> Guides
                         </span>
                        <span>
                            <i class="fas fa-chevron-down fa-fw text-sm"></i>
                        </span>
                </div>
                <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                    <div class="py-1">
                        <a href="{{ route('staff.guides.index') }}" class="transition duration-200 hover:text-primary">All available guides</a>
                    </div>
                    <div class="py-1">
                        @can('manage-guides')
                            <a href="{{ route('staff.guides.create') }}" class="transition duration-200 hover:text-primary">Create a new guide</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Create a new guide</a>
                        @endcan
                    </div>
                </div>

                @can('manage-contact-messages')
                    <a class="staff-menu-item" href="{{ route('staff.contact-messages.index') }}">
                        <span>
                            <i class="fas fa-envelope fa-fw"></i> Contact Messages
                            @if($contactMessagesCount > 0)
                                <span class="ml-2 p-1 bg-red-500 rounded-full text-xs text-gray-100 font-bold w-6 h-6 inline-flex justify-center">{{ $contactMessagesCount }}</span>
                            @endif
                        </span>
                    </a>
                @else
                    <a class="staff-menu-item-disabled">
                        <span>
                            <i class="fas fa-envelope fa-fw"></i> Contact Messages
                        </span>
                    </a>
                @endcan

                <div class="staff-menu-item staff-menu-dropdown">
                    <span>
                        <i class="fas fa-briefcase fa-fw"></i> Recruitments
                        @if($applicationsCount > 0)
                            <span class="ml-2 p-1 bg-red-500 rounded-full text-xs text-gray-100 font-bold w-6 h-6 inline-flex justify-center">{{ $applicationsCount }}</span>
                        @endif
                    </span>
                    <span>
                        <i class="fas fa-chevron-down fa-fw text-sm"></i>
                    </span>
                </div>
                <div class="staff-menu-dropdown-items pl-20 hidden text-gray-400">
                    <div class="py-1">
                        @canany(['manage-recruitments', 'manage-applications'])
                            <a href="{{ route('staff.recruitments.index') }}" class="transition duration-200 hover:text-primary">All recruitment sessions</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">All recruitment sessions</a>
                        @endcanany
                    </div>
                    <div class="py-1">
                        @can('manage-recruitments')
                            <a href="{{ route('staff.recruitments.create') }}" class="transition duration-200 hover:text-primary">Create a new recruitment session</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Create a new recruitment session</a>
                        @endcan
                    </div>
                    <div class="py-1">
                        @can('edit-global-requirements')
                            <a href="{{ route('staff.global-requirements.create') }}" class="transition duration-200 hover:text-primary">Global requirements</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Global requirements</a>
                        @endcan
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
                        @can('add-staff-members')
                            <a href="{{ route('staff.users.create') }}" class="transition duration-200 hover:text-primary">Add a new staff member</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Add a new staff member</a>
                        @endcan
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
                        @can('see-activity')
                            <a href="{{ route('staff.website-settings.activity') }}" class="transition duration-200 hover:text-primary">Activity</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Activity</a>
                        @endcan
                    </div>
                    <div class="py-1">
                        @can('edit-legal-notice')
                            <a href="{{ route('staff.website-settings.legal-notice.create') }}" class="transition duration-200 hover:text-primary">Legal Notice</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Legal Notice</a>
                        @endcan
                    </div>
                    <div class="py-1">
                        @can('edit-privacy-policy')
                            <a href="{{ route('staff.website-settings.privacy-policy.create') }}" class="transition duration-200 hover:text-primary">Privacy Policy</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Privacy Policy</a>
                        @endcan
                    </div>
                    <div class="py-1">
                        @can('see-statistics')
                            <a href="{{ route('staff.website-settings.statistics') }}" class="transition duration-200 hover:text-primary">Statistics</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Statistics</a>
                        @endcan
                    </div>
                    <div class="py-1">
                        @can('see-error-logs')
                            <a href="{{ route('staff.website-settings.error-logs') }}" class="transition duration-200 hover:text-primary">Error logs</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Error logs</a>
                        @endcan
                    </div>
                    <div class="py-1">
                        @can('toggle-maintenance-mode')
                            <a href="{{ route('staff.website-settings.maintenance-mode') }}" class="transition duration-200 hover:text-primary">Maintenance Mode</a>
                        @else
                            <a class="opacity-40 select-none cursor-not-allowed hover:text-primary">Maintenance Mode</a>
                        @endcan
                    </div>
                </div>

                <hr>

                @can('has-admin-rights')
                    <a class="staff-menu-item" href="https://web41.lws-hosting.com/cpanel" target="_blank">
                        <span>
                            <i class="fab fa-cpanel fa-fw"></i> CPanel
                        </span>
                    </a>
                @else
                    <a class="staff-menu-item-disabled">
                        <span>
                            <i class="fab fa-cpanel fa-fw"></i> CPanel
                        </span>
                    </a>
                @endcan

                @can('has-admin-rights')
                    <a class="staff-menu-item" href="https://dash.cloudflare.com/login" target="_blank">
                        <span>
                            <i class="fab fa-cloudflare fa-fw"></i> Cloudflare
                        </span>
                    </a>
                @else
                    <a class="staff-menu-item-disabled">
                        <span>
                            <i class="fab fa-cloudflare fa-fw"></i> Cloudflare
                        </span>
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="fixed bottom-5 right-5 z-50 block md:hidden">
        <button id="responsive-staff-menu-button" class="rounded-full h-14 w-14 bg-primary text-gray-700 focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </div>
@endsection

@push('scripts')
    <script>
        $('.staff-menu-dropdown').click(function () {
            $(this).next('.staff-menu-dropdown-items').slideToggle();
            $(this).children('span').eq(1).find('i').toggleClass('fa-chevron-down fa-chevron-up');
        });

        $('#responsive-staff-menu-button').click(function () {
            $('#responsive-staff-menu').fadeToggle(200);
        });
    </script>
@endpush
