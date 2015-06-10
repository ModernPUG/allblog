@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">blog 추가하기</div>

                    <div class="panel-body">
                        <form method="post" action="{{ url('/blog') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-md-4 control-label">blog url</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="url" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="atom"> Atom feed
                                    </label>
                                </div>
                                <label class="col-md-4 control-label">host url(feed url 과 다를 경우 입력)</label>
                                <div class="col-md-6">
                                   <input type="text" class="form-control" name="hostUrl" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
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
