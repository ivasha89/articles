<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MainController extends Controller
{
    /**
     * Get List of last 6 articles
     * @return \Illuminate\View\View
     */
    public function index() 
    {
        $lastArticles = Article::last(6);
        return view('articles.front')
            ->witharticles($lastArticles);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function showList()
    {
        if (session('tag_id')) {
            $tag = Tag::find(session('tag_id'));
            $articles = $tag->articles()->paginate(10);
        }
        else {
            $articles = Article::paginate(10);
        }
        return view('articles.index')
            ->witharticles($articles);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id) 
    {
        try {
            $article = Article::findOrFail($id);
            $tags = $article->tags;
        }
        catch(ModelNotFoundException $exception) {
            $article = [
                'error' => 'Такой статьи не найдено'
            ];
        }

        return view('articles.view')
            ->witharticle($article)
            ->withtags($tags);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addComment(Request $request) 
    {
        $request->validate([
            'subject' => 'required|min:3',
            'body' => 'required|min:3'
        ]);
        Comment::create($request->all());
        return [
            'result' => 'Ваше сообщение успешно отправлено'
        ];
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeArticle(Request $request) 
    {
        try {
            $article = Article::findOrFail($request->article_id);
            $article->likes++;
            $article->save();
        }
        catch(ModelNotFoundException $exception) {
            $article = [
                'error' => 'Не найдена статья'
            ];
        }
        return $article;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function viewArticle(Request $request) 
    {
        try {
            $article = Article::findOrFail($request->article_id);
            $article->views++;
            $article->save();
        }
        catch(ModelNotFoundException $exception) {
            $article = [
                'error' => 'Не найдена статья'
            ];
        }
        return $article;
    }

    /**
     * 
     */
    public function tagArticles($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $articles = $tag->articles()->paginate(10);
        }
        catch(ModelNotFoundException $exception) {
            $articles = [
                'error' => 'Тэг не найден'
            ];
        }

        return redirect('articles')
            ->with('tag_id', $id);
    }
}
