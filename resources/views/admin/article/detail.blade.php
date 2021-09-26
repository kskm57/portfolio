@extends('layouts.admin')



@section('title', 'ゲーム詳細')



@section('content')
    <div class="container">
        <h1>ゲーム詳細</h1>
        <div class="row">
            @if($article_detail->user->id == Auth::id()){{--表示している記事のユーザーidがアクセス者のidなら--}}
            <a href="{{ action('Admin\ArticleController@edit', ['id' => $article_detail->id]) }}"
            role="button" class="btn btn-primary">編集</a>
            <a href="{{ action('Admin\ArticleController@delete', ['id' => $article_detail->id]) }}"
            role="button" class="btn btn-primary">削除</a>
            @endif
            
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
                        <text width="10%">{!! nl2br(e($article_detail->contents)) !!}</text>    
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
                        <text width="10%">{{ $article_detail->user->name }}</text>    {{--ユーザーidからユーザー名を取得？---}}
                    </div>
                    {{--画像を表示させるdiv作る--}}
                </div>
            </div>
            <div class="col-md-8 mx-auto">
                <form action="{{ action('Admin\CommentController@create') }}" method="post" 
enctype="multipart/form-data">
                    
                    @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-2">コメント投稿</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="contents" value="{{ 'contents' }}">
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="id" value="{{ $article_detail->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="コメント">
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <h1>コメント一覧</h1>    
            </div>
            <div class="row">
                <div class="list-article col-md-12 mx-auto">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>コメント</th>
                                <th>投稿者</th>
                                <th>削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                            <tr>
                                <td>{{$comment->contents}}</td>
                                <td>{{$comment->user->name}}</td>
                                <td>
                                    <div>
                                        <a href="{{ action('Admin\CommentController@delete', 
['id' => $comment->id]) }}">削除</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="{{ action('Admin\ArticleController@home') }}"
            role="button" class="btn btn-primary">検索画面へ</a>
        </div>
    </div>
@endsection