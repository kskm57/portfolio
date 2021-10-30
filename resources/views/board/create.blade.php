@extends('layouts.admin')



@section('title', '掲示板投稿作成')



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>掲示板投稿作成</h2>
                <form action="{{ action('User\BoardController@create') }}" method="post" 
enctype="multipart/form-data">
                    
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                
                <div class="form-group row">
                    <label class="col-md-2">タイトル</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="title" value="{{ 
old('title') }}">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2">内容</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="contents" rows="20">
{{ old('contents') }}
                        </textarea>
                    </div>
                </div>
                
                 {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection