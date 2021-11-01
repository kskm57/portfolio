@extends('layouts.admin')



@section('title', 'ゲーム記事作成')



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ゲーム記事作成</h2>
                <form action="{{ action('User\ArticleController@create') }}" method="post" 
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
                            <div class="col-md-8">
                                <select name="time">
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
                            <select name="number">
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
                            <select name="place">
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