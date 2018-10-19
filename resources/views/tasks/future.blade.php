@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@php
$user = Auth::user();
$start_date=null;
@endphp

@if(count($tasks) > 0)


<h3 style="text-align: center;">明日以降のタスク&スケジュール　リスト</h3>

<ul>
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


<ul>
    <li class="repeat_lists">繰り返しタスク一覧<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></li>
    @foreach($tasks as $task)
        @if($task -> type == "repeat")
            @include('commons.future_item_repeat')
        @endif
    @endforeach    
</ul>





@endif

@endsection