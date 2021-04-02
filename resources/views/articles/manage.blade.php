@inject("carbon", "\Carbon\Carbon")

@extends('layouts.staff')

@section('title', 'News Articles - Staff')

@section('breadcrumb', 'Staff - News Articles')

@section('content-staff')
    <div class="px-4 py-5 md:p-6 bg-gray-800 rounded-md shadow overflow-hidden">

        <div class="flex justify-between items-center mt-2 mb-6">
            <div>
                <h3 class="m-0 font-bold text-2xl text-gray-300">News Articles</h3>
            </div>
            <div>
                <a href="{{ route('staff.articles.create') }}" class="transition duration-200 ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-gray-700 font-bold bg-primary hover:text-gray-800 hover:bg-primary-dark">
                    Post a new article
                </a>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-20">
            @forelse($articles as $article)
                <div class="col-span-full md:col-span-1 rounded-md bg-gray-900 overflow-hidden">
                    <div class="text-sm mb-6">
                        <img class="max-w-full h-auto" src="{{ $article->banner_url ?? 'https://static.truckersmp.com/images/bg/ets.jpg' }}" alt="News Article Banner">
                    </div>

                    <div class="h-16 mx-6">
                        <h3 class="font-semibold text-xl m-0 text-gray-200">
                            {{ $article->title }}
                        </h3>
                    </div>

                    <div class="mx-6 mb-6">
                        <div class="flex justify-between">
                        <span class="text-sm italic text-gray-300">
                            <i class="fas fa-user fa-fw fa-md"></i>
                            @if($article->postedByUser)
                                <span class="font-bold" style="color: {{ $article->postedByUser->roles->first()->color }}">{{ $article->postedByUser->name }}</span>
                            @else
                                <span>Unkown User</span>
                            @endif
                        </span>
                            <span class="ml-4 text-sm italic text-gray-300"><i class="fas fa-clock fa-fw fa-md"></i> {{ $carbon->parse($article->created_at)->format('d M H:i') }}</span>
                        </div>
                        <div class="grid grid-cols-6 gap-2 mt-4">
                            <div class="col-span-4">
                                <a href="{{ route('articles.show', $article) }}" class="h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark focus:outline-none">
                                    Read
                                </a>
                            </div>
                            <div class="col-span-1">
                                <a href="{{ route('staff.articles.edit', $article) }}" class="h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark focus:outline-none">
                                    <i class="fas fa-pen fa-fw fa-md"></i>
                                </a>
                            </div>
                            <form action="{{ route('staff.articles.destroy', $article) }}" method="POST" class="col-span-1">
                                @csrf
                                @method('DELETE')
                                <button type="Submit" class="h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-200 bg-red-500 hover:text-gray-300 hover:bg-red-600 focus:outline-none"><i class="fas fa-trash-alt fa-fw fa-md"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <span class="text-sm italic text-gray-300">No news articles yet...</span>
            @endforelse
        </div>
    </div>
@endsection
