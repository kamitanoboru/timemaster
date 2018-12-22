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
        <h3><span class="label label-success">以下詳細設定</span></h3>
        
        <!--
        <div class="form-group">        
        {!! Form::label('start_date', '開始日:') !!}
        {{Form::date('start_date', \Carbon\Carbon::tomorrow())}}
        </div>    
        -->
@php
$today_date=date('Y-m-d');
$tomorrow=date('Y-m-d', strtotime('+1 day'));
@endphp
<div class="form-group" id="datepicker-startview">

  <label for="start_date">開始日(デフォルトは明日)</label>
  <span class="label label-info" id="today">今日</span>
  <span class="label label-info" id="plus1">＋1</span>
  <span class="label label-info" id="plus2">＋2</span>
  <span class="label label-info" id="plus7">＋7</span>
  

  <div>
    <div class="input-group date">
      <input type="text"  name="start_date" size="10" id="start_date" class="form-control" value="{{ $tomorrow }}">
      <span class="input-group-addon">
        <i class="glyphicon glyphicon-th"></i>
      </span>
    </div>
  </div>
</div>

   
    <div class="alert alert-info" role="alert">本日は{{ $today_date }}です</div>
    
        <div class="form-group">
        {!! Form::label('fix_start', 'タスクの開始指定時間(未記入OK)') !!}

<div class="input-group clockpicker">
    <input type="text" name="fix_start" class="form-control" value="">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
</div>
<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>
        </div>    
    
<div class="row">

        <div class="form-group form-little">
        {!! Form::label('task_time', '所要時間:') !!}<br>
        <input type="number" id="height" name="task_time_hours" placeholder="5分刻みで設定できます" step="1" value="0" style="width: 4rem;"/>時間
        <input type="number" id="height" name="task_time_mins" placeholder="5分刻みで設定できます" step="5" value="15" style="width: 4rem;"/>分
        </div>           
        <div class="form-group form-little">
        {!! Form::label('type', 'タイプ:') !!}<br>
        
        {{Form::radio('type', 'single', true)}}単発　{{Form::radio('type', 'repeat')}}繰り返し
        </div>
        <div class="form-little">
         {!! Form::label('zone', '時間帯:') !!}<br>
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


    </div>
        <div class="form-group">
        {!! Form::label('memo', 'メモ:') !!}<span class="glyphicon glyphicon-list-alt" aria-hidden="true" id="my-button" style="font-size:3rem;"></span><span id="toggle">表示する</span>
        {!! Form::textarea('memo',null,['class'=>'form-control','style'=>'display:none;']) !!}
        </div>


        {!! Form::submit('タスク追加', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>
</div>

<script>
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

$(function(){
    $('#datepicker-startview .date').datepicker({
        startView: 1,
        language: "ja",
        autoclose: true
    });
});



$(function(){
    $("#today").click(function(){

    //今日の日付データを変数todayに格納
    var theday=new Date(); 
    var y = theday.getFullYear();
    var m = theday.getMonth()+1; 
    var d = theday.getDate();
    var start_day = y +'-'+m+'-'+d;    
    $("#start_date").val(start_day);
    });
    
    $("#plus1").click(function(){

    //今日の日付データを変数thedayに格納
    var theday=new Date(); 
    theday.setDate(theday.getDate() + 1);
    //明日
    var y = theday.getFullYear();
    var m = theday.getMonth()+1; 
    var d = theday.getDate();
    var start_day = y +'-'+m+'-'+d;
    $("#start_date").val(start_day);
    });
    
    $("#plus2").click(function(){

    //今日の日付データを変数thedayに格納
    var theday=new Date(); 
    theday.setDate(theday.getDate() + 2);
    //明日
    var y = theday.getFullYear();
    var m = theday.getMonth()+1; 
    var d = theday.getDate();
    var start_day = y +'-'+m+'-'+d;
    $("#start_date").val(start_day);
    });
    

    $("#plus7").click(function(){

    //今日の日付データを変数thedayに格納
    var theday=new Date(); 
    theday.setDate(theday.getDate() + 7);
    //明日
    var y = theday.getFullYear();
    var m = theday.getMonth()+1; 
    var d = theday.getDate();
    var start_day = y +'-'+m+'-'+d;
    $("#start_date").val(start_day);
    });    
    
    
    
});
    
    
</script>

@endsection