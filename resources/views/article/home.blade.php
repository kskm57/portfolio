@extends('layouts.admin')



@section('title', '検索画面')



@section('content')
    <div class="container">
        <div class="row">
            <h1>ゲームを探す</h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ action('ArticleController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">ゲーム名</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" value="{{ $a_name }}">{{--テキストボックスに入力した値が$a_nameとして渡される--}}
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
        <div class="row">
            <a href="{{ action('User\ArticleController@add') }}">新規作成</a>
        </div>
        <div class="row">
            <a href="{{ action('User\BoardController@add') }}">掲示板投稿作成</a>
        </div>
        <div class="row">
            <a href="{{ action('User\BoardController@index') }}">掲示板投稿一覧</a>
        </div>
    </div>
@endsection


