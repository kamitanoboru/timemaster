@extends('layouts.app_mini')

@section('content')
@php
$user = Auth::user();
@endphp
<!-- ここにページ毎のコンテンツを書く -->
<div class="row">

    <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

        <h1>複数タスクのCSVインポート</h1>

        <h4>以下のような形式でCSVファイルを準備してください</h4>
        
<table class="table">
	<thead>
		<tr>
			<th>タイトル</th>
			<th>単発か定期か</th>
			<th>開始日</th>
			<th>処理時間</th>
            <th>重要フラグ</th>
            <th>緊急フラグ</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>プレゼントを購入</th>
			<td>single</td>
			<td>2020-05-05</td>
			<td>30</td>
			<td>1</td>
			<td></td>
		</tr>
		<tr>
			<th>パソコンの修理</th>
			<td>single</td>
			<td>2020-04-01</td>
			<td>45</td>
			<td></td>
			<td>1</td>
		</tr>
		<tr>
			<th>キッチン回りの整頓</th>
			<td>repeat</td>
			<td>2020-03-20</td>
			<td>15</td>
			<td></td>
			<td></td>
		</tr>	</tbody>
</table>        
        
        
        
<h4>CSVの仕様</h4>
<ol>
    <li>1行目は処理されませんので、項目名などを入れておいて構いません。</li>
    <li>カンマ区切りのCSVになっている</li>
    <li>「単発」タスクの場合は、single、「定期」タスクの場合は、repeatにしてください。</li>
    <li>開始日の書式は、YYYY-MM-DDにしてください。</li>
    <li>「処理時間」は分数です。</li>
    <li>「重要フラグ」は、重要の場合は、1を入れてください。同様に、「緊急フラグ」は、緊急の場合は、1を入れてください。</li>
    <li>タイトル以外は、すべて半角の英数文字です。</li>
</ol>

        <form role="form" method="post" action="csv" enctype="multipart/form-data">
            {{ csrf_field() }}
            {!! Form::hidden('user_id',$user -> id,['class'=>'form-control']) !!}
            <input type="file" name="csv_file" id="csv_file">
            <div class="form-group" style="margin-top:15px">
                <button type="submit" class="btn btn-default btn-success">インポートする</button>
            </div>
        </form>

    </div>
</div>
@endsection