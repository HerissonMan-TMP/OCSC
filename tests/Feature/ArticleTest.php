<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Article;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the news (articles index for public) are accessible by everyone.
     */
    public function testNewsAreAccessible()
    {
        $response = $this->get(
            route('news')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an article is readable by everyone.
     */
    public function testArticleIsReadable()
    {
        $article = Article::factory()->create();

        $response = $this->get(
            route(
                'articles.show', $article
            )
        );

        $response->assertStatus(200);
    }

    /**
     * Test that the articles index is not accessible by visitors.
     */
    public function testArticlesIndexIsNotAccessibleByVisitors()
    {
        $response = $this->get(
            route('staff.articles.index')
        );

        $response->assertRedirect(route('login.show-form'));
    }

    /**
     * Test that the articles index is accessible by staff members.
     */
    public function testArticlesIndexIsAccessibleByStaffMembers()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.articles.index')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that a non-authorized user cannot see the creation page.
     */
    public function testANonAuthorizedUserCannotSeeTheCreationPage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.articles.create')
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot store an article.
     */
    public function testANonAuthorizedUserCannotStoreAnArticle()
    {
        $user = User::factory()->create();

        $articleData = Article::factory()->make()->toArray();

        $response = $this->actingAs($user)->post(
            route('staff.articles.store'),
            $articleData
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot see the edition page.
     */
    public function testANonAuthorizedUserCannotSeeTheEditionPage()
    {
        $user = User::factory()->create();

        $article = Article::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.articles.edit', $article)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot update an article.
     */
    public function testANonAuthorizedUserCannotUpdateAnArticle()
    {
        $user = User::factory()->create();

        $article = Article::factory()->create();
        $editedArticleData = Article::factory()->make()->toArray();

        $response = $this->actingAs($user)->patch(
            route('staff.articles.update', $article),
            $editedArticleData
        );

        $response->assertStatus(403);
    }

    /**
     * Test that a non-authorized user cannot delete an article.
     */
    public function testANonAuthorizedUserCannotDeleteAnArticle()
    {
        $user = User::factory()->create();

        $article = Article::factory()->create();

        $response = $this->actingAs($user)->delete(
            route('staff.articles.destroy', $article)
        );

        $response->assertStatus(403);
    }

    /**
     * Test that an authorized user can see the creation page.
     */
    public function testAnAuthorizedUserCanSeeTheCreationPage()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage news articles',
                        'slug' => 'manage-news-articles',
                    ]))
            )
            ->create();

        $response = $this->actingAs($user)->get(
            route('staff.articles.create')
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can store an article.
     */
    public function testAnAuthorizedUserCanStoreAnArticle()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage news articles',
                        'slug' => 'manage-news-articles',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $articleData = Article::factory()->make();

        $response = $this->actingAs($user)->post(
            route('staff.articles.store'),
            $articleData->toArray()
        );

        $this->assertDatabaseHas('articles', [
            'title' => $articleData['title'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('articles.show', Article::latest()->first()));
    }

    /**
     * Test that an authorized user can see the edition page.
     */
    public function testAnAuthorizedUserCanSeeTheEditionPage()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage news articles',
                        'slug' => 'manage-news-articles',
                    ]))
            )
            ->create();

        $article = Article::factory()->create();

        $response = $this->actingAs($user)->get(
            route('staff.articles.edit', $article)
        );

        $response->assertStatus(200);
    }

    /**
     * Test that an authorized user can update an article.
     */
    public function testAnAuthorizedUserCanUpdateAnArticle()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage news articles',
                        'slug' => 'manage-news-articles',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $article = Article::factory()->create();
        $editedArticleData = Article::factory()->make();

        $response = $this->actingAs($user)->patch(
            route('staff.articles.update', $article),
            $editedArticleData->toArray()
        );

        $this->assertDatabaseHas('articles', [
            'title' => $editedArticleData['title'],
        ]);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('articles.show', $article));
    }

    /**
     * Test that an authorized user can delete an article.
     */
    public function testAnAuthorizedUserCanDeleteAnArticle()
    {
        $user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->for(Group::factory())
                    ->hasAttached(Permission::create([
                        'name' => 'Manage news articles',
                        'slug' => 'manage-news-articles',
                    ]))
            )
            ->create();

        $numberOfActivities = Activity::count();

        $article = Article::factory()->create();

        $response = $this->actingAs($user)->delete(
            route('staff.articles.destroy', $article)
        );

        $this->assertDeleted($article);
        $this->assertDatabaseCount('activities', $numberOfActivities + 1);
        $response->assertRedirect(route('staff.articles.index'));
    }
}
