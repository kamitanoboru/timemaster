@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>TIME MASTER</h1>
                @if (Auth::check())
                    <a href="mytime" class="btn btn-success btn-lg">マイタイムに行く</a>
                @else
                <a href="/signup" class="btn btn-success btn-lg">時間の効率化を手にしますか?</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')
    テスト
    

@endsection