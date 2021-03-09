@extends('layouts.app')

@section('title', "Apply for {$recruitment->role->name}")

@section('breadcrumb')
    Recruitment for <span style="color: {{ $recruitment->role->color }}">{{ $recruitment->role->name }}</span>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-6 my-16">
    <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
        <form action="{{ route('recruitments.applications.store', $recruitment) }}" method="POST">
            @csrf
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Recruitment #{{ $recruitment->id }} - Apply for <span style="color: {{ $recruitment->role->color }}">{{ $recruitment->role->name }}</span></h3>
                <i style="color: {{ $recruitment->role->color }}" class="flex-shrink-0 text-primary fas fa-{{ $recruitment->role->icon_name }} fa-fw fa-2x"></i>
            </div>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-3">
                    <label for="discord" class="block font-medium text-gray-300">Discord username <span class="text-red-500">*</span></label>
                    <input type="text" name="discord" id="discord" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="MyUsername#1234" maxlength="50" value="{{ old('discord_username') }}" required>
                    @error('discord_username')
                    <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="email" class="block font-medium text-gray-300">Email address <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="myemail@example.com" maxlength="300" value="{{ old('email_address') }}" required>
                    @error('email_address')
                    <span class="pt-2 text-sm text-red-500">
                    {{ $message }}
                </span>
                    @enderror
                </div>

                <hr class="col-span-full border-b border-gray-700">

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
                            <input type="text" name="question_{{ $question->id }}" id="question-{{ $question->id }}" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" value="{{ old('question_' . $question->id) }}" required>
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
                            <textarea name="question_{{ $question->id }}" id="question-{{ $question->id }}" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" cols="30" rows="8" required>{{ old('question_' . $question->id) }}</textarea>
                        @endif
                        @error('question_' . $question->id)
                        <span class="pt-2 text-sm text-red-500">
                {{ $message }}
                </span>
                        @enderror
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
