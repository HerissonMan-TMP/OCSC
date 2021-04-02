<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use Auth;
use Gate;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('postedByUser.roles')->get();

        return view('articles.index')
                ->with(compact('articles'));
    }

    public function manage()
    {
        Gate::authorize('manage-news-articles');

        $articles = Article::with('postedByUser.roles')->get();

        return view('articles.manage')
                ->with(compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('manage-news-articles');

        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreArticleRequest $request)
    {
        Gate::authorize('manage-news-articles');

        $article = Article::create($request->validated());
        $article->postedByUser()->associate(Auth::user()->id);
        $article->save();

        return redirect()->route('articles.show', $article);
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Article $article)
    {
        $article = $article->load('postedByUser.roles');
        $latestArticles = Article::latest()->take(3)->with('postedByUser.roles')->get();

        return view('articles.show')
                ->with(compact('article'))
                ->with(compact('latestArticles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        Gate::authorize('manage-news-articles');

        $article = $article->load('postedByUser.roles');

        return view('articles.edit')
                ->with(compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        Gate::authorize('manage-news-articles');

        $article->update($request->validated());

        return redirect()->route('articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        Gate::authorize('manage-news-articles');

        $article->delete();

        return redirect()->route('staff.articles.manage');
    }
}
