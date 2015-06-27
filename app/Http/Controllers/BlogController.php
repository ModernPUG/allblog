<?php

namespace App\Http\Controllers;

use Koojunho\Reader\IReader;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index(IReader $reader)
    {
        $blogs = $reader->blogs();

        return view('blogs.index', compact('blogs'));
    }

    public function create(IReader $reader)
    {
        return view($reader->getCreateViewName());
    }

    public function store(IReader $reader, Request $request)
    {
        $redirect = redirect('/blog');
        if (!$reader->insertFeed($request->all())) {
            $redirect->with('message', $reader->getLastError());
        }

        return $redirect;
    }
}
