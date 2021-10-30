@extends('layouts.admin')



@section('title', 'ゲーム詳細')



@section('content')
    <div class="container">
        <div class="row">
        <h1>ゲーム詳細</h1>    
        </div>
        <div class="row">
            @if(Auth::check()){{--ユーザーがログインしているなら--}}
                @if(isset($favorite)){{--ユーザーがこの記事にいいねしているなら--}}
                <form action="{{ action('User\FavoriteController@destroy') }}" 
                method="POST" class="btn btn-primary">
                    <input type="hidden" name="article_id" value="{{$article_detail->id}}">
                    {{ csrf_field() }}
                    {{--@method('DELETE')--}}
                    <input type="submit" class="btn btn-primary" value="いいね解除">
                </form>
                @else{{--ユーザーがこの記事にいいねしていないなら--}}
                <form action="{{ action('User\FavoriteController@store') }}" method="POST" class="btn btn-primary">
                    <input type="hidden" name="article_id" value="{{$article_detail->id}}">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="いいね">
                </form>
                @endif
            @endif
        </div>
        <div class="row">
            @if(!empty($article_detail->user->id))
                @if($article_detail->user->id == Auth::id()){{--アクセス者が掲示板投稿作成者なら--}}
                <a href="{{ action('User\ArticleController@edit', ['id' => $article_detail->id]) }}"><span class="mgr-10">編集</span></a>
                <a href="{{ action('User\ArticleController@delete', ['id' => $article_detail->id]) }}">削除</a>
                @endif
            @endif
        </div>
        <div class="col-md-10 mx-auto details">
            <div class="text-group row">
                <div class="col-md-2 detail_item">ゲーム名</div>
                <div class="col-md-8 detail_content">{{ $article_detail->name }}</div>  
            </div>
            <div class="text-group row">
                <div class="col-md-2 detail_item">所要時間</div>
                <div class="col-md-8 detail_content">{{ $article_detail->time }}</div>
            </div>
            <div class="text-group row">
                <div class="col-md-2 detail_item">プレイ人数</div>
                <div class="col-md-8 detail_content">{{ $article_detail->number }}</div>  
            </div>
            <div class="text-group row">
                <div class="col-md-2 detail_item">場所</div>
                <div class="col-md-8 detail_content">{{ $article_detail->place }}</div>  
            </div>
            <div class="text-group row">
                <div class="col-md-2 detail_item">内容</div>
                <div class="col-md-8 detail_content">{!! nl2br(e($article_detail->contents)) !!}</div>
            </div>
            <div class="text-group row">
                <div class="col-md-2 detail_item">投稿日</div>
                <div class="col-md-8 detail_content">{{ $article_detail->created_at }}</div>
            </div>
            <div class="text-group row">
                <div class="col-md-2 detail_item">更新日</div>
                <div class="col-md-8 detail_content">{{ $article_detail->updated_at }}</div>
            </div>
            <div class="text-group row">
                <div class="col-md-2 detail_item">いいね数</div>
                <div class="col-md-8 detail_content">{{ $article_detail->favorites->count() }}</div>
            </div>                    
            <div class="text-group row">
                <div class="col-md-2 detail_item">投稿者</div>
                    @if(!empty($article_detail->user->id))
                        <div class="col-md-8 detail_content"><a href="{{ action('UserController@show', ['id'=>$article_detail->user->id]) }}">{{ $article_detail->user->name }}</a></div>
                    @else
                        <div class="col-md-8 detail_content">{{ "削除されたユーザー" }}</div>
                    @endif
            </div>
                {{--画像を表示させるdiv作る--}}
        </div>
        <div class="row">
            <h3>コメント投稿</h3>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ action('User\CommentController@create') }}" method="post" 
enctype="multipart/form-data">
                    
                    @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                    @endif
                    
                    <div class="form-group row">
                        <div class="col-md-8">
                            <textarea class="form-control" name="contents" value="{{ 'contents' }}"></textarea>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="id" value="{{ $article_detail->id }}">{{--コメントする記事のidを渡す--}}
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="コメント">
                        </div>
                    </div>
                </form>
            </div>
        </div>    
        <div class="row">
            <h5>コメント一覧</h5>
        </div>    
        <div class="row">
            <div class="list-article col-md-12 mx-auto">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>コメント</th>
                            <th>投稿者</th>
                            <th>投稿日</th>
                            <th>削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->contents}}</td>
                            <td>
                                @if(!empty($comment->user->id))
                                    <a href="{{ action('UserController@show', ['id' => $comment->user->id]) }}">{{$comment->user->name}}</a>
                                @else
                                    {{ "削除されたユーザー" }}
                                @endif
                            </td>
                            <td>{{$comment->created_at}}</td>
                            <td>
                                 @if(!empty($comment->user->id))
                                    @if($comment->user->id == Auth::id()){{--アクセス者が返信の作成者なら削除リンクを表示--}}
                                        <div>
                                            <a href="{{ action('User\CommentController@delete', 
    ['id' => $comment->id]) }}">削除</a>
                                        </div>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ action('ArticleController@home') }}">検索画面へ</a>
    </div>
@endsection