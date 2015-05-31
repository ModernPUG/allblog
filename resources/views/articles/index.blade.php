@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">글 목록</div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            {{Session('message')}}
                        @endif
                    </div>
                    <div class="panel-body">
                        <ul>
                        @foreach($articles as $article)
                            <li><span style="font-weight: bold">{{$article->blog->title}}<{{$article->blog->created_at}}></span><a href="//{{$article->blog->host}}{{$article->link}}"><span style="font-weight: bold">{{$article->title}}</span></a>
                            {{strip_tags($article->description)}}
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
