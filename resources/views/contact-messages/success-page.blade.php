@extends('layouts.app')

@section('title', 'Contact')

@section('breadcrumb', 'Message sent')

@section('content')
<div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center px-2 md:px-0 py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.imgur.com/kZ3YjwR.png');">
    <div class="text-center grid gap-4">
        <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-envelope fa-fw"></i> Contact</h1>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 md:px-6 my-16">
    <div class="mt-6 bg-gray-800 rounded-md px-4 py-5 bg-gray-800 md:p-6 shadow overflow-hidden text-center">
        <h3 class="font-bold text-2xl text-gray-300 mt-2 mb-6">Your message has been successfully sent!</h3>
    </div>
</div>
@endsection
