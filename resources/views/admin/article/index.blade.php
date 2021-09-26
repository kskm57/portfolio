@extends('layouts.admin')



@section('title', '検索結果')



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
        <div>
            <h1>検索結果</h1>
        </div>
        <div class="row">
            <div class="list-article col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="10%">名前</th>
                                <th width="5%">時間</th>
                                <th width="20%">投稿日</th>                                
                                <th width="10%">いいね数</th>
                                <th width="40%">内容</th>
                                <th width="10%">詳細へ</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <th>{{ $article->id }}</th>
                                    <td>{{ \Str::limit($article->name, 100) }}</td>
                                    <td>{{ \Str::limit($article->time, 100) }}</td>
                                    <td>{{ \Str::limit($article->created_at, 250) }}</td>
                                    <td>{{ \Str::limit($article->number, 250) }}</td>  {{--あとでfavoritesにする？--}}
                                    <td>{{ \Str::limit($article->contents, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\ArticleController@detail', ['id' => $article->id]) }}">詳細</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection