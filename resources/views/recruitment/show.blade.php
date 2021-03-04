@extends('layouts.app')

@section('title', 'Contact')

@section('breadcrumb')
    Recruitment for <span style="color: {{ $recruitment->role->color }}">{{ $recruitment->role->name }}</span>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 mt-16">
    <div class="mt-6 bg-gray-800 rounded-md px-4 py-5 bg-gray-800 sm:p-6 shadow overflow-hidden">
        <form action="{{ route('recruitments.applications.store', $recruitment) }}" method="POST">
            @csrf
               <div class="flex justify-between items-center">
                <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Recruitment #{{ $recruitment->id }} - Apply for <span style="color: {{ $recruitment->role->color }}">{{ $recruitment->role->name }}</span></h3>
                <i style="color: {{ $recruitment->role->color }}" class="flex-shrink-0 text-primary fas fa-{{ $recruitment->role->icon_name }} fa-fw fa-2x"></i>
            </div>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full sm:col-span-3">
                    <label for="discord_username" class="block font-medium text-gray-300">Discord username</label>
                    <input type="text" name="discord_username" id="discord_username" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" placeholder="MyUsername#1234" maxlength="100">
                </div>

                <div class="col-span-full sm:col-span-3">
                    <label for="email_address" class="block font-medium text-gray-300">Email address</label>
                    <input type="text" name="email_address" id="email_address" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" placeholder="myemail@example.com" maxlength="300">
                </div>

                <hr class="col-span-full border-b border-gray-700">

                @foreach($recruitment->questions as $question)
                <div class="col-span-full mb-4">
                    @if($question->type === 'inline')
                    <label for="question-{{ $question->id }}" class="block text-2xl font-light text-gray-300 mb-3">{{ $question->name }}</label>
                    <input type="text" name="{{ $question->id }}" id="question-{{ $question->id }}" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md">
                    @elseif($question->type === 'multiline')
                        <label for="question-{{ $question->id }}" class="block text-2xl font-light text-gray-300 mb-3">{{ $question->name }}</label>
                        <textarea name="{{ $question->id }}" id="question-{{ $question->id }}" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" cols="30" rows="8"></textarea>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="mt-6 bg-gray-800 text-right">
                <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Send my application
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
