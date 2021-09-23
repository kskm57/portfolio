@extends('layouts.admin')



@section('title', 'ゲーム編集')



@section('content')
    <div class="container">
        <h1>ゲーム編集</h1>
        
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ニュース編集</h2>
                <form action="{{ action('Admin\ArticleController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="name">ゲーム名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $article_form->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="time">所要時間</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="time" value="{{ $article_form->time }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="number">人数</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="number" value="{{ $article_form->number }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="place">場所</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="place" value="{{ $article_form->place }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="contents">内容</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="contents" rows="20">{{ $article_form->contents }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $article_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $article_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection