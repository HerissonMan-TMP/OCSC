@extends('layouts.app')

@section('title', 'Global Requirements')

@section('breadcrumb', 'Global Requirements')

@section('content')
    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.imgur.com/kZ3YjwR.png');">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-tasks fa-fw"></i> Global Requirements for Recruitment</h1>
        </div>
    </div>

    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
        @if(setting('global-requirements'))
            @markdown(setting('global-requirements'))
        @else
            <span class="italic">No global requirements set yet...</span>
        @endif
    </div>
@endsection
