@extends('layouts.staff')

@section('title', "{$application->discord}'s Application for {$recruitment->role->name}")

@section('breadcrumb', "Staff - Recruitment #{$recruitment->id} - Application #{$application->id}")

@section('content-staff')
<div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
    <div class="mb-10 flex justify-between items-center">
        <h3 class="font-bold text-2xl text-gray-300">Recruitment #{{ $recruitment->id }} - Application #{{ $application->id }} for <span style="color: {{ $recruitment->role->color }}">{{ $recruitment->role->name }}</span></h3>
        <i style="color: {{ $recruitment->role->color }}" class="flex-shrink-0 text-primary fas fa-{{ $recruitment->role->icon_name }} fa-fw fa-2x"></i>
    </div>

    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-full md:col-span-3">
            <label for="discord_username" class="block font-medium text-gray-300">Discord username</label>
            <input type="text" disabled id="discord_username" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ $application->discord }}">
        </div>

        <div class="col-span-full md:col-span-3">
            <label for="email_address" class="block font-medium text-gray-300">Email address</label>
            <input type="text" disabled id="email_address" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ $application->email }}">
        </div>

        <hr class="col-span-full border-b border-gray-700">

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