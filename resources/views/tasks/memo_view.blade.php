@extends('layouts.app_mini')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@php

$user = Auth::user();

@endphp

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h3>メモ表示</h3>

      {!! Form::open(['route' => 'tasks.update_memo']) !!}
    
        <div class="form-group">

        {!! Form::hidden('task_id',$task -> id,['class'=>'form-control']) !!}
        </div>
       <div class="form-group">
        {!! Form::label('title', 'タスク:') !!}
        <div>{{ $task -> title }}</div>
        </div>
 
        <div class="form-group">
        {!! Form::label('memo', 'メモ:') !!}
        {!! Form::textarea('memo',$task -> memo,['class'=>'form-control memo','style'=>'display:block;']) !!}
        </div>


                    
        {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

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