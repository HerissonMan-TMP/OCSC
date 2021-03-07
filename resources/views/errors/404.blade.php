@extends('layouts.app')

@section('title', "403 Not Authorized")

@section('breadcrumb')
    404 - Not Found
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 mt-16">
        <div class="text-center mt-6 rounded-md px-4 py-5 sm:p-16 overflow-hidden">
            <div class="mb-8">
                <span class="font-bold text-6xl text-gray-300 mt-2 mb-6">404</span>
            </div>
            <span class="font-light text-2xl text-gray-300 mt-2 mb-6">The page / resource you are looking for cannot be found.</span>
        </div>
    </div>
@endsection
