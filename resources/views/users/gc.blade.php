@extends('layouts.app_mini')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@if (Auth::check())
@php


$user = Auth::user();

$user_gc=htmlspecialchars_decode($user -> gc);

//$user_gc=null;

@endphp

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h3>{{ $user ->name }}さん のグーグルカレンダー</h3>
        @if($user_gc == null)
        カレンダーの設定がされていません<br>
        ご利用のgoogleカレンダーのiframeタグをアカウント管理から登録すると、ここにカレンダーが表示され、予定を確認することができます。
        @else
        {!! $user_gc !!}
        @endif
    </div>
@endif
@endsection