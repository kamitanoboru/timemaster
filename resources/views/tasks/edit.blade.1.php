@extends('layouts.app_mini')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@php

$user = Auth::user();

@endphp

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h3>タスク編集</h3>

      {!! Form::open(['route' => 'tasks.update']) !!}
    
        <div class="form-group">

        {!! Form::hidden('task_id',$task -> id,['class'=>'form-control']) !!}
        </div>
       <div class="form-group">
        {!! Form::label('title', 'タスク:') !!}
        {!! Form::text('title',$task ->title,['class'=>'form-control']) !!}
        </div>
 
        <h3><span class="label label-success">以下詳細設定</span></h3>

        
        <div class="form-group" id="datepicker-startview">

  <label for="start_date">開始日</label><span id="today">今日に変更する</span>
  <div>
    <div class="input-group date">
      <input type="text"  name="start_date" size="10" id="start_date" class="form-control" value="{{ $task->start_date }}">
      <span class="input-group-addon">
        <i class="glyphicon glyphicon-th"></i>
      </span>
    </div>
  </div>
</div>

        
        <div class="form-group">
        {!! Form::label('fix_start', 'タスクの開始指定時間(未記入OK)') !!}

        <div class="input-group clockpicker">
        <input type="text" name="fix_start" class="form-control" value="">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-time"></span>
        </span>
        </div>
        </div>    
        
        
        <div class="form-group">        
        {!! Form::label('task_time', '所要時間:') !!}
        <input type="number" value="{{ $hours }}" id="height" name="task_time_hours" placeholder="5分刻みで設定できます" step="1" value="0" style="width: 4rem;"/>時間
        <input type="number" value="{{ $mins }}" id="height" name="task_time_mins" placeholder="5分刻みで設定できます" step="5" value="20" style="width: 4rem;"/>分
        </div>           
        <div class="form-group">        
        {!! Form::label('type', 'タイプ:') !!}
        @php
        if($task -> type == 'single'){
            $single="true";
            $repeat=null;
        }else{
            $single=null;
            $repeat="true";
        }
        @endphp
        
        {{Form::radio('type', 'single', $single)}}単発　{{Form::radio('type', 'repeat',$repeat)}}繰り返し
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
           ],$task -> zone
        )}}
        
        </div>
        <div class="form-group">
        {!! Form::label('memo', 'メモ:') !!}<span id="toggle">表示する</span>
        {!! Form::textarea('memo',$task -> memo,['class'=>'form-control memo','style'=>'display:none;']) !!}
        </div>


                    
        {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h3>このタスクの削除</h3>

    {!! Form::model($task, ['route' => ['tasks.destroy'], 'method' => 'post']) !!}
    
        <div class="form-group"　name="destroy">
@if($task -> type == 'repeat')
このタスクはタイプが「繰り返し」です。今後も繰り返さず完全に削除するには、以下にチェックを入れてください。
<br>完全に削除する<input type="checkbox" name="repeat_del">
@endif
       {!! Form::hidden('task_id',$task -> id,['class'=>'form-control']) !!}        </div>
        {!! Form::submit('タスクを削除する', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
        </div>
    </div>
    
<script>

$(function(){
    $('#datepicker-startview .date').datepicker({
        startView: 1,
        language: "ja",
        autoclose: true
    });
});


$('.clockpicker').clockpicker();


$(function(){
    $("#toggle").click(function(){
        $("#memo").toggle();

        if($("#toggle").text() =='表示する'){
             $("#toggle").text('閉じる');
             }else{
              $("#toggle").text('表示する'); 
             }
    });
});
    
$(function(){
    //Default
    $('#datepicker-default .date').datepicker({
        format: "yyyy年mm月dd日",
        language: 'ja',
        autoclose: true
    });
    
});    
    
</script>    

@endsection