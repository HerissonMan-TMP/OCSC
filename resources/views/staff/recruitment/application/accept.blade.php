@extends('layouts.staff')

@section('title', 'Recruitment Management')

@section('breadcrumb', "Staff - Accept Application $application->id")

@section('content-staff')
    <form action="{{ route('staff.users.store', $application) }}" method="POST">
        @csrf
        <div class="mt-6 px-4 py-5 sm:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Recruitment #{{ $recruitment->id }} - Accept application #{{ $application->id }} for <span style="color: {{ $recruitment->role->color }}">{{ $recruitment->role->name }}</span></h3>
                <i style="color: {{ $recruitment->role->color }}" class="flex-shrink-0 text-primary fas fa-{{ $recruitment->role->icon_name }} fa-fw fa-2x"></i>
            </div>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full">
                    <label for="name" class="block text-sm font-medium text-gray-300">Name <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="name" id="name" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" placeholder="Username of the new account" required>
                </div>

                <input type="hidden" name="password" value="{{ $temporary_password }}" required>
            </div>
            <div class="mt-6 text-sm">
                A new account with the role <span style="color: {{ $recruitment->role->color }}" class="font-bold">{{ $recruitment->role->name }}</span> will be created.
                <br><br>
                <br>
                <span class="font-bold">Email:</span> {{ $application->email }}
                <br>
                <span class="font-bold">Temporary password:</span> {{ $temporary_password }}
            </div>
            <div class="mt-6 grid grid-cols-6 gap-6">
                <div class="sm:col-span-5"></div>
                <div class="col-span-full sm:col-span-1">
                    <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                        Validate
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
