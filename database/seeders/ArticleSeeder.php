<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->truncate();

        $article = Article::create([
            'title' => 'Answer our community survey',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'banner_url' => 'https://i.imgur.com/kZ3YjwR.png',
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(2),
        ]);
        $article->postedByUser()->associate(4);
        $article->save();

        $article = Article::create([
            'title' => 'MEGA Convoy - 28/05/2021 19:00 UTC',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'banner_url' => 'https://i.imgur.com/kZ3YjwR.png',
            'created_at' => now()->subDays(10),
            'updated_at' => now()->subDays(10),
        ]);
        $article->postedByUser()->associate(2);
        $article->save();

        $article = Article::create([
            'title' => 'Update of our Convoy Rules',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'banner_url' => 'https://i.imgur.com/kZ3YjwR.png',
            'created_at' => now()->subDays(15),
            'updated_at' => now()->subDays(15),
        ]);
        $article->postedByUser()->associate(1);
        $article->save();

        $article = Article::create([
            'title' => 'New Partnership | Welcome to SimNews!',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'banner_url' => 'https://i.imgur.com/kZ3YjwR.png',
            'created_at' => now()->subDays(20),
            'updated_at' => now()->subDays(20),
        ]);
        $article->postedByUser()->associate(4);
        $article->save();
    }
}
