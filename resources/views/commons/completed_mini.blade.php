@extends('layouts.app_mini')

@section('content')


<div class="alert alert-danger" role="alert" style="margin-top:1rem;">{{ $message }}</div>

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
        setTimeout(func1, 1000);
        //setTimeout(func2, 2000);
    });
-->
</script>             


@endsection