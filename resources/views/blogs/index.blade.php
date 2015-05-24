@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">blog 목록</div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            {{Session('message')}}
                        @endif
                    </div>
                    <div class="panel-body">
                        <ul>
                        @foreach($blogs as $blog)
                            <li><span style="font-weight: bold">{{$blog->title}}</span>{{$blog->url}}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
