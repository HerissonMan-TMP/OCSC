@extends('layouts.app')

@section('breadcrumb-additional-content')
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="transition duration-200 ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-gray-700 font-bold bg-primary hover:text-gray-800 hover:bg-primary-dark">
            Logout
        </button>
    </form>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 mt-16">
    <div class="px-4 py-5 sm:p-6 bg-gray-800 rounded-md flex justify-between">
        <div>
            <span class="font-bold">{{ $authUser->name }}</span> / {{ $authUser->email }}
        </div>
        <div style="background-color: {{ $authUser->roles->first()->color }}" class="px-2 py-1 rounded-md leading-3">
            <span class="font-bold text-gray-800 text-sm">{{ $authUser->roles->first()->name }}</span>
        </div>
    </div>
@yield('content-staff')
</div>
@endsection
