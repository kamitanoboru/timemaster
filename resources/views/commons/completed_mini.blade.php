@extends('layouts.app_mini')

@section('content')

<div class="alert alert-danger" role="alert" style="margin-top:4rem;">{{ $message }}</div>

<script>
<!--
    $(function() {
        
        
        //親ウィンドウをリロード これで子ウィンドウも一緒になくなる
        function func1(){
            parent.location.href=parent.location.href;
        }
        
        //子ウィンドウを閉じる
        /*
        function func2(){
            $('#mdOverlay,#mdWindow',parent.document).remove();
        }
        */
        setTimeout(func1, 3000);
        //setTimeout(func2, 3000);
    });
-->
</script>             


@endsection