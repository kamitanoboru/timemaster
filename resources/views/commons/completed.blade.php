@extends('layouts.app')

@section('content')
<div class="alert alert-danger" role="alert">{{ $message }}</div>
<h3>あと5秒後に{{ $redirect }}{{ $url }}に移動します。</h3>


<script type="text/javascript">
<!--
// 一定時間経過後に指定ページにジャンプする
waitTimer = 5; // 何秒後に移動する
url = "{{ $url }}"; // 移動するアドレス
function jumpPage() {
  location.href = url;
}
//setTimeout("jumpPage()",waitTimer*1000)
//-->
</script>

@endsection