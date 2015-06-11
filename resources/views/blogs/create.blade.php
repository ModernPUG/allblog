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
                                <label class="col-md-3 control-label">FEED URL</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="feed_url" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Type</label>
                                <div class="col-md-6">
                                    <select name="type" class="form-control">
                                        <option value="rss">RSS</option>
                                        <option value="atom">ATOM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">사이트 URL</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="site_url" value="">
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
