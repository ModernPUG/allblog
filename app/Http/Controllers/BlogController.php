<?php namespace App\Http\Controllers;

use App\Blog;
use App\BlogModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Feed;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Wandu\Http\Uri;

class BlogController extends Controller {

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
	public function index()
	{
		$blogs = Blog::all();
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
	public function store(Request $request)
	{
        $url = $request->input('url');
        $feed = Feed::loadRss($url);

        $uri = new Uri($url);

        try {
            Blog::create([
                'title' => $feed->title,
                'url' => $url,
                'host' => $uri->getHost()
            ]);

        } catch (QueryException $e) {

            $message = "데이터베이스 오류입니다.";

            if ($e->getCode() === '23000') {
                $message = "중복된 url이거나 title입니다";
            }

            Session::flash('message', $message);
        }

        return redirect('/blog');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
