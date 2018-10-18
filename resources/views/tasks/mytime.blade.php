@extends('layouts.app')

@section('content')


<!-- ここにページ毎のコンテンツを書く -->
@php
//ログイン認証
$id = Auth::id();
$user=\App\User::find($id);

//タスクの数
$max_cnt=count($tasks);




//個人設定の$start_timeを分にする
$tArry=explode(":",$start_time);
$hour=$tArry[0]*60;//時間→分
$sum_end=$hour+$tArry[1];//分だけを足す

//タスクをli表示する時の表示番号
$i=1;
@endphp

<h3 style="text-align: center;">今日のタスク・スケジュール({{ $max_cnt }} Tasks)</h3>
<h4 style="text-align: center;">スタートタイム:{{ $start_time }}</h4>

@if($max_cnt > 0)

<form action="/mytime" method="post">
    {{ csrf_field() }}
    <ul class="sortable buruburu">


{{--//各タスクごとの表示開始--}}
@foreach($tasks as $task)

@php

//開始時間の初期化と反映のフラグ
$fix_start=null;
$fix_flag="off";


//各タスクの開始時間を計算(最初は個人設定の$start_timeの分換算が入る)
$sum_start=$sum_end;;


//開始時間の初期設定 $fix_startが存在すれば
if($task -> fix_start){
    $fix_start=$task -> fix_start;

    //テスト開始時間があるもので分岐　開始時間をまずは分にする
    $tArry_fix=explode(":",$fix_start);
    $hour_fix=$tArry_fix[0]*60;//時間→分
    $fix_start=$hour_fix+$tArry_fix[1];//分だけを足す

    //もし$fix_start　>　$sum_start であれば $sum_startを開始時間の方にする
    if($fix_start > $sum_start){
        $sum_start = $fix_start;
    }else{
    //開示時間にすでに間にあってないという場合
        $fix_flag="on";
    }

}    

//そのタスクの開始時間が決定したので

//開始時間をH:i形式にする
$start = gmdate('H:i:s', $sum_start*60);
$tArry_s=explode(":",$start);
$item_start=$tArry_s[0].":".$tArry_s[1];

//各タスクの終了時間を得て、H:i形式にする
$sum_end =$sum_start + ($task -> task_time);
$end = gmdate('H:i:s', $sum_end*60);
$tArry_e=explode(":",$end);
$item_end=$tArry_e[0].":".$tArry_e[1];

//タスクの更新日時が10分以内のものをフラグ化する
//現在時間から10分前
$timestamp = strtotime( "-10 minutes" );
$before = date("H:i:s",$timestamp);

//比較して後の方を有効とする
if(strtotime($task -> created_at) > strtotime($before)){
    $before_flag="newlist";
}else{
    $before_flag="";
}

@endphp

{{--データの表示--}}
@include('commons.mytime_item',['item_start'=>$item_start,'item_end' =>$item_end,'list_i' => $i,'fix_flag' => $fix_flag])
        
@php
//タスクをli表示する時の表示番号をカウントアップ
$i=$i+1;
@endphp

@endforeach


     </ul>
    <input type="hidden" id="result" name="result" />
    <div class="center-block" style="text-align:center;margin-bottom:1rem;">スタート時間を<input type="text" id="hour" name="hour" size="2"/>時<input type="text" id="min" name="min" size="2"/>分にして</div>

     <button id="submit" class="btn btn-primary center-block" style="text-align:center;">再計算する</button>
</form>

@else
<div class="alert alert-success" role="alert">本日以前が開始日となっている未完了のタスクはありません</div>

@endif


<script>
<!--


$(function() {
    $('.mytimelist').on('mousedown', function() {
        $(this).css('background-color','aqua');
        $(this).css('border','solid 2px blue');
    });
    $('.mytimelist').on('mouseup', function() {
        $(this).css('border','inherit');
    });
});
 

jQuery(function() {
      jQuery(".sortable").sortable();
      jQuery(".sortable").disableSelection();
      jQuery("#submit").click(function() {
          var result = jQuery(".sortable").sortable("toArray");
          jQuery("#result").val(result);
          jQuery("form").submit();
      });
  });
  

     
    ;(function($) {
        $(function() {
            $('a.destroy').on('click', function() {
                $(this).parents('li').css('background-color','#bbbbbb');
            });
         });
     })(jQuery);     

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