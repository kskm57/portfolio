@extends('layouts.admin')



@section('title', 'ユーザーページ')



@section('content')
    <div class="container">
    <div>
        <h1>ユーザー名：{{ $user->name }}</h1>
    </div>
    <div>
        @if(Auth::user() == $user)
            <h3>（あなたのページ）</h3>
        @endif
    </div>
    <div>
        @guest
        @else
            @if(Auth::user() != $user){{--アクセス者以外のユーザーページならフォローボタンとフォロー状態を表示--}}
                @if($user->isFollowed($user->id))
                    <div class="px-2">
                        <span class="px-1 bg-secondary text-light">フォローされています</span>
                    </div>
                @endif
                    <div class="d-flex justify-content-end flex-grow-1">
                        @if (auth()->user()->isFollowing($user->id))
                            <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
        
                                <button type="submit" class="btn btn-danger">フォロー解除</button>
                            </form>
                        @else
                            <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                                {{ csrf_field() }}
        
                                <button type="submit" class="btn btn-primary">フォローする</button>
                            </form>
                        @endif
                    </div>
                    
            @endif
        @endguest
    </div>
    <div>
        @if(Auth::user() == $user)
            <div>
                <h2>フォローしている人の記事一覧</h2>
            </div>
            <div>
                @foreach($user->follows as $follower)
                    @foreach($follower->articles as $article)
                    <div>
                        <a href=" {{ action('ArticleController@detail', ['id' => $article->id]) }} ">{{$article->name}}</a>
                    </div>
                    @endforeach
                @endforeach
            </div>    
        @endif
    </div>
        
    <div>
        <h2>このユーザーがフォローしている人一覧</h2>
    </div>
    <div>
        @foreach($user->follows as $follow)
        <div>
            @if(!empty($follower->id))
                <a href=" {{ action('UserController@show', ['id' => $follow->id]) }} ">{{$follow->name}}</a>
            @else
                {{ "削除されたユーザー" }}
            @endif
        </div>
        @endforeach
        {{--@foreach($all_users as $each_user)
        <div>
            @if($user->isFollowing($each_user->id))
            <li>
                <a href=" {{ action('UserController@show', ['id' => $each_user->id]) }} ">{{$each_user->name}}</a>
            </li>
            @endif
        </div>
        @endforeach--}}
        
    </div>
    <div>
        <h2>このユーザーをフォローしている人一覧</h2>
    </div>
    <div>
        @foreach($user->followers as $follower)
        <div>
            @if(!empty($follower->id))
                <a href=" {{ action('UserController@show', ['id' => $follower->id]) }} ">{{$follower->name}}</a>
            @else
                {{ "削除されたユーザー" }}
            @endif
        </div>
        @endforeach
    </div>
    <div>
    <h2>いいねしたゲーム記事一覧</h2>
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
                                <th width="30%">内容</th>
                                <th width="10%">投稿者</th>
                                <th width="10%">詳細へ</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->favorites as $favorite)
                                <tr>
                                    <th>{{ $favorite->article->id }}</th>
                                    <td>{{ \Str::limit($favorite->article->name, 100) }}</td>
                                    <td>{{ \Str::limit($favorite->article->time, 100) }}</td>
                                    <td>{{ \Str::limit($favorite->article->created_at, 250) }}</td>
                                    <td>{{ \Str::limit($favorite->article->number, 250) }}</td>  
                                    <td>{{ \Str::limit($favorite->article->contents, 250) }}</td>
                                    <td>
                                        @if(!empty($favorite->article->user->id))
                                            <a href="{{ action('UserController@show', ['id' => $favorite->article->user->id]) }}">{{ \Str::limit($favorite->article->user->name, 100) }}</a>
                                        @else
                                            {{ "削除されたユーザー" }}
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('ArticleController@detail', ['id' => $favorite->article->id]) }}">詳細</a>
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
        <h2>投稿したゲーム記事一覧</h2>
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
                                <th width="30%">内容</th>
                                <th width="10%">投稿者</th>
                                <th width="10%">詳細へ</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->articles as $article)
                                <tr>
                                    <th>{{ $article->id }}</th>
                                    <td>{{ \Str::limit($article->name, 100) }}</td>
                                    <td>{{ \Str::limit($article->time, 100) }}</td>
                                    <td>{{ \Str::limit($article->created_at, 250) }}</td>
                                    <td>{{ \Str::limit($article->number, 250) }}</td>  {{--あとでfavoritesにする？--}}
                                    <td>{{ \Str::limit($article->contents, 250) }}</td>
                                    <td>
                                        <a href="{{ action('UserController@show', ['id' => $article->user->id]) }}">{{ \Str::limit($article->user->name, 100) }}</a>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('ArticleController@detail', ['id' => $article->id]) }}">詳細</a>
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
        <h2>投稿した書き込み一覧</h2>
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
                            @foreach($user->boards as $board)
                                <tr>
                                    <th>{{ $board->id }}</th>
                                    <td>{{ \Str::limit($board->title, 100) }}</td>
                                    <td>{{ \Str::limit($board->contents, 250) }}</td>
                                    <td>{{ \Str::limit($board->created_at, 250) }}</td>
                                    <td>{{ \Str::limit($board->updated_at, 250) }}</td>  {{--あとでfavoritesにする？--}}
                                    <td>
                                        <a href="{{ route('user', ['id' => $board->user->id]) }}">{{ \Str::limit($board->user->name) }}</a>
                                    </td>
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