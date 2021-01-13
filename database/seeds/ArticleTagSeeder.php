<?php

use App\Tag;
use App\Article;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();
        $articles = Article::all();

        $articles->each(function($article) use ($tags) {
            $tagsToAttach = $tags->random(rand(2,3))->pluck('id')->toArray();
            in_array(21, $tagsToAttach) ? : array_push($tagsToAttach,21);
            $article->tags()->attach($tagsToAttach);
        });
    }
}
