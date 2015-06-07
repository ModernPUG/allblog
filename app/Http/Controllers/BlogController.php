<?php namespace App\Http\Controllers;

use App\Blog;
use App\BlogModel;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Feed;
use Illuminate\Database\QueryException;
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
    public function __construct(Blog $blog, Feed $feed, \App\Uri $uri)
    {
        $this->middleware('auth', ['except' => ['index']]);
        $this->blog = $blog;
        $this->feed = $feed;
        $this->uri = $uri;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $blogs = $this->blog->all() ;
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
        $rssUrl = $request->input('url');

        if(empty($rssUrl)) {
            return redirect('/blog')->with('message', '누락된 값이 있습니다.');
        }

        try {

            $feed = $this->feed->loadRss($rssUrl);
            $title = $feed->title;
            $hostUrl = $this->uri->getHost($rssUrl);

            $this->blog->create([
                'title' => $title,
                'url' => $rssUrl,
                'host' => $hostUrl
            ]);

        } catch (QueryException $e) {

            $message = "데이터베이스 오류입니다.";

            if ($e->getCode() === '23000') {
                $message = "중복된 url이거나 title입니다";
            }

            return redirect('/blog')->with('message', $message);
        } catch (\Exception $e) {
            if($e->getMessage() == 'String could not be parsed as XML') {
                return redirect('/blog')->with('message', '부적합한 RSS 주소 입니다.');
            } else {
                return redirect('/blog')->with('message', '알 수 없는 예외 발생.');
            }
        }

        return redirect('/blog');
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
