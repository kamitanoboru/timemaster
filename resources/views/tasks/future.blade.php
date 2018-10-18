@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@php
$user = Auth::user();
$start_date=null;
@endphp

@if(count($tasks) > 0)
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
@endif

@endsection