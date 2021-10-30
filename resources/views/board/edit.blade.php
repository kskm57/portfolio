@extends('layouts.admin')

@section('title', '掲示板投稿編集')

@section('content')
    <div class="container">
        <h1>掲示板投稿編集</h1>
        
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>掲示板投稿編集</h2>
                <form action="{{ action('User\BoardController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="name">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $board_form->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="time">内容</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="contents" value="{{ $board_form->contents }}">
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $board_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
