@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@php
$user = Auth::user();
$start_date=null;
@endphp

@if(count($tasks) > 0)


<h3 style="text-align: center;" class="mytime-title">明日以降のタスク&スケジュール　リスト</h3>

<ul class="ul-list">
    @foreach($tasks as $task)
        @if($start_date == $task -> start_date)
        
        @else
            @php
            $start_date = $task -> start_date;
            @endphp
            <li class="each_date">{{ $start_date }}</li>
        @endif
        
@include('commons.future_item')
    @endforeach
</ul>


<ul class="ul-list">
    <li class="repeat_lists">繰り返しタスク一覧<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></li>
    @foreach($tasks as $task)
        @if($task -> type == "repeat")
            @include('commons.future_item_repeat')
        @endif
    @endforeach    
</ul>




@else
<div style=text-align:center;"">
    <div class="alert alert-success" role="alert">明日以降の未完了のタスクはありません
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