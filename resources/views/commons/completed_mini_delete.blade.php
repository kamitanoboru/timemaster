@extends('layouts.app_mini')

@section('content')
@php
$user = Auth::user();
$user_name=$user -> name;
@endphp

<div class="alert alert-danger" role="alert" style="margin-top:1rem;">{{ $user_name."さん ".$message }}<br><strong>{{ $user_name}}さんってスゴイなあ～</strong></div>
@if($flag == "delete completed")
<div><img src="/images/great.png"></div>
@endif
<div>自動的にこのウィンドウは閉じられます</div>

<script>
<!--
    $(function() {
        
        
        //親ウィンドウをリロード これで子ウィンドウも一緒になくなる
        function func1(){
            //parent.location.href=parent.location.href;
            $('#data_post2',parent.document).click();
            //$('#mytime_post',parent.document).text('go');
        }
        function func(){
            $('ul .{{ $list_id }}',parent.document).animate({opacity:0},3000)
        }
        
        //子ウィンドウを閉じる
        /*
        function func2(){
            $('#mdOverlay,#mdWindow',parent.document).remove();
        }
        */
        setTimeout(func1, 4000);
        //setTimeout(func2, 2000);
    });
-->
</script>             


@endsection