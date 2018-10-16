@extends('layouts.app_mini')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
@php

$user = Auth::user();

@endphp

    
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h3>このタスクを完了しますか?</h3>
<div class="alert alert-danger" role="alert">「このタスクを完了する」を押すと、タスクは削除されます。</div>
    {!! Form::model($task, ['route' => ['tasks.destroy'], 'method' => 'post']) !!}
    
        <div class="form-group"　name="destroy">
@if($task -> type == 'repeat')
このタスクはタイプが「繰り返し」です。今後も繰り返さず完全に削除するには、以下にチェックを入れてください。
<br>完全に削除する<input type="checkbox" name="repeat_del">
@endif
       {!! Form::hidden('task_id',$task -> id,['class'=>'form-control']) !!}        </div>
        {!! Form::submit('タスクを完了する', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
        </div>
    </div>

@endsection