<?php namespace App\Http\Controllers;

use App\Article;
use App\Blog;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('blog')->orderBy('created_at', 'desc')->paginate(10);

        $blogs = Blog::orderBy('title', 'asc')->get();

        return view('articles.index', compact('articles', 'blogs'));
    }
}
