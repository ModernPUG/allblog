<?php namespace App\Http\Controllers;

use App\Reader as Reader;

class ArticleController extends Controller
{
    public function index(Reader $reader)
    {
        $articles = $reader->recentUpdatedArticles();
        $blogs = $reader->blogs();
        return view('articles.index', compact('articles', 'blogs'));
    }
}
