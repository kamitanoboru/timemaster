@extends('layouts.app')

@section('content')

  <script type="text/javascript" src="{{ secure_asset('js/tinymce/tinymce.min.js') }}"></script>

<script>
  tinymce.init({
     selector: "#mymemo",
     language: "ja", // 言語 = 日本語
        height: 300,      // 高さ = 300px
        menubar: false,   // メニューバーを隠す
        plugins: "textcolor image link", // 文字色、画像ボタン、リンク用のプラグインを適用
        toolbar: [ // ツールバー(2段)
            // 戻る 進む | フォーマット | 太字 斜体 | 左寄せ 中央寄せ 右寄せ 均等割付 | 箇条書き 段落番号 インデントを減らす インデント
            "undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            // 文字サイズ 文字色 画像 リンク
            "fontsizeselect forecolor image link"
        ],
        statusbar: false, // ステータスバーを隠す
    
  });
  </script>
<!-- ここにページ毎のコンテンツを書く -->
@php

$user = Auth::user();
@endphp

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h3>{{ $user ->name }}さん のアカウント編集</h3>

    {!! Form::model($user, ['route' => ['users.update'], 'method' => 'post']) !!}
    
        <div class="form-group">

        {!! Form::hidden('user_id',$user -> id,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('name', '名前:') !!}
        {!! Form::text('name',$user -> name,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('email', 'メールアドレス:') !!}
        {!! Form::text('email',$user -> email,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('start_time', 'スタート時間(今日のタスクの開始時間)') !!}
@php
$start=$user -> start_time;
$tArry_s=explode(":",$start);
$start=$tArry_s[0].":".$tArry_s[1];

@endphp
        
<div class="input-group clockpicker">
    <input type="text" name="start_time" class="form-control" value="{{ $start }}">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
</div>
<script type="text/javascript">

$('.clockpicker').clockpicker();

</script>


        </div>
        
        <div class="form-group">
        {!! Form::label('password', 'パスワード') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('password_confirmation', 'パスワード（確認）') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group">
        {!! Form::label('name', 'グーグルカレンダーiframeタグ:') !!}
        {!! Form::textarea('gc',$user -> gc,['class'=>'form-control']) !!}
        </div>
        
        <div class="form-group">
        {!! Form::label('name', 'マイメモ:') !!}
        {!! Form::textarea('mymemo',$user -> mymemo,['class'=>'form-control','id' => 'mymemo']) !!}
        </div>        
                    
        {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h3>{{ $user ->name }}さん のアカウント削除</h3>

    {!! Form::model($user, ['route' => ['users.destroy'], 'method' => 'post']) !!}
    
        <div class="form-group">

        {!! Form::hidden('user_id',$user -> id,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('アカウントを削除する', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
        </div>
    </div>

@endsection