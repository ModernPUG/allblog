<?php namespace App\Http\Controllers;

use App\KooReader as Reader;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index(Reader $reader)
    {
        $blogs = $reader->blogs();
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view("blogs.create");
    }

    public function store(Reader $reader, Request $request)
    {
        $hostUrl = $request->input('site_url');
        $feedUrl = $request->input('feed_url');
        $type = $request->input('type');

        $redirect = redirect('/blog');
        if ( !$reader->insertFeed($hostUrl, $feedUrl, $type) ) {
            $redirect->with('message', $reader->getLastError());
        }
        return $redirect;
    }
}
