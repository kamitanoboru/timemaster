@extends('layouts.app_mini')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@if (Auth::check())
@php


$user = Auth::user();

$mymemo=htmlspecialchars_decode($user -> mymemo);

//$mymemo=null;

@endphp

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h3>{{ $user ->name }}さん のマイメモ</h3>
        @if($mymemo == null)
        マイメモの設定がされていません<br>
        マイメモをアカウント管理から登録すると、ここに表示されます。<br>
        今月のテーマや確認事項などを書いておくことができます。
        @else
        
        
    {!! Form::model($user, ['route' => ['users.mymemo_update'], 'method' => 'post']) !!}
    
        <div class="form-group">
        {!! Form::textarea('mymemo',$user -> mymemo,['class'=>'form-control','id' => 'mymemo']) !!}
        </div>        
                    
        {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
        
        
        @endif
    </div>
@endif
@endsection