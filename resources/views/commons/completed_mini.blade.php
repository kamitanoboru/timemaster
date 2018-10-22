@extends('layouts.app_mini')

@section('content')

<div class="alert alert-danger" role="alert" style="margin-top:4rem;">{{ $message }}</div>

<script>
<!--
    $(function() {
        
        
        //親ウィンドウをリロード これで子ウィンドウも一緒になくなる
        function func2(){
            //parent.location.href=parent.location.href;
            //$('#mytime',parent.document).submit();
            $('#mytime_post',parent.document).text('go');
        }
        function func1(){
            $('ul .{{ $list_id }}',parent.document).animate({opacity:0},3000)
        }
        
        //子ウィンドウを閉じる
        /*
        function func2(){
            $('#mdOverlay,#mdWindow',parent.document).remove();
        }
        */
        //setTimeout(func1, 1000);
        setTimeout(func2, 1000);
    });
-->
</script>             


@endsection