@extends('layouts.admin')



@section('title', '検索結果')



@section('content')
    <div class="container">
        <div>
            <h1>ゲームを探す</h1>
        </div>
        <div class="row">
            <div class="col-md-10">
                <form action="{{ action('ArticleController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">ゲーム名</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" value="{{ $a_name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">所要時間</label>
                        <div class="col-md-8">
                            <select name="time" multiple>
                                <option value=""></option>
                                <option value="5分">5分</option>
                                <option value="10分">10分</option>
                                <option value="30分">30分</option>
                                <option value="1時間">1時間</option>
                                <option value="2時間以上">2時間以上</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">プレイ人数</label>
                        <div class="col-md-8">
                            <select name="number" multiple>
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5~10">5~10</option>
                                <option value="11~">11~</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">場所</label>
                        <div class="col-md-8">
                            <select name="place" multiple>
                                <option value=""></option>
                                <option value="自宅">自宅</option>
                                <option value="屋外">屋外</option>
                                <option value="お店で">お店で</option>
                                <option value="電車／車の中">電車／車の中</option>
                                <option value="オフライン">オフライン</option>
                                <option value="静かなところ">静かな場所</option>
                                <option value="どこでも">どこでも</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">投稿者</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="user" value="{{ $a_user }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">投稿者</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="user" value="{{ $a_user }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">全文検索</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="all" value="{{ $a_all }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div> 
        <div>
            <h1>検索結果</h1>
        </div>
        <div>
            <form action="{{ action('ArticleController@index') }}" method="get">
                <select name='order'>
                    <option value='favorites'>いいね数が多い順</option>
                    <option value='created_at_asc'>登校日が古い順</option>
                    <option value='created_at_desc'>登校日が新しい順</option>
                </select>
                <input type="submit" class="btn btn-primary" value="更新">
            </form>
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
                                <th width="5%">プレイ人数</th>
                                <th width="20%">投稿日</th>                                
                                <th width="5%">いいね数</th>
                                <th width="30%">内容</th>
                                <th width="10%">投稿者</th> 
                                <th width="10%">詳細へ</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <th>{{ $article->id }}</th>
                                    <td>{{ \Str::limit($article->name, 100) }}</td>
                                    <td>{{ \Str::limit($article->time, 100) }}</td>
                                    <td>{{ \Str::limit($article->number, 250) }}</td>                                    
                                    <td>{{ \Str::limit($article->created_at, 250) }}</td>
                                    <td>{{ \Str::limit($article->favorites_count, 250) }}</td>
                                    <td>{{ \Str::limit($article->contents, 250) }}</td>
                                    <td>
                                        @if(!empty($article->user->id))
                                            <a href="{{ action('UserController@show', ['id' => $article->user->id]) }}">{{ \Str::limit($article->user->name, 100) }}</a>
                                        @else
                                            {{ "削除されたユーザー" }}
                                        @endif
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
    </div>
@endsection