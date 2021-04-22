@extends('layouts.staff')

@section('title', "{$guide->title} - Guides - Staff")

@section('content-staff')
    <div>
        <div class="mb-20 break-words text-center">
            <h2>Guides <span class="font-light">/ {{ $guide->title }}</span></h2>
        </div>

        <div>
            <div class="h-96 bg-cover bg-center rounded-t-3xl" style="background-image: linear-gradient(to top, #1F2937, rgba(0, 0, 0, 0) 70%), linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ $guide->banner_url }}');">
                <div class="w-full h-full flex justify-center items-center">
                    <div class="text-center">
                        <h3 class="text-4xl">{{ $guide->title }}</h3>
                        <p class="inline-block mb-0 px-2 text-sm text-gray-200">
                            Last updated: <span class="font-bold">{{ $guide->updated_at->format('d M H:i') }} UTC</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 px-6 py-20 rounded-b-3xl">
                @markdown($guide->content)
            </div>
        </div>
    </div>
@endsection
