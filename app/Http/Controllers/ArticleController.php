<?php

namespace App\Http\Controllers;

use ModernPUG\FeedReader\IReader;

class ArticleController extends Controller
{
    public function index(IReader $reader)
    {
        $articles = $reader->recentUpdatedArticles();
        $blogs = $reader->blogs();

        return view('fdrdr::articles.index', compact('articles', 'blogs'));
    }
}
