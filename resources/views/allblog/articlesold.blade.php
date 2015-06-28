@extends('allblog.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-1">

            @if(Session::has('message'))
            {{Session('message')}}
            @endif

            <ul class="articleList">
                @foreach($articles as $article)
                <li>
                    <p class="title"><a href="{{$article->link}}"><span style="font-weight: bold">{{$article->title}}</span></a></p>
                    <p class="info">{{$article->blog->title}} {{$article->published_at}}</p>
                    <p class="description">{{strip_tags($article->description)}}</p>
                </li>
                @endforeach
            </ul>

            <?php echo $articles->render();?>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    블로그 목록
                </div>
                <div class="panel-body">
                    <ul class="blogList">
                        @foreach($blogs as $blog)
                        <li>
                            @if($blog->site_url)
                            <a href="{{$blog->site_url}}">{{$blog->title}}</a>
                            @else
                            {{$blog->title}}
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
