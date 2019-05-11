@extends('layouts.app')

@section('content')
<div class="row">
@if(session()->has('csrfError'))
    <div class="alert alert-info" style="text-align:center;">セッションの有効期間が過ぎました、再ログインしてください</div>
@endif  
    <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4 text-center" id="login">
        <div class="panel panel-default">
            <div class="panel-heading">ログイン</div>
            <div class="panel-body">
                {!! Form::open(['route' => 'login.post']) !!}
                    <div class="form-group">
                        {!! form::label('email', 'メールアドレス') !!}
                        {!! form::email('email', old('email'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! form::label('password', 'パスワード') !!}
                        {!! form::password('password', ['class' => 'form-control']) !!}
                    </div>

                    <div class="text-right">
                        {!! form::submit('ログイン', ['class' => 'btn btn-success center-block']) !!}
                    </div>
                {!! form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection