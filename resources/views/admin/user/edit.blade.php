@extends('layouts.admin')



@section('title', 'ユーザーパスワード編集')



@section('content')
    <div class="container">
        <h1>ユーザーパスワード編集</h1>
        
        <div class="row">
            <div class="col-md-8 mx-auto">
                <form action="{{ action('Admin\UserController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-10" for="name">パスワード</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="password" value="{{ \Str::limit($user->password, 100) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="name" value="{{ $user->name }}">
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection