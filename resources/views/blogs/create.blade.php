@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">blog 추가하기</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="{{ url('/blog') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-md-3 control-label">RSS URL</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="url" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="atom"> Atom feed 여부
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">블로그 URL</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="hostUrl" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">추가</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
