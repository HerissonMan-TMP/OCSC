@extends('layouts.app')

@section('title', 'Legal Notice')

@section('content')
    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.imgur.com/kZ3YjwR.png');">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-balance-scale fa-fw"></i> Legal Notice</h1>
            <div>
                <p class="inline-block mb-0 px-2 text-sm text-gray-200">
                    Last updated: <span class="font-bold">{{ $legalNotice?->created_at->format('d M H:i') }} UTC</span>
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16 text-justify">
        @if($legalNotice)
            @markdown($legalNotice->content)
        @else
            <span class="italic">No legal notice set yet...</span>
        @endif
    </div>
@endsection