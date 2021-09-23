@extends('layouts.admin')



@section('title', '検索画面')



@section('content')
    <div class="container">
        <div>
            <h1>ゲームを探す</h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ action('Admin\ArticleController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">ゲーム名</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_name" value="{{ $cond_name}}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <a href="{{ action('Admin\ArticleController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
        </div>        
    </div>
@endsection


