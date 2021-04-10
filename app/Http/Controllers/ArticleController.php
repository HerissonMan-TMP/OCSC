<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use Auth;
use Gate;

/**
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{
    /**
     * Display all the articles.
     */
    public function index()
    {
        $articles = Article::with('postedByUser.roles')->get();

        return view('articles.index')
                ->with(compact('articles'));
    }

    /**
     * Display the page to manage the articles.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function manage()
    {
        Gate::authorize('manage-news-articles');

        $articles = Article::with('postedByUser.roles')->get();

        return view('articles.manage')
                ->with(compact('articles'));
    }

    /**
     * Display the form to create a new article.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        Gate::authorize('manage-news-articles');

        return view('articles.create');
    }

    /**
     * Store a new article in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreArticleRequest $request)
    {
        Gate::authorize('manage-news-articles');

        $article = Auth::user()->articles()->create($request->validated());

        return redirect()->route('articles.show', $article);
    }

    /**
     * Display the given article.
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
     * Display the form to edit the given article.
     *
     * @param Article $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Article $article)
    {
        Gate::authorize('manage-news-articles');

        $article = $article->load('postedByUser.roles');

        return view('articles.edit')
                ->with(compact('article'));
    }

    /**
     * Update the given article.
     *
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        Gate::authorize('manage-news-articles');

        $article->update($request->validated());

        return redirect()->route('articles.show', $article);
    }

    /**
     * Delete the given article.
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
