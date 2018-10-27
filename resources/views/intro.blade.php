@extends('layouts.app')


@section('content')
<div class="intro">
@if(Auth::check() == false)
<div id="signup">
利用するには<a href="/signup" style="background-color:yellow;">新規登録</a>が必要です    
</div>
@endif
<h1>TIME MASTER Concept & How to Use & Help</h1>
<h2>Concept</h2>
    <h3>「TIMEMASTER」はタスクから一日のスケジュールを作るサービスです</h3>
    <ul class="list-group">
        <li class="list-group-item">コンセプト　毎日の行動に充実感を持てるための支援ツールです</li>
        <li class="list-group-item">対象者 たくさんのタスクを抱える方、効率的な時間管理をしたい方</li>
        <li class="list-group-item">メリット　一日のタスクが効率的に進みます</li>
        <li class="list-group-item">特徴　タスクの優先(実行)順を決めると、自動的にスケジュールリングします</li>
    </ul>
<h2>How to Use</h2>    
    <h3>タスクを追加する</h3>
        
            <div><i class="fas fa-plus-circle fa-2x" style="color:red;"></i>のアンコンからタスクをいつでも追加してください</div>
            <p>
                タスクのタイトルだけを書いて、「タスク追加」ボタンを押すことでOKです。<br>
                この場合は、開始日は明日に設定されます。またタスクのデフォルトの所要時間は20分になっています。<br>
                詳細設定で、開始日や所要時間、繰り返しタスク、メモなどを登録、カスタマイズすることも可能です。<br>
                また、この詳細はいつでも編集アイコン<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>から変更可能です。
            </p>
            <img src="{{ secure_asset("images/intro_head.png") }}" alt="add Task">
        
    <h3>毎日の朝に一日のスケジューリングをする</h3>
        
            <div><span class="b-yellow">「マイタイム(mytime)」</span>ページに行くと、今日を開始日に設定されているタスクのリストが表示されています。</div>
            <img src="{{ secure_asset("images/logo.png") }}" style="width: 200px;margin: 2rem 0;padding: 6px;" alt="add Task">
            <div>ログインしている場合、このロゴをクリックすると「マイタイム(mytime)」ページに行きます。</div>
            <div>
                タスクのリストは、新規タスク登録時の「時間帯」の順番に最初は並んでいますが、順番を変更することでお好きな順番になります。
            </div>
                        
              <ol>
                    <li><div class="title">優先順(実行順)に並び替える</div>
                        <div>
                        タスクのリストは<span class="b-yellow">ドラック&ドロップで上下に動きます</span>ので、実行したい順番にならべてください。
                        自分の状況(その時にいる場所、条件、気分、体調など)に合わせて、優先すべき順に並べることをおすすめします。
                        </div>
                    </li>
                    <li><div class="title">いらないタスクは削除しましょう</div>
                        <div>
                            PCの場合は、編集・削除アイコンは<span class="b-yellow">「edit」</span>という文字をクリックすると現れます。
                            スケジューリングしている時に、「このタスクはいらない」と思うものがあれば、<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>アイコンから削除できます。
                        </div>
                    </li>
                    <li><div class="title">今日はしないもの、開始日をずらしいたいものは、開始日をずらしましょう。</div>
                        <div>
                            PCの場合は、編集・削除アイコンは「edit」という文字をクリックすると現れます。<br>
                            編集アイコン<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>から開始日を設定し直すことができます。<br>
                            単に翌日や翌々日、来週に先送りしたい場合は、<span class="b-yellow">「＋1」「＋2」「+7」のラベル</span>をクリックすると、
                            開始日が簡単に変更できます。
                        </div>
                    </li>
                    <li><div class="title">並べなおしたり、タスクの編集や削除をした後は、適時、計算機アイコンをクリックしてください。</div>
                        <div>
                            タスクの背景色に色がついている場合は、まだ確定していないので、計算機アイコン<i class="fas fa-calculator fa-2x" style="color:blue;" alt="再計算する"></i>を適時押してください。
                            そうすると、順番が確定していきます。
                        </div>
                        
                    </li>
                </ol>
     <div>上記ののサイクルを回して、一日のスケジュールを確定させてください</div>
            
                <p>これらは一日のうち、適時行うことができますので、スケジュールの変化や状況の変化にフレキシブルに対応できます。</p>
         

            
            <div style="margin-bottom:4rem;">
                リストの一番左に、実際の時間帯が出ていますので、自分で納得するスケジュールを作成してください。
            </div>
            
            <div>リストのアイコンなどの説明</<div>
                <img src="{{ secure_asset("images/intro_resize.png") }}" alt="make schedule">
            </div>
        
    <h3>前日の夜に翌日のスケジューリングをする</h3>
        <p>上記の作業と同様に、前日に翌日のスケジュールを済ませてしまうためには、<i class="fas fa-arrow-alt-circle-right fa-2x" style="color:green;margin-right: 1rem;"></i>のアイコンをクリックしてください。
        翌日のスケジュール作成ページに行きます。
        </p>
    <h3>開始時間の設定</h3>
        <h4>毎日の作業の開始時間をカスタマイズするには</h4>
        <p>
            アカウントから、開始時間を登録してください。この時間を基本として一日のスケジュールを計算します。
            ただし、その時間を過ぎている場合には、今の時間の10分後が開始時間となります。
        </p>
        <h4>開始時間が決まっているタスク(「予定」)も登録できます</h4>
        <p>
            その場合は、その開始時間と所要時間が固定化されて表示されます。
            もし、その前のタスクにより、予定の開始時間が守れない場合には、<span class="b-yellow">ドクロアイコン<i class="fas fa-skull-crossbones"></i>が出現し、背景が黄色</span>になります。
            その場合は、タスクの順番を変えるなどして修正してください。
        </p>

<h2>Help</h2>
<ul class="list-group">
    <li class="list-group-item"><div class="title">スケジュールの印刷ができませんか</div>
        <div>
            印刷アイコン<span class="glyphicon glyphicon-print" aria-hidden="true" style="font-size: 2.5rem;"></span>で一日のスケジュールがプリントできます。余計なアイコンなどの表示は省いています。
        </div>
    </li>
    <li class="list-group-item"><div class="title">繰り返しタスクの周期は登録できますか</div>
        <div>
            「繰り返しタスク」であることは設定できますが、周期は登録できません。タスクを削除する時に、次回の開始日を指定するようにしてください。
        </div>
    </li>
    <li class="list-group-item"><div class="title">休憩や食事タイムや予備時間は設定できますか</div>
        <div>
            休憩や食事、予備時間もすべてタスクとして登録してください。繰り返しタスクにすることもできます。
        </div>
    </li>
    <li class="list-group-item"><div class="title">タスクのジャンルは設定できますか</div>
        <div>
            ジャンルの設定はできません。タスク名の先頭に「(ジャンル名)タスク名」などと書くと、全タスクの一覧などは
            ソートされるので、ジャンルごとに見ることができます。
        </div>
    </li>
    <li class="list-group-item"><div class="title">タスクに優先度や重要度を設定できますか</div>
        <div>
            できません。状況において優先順位は変更されるので、スケジューリングする上であまり参考にならないという考えに基づいています。
        </div>
    </li>
    <li class="list-group-item"><div class="title">スマホやタブレットでも使えますか</div>
        <div>
            はい、PC画面とは少し異なりますが、専用の画面で使えます。
            (タスクのドラッグ&ドロップでの移動に対応していませんが、アイコンで順番を変更できます。)
        </div>
    </li>
    <li class="list-group-item"><div class="title">スケジューリングの開始時間が思うような時間になりません</div>
        <di>
            一番最初に来るタスクに開始時間を設定してください。そこが、一日の開始時間になります。
            「作業開始」というタスクでもOKです。
        </di>
    </li>
    <li class="list-group-item"><div class="title">完了したタスクは都度削除していいのでしょうか</div>
        <div>
            はい、削除してもOKです。その時間から再スケジューリングされますので、より正確なスケジューリングになります。
        </div>
    </li>
    <li class="list-group-item"><div class="title">立てたスケジュールどおり行きませんでした。どうするといいですか</div>
        <div>
            スケジューリングをその時点からやり直すことをおすすめします。
        </div>
    </li>
</ul>

<h2>Others</h2>
    
                <div>ヘッダーのアイコンなどの説明</<div>
                <div>
                <img src="{{ secure_asset("images/header_icons.png") }}" alt="header_icons" style="width:300px"><br>
                <i class="far fa-calendar-alt fa-2x"></i> カレンダー表示(googleカレンダーのiframeタグの登録が必要)<br>
                <i class="far fa-comment-alt fa-2x"></i>　自分のメモなどの表示(アカウント管理より登録できます)<br>
                <i class="fas fa-plus-circle fa-2x" style="color:red;"></i>　タスク登録<br>
                <i class="fas fa-question-circle fa-2x" style="color:green;"></i>このページへのリンクアイコン<br>
                </div>
            
    
<div>    

@endsection