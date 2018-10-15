@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@php
$user = Auth::user();
@endphp

<div class="row">
    <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">
    <h1>タスク新規作成ページ</h1>
    
    {!! Form::open(['route' => 'tasks.store']) !!}
        {!! Form::hidden('user_id',$user -> id,['class'=>'form-control']) !!}
        <div class="form-group">
        {!! Form::label('title', 'タスク:') !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('タスク追加', ['class' => 'btn btn-primary']) !!}
        <div>以下詳細設定</div>
        <div class="form-group">        
        {!! Form::label('start_date', '開始日:') !!}
        {{Form::date('start_date', \Carbon\Carbon::tomorrow())}}
        </div>    
        <div class="form-group">        
        {!! Form::label('task_time', '所要時間:') !!}
        <input type="number" id="height" name="task_time_hours" placeholder="5分刻みで設定できます" step="1" value="0" style="width: 4rem;"/>時間
        <input type="number" id="height" name="task_time_mins" placeholder="5分刻みで設定できます" step="5" value="20" style="width: 4rem;"/>分
        </div>           
        <div class="form-group">        
        {!! Form::label('type', 'タイプ:') !!}
        
        {{Form::radio('type', 'single', true)}}単発　{{Form::radio('type', 'repeat')}}繰り返し
        </div>
        <div>
         {!! Form::label('zone', '時間帯:') !!}
        {{Form::select('zone', [
           '1' => '1(早朝)',
           '2' => '2(午前中)',
           '3' => '3(正午前後)',
           '4' => '4(午後)',
           '5' => '5(夕方)',
           '6' => '6(夜)',
           '7' => '7(深夜)',
           ],'4'
        )}}
        
        </div>
        <div class="form-group">
        {!! Form::label('memo', 'メモ:') !!}
        {!! Form::textarea('memo',null,['class'=>'form-control']) !!}
        </div>


        {!! Form::submit('タスク追加', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>
</div>

@endsection