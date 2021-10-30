@extends('layouts.admin')



@section('title', 'ユーザー一覧ページ')



@section('content')
    <div class="container">
    <div>
    <h1>ユーザー一覧</h1>
    </div>
        <div class="row">
            <div class="list-article col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="10%">ユーザー名</th>
                                <th width="5%">メールアドレス</th>
                                <th width="20%">パスワード</th>                                
                                <th width="10%">作成日</th>
                                <th width="30%">更新日</th>
                                <th width="10%">削除日</th>
                                <th width="10%">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_users as $user)
                                <tr>
                                    <th>{{ $user->id }}</th>
                                    <td><a href="{{ action('UserController@show', ['id' => $user->id]) }}">{{ \Str::limit($user->name, 100) }}</a></td>
                                    <td>{{ \Str::limit($user->email, 100) }}</td>
                                    <td>{{ \Str::limit($user->password, 100) }}</td>
                                    <td>{{ \Str::limit($user->created_at, 100) }}</td>
                                    <td>{{ \Str::limit($user->updated_at, 100) }}</td>  
                                    <td>{{ \Str::limit($user->deleted_at, 100) }}</td>
                                    <td><a href="{{ action('Admin\UserController@delete', ['id' => $user->id]) }}">削除</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
    <h1>削除したユーザー一覧</h1>
    </div>
        <div class="row">
            <div class="list-article col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="10%">ユーザー名</th>
                                <th width="5%">メールアドレス</th>
                                <th width="20%">パスワード</th>                                
                                <th width="10%">作成日</th>
                                <th width="30%">更新日</th>
                                <th width="10%">削除日</th>
                                <th width="10%">復元</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deleted_users as $user)
                                <tr>
                                    <th>{{ $user->id }}</th>
                                    <td><a href="{{ action('UserController@show', ['id' => $user->id]) }}">{{ \Str::limit($user->name, 100) }}</a></td>
                                    <td>{{ \Str::limit($user->email, 100) }}</td>
                                    <td>{{ \Str::limit($user->password, 100) }}</td>
                                    <td>{{ \Str::limit($user->created_at, 100) }}</td>
                                    <td>{{ \Str::limit($user->updated_at, 100) }}</td>  
                                    <td>{{ \Str::limit($user->deleted_at, 100) }}</td>
                                    <td><a href="{{ action('Admin\UserController@restore', ['id' => $user->id]) }}">復元</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

        