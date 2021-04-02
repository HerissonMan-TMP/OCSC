@inject("carbon", "\Carbon\Carbon")

@extends("layouts.app")

@section("title", "{$article->title}")

@section("content")

<div class="flex flex-col justify-center items-center bg-fixed bg-cover bg-center py-52" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url({{ $article->banner_url ?? 'https://i.imgur.com/kZ3YjwR.png' }});">
        <div class="text-center grid gap-4">
            <h1 class="text-5xl m-0">{{ $article->title }}</h1>
            <div class="flex justify-center">
                <span class="text-sm italic text-gray-300">
                    <i class="fas fa-user fa-fw fa-md"></i> Posted by
                    @if($article->postedByUser)
                    <span class="font-bold" style="color: {{ $article->postedByUser->roles->first()->color }}">{{ $article->postedByUser->name }} ({{ $article->postedByUser->roles->first()->name }})</span>
                    @else
                    <span>Unkown User</span>
                    @endif
                </span>
                <span class="ml-4 text-sm italic text-gray-300"><i class="fas fa-clock fa-fw fa-md"></i> {{ $carbon->parse($article->created_at)->format('d M H:i') }}</span>
            </div>
        </div>
    </div>
    <div class="max-w-7xl px-4 py-5 md:p-6 mx-auto my-16 grid grid-cols-6 gap-20">
        <div class="col-span-full md:col-span-4 article-content">
            @markdown($article->content)
        </div>
        <div class="col-span-full md:col-span-2 bg-gray-800 rounded-md p-6">
            <div class="border-b border-gray-600">
                <h3 class="inline-block m-0 border-b-2 border-primary">Latest Articles</h3>
            </div>

            <div>
                @forelse($latestArticles as $latestArticle)
                <div class="mt-8">
                    <div class="text-sm mb-2">
                        <img class="max-w-full h-auto" src="{{ $latestArticle->banner_url ?? 'https://static.truckersmp.com/images/bg/ets.jpg' }}" alt="News Article Banner">
                    </div>
                    <a href="{{ route('articles.show', $latestArticle) }}">
                        <h3 class="m-0 mb-4 text-sm tracking-wide font-bold text-gray-400 uppercase">
                            {{ $latestArticle->title }}
                        </h3>
                    </a>
                    <div class="mt-1 flex justify-between">
                        <span class="text-sm italic text-gray-300">
                            <i class="fas fa-user fa-fw fa-md"></i>
                            @if($latestArticle->postedByUser)
                            <span class="font-bold" style="color: {{ $latestArticle->postedByUser->roles->first()->color }}">{{ $latestArticle->postedByUser->name }}</span>
                            @else
                            <span>Unkown User</span>
                            @endif
                        </span>
                        <span class="ml-4 text-sm italic text-gray-300"><i class="fas fa-clock fa-fw fa-md"></i> {{ $carbon->parse($latestArticle->created_at)->format('d M H:i') }}</span>
                    </div>
                </div>
                @empty
                <span class="text-sm italic text-gray-300">No articles yet...</span>
                @endforelse
            </div>
        </div>
    </div>
@endsection
