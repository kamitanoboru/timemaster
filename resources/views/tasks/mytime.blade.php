@extends('layouts.app')

@section('content')


<!-- ここにページ毎のコンテンツを書く -->
@php
$id = Auth::id();
$user=\App\User::find($id);


$max_cnt=count($tasks);



//$start_timeを秒数にする
$tArry=explode(":",$start_time);
$hour=$tArry[0]*60;//時間→分
$sum_end=$hour+$tArry[1];//分だけを足す

$i=1;
@endphp
<h3 style="text-align: center;">今日のタスク・スケジュール({{ $max_cnt }} Tasks)</h3>
<h4 style="text-align: center;">スタートタイム:{{ $start_time }}</h4>
<form action="/mytime" method="post">
    {{ csrf_field() }}
    <ul class="sortable">
     @foreach($tasks as $task)
@php

//各タスクの終了時間を得る
$sum_start=$sum_end;;
$start = gmdate('H:i:s', $sum_start*60);
$tArry_s=explode(":",$start);
$item_start=$tArry_s[0].":".$tArry_s[1];

$sum_end =$sum_start + ($task -> task_time);
$end = gmdate('H:i:s', $sum_end*60);
$tArry_e=explode(":",$end);
$item_end=$tArry_e[0].":".$tArry_e[1];

@endphp
        @include('commons.mytime_item',['item_start'=>$item_start,'item_end' =>$item_end,'list_i' => $i])
        
@php
$i=$i+1;
@endphp
    @endforeach
     </ul>
    <input type="hidden" id="result" name="result" />
    <div class="center-block" style="text-align:center;margin-bottom:1rem;">スタート時間を<input type="text" id="hour" name="hour" size="2"/>時<input type="text" id="min" name="min" size="2"/>分にして</div>

     <button id="submit" class="btn btn-primary center-block" style="text-align:center;">再計算する</button>
</form>

<script>
<!--
jQuery( function() {
    jQuery( '.ui-sortable-handle' ) . mousedown( function () {
        jQuery( this ) . css( 'backgroundColor', 'yellow' );
        var str = jQuery( this ) . text();
        jQuery( '#jquery-api-mousedown-contents' ) . text( str );
    } );
    jQuery( '.ui-sortable-handle' ) . mouseup( function () {
        jQuery( this ) . css( 'backgroundColor', '#ffffff' );
        var str = '';
        jQuery( '#jquery-api-mousedown-contents' ) . text( str );
    } );
} );

jQuery(function() {
      jQuery(".sortable").sortable();
      jQuery(".sortable").disableSelection();
      jQuery("#submit").click(function() {
          var result = jQuery(".sortable").sortable("toArray");
          jQuery("#result").val(result);
          jQuery("form").submit();
      });
  });
  

//時刻データを取得して変数jikanに格納する
function mytime(){
//10分足す
var jikan= new Date(+new Date() + (10 * 60 * 1000));

//時・分・秒を取得する
var hour = jikan.getHours();
var minute = jikan.getMinutes();

//
document.getElementById( "hour" ).value = hour ;
document.getElementById( "min" ).value = minute;

    
}
//1分毎に表示
mytime();
setInterval('mytime()',1000*60);

// -->
</script>

@endsection