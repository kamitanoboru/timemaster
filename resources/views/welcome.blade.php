@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>TIME MASTER</h1>
                @if (Auth::check())
                    <a href="mytime" class="btn btn-success btn-lg">Go to Mytime!</a>
                @else
                <a href="/intro" class="btn btn-success btn-lg">Let's make your time!</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')
    
    

@endsection