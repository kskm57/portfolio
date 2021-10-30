@extends('layouts.admin')

@section('title', '掲示板投稿詳細')

@section('content')
    <div class="container">
        <div class="row">
            <h1>掲示板投稿詳細</h1>
        </div>
        <div class="row">
            @if(!empty($board_detail->user->id))
                @if($board_detail->user->id == Auth::id()){{--アクセス者が掲示板投稿作成者なら--}}
                <a href="{{ action('User\BoardController@edit', ['id' => $board_detail->id]) }}">編集</a>
                <a href="{{ action('User\BoardController@delete', ['id' => $board_detail->id]) }}">削除</a>
                @endif
            @endif
        </div>
        <div class="row">
            <div class="list-article col-md-12 mx-auto">
                <div class="text-group row">
                    <div class="col-md-4">タイトル</div>
                    <div class="col-md-6">{{ $board_detail->title}}</div>
                </div>
                <div class="text-group row">
                    <div class="col-md-4">内容</div>
                    <div class="col-md-6">{!! nl2br(e($board_detail->contents)) !!}</div>
                </div>
                <div class="text-group row">
                    <div class="col-md-4">投稿日</div>
                    <div class="col-md-6">{{ $board_detail->created_at }}</div>
                </div>
                <div class="text-group row">
                    <div class="col-md-4">更新日</div>
                    <div class="col-md-6">{{ $board_detail->updated_at }}</div>
                </div>
                <div class="text-group row">
                    <div class="col-md-4">投稿者</div>
                    <div class="col-md-6">
                        @if(!empty($board_detail->user->name))
                            {{ $board_detail->user->name }}
                        @else
                            {{ "削除されたユーザー" }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h2>掲示板投稿への返信</h2>    
        </div>
        <div class="col-md-8 mx-auto">
            <form action="{{ action('User\ReplyController@create') }}" method="post" 
enctype="multipart/form-data">
                
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                
                <div class="form-group row">
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="contents" value="{{ 'contents' }}">
                    </div>
                    <div class="col-md-2">
                        <input type="hidden" name="id" value="{{ $board_detail->id }}">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="返信">
                    </div>
                </div>
            </form>
        </div>
        <div>
            <h2>返信一覧</h2>    
        </div>
        <div class="row">
            <div class="list-article col-md-12 mx-auto">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>返信</th>
                            <th>投稿者</th>
                            <th>投稿日</th>
                            <th>削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($replies as $reply)
                        <tr>
                            <td>{{$reply->contents}}</td>
                            <td>
                                @if(!empty($reply->user->id))
                                    <a href="{{ action('UserController@show', ['id' => $reply->user->id]) }}">{{$reply->user->name}}</a>
                                @else
                                    {{ "削除されたユーザー" }}
                                @endif
                            </td>
                            <td>{{$reply->created_at}}</td>
                            <td>
                                @if(!empty($reply->user->id))
                                    @if($reply->user->id == Auth::id()){{--アクセス者が返信の作成者なら削除リンクを表示--}}
                                    <div>
                                        <a href="{{ action('User\ReplyController@delete', ['id' => $reply->id]) }}">削除</a>
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
        <a href="{{ action('ArticleController@home') }}" 
role="button" class="btn btn-primary">検索画面へ</a>
    </div>
@endsection
