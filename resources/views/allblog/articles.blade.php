@extends('allblog.app')

@section('content')
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-1">

            @if(Session::has('message'))
            {{Session('message')}}
            @endif

            @foreach($articles as $article)
            <div class="post-preview">
                <a href="{{$article->link}}">
                    <h2 class="post-title">
                        {{$article->title}}
                    </h2>
                    <h3 class="post-subtitle">
                        {{strip_tags($article->description)}}
                    </h3>
                </a>
                <p class="post-meta">Posted by <a href="#">{{$article->blog->title}}</a> on {{$article->published_at}}</p>
            </div>
            <hr>
            @endforeach
            <!-- Pager -->
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
