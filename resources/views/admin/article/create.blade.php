@extends('layouts.admin')



@section('title', 'ゲーム記事作成')



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ゲーム記事作成</h2>
                <form action="{{ action('Admin\ArticleController@create') }}" method="post" 
enctype="multipart/form-data">
                    
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                
                <div class="form-group row">
                    <label class="col-md-2">ゲーム名</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" value="{{ 
old('name') }}">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2">所要時間</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="time" value="{{ 
old('time') }}">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2">プレイ人数</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="number" value="{{ 
old('number') }}">
                    </div>    
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2">場所</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="place" value="{{ 
old('place') }}">
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
                
                <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                </div>
                
        
                
                 {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection