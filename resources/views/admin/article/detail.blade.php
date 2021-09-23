@extends('layouts.admin')



@section('title', 'ゲーム詳細')



@section('content')
    <div class="container">
        <h1>ゲーム詳細</h1>
        <div class="row">
            <a href="{{ action('Admin\ArticleController@edit', ['id' => $article_detail->id]) }}"
            role="button" class="btn btn-primary">編集</a>
            <a href="{{ action('Admin\ArticleController@delete', ['id' => $article_detail->id]) }}"
            role="button" class="btn btn-primary">削除</a>
            
            <div class="list-article col-md-12 mx-auto">
                <div class="row">
                    <div class="text-group row">
                        <text width="20%">ゲーム名</text>
                        <text width="10%">{{ $article_detail->name }}</text>    
                    </div>
                    <div class="text-group row">
                        <text width="20%">所要時間</text>
                        <text width="10%">{{ $article_detail->time }}</text>    
                    </div>
                    <div class="text-group row">
                        <text width="20%">プレイ人数</text>
                        <text width="10%">{{ $article_detail->number }}</text>    
                    </div>
                    <div class="text-group row">
                        <text width="20%">場所</text>
                        <text width="10%">{{ $article_detail->place }}</text>    
                    </div>
                    <div class="text-group row">
                        <text width="20%">内容</text>
                        <text width="10%">{{ $article_detail->contents }}</text>    
                    </div>
                    <div class="text-group row">
                        <text width="20%">投稿日</text>
                        <text width="10%">{{ $article_detail->created_at }}</text>
                    </div>
                    <div class="text-group row">
                        <text width="20%">更新日</text>
                        <text width="10%">{{ $article_detail->updated_at }}</text>
                    </div>
                    <div class="text-group row">
                        <text width="20%">投稿者</text>
                        <text width="10%">{{ $article_detail->id }}</text>    {{--ユーザーidからユーザー名を取得？---}}
                    </div>
                    {{--画像を表示させるdiv作る--}}
                </div>
            </div>
            <a href="{{ action('Admin\ArticleController@home') }}"
            role="button" class="btn btn-primary">検索画面へ</a>
        </div>
    </div>
@endsection