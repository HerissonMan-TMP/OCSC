@extends('layouts.app')

@section('title', 'Global Requirements')

@section('breadcrumb', 'Global Requirements')

@section('content')
    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
        <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">
            <div class="flex justify-center items-center mt-2 mb-10">
                <i class="inline-block fas fa-tasks fa-fw fa-2x mr-2"></i>
                <h2 class="m-0 inline-block font-bold text-gray-300">Global Requirements for Recruitment</h2>
            </div>
            <div>
                @markdown($globalRequirements)
            </div>
        </div>
    </div>
@endsection
