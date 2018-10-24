@extends('layouts.app')

@section('content')
<div class="alert alert-danger" role="alert">{{ $message }}</div>
<h3>あと3秒後に{{ $redirect }}に移動します。</h3>
        @include('commons.links')
<script type="text/javascript">
<!--
// 一定時間経過後に指定ページにジャンプする
waitTimer = 3; // 何秒後に移動する
url = "{{ $url }}"; // 移動するアドレス
function jumpPage() {
  location.href = url;
}
setTimeout("jumpPage()",waitTimer*1000)
//-->
</script>

@endsection