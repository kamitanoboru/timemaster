@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@php

$user = Auth::user();
@endphp

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h3>{{ $user ->name }}さん のアカウント編集ページ</h3>

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
        {!! Form::text('start_time',$user -> start_time,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h3>{{ $user ->name }}さん のアカウント削除ページ</h3>

    {!! Form::model($user, ['route' => ['users.destroy'], 'method' => 'post']) !!}
    
        <div class="form-group">

        {!! Form::hidden('user_id',$user -> id,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('アカウントを削除する', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
        </div>
    </div>

@endsection