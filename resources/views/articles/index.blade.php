@extends('layouts.staff')

@section('title', 'News Articles - Staff')

@section('content-staff')
    <div>
        <div class="mb-20 text-center">
            <h2>News Articles</h2>
        </div>

        <form action="" method="GET" class="mb-10 p-6 bg-gray-800 rounded-md grid grid-cols-10 gap-4">
            <div class="col-span-1">
                <input type="text" name="by" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="By" value="{{ request('by') }}">
            </div>

            <div class="col-span-2">
                <input type="text" name="title" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Title" value="{{ request('title') }}">
            </div>

            <div class="col-span-1">
                <select name="sortByCreatedAt" class="capitalize text-gray-300 bg-gray-700 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option @if(request('sortByCreatedAt') === 'desc') selected @endif value="desc">Latest</option>
                    <option @if(request('sortByCreatedAt') === 'asc') selected @endif value="asc">Oldest</option>
                </select>
            </div>

            <div class="col-span-1">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    OK
                </button>
            </div>
        </form>

        <div class="grid grid-cols-4 gap-10">
            @forelse($articles as $article)
                <div class="col-span-full md:col-span-1 rounded-md bg-gray-800 overflow-hidden">
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
                            <span class="ml-4 text-sm italic text-gray-300"><i class="fas fa-clock fa-fw fa-md"></i> {{ $article->created_at->format('d M H:i') }}</span>
                        </div>
                        <div class="grid grid-cols-6 gap-2 mt-4">
                            <div class="col-span-4">
                                <a href="{{ route('articles.show', $article) }}" class="h-full transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark focus:outline-none">
                                    Read
                                </a>
                            </div>
                            @can('manage-news-articles')
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
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <span class="text-sm italic text-gray-300">No news articles yet...</span>
            @endforelse
        </div>

        {{ $articles->onEachSide(1)->withQueryString()->links() }}
    </div>
@endsection
