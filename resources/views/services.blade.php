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
            <div class="hidden md:block">
                <div class="z-40 bg-red-400 rounded-l-md" style="width: 300px; height: 300px; background-image: linear-gradient(to left, #1f2937, rgba(0, 0, 0, 0) 70%), linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://i.imgur.com/12OoLJo.png');"></div>
            </div>
            <div class="w-full px-10 py-5 rounded-r-md rounded-l-md md:rounded-l-none bg-gray-800">
                <h2 class="m-0 uppercase font-bold text-primary">Public Supervision</h2>
                <p class="mt-5">
                    As a convoy organisation since September 2019, our public server supervisions have been OCSC Event's core business since our inception.
                    We can therefore offer you through our Event Team, the creation of your routes (if you wish), the management of slots, the publication of your Event on TMP and our discord, and the organization of your convoy with our CC Car team trained beforehand according to TruckersMP rules.
                    <br>
                    By choosing to be supervised by OCSC Event, you will have the assurance that your convoy will be managed by our CC Car team, throughout its duration. Our CC Car will accompany you throughout the journey and ensure that it runs smoothly by relaying essential information about the speed of the convoy, directions, random events, etc.
                </p>
            </div>
        </div>

        <div class="flex flex-row-reverse mt-10">
            <div class="hidden md:block">
                <div class="z-40 bg-red-400 rounded-r-md" style="width: 300px; height: 300px; background-image: linear-gradient(to right, #1f2937, rgba(0, 0, 0, 0) 70%), linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://i.imgur.com/SWriwQd.png');"></div>
            </div>
            <div class="w-full px-10 py-5 rounded-l-md rounded-r-md md:rounded-r-none bg-gray-800">
                <h2 class="text-left md:text-right m-0 uppercase font-bold text-primary">Mega Supervision</h2>
                <p class="mt-5">
                    Megas supervisions actually mean the supervision and guidance of your convoy taking place in the TruckersMP server event.
                    Our Event Team then prepares your convoy by means of road blocks, according to the rules in the temporary event rules.
                    <br>
                    By working in this way, your convoy will run smoothly from start to finish.
                    We are in direct contact with TruckersMP staff and can also provide you with support on this.
                    By contacting us, you will be able to enjoy your convoy freely while having our Event Managers supervise it in a meticulous and organised manner.
                </p>
            </div>
        </div>

        <div class="flex mt-10">
            <div class="hidden md:block">
                <div class="z-40 bg-red-400 rounded-l-md" style="width: 300px; height: 300px; background-image: linear-gradient(to left, #1f2937, rgba(0, 0, 0, 0) 70%), linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://i.imgur.com/nMB4IBZ.jpg');"></div>
            </div>
            <div class="w-full px-10 py-5 rounded-r-md rounded-l-md md:rounded-l-none bg-gray-800">
                <h2 class="m-0 uppercase font-bold text-primary">Route Planning</h2>
                <p class="mt-5">
                    With the arrival of our convoy booking calendar on our website, you can now have a real-time overview of our supervision possibilities.
                    This means that you will have a better overview of our calendar and that you will be able to book your convoys easily and completely.
                    Our team will be able to respond more quickly to your requests and process them in a shorter timeframe, allowing you to effectively set up your convoys.
                </p>
            </div>
        </div>
    </div>
@endsection
