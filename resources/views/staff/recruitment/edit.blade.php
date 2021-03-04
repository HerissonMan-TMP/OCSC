@extends('layouts.staff')

@section('title', 'Recruitment Management')

@section('breadcrumb', 'Staff - Create a Recruitment')

@section('content-staff')
<div class="mt-6 bg-gray-800 rounded-md px-4 py-5 bg-gray-800 sm:p-6 shadow overflow-hidden">
    <form action="{{ route('staff.recruitments.update', $recruitment) }}" method="POST" class="mb-10">
        @method('PATCH')
        @csrf
        <div class="shadow overflow-hidden rounded-md">
            <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Edit Recruitment #{{ $recruitment->id }}</h3>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-full sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-300">Opened By</label>
                    <input type="text" disabled style="color: {{ $recruitment->user->roles->first()->color }}" class="text-gray-300 bg-gray-700 font-bold mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" value="{{ $recruitment->user->name }}">
                </div>

                <div class="col-span-full sm:col-span-full">
                    <label for="role" class="block text-sm font-medium text-gray-300">Role @if($recruitment->is_open) <span class="text-red-500 italic">You cannot edit the role because the recruitment is open.</span> @else <span class="text-red-500 font-bold">*</span> @endif</label>
                    <select id="role" name="role" class="text-gray-300 bg-gray-700 mt-1 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm" required>
                        @foreach($recruitableRoles as $role)
                            <option @if($role->id == $recruitment->role->id) selected @endif value="{{ $role->id }}" style="color: {{ $role->color }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-full sm:col-span-3">
                    <label for="start_date" class="block text-sm font-medium text-gray-300">Start Date (UTC) <span class="text-red-500 font-bold">*</span></label>
                    <input id="" type="text" name="start_datetime" id="start_date" class="flatpickr text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" value="{{ $recruitment->start_at }}" required>
                </div>

                <div class="col-span-full sm:col-span-3">
                    <label for="end_date" class="block text-sm font-medium text-gray-300">End Date (UTC) <span class="text-red-500 font-bold">*</span></label>
                    <input id="" type="text" name="end_datetime" id="end_date" class="flatpickr text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" value="{{ $recruitment->end_at }}" required>
                </div>

                <div class="col-span-full">
                    <label for="note" class="block text-sm font-medium text-gray-300">Additional Note</label>
                    <textarea name="note" id="note" class="text-gray-300 bg-gray-700 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" cols="30" rows="3">{{ $recruitment->note }}</textarea>
                </div>
            </div>
        </div>
        <div class="mt-6 bg-gray-800 text-right grid grid-cols-6 gap-6">
            <div class="sm:col-span-5"></div>
            <div class="col-span-full sm:col-span-1">
                <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    Update
                </button>
            </div>
        </div>
    </form>

    <div class="mb-10">
        <div>
            <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Questions</h3>
            <form action="{{ route('staff.recruitments.questions.store', $recruitment) }}" method="POST">
                @csrf
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-full sm:col-span-2 flex items-center">
                        Create a question
                    </div>

                    <div class="col-span-full sm:col-span-2 flex items-center">
                        <input type="text" name="name" id="name" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" placeholder="Question" maxlength="60">
                    </div>

                    <div class="col-span-full sm:col-span-1 flex items-center">
                        <select id="type" name="type" class="text-gray-300 bg-gray-700 mt-1 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm">

                            <option value="inline">Inline input</option>
                            <option value="multiline">Multiline input</option>
                        </select>
                    </div>

                    <div class="col-span-full sm:col-span-1 flex items-center">
                        <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                            Create
                        </button>
                    </div>
                </div>
            </form>

            <hr class="my-6 order-b border-gray-700">


            @foreach($recruitment->questions as $question)
            <form action="{{ route('staff.recruitments.questions.update', [$recruitment, $question]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-6 gap-6 mt-2">
                    <div class="col-span-full sm:col-span-2 flex items-center">
                        {{ $question->name }}
                    </div>

                    <div class="col-span-full sm:col-span-2 flex items-center">
                        <input type="text" name="name" id="name" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm sm:text-sm border-gray-600 rounded-md" placeholder="Question" value="{{ $question->name }}" maxlength="60">
                    </div>

                    <div class="col-span-full sm:col-span-1 flex items-center">
                        <select id="type" name="type" class="text-gray-300 bg-gray-700 mt-1 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                            <option @if($question->type === 'inline') selected @endif value="inline">Inline input</option>
                            <option @if($question->type === 'multiline') selected @endif value="multiline">Multiline input</option>
                        </select>
                    </div>

                    <div class="col-span-full sm:col-span-1 flex items-center">
                        <button type="submit" class="w-full transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                            Update
                        </button>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>

    <div class="mt-6 w-full bg-gray-700 rounded-md border border-red-500">
        <div class="p-4 bg-red-500">
            <h3 class="font-semibold text-2xl text-ged-200">Danger Zone</h3>
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
