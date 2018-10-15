@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@php
$user = Auth::user();
@endphp

@if(count($tasks) > 0)
<ul>
    @foreach($tasks as $task)
<li>{{ $task -> title }}({{ $task -> zone }}){{ $task -> start_date }}{{ $task -> type }}<<a href="/tasks/{{ $task -> id }}/edit">edit</a></li>
    @endforeach
</ul>
@endif

@endsection