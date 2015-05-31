@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-1">
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
                        <?php echo $articles->render(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-offset-1">
                <ul>
                @foreach($blogs as $blog)
                    <li>
                    @if($blog->host)
                        <a href="//{{$blog->host}}">{{$blog->title}}</a>
                    @else
                        {{$blog->title}}
                    @endif
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
