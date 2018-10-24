@extends('layouts.app_mini')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@php

$user = Auth::user();

@endphp

    
<div class="row">
    <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h3>このタスクを完了しますか?</h3>
        <h4>「{{ $task -> title }}」</h4>
        <div class="alert alert-danger" role="alert">「このタスクを完了する」を押すと、タスクは削除されます。
        </div>

        {!! Form::model($task, ['route' => ['tasks.destroy'], 'method' => 'post']) !!}
        
        {!! Form::hidden('task_id',$task -> id,['class'=>'form-control']) !!}        

        {!! Form::submit('タスクを完了する', ['class' => 'btn btn-primary']) !!}
    
            <div class="form-group"　name="destroy">

            @if($task -> type == 'repeat')
                <div class="alert alert-warning" role="alert" style="margin-top:1rem;">このタスクはタイプが「繰り返し」です。今後も繰り返さず完全に削除するには、以下にチェックを入れてください。</div>
                <div class="emp_in_form">完全に削除する<input type="checkbox" name="repeat_del"></div>
                <div class="emp_in_form">次回開始日を指定(指定ない場合は、翌日になります)</div>

                @php
                $today_date=date('Y-m-d');
                $tomorrow=date('Y-m-d', strtotime('+1 day'));
                @endphp
        
                <div class="form-group" id="datepicker-startview">

                  <label for="start_date">開始日(デフォルトは明日)</label>
                  <span class="label label-info" id="plus1">＋1</span>
                  <span class="label label-info" id="plus2">＋2</span>
                  <span class="label label-info" id="plus7">＋7</span>
                  <span class="label label-info" id="plus30">＋30</span>  
                  
                <div>

                <div>
                    <div class="input-group date">
                        <input type="text"  name="start_date" size="10" id="start_date" class="form-control" value="">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-th"></i>
                          </span>
                    </div>
                </div>
   
                <div class="alert alert-info" role="alert">本日は{{ $today_date }}です</div>

            @endif     
            
            </div>
      
        {!! Form::submit('タスクを完了する', ['class' => 'btn btn-primary']) !!}

        
    </div>
        {!! Form::close() !!}

</div>
    
<script>
<!--    
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
    
    $("#plus30").click(function(){

    //今日の日付データを変数thedayに格納
    var theday=new Date(); 
    theday.setDate(theday.getDate() + 30);
    //明日
    var y = theday.getFullYear();
    var m = theday.getMonth()+1; 
    var d = theday.getDate();
    var start_day = y +'-'+m+'-'+d;
    $("#start_date").val(start_day);
    });        
    
    
    
});

    
    
    
-->    
</script>    

@endsection