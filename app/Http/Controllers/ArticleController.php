<?php

namespace App\Http\Controllers;

use App\Reader\IReader;

class ArticleController extends Controller
{
    public function index(IReader $reader)
    {
        $articles = $reader->recentUpdatedArticles();
        $blogs = $reader->blogs();

        return view('articles.index', compact('articles', 'blogs'));
    }
}
