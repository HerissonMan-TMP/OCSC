@extends('layouts.app')

@section('title', 'Our services')

@section('content')
    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ config('app.default_banner') }}');">
        <div class="text-center break-words grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><span class="inline-block transform"><i class="flex-shrink-0 fas fa-concierge-bell fa-fw"></i></span> Our services</h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-6 my-16">
        <div class="flex">
            <div>
                <div class="z-40 bg-red-400 rounded-l-md" style="width: 300px; height: 300px; background-image: linear-gradient(to left, #1f2937, rgba(0, 0, 0, 0) 70%), linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://i.imgur.com/5E117HM.png');"></div>
            </div>
            <div class="w-full px-10 py-5 rounded-r-md bg-gray-800">
                <h2 class="m-0 uppercase font-bold text-primary">Title</h2>
                <p class="mt-5 text-lg">Test</p>
            </div>
        </div>

        <div class="flex flex-row-reverse mt-10">
            <div>
                <div class="z-40 bg-red-400 rounded-r-md" style="width: 300px; height: 300px; background-image: linear-gradient(to right, #1f2937, rgba(0, 0, 0, 0) 70%), linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://i.imgur.com/5E117HM.png');"></div>
            </div>
            <div class="w-full px-10 py-5 rounded-l-md bg-gray-800">
                <h2 class="text-right m-0 uppercase font-bold text-primary">Title</h2>
                <p class="text-right mt-5 text-lg">Test</p>
            </div>
        </div>

        <div class="flex mt-10">
            <div>
                <div class="z-40 bg-red-400 rounded-l-md" style="width: 300px; height: 300px; background-image: linear-gradient(to left, #1f2937, rgba(0, 0, 0, 0) 70%), linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://i.imgur.com/5E117HM.png');"></div>
            </div>
            <div class="w-full px-10 py-5 rounded-r-md bg-gray-800">
                <h2 class="m-0 uppercase font-bold text-primary">Title</h2>
                <p class="mt-5 text-lg">Test</p>
            </div>
        </div>
    </div>
@endsection
