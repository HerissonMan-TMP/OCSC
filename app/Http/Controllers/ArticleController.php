<?php

namespace App\Http\Controllers;

use App\Filters\ArticleFilters;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\ActivityType;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{
    /**
     * Display all the articles for the public.
     * @param ArticleFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function news(ArticleFilters $filters)
    {
        $articles = Article::filter($filters)->with('postedByUser.roles')->paginate(12);

        return view('articles.news')
                ->with(compact('articles'));
    }

    /**
     * Display all the articles.
     *
     * @param ArticleFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(ArticleFilters $filters)
    {
        $articles = Article::filter($filters)->with('postedByUser.roles')->paginate(12);

        return view('articles.index')
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
     * @param StoreArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreArticleRequest $request)
    {
        Gate::authorize('manage-news-articles');

        $article = Auth::user()->articles()->create($request->validated());

        activity(ActivityType::CREATED)
                ->subject('fas fa-newspaper', "Article #{$article->id}")
                ->description("Title: {$article->title}")
                ->log();

        flash("You have successfully posted a new article!")->success();

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

        activity(ActivityType::UPDATED)
                ->subject('fas fa-newspaper', "Article #{$article->id}")
                ->description("Title: {$article->title}")
                ->log();

        flash("You have successfully updated the article '{$article->title}'!")->success();

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

        activity(ActivityType::DELETED)
                ->subject('fas fa-newspaper', "Article #{$article->id}")
                ->description("Title: {$article->title}")
                ->log();

        flash("You have successfully deleted the article '{$article->title}'!")->success();

        return redirect()->route('staff.articles.index');
    }
}
