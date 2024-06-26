@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center px-2 md:px-0 py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ config('app.default_banner') }}');">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-user-secret fa-fw"></i> Privacy Policy</h1>
            <div>
                <p class="inline-block mb-0 px-2 text-sm text-gray-200">
                    Last updated:
                    @isset($privacyPolicy)
                        <span class="font-bold">{{ $privacyPolicy->created_at->format('d M H:i') }} UTC</span>
                    @else
                        <span class="text-sm italic text-gray-300">Never</span>
                    @endisset
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16 break-words">
        @isset($privacyPolicy)
            @markdown($privacyPolicy->content)
        @else
            <span class="italic">No privacy policy yet...</span>
        @endisset
    </div>
@endsection
