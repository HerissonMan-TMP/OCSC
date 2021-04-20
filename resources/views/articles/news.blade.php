@extends("layouts.app")

@section("title", "Articles")

@section("content")

    <div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center px-2 md:px-0 py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://i.imgur.com/kZ3YjwR.png');">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0 capitalize"><i class="flex-shrink-0 fas fa-newspaper fa-fw"></i> News articles</h1>
        </div>
    </div>

    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16">
        <form action="" method="GET" class="mb-10 p-6 bg-gray-800 rounded-md grid grid-cols-10 gap-4">
            <div class="col-span-full md:col-span-1">
                <input type="text" name="by" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="By" value="{{ request('by') }}">
            </div>

            <div class="col-span-full md:col-span-2">
                <input type="text" name="title" class="text-gray-300 bg-gray-700 focus:ring-primary-dark focus:border-primary-dark block w-full shadow-sm md:text-sm border-gray-600 rounded-md" placeholder="Title" value="{{ request('title') }}">
            </div>

            <div class="col-span-full md:col-span-1">
                <select name="sortByCreatedAt" class="capitalize text-gray-300 bg-gray-700 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-dark focus:border-primary-dark md:text-sm">
                    <option @if(request('sortByCreatedAt') === 'desc') selected @endif value="desc">Latest</option>
                    <option @if(request('sortByCreatedAt') === 'asc') selected @endif value="asc">Oldest</option>
                </select>
            </div>

            <div class="col-span-full md:col-span-1">
                <button type="submit" class="w-full md:w-auto transition duration-200 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-gray-700 bg-primary hover:text-gray-700 hover:bg-primary-dark focus:outline-none">
                    OK
                </button>
            </div>
        </form>

        <div class="grid grid-cols-3 gap-5 md:gap-20">
            @forelse($articles as $article)
                <div class="col-span-full md:col-span-1 rounded-md bg-gray-900 overflow-hidden">
                    <div class="h-52 text-sm mb-6 bg-cover bg-center" style="background-image: url({{ $article->banner_url ?? 'https://static.truckersmp.com/images/bg/ets.jpg' }});">
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
                                <span>Anonymous</span>
                            @endif
                        </span>
                            <span class="ml-4 text-sm italic text-gray-300"><i class="fas fa-clock fa-fw fa-md"></i> {{ $article->created_at->format('d M H:i') }}</span>
                        </div>
                        <a href="{{ route('articles.show', $article) }}" class="mt-4 transition duration-200 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-semibold text-gray-700 bg-primary hover:text-gray-800 hover:bg-primary-dark">
                            Read
                        </a>
                    </div>
                </div>
            @empty
                <span class="text-sm italic text-gray-300">No news articles yet...</span>
            @endforelse
        </div>

        {{ $articles->onEachSide(1)->withQueryString()->links() }}
    </div>
@endsection
