@extends('layouts.staff')

@section('title', 'Convoy Rules - Convoys - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>Convoys <span class="font-light">/ Convoy Rules</span></h2>
        </div>

        <div class="my-4 p-4 rounded-md bg-blue-500 text-sm">
            <i class="fas fa-info-circle fa-fw"></i>
            A new version of the convoy rules is created everytime you change them, which means that the previous versions are saved.
        </div>

        <form action="{{ route('staff.convoy-rules.store') }}" method="POST">
            @csrf

            <label for="convoy-rules-input" class="block text-sm font-medium text-gray-300">Convoy Rules <span class="text-red-500 font-bold">*</span> <i class="ml-1 flex-shrink-0 fab fa-markdown fa-fw"></i></label>
            <textarea name="content" id="convoy-rules-input" class="text-gray-300 bg-gray-800 mt-1 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-700 rounded-md" cols="30" rows="30">{{ old('content') ?? App\Models\ConvoyRules::latest()->first()?->content }}</textarea>
            @error('content')
            <span class="pt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror

            <div class="mt-6 text-right">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">Store a new version of the convoy rules</button>
            </div>
        </form>
    </div>
@endsection
