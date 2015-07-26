@extends('allblog.app')


@section('jumbotron')
<h1>PHP Blog List</h1>
<hr class="small">
<span class="subheading">PHP 블로그 목록</span>
@endsection


@section('content')
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if(Session::has('message'))
            {{Session('message')}}
            @endif

            @foreach($blogs as $blog)
                <div><a href="{{$blog->site_url}}"><span style="font-weight: bold">{{$blog->title}}</span></a></div>
            @endforeach
        </div>

    </div>
</div>
@endsection
