@extends('layouts.admin')



@section('title', 'ユーザーページ')



@section('content')
    <div class="container">
    <div>
        <h1>あなたがフォローている人一覧</h1>
    </div>
    <div>
        <h1>あなたをフォローしている人一覧</h1>
    </div>
    <div>
        <h1>いいねしたゲーム記事一覧</h1>
    </div>
    <div>
        <h1>投稿したゲーム記事一覧</h1>
    </div>
        <div class="row">
            <div class="list-article col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="10%">名前</th>
                                <th width="20%">投稿日</th>                                
                                <th width="10%">いいね数</th>
                                <th width="40%">内容</th>
                                <th width="10%">詳細へ</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $article)
                                <tr>
                                    <th>{{ $article->id }}</th>
                                    <td>{{ \Str::limit($article->name, 100) }}</td>
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
    <div>
        <h1>投稿した書き込み一覧</h1>
    </div>
    </div>
@endsection