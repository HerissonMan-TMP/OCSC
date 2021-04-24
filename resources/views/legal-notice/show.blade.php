@extends('layouts.app')

@section('title', 'Legal Notice')

@section('content')
    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center px-2 md:px-0 py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ config('app.default_banner') }}');">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-balance-scale fa-fw"></i> Legal Notice & Terms and Conditions</h1>
            <div>
                <p class="inline-block mb-0 px-2 text-sm text-gray-200">
                    Last updated:
                    @isset($legalNotice)
                        <span class="font-bold">{{ $legalNotice->created_at->format('d M H:i') }} UTC</span>
                    @else
                        <span class="text-sm italic text-gray-300">Never</span>
                    @endisset
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
        @isset($legalNotice)
            @markdown($legalNotice->content)
        @else
            <span class="italic">No legal notice yet...</span>
        @endisset
    </div>
@endsection
