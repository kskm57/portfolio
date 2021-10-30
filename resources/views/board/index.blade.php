@extends('layouts.admin')

@section('title', '掲示板投稿一覧')

@section('content')
    <div class="container">
        <div>
            <h1>掲示板投稿一覧</h1>
        </div>
        <div class="col-md-4">
            <a href="{{ action('User\BoardController@add') }}" role="button" class="btn btn-primary">掲示板投稿新規作成</a>
        </div>
        <div class="row">
            <div class="list-article col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="10%">タイトル</th>
                                <th width="40%">内容</th>
                                <th width="10%">投稿日</th>
                                <th width="10%">更新日</th>
                                <th width="10%">投稿者</th>
                                <th width="10%">詳細へ</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($boards as $board)
                                <tr>
                                    <th>{{ $board->id }}</th>
                                    <td>{{ \Str::limit($board->title, 100) }}</td>
                                    <td>{{ \Str::limit($board->contents, 250) }}</td>
                                    <td>{{ \Str::limit($board->created_at, 250) }}</td>
                                    <td>{{ \Str::limit($board->updated_at, 250) }}</td>  {{--あとでfavoritesにする？--}}
                                    <td>
                                        @if(!empty($board->user->id))
                                            <a href="{{ action('UserController@show',['id' => $board->user->id]) }}}">
{{ \Str::limit($board->user->name) }}</a></td>
                                        @else
                                            {{ "削除されたユーザー" }}
                                        @endif
                                    <td>
                                        <div>
                                            <a href="{{ action('User\BoardController@detail', ['id' => $board->id]) }}">詳細</a>
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