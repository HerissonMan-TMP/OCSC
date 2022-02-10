@extends('layouts.staff')

@section('title', "Edit #{$recruitment->id} - Recruitments - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Recruitments <span class="font-light">/ Edit recruitment for <span style="color: {{ $recruitment->role->color }};">{{ $recruitment->role->name }}</span></span></h2>
        </div>

        <form action="{{ route('staff.recruitments.update', $recruitment) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full md:col-span-3">
                    <label class="block text-sm font-medium text-gray-300">Opened By</label>
                    <input type="text" disabled style="color: {{ $recruitment->user?->roles->first()->color }}" class="text-gray-300 bg-gray-800 font-bold mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $recruitment->user?->name ?: 'Anonymous' }}">
                </div>

                <div class="col-span-full md:col-span-full">
                    <label for="role_id" class="block text-sm font-medium text-gray-300">Role <span class="text-red-500 italic">You can no longer change the role.</span></label>
                    <select id="role_id" disabled style="color: {{ $recruitment->role->color }}" class="text-gray-300 bg-gray-800 mt-1 block w-full py-2 px-3 border border-gray-700 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm" required>
                        <option selected>{{ $recruitment->role->name }}</option>
                    </select>
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="start_at" class="block text-sm font-medium text-gray-300">Start Date (UTC) <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="start_at" id="start_at" class="flatpickr text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $recruitment->start_at }}" required>
                    @error('start_at')
                    <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full md:col-span-3">
                    <label for="end_at" class="block text-sm font-medium text-gray-300">End Date (UTC) <span class="text-red-500 font-bold">*</span></label>
                    <input type="text" name="end_at" id="end_at" class="flatpickr text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" value="{{ $recruitment->end_at }}" required>
                    @error('end_at')
                    <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="note" class="block text-sm font-medium text-gray-300">Additional Note</label>
                    <textarea name="note" id="note" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" cols="30" rows="3">{{ $recruitment->note }}</textarea>
                    @error('note')
                    <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="specific_requirements" class="block text-sm font-medium text-gray-300">Specific Requirements <i class="ml-1 flex-shrink-0 fab fa-markdown fa-fw"></i></label>
                    <textarea name="specific_requirements" id="specific_requirements" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" cols="30" rows="10">{{ old('specific_requirements') ?? $recruitment->specific_requirements }}</textarea>
                    @error('specific_requirements')
                    <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-6 text-right grid grid-cols-6 gap-6">
                <div class="md:col-span-5"></div>
                <div class="col-span-full md:col-span-1">
                    <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                        Update
                    </button>
                </div>
            </div>
        </form>

        <div class="mt-20">
            <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Questions</h3>

            <form action="{{ route('staff.recruitments.questions.store', $recruitment) }}" method="POST">
                @csrf

                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-full md:col-span-2 flex flex-col justify-center">
                        Create a question
                    </div>

                    <div class="col-span-full md:col-span-2 flex flex-col justify-center">
                        <input type="text" name="name" class="text-gray-300 bg-gray-800 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" placeholder="Question" maxlength="60">
                        @error('name')
                        <div class="block md:hidden pt-2 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-full md:col-span-1 flex flex-col justify-center">
                        <select name="type" class="text-gray-300 bg-gray-800 mt-1 block w-full py-2 px-3 border border-gray-700 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                            <option value="inline">Inline input</option>
                            <option value="multiline">Multiline input</option>
                        </select>
                        @error('type')
                        <div class="block md:hidden block pt-2 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-full md:col-span-1 flex items-center">
                        <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                            Create
                        </button>
                    </div>
                </div>
                <div class="hidden md:grid grid-cols-6 gap-6">
                    <div class="col-span-full md:col-span-2 flex items-center"></div>

                    <div class="col-span-full md:col-span-2 flex items-center">
                        @error('name')
                        <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-full md:col-span-1 flex items-center">
                        @error('type')
                        <span class="block pt-2 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-full md:col-span-1 flex items-center"></div>
                </div>
            </form>

            <hr class="my-6 order-b border-gray-700">

            @foreach($recruitment->questions as $question)
                <div class="mt-10 md:mt-2 grid grid-cols-8 gap-4 md:gap-6">
                    <form action="{{ route('staff.questions.update', $question) }}" method="POST" class="col-span-full md:col-span-7 grid grid-cols-8 gap-4 md:gap-6">
                        @csrf
                        @method('PATCH')

                        <div class="col-span-full md:col-span-3 flex flex-col justify-center">
                            {{ $question->name }}
                        </div>

                        <div class="col-span-full md:col-span-2 flex flex-col justify-center">
                            <input type="text" name="name" class="text-gray-300 bg-gray-800 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" placeholder="Question" value="{{ $question->name }}" maxlength="60">
                        </div>

                        <div class="col-span-full md:col-span-2 flex flex-col justify-center">
                            <select name="type" class="text-gray-300 bg-gray-800 mt-1 block w-full py-2 px-3 border border-gray-700 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                                <option @if($question->type === 'inline') selected @endif value="inline">Inline input</option>
                                <option @if($question->type === 'multiline') selected @endif value="multiline">Multiline input</option>
                            </select>
                        </div>

                        <div class="col-span-full md:col-span-1 flex flex-col justify-center">
                            <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                                Update
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('staff.questions.destroy', $question) }}" method="POST" class="col-span-full md:col-span-1 flex flex-col justify-center">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-200 bg-red-500 hover:bg-red-700 focus:outline-none">
                            Delete
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-20 w-full rounded-md border border-red-500">
            <div class="p-4 bg-red-500">
                <h3 class="font-semibold text-2xl text-ged-200 m-0">Danger Zone</h3>
            </div>

            <div class="p-4">
                <form action="{{ route('staff.recruitments.destroy', $recruitment) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <p class="mb-2 text-gray-200">Deleting a recruitment will also delete the applications sent for this one!</p>

                    <button type="submit" class="transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-200 bg-red-500 hover:bg-red-700 focus:outline-none">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
