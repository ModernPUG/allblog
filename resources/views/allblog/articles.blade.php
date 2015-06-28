@extends('allblog.app')

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
                <a href="{{$article->link}}" target="_blank">
                    <h2 class="post-title">
                        {{$article->title}}
                    </h2>
                    <h3 class="post-subtitle">
                        {{strip_tags($article->description)}}
                    </h3>
                </a>
                <p class="post-meta">Posted by <a href="{{$article->blog->site_url}}" target="_blank">{{$article->blog->title}}</a> on {{$article->published_at}}</p>
            </div>
            <hr>
            @endforeach
            <!-- Pager -->
            <?php echo $articles->render();?>
        </div>

    </div>
</div>
@endsection
