@extends('layouts.staff')

@section('title', "{$application->discord}'s Application for {$recruitment->role->name}")

@section('breadcrumb', "Staff - Recruitment #{$recruitment->id} - Application #{$application->id}")

@section('content-staff')
<div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
    <div class="flex justify-between items-center mt-2 mb-6">
        <h3 class="m-0 font-bold text-2xl text-gray-300">Recruitment #{{ $recruitment->id }} - Application #{{ $application->id }} for <span style="color: {{ $recruitment->role->color }}">{{ $recruitment->role->name }}</span></h3>
        <i style="color: {{ $recruitment->role->color }}" class="flex-shrink-0 text-primary fas fa-{{ $recruitment->role->icon_name }} fa-fw fa-2x"></i>
    </div>

    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-full md:col-span-2">
            <label for="truckersmp_id" class="block text-sm font-medium text-gray-300">TruckersMP ID</label>
            <input type="text" disabled id="truckersmp_id" class="text-gray-300 bg-gray-700 font-bold uppercase mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ $application->truckersmp_id }}">
        </div>

        <div class="col-span-full md:col-span-2">
            <label for="discord" class="block font-medium text-gray-300">Discord username</label>
            <input type="text" disabled id="discord" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ $application->discord }}">
        </div>

        <div class="col-span-full md:col-span-2">
            <label for="email" class="block font-medium text-gray-300">Email address</label>
            <input type="email" disabled id="email" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ $application->email }}">
        </div>

        <div class="col-span-full md:col-span-3">
            <label for="steam-profile" class="block font-medium text-gray-300">Steam profile link</label>
            <input type="text" disabled id="steam-profile" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ $application->steam_profile }}">
        </div>

        <div class="col-span-full md:col-span-3">
            <label for="trucksbook-profile" class="block font-medium text-gray-300">Trucksbook profile link</label>
            <input type="text" disabled id="trucksbook-profile" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ $application->trucksbook_profile }}">
        </div>

        <div class="col-span-full md:col-span-3">
            <label for="age" class="block font-medium text-gray-300">Age</label>
            <input type="text" disabled id="age" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ $application->age }}">
        </div>

        <div class="col-span-full md:col-span-3">
            <label for="pc-configuration" class="block font-medium text-gray-300">PC Configuration</label>
            <input type="text" disabled id="pc-configuration" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ $application->pc_configuration }}">
        </div>

        @foreach($recruitment->questions as $question)
            <div class="col-span-full mb-4">
                @if($question->type === 'inline')
                    <label for="question-{{ $question->id }}" class="block text-2xl font-light text-gray-300 mb-3">{{ $question->name }}</label>
                    <input type="text" disabled id="question-{{ $question->id }}" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ optional($application->answerForQuestion($question))->text }}">
                @elseif($question->type === 'multiline')
                    <label for="question-{{ $question->id }}" class="block text-2xl font-light text-gray-300 mb-3">{{ $question->name }}</label>
                    <textarea disabled id="question-{{ $question->id }}" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" cols="30" rows="8">{{ optional($application->answerForQuestion($question))->text }}</textarea>
                @endif
            </div>
        @endforeach
    </div>

    <div class="text-right grid grid-cols-6 gap-6 mt-6">
        <div class="col-span-4"></div>
        @switch($application->status)
        @case('new')
            <form class="col-span-1" action="{{ route('staff.recruitments.applications.decline', [$recruitment, $application]) }}" method="POST">
                @csrf
                <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-red-200 bg-red-700 hover:text-red-300 hover:bg-red-800 focus:outline-none">
                    Decline
                </button>
            </form>
            <form class="col-span-1" action="{{ route('staff.recruitments.applications.accept', [$recruitment, $application]) }}" method="POST">
                @csrf
                <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-green-200 bg-green-700 hover:text-green-300 hover:bg-green-800 focus:outline-none">
                    Accept
                </button>
            </form>
            @break
        @case('accepted')
            <span class="col-span-full md:col-span-2 text-sm">You have already <span class="text-green-600">accepted</span> this application.</span>
            @break
        @case('declined')
            <span class="col-span-full md:col-span-2 text-sm">You have already <span class="text-red-600">declined</span> this application.</span>
            @break
        @endswitch
    </div>
</div>
@endsection
