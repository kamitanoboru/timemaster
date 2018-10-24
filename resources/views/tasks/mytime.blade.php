@extends('layouts.app')

@section('content')



<!-- ここにページ毎のコンテンツを書く -->
@php
//ログイン認証
$id = Auth::id();
$user=\App\User::find($id);

//対象日付の確定 今日か明日
if($tm == null){
    $this_day=date("Y-m-d");
    $date = date('w');
    $this_day_str="Today";
    $to_post="/mytime";
    $nextbefore='<a class="navbar-left" href="/mytime_tm"><i class="fas fa-arrow-alt-circle-right fa-2x" style="color:green;margin-right: 1rem;"></i></a>';

}else{
    $this_day=$tm;
    $date=date('w', strtotime('+1 day'));  
    $this_day_str="Tomorrow";
    $to_post="/mytime_tm";
    $nextbefore='<a class="navbar-left" href="/mytime"><i class="fas fa-arrow-alt-circle-left fa-2x" style="color:green;margin-right: 1rem;"></i></a>';
    $start_time="0:0";
}


//タスクの数
$max_cnt=count($tasks);


//個人設定の$start_timeを分にする
$tArry=explode(":",$start_time);
$hour=$tArry[0]*60;//時間→分
$sum_end=$hour+$tArry[1];//分だけを足す

//タスクをli表示する時の表示番号
$i=1;



//曜日取得
//配列を使用し、要素順に(日:0〜土:6)を設定する
$week = [
  '日', //0
  '月', //1
  '火', //2
  '水', //3
  '木', //4
  '金', //5
  '土', //6
];
 

$youbi=$week[$date] . '曜日';
@endphp






<h3 class="mytime-title">{{ $this_day_str }}'s Tasks & Schedule({{ $max_cnt }} Items)</h3>
<h4 class="mytime-title">{{ $this_day }}({{ $youbi }})<i class="fas fa-running fa-3x" id="run-mytime"></i>Start Time:{{ $start_time }}</h4>

<!--印刷表示出ない場合はアイコンを出す-->
@if($print != "print")
<div id="icons-mytime">
<a class="navbar-left" href="/tasks/create"><i class="fas fa-plus-circle fa-2x inner" style="color:red;margin-right: 1rem;"></i></a>
{!! $nextbefore !!}
<a class="navbar-left" href="/mytime/print"><span class="glyphicon glyphicon-print" aria-hidden="true" style="font-size: 2.5rem;"></span></a>
<button id="data_post" class="btn" style="float: right;background-color: inherit;"><i class="fas fa-calculator fa-2x" style="color:blue;float:right;" alt="再計算する"></i></button>
</div>
@endif

<!--タスクリストの表示開始-->
@if($max_cnt > 0)
<span id="mytime_post" class="alert alert-warning"></span>
<form action="{{ $to_post }}" method="post" id="mytime">
    {{ csrf_field() }}

    <ul class="sortable buruburu ul-list">




{{--//各タスクごとの表示開始--}}
@foreach($tasks as $task)

@php

//開始時間の初期化と反映のフラグ
$fix_start=null;
$fix_flag="off";
$free_time=0;


//各タスクの開始時間を計算(最初は個人設定の$start_timeの分換算が入る)
$sum_start=$sum_end;;


//開始時間の初期設定 $fix_startが存在すれば
if($task -> fix_start){
    $fix_start=$task -> fix_start;

    //開始時間があるもので分岐　開始時間をまずは分にする
    $tArry_fix=explode(":",$fix_start);
    $hour_fix=$tArry_fix[0]*60;//時間→分
    $fix_start=$hour_fix+$tArry_fix[1];//分だけを足す

    //空き時間の確認
    $free_time=$fix_start - $sum_start;


    //もし$fix_start　>　$sum_start であれば $sum_startを開始時間の方にする
    if($fix_start >= $sum_start){
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

@if($free_time > 0)
{{--空き時間の表示--}}
@include('commons.mytime_item_free',['free_time' => $free_time])

@endif

@if($print == "print")
{{--印刷用データの表示--}}
@include('commons.mytime_item_print',['item_start'=>$item_start,'item_end' =>$item_end,'list_i' => $i,'fix_flag' => $fix_flag])

@else

{{--通常ペーシデータの表示　但しPCとモバイルなどで分岐--}}
    @php
    $ua = $_SERVER['HTTP_USER_AGENT'];
    @endphp

    @if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false) || (strpos($ua, 'Windows Phone') !== false))


        {{--スマホの場合に読み込むソースを記述--}}
        @include('commons.mytime_item_mobile',['item_start'=>$item_start,'item_end' =>$item_end,'list_i' => $i,'fix_flag' => $fix_flag])

    @elseif ((strpos($ua, 'Android') !== false) || (strpos($ua, 'iPad') !== false))

        {{--タブレットの場合に読み込むソースを記述--}}
        @include('commons.mytime_item_mobile',['item_start'=>$item_start,'item_end' =>$item_end,'list_i' => $i,'fix_flag' => $fix_flag])
        
    @else

        {{--PCの場合に読み込むソースを記述--}}

        @include('commons.mytime_item_pc',['item_start'=>$item_start,'item_end' =>$item_end,'list_i' => $i,'fix_flag' => $fix_flag])
    @endif

@endif

        
@php
//タスクをli表示する時の表示番号をカウントアップ
$i=$i+1;
@endphp

@endforeach


     </ul>
    <input type="hidden" id="result" name="result" />
@if($print !="print")    
    <div class="center-block" style="text-align:center;margin-bottom:1rem;"><i class="fas fa-running fa-2x"></i>スタート時間を<input type="text" id="hour" name="hour" style="width:3rem;">時<input type="text" id="min" name="min" style="width:3rem;">分にして
<!--
<button id="submit" class="btn btn-primary center-block" style="text-align:center;">再計算する</button>
-->

     <button id="data_post2" type="submit" class="btn" style="background-color: inherit;"><i class="fas fa-calculator fa-2x" style="color:blue;" alt="再計算する"></i></button>

    </div>
@else
<!--javascriptのエラー対策　コントローラーで必要なので削除禁止 -->
  <input type="hidden" id="hour" name="hour" style="width:3rem;">
  <input type="hidden" id="min" name="min" style="width:3rem;">

@endif
</form>

@else
<!--今日のタスクがない場合の分岐-->
<div style=text-align:center;"">
    <div class="alert alert-success" role="alert">本日以前が開始日となっている未完了のタスクはありません
    <div>
    <div>
    <a href="/tasks/create"><i class="fas fa-plus-circle fa-2x inner" style="color:red;margin-right: 1rem;"></i>からタスクの追加ができます</a>
    </div>
</div>
@endif
<!--タスクリストの表示終了-->


<script>
<!--

//対象日付の確定 今日か明日で背景色を変える
@if($tm == null)
$(function() {
    //$('body').css('background-color','yellow');
})

@else
$(function() {
    $('body').css('background-color','#C2F4F1');
})

@endif


$(function() {
    $('.mytimelist').on('mousedown', function() {
        $(this).css('background-color','aqua');
        $(this).css('border','solid 2px blue');
    });
    $('.mytimelist').on('mouseup', function() {
        $(this).css('border','inherit');
        $('#mytime_post').text('変更を確定するためには、計算機アイコンをクリックしてください');
        $('#mytime_post').css('display','block');

    });  
});
 

jQuery(function() {
      jQuery(".sortable").sortable();
      jQuery(".sortable").disableSelection();
      jQuery("#data_post,#data_post2").click(function() {
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

//#mytime_postのところに「go」という文字があれば、フォームを自動ポストする
function mytime_post(){
    if($('#mytime_post').text() == "go"){
        $('#mytime_post').text('');
        $('#data_post2').click();
    }else{
    }
}
//setInterval('mytime_post()',1000*10);

$(function () {
  $('.lichange-up').click(function() {
    // 上要素の内容取得 
    var prev_element = $(this).parent().parent().parent().parent().prev('li');
    // 下要素の内容取得 
    //var next_element = $(this).parent().parent().parent().parent().next('li');

    // 設定
    //$(this).parent().parent().parent().parent().before(next_element);
    $(this).parent().parent().parent().parent().after(prev_element);
    
    // 入力欄に採番(1番目に1、2番目に2）
    $('li.element').each(function(i){
      // デフォルトでvalueが設定されている場合はattr('value', value)を併用
      //$(this).find('input').attr('value', i + 1).val(i + 1);
        var result = jQuery(".sortable").sortable("toArray");
        jQuery("#result").val(result);
        jQuery("form").submit();
    });
  });
});


$(function () {
  $('.lichange-down').click(function() {
    // 上要素の内容取得 
    //var prev_element = $(this).parent().parent().parent().parent().prev('li');
    // 下要素の内容取得 
    var next_element = $(this).parent().parent().parent().parent().next('li');

    // 設定
    $(this).parent().parent().parent().parent().before(next_element);
    //$(this).parent().parent().parent().parent().after(prev_element);
    
    // 入力欄に採番(1番目に1、2番目に2）
    $('li.element').each(function(i){
      // デフォルトでvalueが設定されている場合はattr('value', value)を併用
      //$(this).find('input').attr('value', i + 1).val(i + 1);
        var result = jQuery(".sortable").sortable("toArray");
        jQuery("#result").val(result);
        jQuery("form").submit();
    });
  });
});

$(function(){
    
   $(".open_toggle").click(function(){
        
        $(this).next('.contents_toggle').toggle();
        if($(this).text() == "close"){
        $(this).text("edit");
            
        }else{
        $(this).text("close");
            
        }
    });
});


// -->
</script>

@endsection