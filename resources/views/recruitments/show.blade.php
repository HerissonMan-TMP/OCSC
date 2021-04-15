@extends('layouts.app')

@section('title', "Apply for {$recruitment->role->name}")

@section('content')
<div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.imgur.com/kZ3YjwR.png');">
    <div class="text-center grid gap-4">
        <h1 class="text-5xl m-0 capitalize">Recruitment - <i class="flex-shrink-0 fas fa-{{ $recruitment->role->icon_name }} fa-fw" style="color: {{ $recruitment->role->color }}"></i> <span style="color: {{ $recruitment->role->color }}">{{ $recruitment->role->name }}</span></h1>
        <div>
            <p class="inline-block mb-0 rounded px-2 text-sm text-gray-200 bg-green-500 uppercase">
                Open until <span class="font-bold">{{ $recruitment->end_at->format('d M H:i') }} UTC</span>
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 md:px-6 my-16">
    <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <form action="{{ route('recruitments.applications.store', $recruitment) }}" method="POST">
            @csrf
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Recruitment #{{ $recruitment->id }} - Apply for <span style="color: {{ $recruitment->role->color }}">{{ $recruitment->role->name }}</span></h3>
                <i style="color: {{ $recruitment->role->color }}" class="flex-shrink-0 text-primary fas fa-{{ $recruitment->role->icon_name }} fa-fw fa-2x"></i>
            </div>

            @if(setting('global-requirements') || $recruitment->specific_requirements)
            <div class="mb-10">
                <h4 class="font-bold text-gray-300 mt-2 mb-6">Requirements</h4>
                @if(setting('global-requirements'))
                <p>
                    @markdown(setting('global-requirements'))
                </p>
                @endif
                @if($recruitment->specific_requirements)
                <p>
                    @markdown($recruitment->specific_requirements)
                </p>
                @endif
            </div>
            @endif

            @if($recruitment->note)
            <div>
                <h4 class="font-bold text-gray-300 mt-2 mb-6">Notes</h4>
                <p>
                    {{ $recruitment->note }}
                </p>
            </div>
            @endif

            <hr class="col-span-full border-b border-gray-700">

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-2">
                    <label for="truckersmp_id" class="block text-sm font-medium text-gray-300">TruckersMP ID <span class="text-red-500">*</span></label>
                    <input type="text" name="truckersmp_id" id="truckersmp_id" class="text-gray-300 bg-gray-700 font-bold uppercase mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="3116422" maxlength="8" value="{{ old('truckersmp_id') }}" required>
                    @error('truckersmp_id')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-2">
                    <label for="discord" class="block font-medium text-gray-300">Discord username <span class="text-red-500">*</span></label>
                    <input type="text" name="discord" id="discord" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="MyUsername#1234" maxlength="50" value="{{ old('discord') }}" required>
                    @error('discord_username')
                        <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-2">
                    <label for="email" class="block font-medium text-gray-300">Email address <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="myemail@example.com" maxlength="300" value="{{ old('email') }}" required>
                    @error('email_address')
                        <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="steam-profile" class="block font-medium text-gray-300">Steam profile link <span class="text-red-500">*</span></label>
                    <input type="text" name="steam_profile" id="steam-profile" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="https://steamcommunity.com/profiles/76561199011527918" value="{{ old('steam_profile') }}" required>
                    @error('steam_profile')
                        <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="trucksbook-profile" class="block font-medium text-gray-300">Trucksbook profile link <span class="text-red-500">*</span></label>
                    <input type="text" name="trucksbook_profile" id="trucksbook-profile" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="https://trucksbook.eu/profile/176697" value="{{ old('trucksbook_profile') }}" required>
                    @error('trucksbook_profile')
                        <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="age" class="block font-medium text-gray-300">Age <span class="text-red-500">*</span></label>
                    <input type="text" name="age" id="age" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" maxlength="2" placeholder="19" value="{{ old('age') }}" required>
                    @error('age')
                        <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="pc-configuration" class="block font-medium text-gray-300">PC Configuration <span class="text-red-500">*</span></label>
                    <input type="text" name="pc_configuration" id="pc-configuration" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Intel Core i5, 8 GB RAM, 500 GB internal storage drive, ..." value="{{ old('pc_configuration') }}" required>
                    @error('pc_configuration')
                    <span class="pt-2 text-sm text-red-500">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                @foreach($recruitment->questions as $question)
                    <div class="col-span-full mb-4">
                        @if($question->type === 'inline')
                            <div class="flex justify-between items-center">
                                <label for="question-{{ $question->id }}" class="block text-2xl font-light text-gray-300 mb-3">{{ $question->name }} <span class="text-red-500">*</span></label>
                                <span id="question-{{ $question->id }}-counter" class="text-xs @if($question->min_length > 0) text-red-500 @else text-green-500 @endif">
                        @if($question->min_length > 0)
                                        <span>Minimum: {{ $question->min_length }} |</span>
                                    @endif
                        <span id="question-{{ $question->id }}-counter-number">0</span>
                        <span> / {{ $question->max_length }}</span>
                    </span>
                            </div>
                            <input type="text" name="questions[]" id="question-{{ $question->id }}" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ old('questions') ? old('questions')[$loop->index] : null }}" required>
                        @elseif($question->type === 'multiline')
                            <div class="flex justify-between items-center">
                                <label for="question-{{ $question->id }}" class="block text-2xl font-light text-gray-300 mb-3">{{ $question->name }} <span class="text-red-500">*</span></label>
                                <span id="question-{{ $question->id }}-counter" class="text-xs @if($question->min_length > 0) text-red-500 @else text-green-500 @endif">
                        @if($question->min_length > 0)
                                        <span>Minimum: {{ $question->min_length }} |</span>
                                    @endif
                        <span id="question-{{ $question->id }}-counter-number">0</span>
                        <span> / {{ $question->max_length }}</span>
                    </span>
                            </div>
                            <textarea name="questions[]" id="question-{{ $question->id }}" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" cols="30" rows="8" required>{{ old('questions') ? old('questions')[$loop->index] : null }}</textarea>
                        @endif
                        @error('questions.' . $loop->index)
                        <span class="pt-2 text-sm text-red-500">
                {{ $message }}
                </span>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <input type="checkbox" name="consent" id="personal-data-consent" class="form-checkbox rounded-full text-primary border-none focus:ring-offset-0 focus:ring-0 cursor-pointer">
                <label for="personal-data-consent" class="text-sm text-gray-300">
                    By submitting an application, you consent that we are allowed to store any information provided above,
                    in accordance with our <a href="{{ route('privacy-policy.show') }}">Privacy Policy</a>.
                </label>
            </div>
            @error('consent')
            <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
            @enderror

            <div class="mt-6 bg-gray-800 text-right">
                <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Send my application
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script>
    //Character counter
    @foreach($recruitment->questions as $question)

        var questionInput = document.getElementById('question-{{ $question->id }}');
        var questionCounter = document.getElementById('question-{{ $question->id }}-counter');
        var questionCounterNumber = document.getElementById('question-{{ $question->id }}-counter-number');

        questionCounterNumber.innerHTML = questionInput.value.length;

        questionInput.addEventListener('input', function() {
            var questionInput = document.getElementById('question-{{ $question->id }}');
            var questionCounter = document.getElementById('question-{{ $question->id }}-counter');
            var questionCounterNumber = document.getElementById('question-{{ $question->id }}-counter-number');

            questionCounterNumber.innerHTML = questionInput.value.length;

            if (questionInput.value.length > {{ $question->max_length }} || questionInput.value.length < {{ $question->min_length }}) {
                questionCounter.classList.add('text-red-500');
                questionCounter.classList.remove('text-green-500');
            } else {
                questionCounter.classList.add('text-green-500');
                questionCounter.classList.remove('text-red-500');
            }
        });

    @endforeach
    </script>
@endpush
