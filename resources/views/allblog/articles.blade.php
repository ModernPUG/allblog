@extends('allblog.app')


@section('jumbotron')
<h1>join('♥', $blogs);</h1>
<hr class="small">
<span class="subheading">PHP 블로그 글모음</span>
@endsection


@section('content')
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if(Session::has('message'))
            {{Session('message')}}
            @endif

            @foreach($articles as $article)
            <div class="post-preview">
                <a href="{{ url("article/{$article->id}") }}" target="_blank">
                    <h2 class="post-title">
                        {{$article->title}}
                    </h2>
                    <h3 class="post-subtitle">
                        {{mb_strcut(strip_tags($article->description),0,150).'...'}}
                    </h3>
                </a>
                @if(isset($article->blog))
                <p class="post-meta">Posted by <a href="{{$article->blog->site_url}}" target="_blank">{{$article->blog->title}}</a> on {{$article->published_at}}</p>
                @endif
            </div>
            <hr>
            @endforeach
            <!-- Pager -->
            <?php echo $articles->render();?>
        </div>

    </div>
</div>
@endsection
