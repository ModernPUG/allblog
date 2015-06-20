<?php namespace App\Http\Controllers;

use App\Blog;
use App\Reader as Reader;
use Feed;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blog;
    protected $feed;
    protected $uri;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Reader $reader)
    {
        $blogs = $reader->blogs();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("blogs.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Reader $reader, Request $request, Blog $blog, Feed $feed, \App\Uri $uri)
    {
        return $reader->insertFeed($request, $blog, $feed, $uri);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
