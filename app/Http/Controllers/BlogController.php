<?php

namespace App\Http\Controllers;

use ModernPUG\FeedReader\BlogController as BlogTrait;

class BlogController extends Controller
{
    use BlogTrait;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }
}
