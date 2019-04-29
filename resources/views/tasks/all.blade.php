@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@php
$user = Auth::user();
$start_date=null;
@endphp

@if(count($tasks) > 0)


<h3 style="text-align: center;" class="mytime-title">全てのタスク&スケジュール　リスト</h3>



<ul class="ul-list">
    @foreach($tasks as $task)
        @if($start_date == $task -> start_date)
        
        @else
            @php
            $start_date = $task -> start_date;
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
            $youbi=$week[date("w",strtotime($start_date))] . '曜日';
            @endphp
            <li class="each_date">{{ $start_date }}({{ $youbi }})</li>
        @endif
        
@include('commons.future_item')
    @endforeach
</ul>


<ul class="ul-list">
    <li class="repeat_lists">繰り返しタスク一覧</li>
    @foreach($tasks as $task)
        @if($task -> type == "repeat")
            @include('commons.future_item_repeat')
        @endif
    @endforeach    
</ul>
<!--データのダウンロードファイルの作成-->


@else
<div style=text-align:center;"">
    <div class="alert alert-success" role="alert">未完了のタスクはありません
    <div>
    <div>
    <a href="/tasks/create"><i class="fas fa-plus-circle fa-2x inner" style="color:red;margin-right: 1rem;"></i>からタスクの追加ができます</a>
    </div>
</div>
@endif
<script>
<!--
    ;(function($) {
        $(function() {
            $('a.destroy').on('click', function() {
                $(this).parents('li').css('background-color','#bbbbbb');
            });
         });
     })(jQuery);
-->
</script>     
@endsection