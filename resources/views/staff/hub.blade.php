@extends('layouts.staff')

@section('title', 'Staff Hub')

@section('breadcrumb')
Staff Hub
@endsection

@section('content-staff')
<div class="mt-6 px-4 py-5 sm:p-6 bg-gray-800 rounded-md shadow overflow-hidden grid grid-cols-6 gap-4">
    <a href="{{ route('staff.news-management') }}" class="col-span-full md:col-span-3">
        <div class="p-8 text-gray-300 bg-gray-900 hover:bg-gray rounded-md text-center font-light tracking-wide">
            <div class="mb-5">
                <i class="flex-shrink-0 text-gray-300 fas fa-newspaper fa-fw fa-5x"></i>
            </div>
            News Management
        </div>
    </a>
    <a href="{{ route('staff.convoy-management') }}" class="col-span-full md:col-span-3">
        <div class="p-8 text-gray-300 bg-gray-900 hover:bg-gray rounded-md text-center font-light tracking-wide">
            <div class="mb-5">
                <i class="flex-shrink-0 text-gray-300 fas fa-truck-moving fa-fw fa-5x"></i>
            </div>
            Convoy Management
        </div>
    </a>
    <a href="{{ route('staff.partnership-management') }}" class="col-span-full md:col-span-2">
        <div class="p-8 text-gray-300 bg-gray-900 hover:bg-gray rounded-md text-center font-light tracking-wide">
            <div class="mb-5">
                <i class="flex-shrink-0 text-gray-300 fas fa-handshake fa-fw fa-5x"></i>
            </div>
            Partnership Management
        </div>
    </a>
    <a href="{{ route('staff.gallery-management') }}" class="col-span-full md:col-span-2">
        <div class="p-8 text-gray-300 bg-gray-900 hover:bg-gray rounded-md text-center font-light tracking-wide">
            <div class="mb-5">
                <i class="flex-shrink-0 text-gray-300 fas fa-images fa-fw fa-5x"></i>
            </div>
            Gallery Management
        </div>
    </a>
    <a href="{{ route('staff.contact-messages.index') }}" class="col-span-full md:col-span-2">
        <div class="p-8 text-gray-300 bg-gray-900 hover:bg-gray rounded-md text-center font-light tracking-wide">
            <div class="mb-5">
                <i class="flex-shrink-0 text-gray-300 fas fa-envelope fa-fw fa-5x"></i>
            </div>
            Contact Messages
        </div>
    </a>
    <a href="{{ route('staff.role-permission-management') }}" class="col-span-full md:col-span-2">
        <div class="p-8 text-gray-300 bg-gray-900 hover:bg-gray rounded-md text-center font-light tracking-wide">
            <div class="mb-5">
                <i class="flex-shrink-0 text-gray-300 fas fa-shield-alt fa-fw fa-5x"></i>
            </div>
            Role & Permission Management
        </div>
    </a>
    <a href="{{ route('staff.recruitment-management') }}" class="col-span-full md:col-span-2">
        <div class="p-8 text-gray-300 bg-gray-900 hover:bg-gray rounded-md text-center font-light tracking-wide">
            <div class="mb-5">
                <i class="flex-shrink-0 text-gray-300 fas fa-briefcase fa-fw fa-5x"></i>
            </div>
            Recruitment Management
        </div>
    </a>
    <a href="{{ route('staff.staff-members-management') }}" class="col-span-full md:col-span-2">
        <div class="p-8 text-gray-300 bg-gray-900 hover:bg-gray rounded-md text-center font-light tracking-wide">
            <div class="mb-5">
                <i class="flex-shrink-0 text-gray-300 fas fa-users fa-fw fa-5x"></i>
            </div>
            Staff Members Management
        </div>
    </a>
</div>
@endsection
