@extends('layouts.staff')

@section('title', 'Supporters Conditions & Info - Supporters - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Supporters <span class="font-light">/ Supporters Conditions & Info</span></h2>
        </div>

        <div class="my-4 p-4 rounded-md bg-blue-500 text-sm">
            <i class="fas fa-info-circle fa-fw"></i>
            A new version of the Supporters conditions & information is created everytime you change it, which means that the previous versions are saved.
        </div>

        <form action="{{ route('staff.partnership-conditions.store') }}" method="POST">
            @csrf

            <label for="partnership-conditions-input" class="block text-sm font-medium text-gray-300">Supporters Conditions & Info <span class="text-red-500 font-bold">*</span> <i class="ml-1 flex-shrink-0 fab fa-markdown fa-fw"></i></label>
            <textarea name="content" id="partnership-conditions-input" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" cols="30" rows="30">{{ old('content') ?? $partnershipConditions?->content }}</textarea>
            @error('content')
            <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">Edit the partnership conditions & info</button>
            </div>
        </form>
    </div>
@endsection
