<?php namespace App\Http\Controllers;

use App\Blog;
use App\BlogModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Feed;

use Illuminate\Http\Request;
use webignition\WebsiteRssFeedFinder\WebsiteRssFeedFinder;

class BlogController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return 'here';
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
        $finder = new WebsiteRssFeedFinder();
        $finder -> setRootUrl($url);

        $feedUrl = $finder->getRssFeedUrl();
        $feed = Feed::loadRss($feedUrl);

        $blog = Blog::create([
            'title'=>$feed->title,
            'url'=>$url
        ]);
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
