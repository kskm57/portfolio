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
                            <input type="text" class="form-control" name="name" value="{{ $a_name }}">
                        </div>
                        <label class="col-md-2">所要時間</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="time" value="{{ $a_time }}">
                        </div>
                        <label class="col-md-2">プレイ人数</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="number" value="{{ $a_number }}">
                        </div>
                        <label class="col-md-2">場所</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="place" value="{{ $a_place }}">
                        </div>
                        <label class="col-md-2">投稿者</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="user" value="{{ $a_user }}">
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


