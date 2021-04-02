@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('breadcrumb', 'Privacy Policy')

@section('content')
    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.imgur.com/kZ3YjwR.png');">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-user-secret fa-fw"></i> Privacy Policy</h1>
        </div>
    </div>

    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
        @markdown(setting('privacy-policy'))
    </div>
@endsection
