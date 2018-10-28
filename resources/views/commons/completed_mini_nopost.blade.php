@extends('layouts.app_mini')

@section('content')

<div class="alert alert-danger" role="alert" style="margin-top:4rem;">{{ $message }}</div>
<div>自動的にこのウィンドウは閉じられます</div>

<script>
<!--
    $(function() {
        
        
        //親ウィンドウをリロード これで子ウィンドウも一緒になくなる
        function func1(){
            //parent.location.href=parent.location.href;
            //$('#data_post2',parent.document).click();
            $('#mytime_post',parent.document).text('一連の変更処理後、計算機のアイコンを押してください');
        }
        function func2(){
            $('ul .{{ $list_id }}',parent.document).animate({opacity:0},3000)
        }
        
        //子ウィンドウを閉じる
        
        function func3(){
            $('#mdOverlay,#mdWindow',parent.document).remove();
        }
        
        setTimeout(func2, 1000);
        setTimeout(func1, 2000);
        setTimeout(func3, 2000);
    });
-->
</script>             


@endsection