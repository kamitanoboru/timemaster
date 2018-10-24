<li id="{{ $task -> id }}-{{ $list_i }}" class="fix-{{ $fix_flag }} mytimelist list-{{ $task -> id }}">
    <table class="table-condensed" style="width:100%;">
        <tr>
            <td style="width:100%;">
                <span class="glyphicon glyphicon-hand-up" aria-hidden="true" style="font-size: 130%;"></span>
                <span class="time">{{ $item_start }}-{{ $item_end }} ( {{ $task -> task_time }}min )</span>
                
                <!--開始時間遅れ　ドクロマークと指定開始時間表示 -->
                @if($fix_flag == "on")        
                  <i class="fas fa-skull-crossbones"></i>
                @endif
                @if($task -> fix_start)
                    [{{ $task -> fix_start }}]
                @endif
                
                <!--開始日時が今日より前に日付を表示-->
                @if($task -> start_date < date('Y-m-d'))        
                  <span class="label label-default date-list">{{ $task -> start_date }}</span>  
                @endif
                
                <!--新着タスク　若葉マーク-->
                @if($before_flag == "newlist")
                <span class="glyphicon glyphicon-leaf" aria-hidden="true" id="my-button"></span>
                @endif


                <span class="task_title">
                    <!--繰り返しタスクマーク-->
                    @if($task -> type == "repeat")        
                        <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>        
                    @endif
                    
                </span>
                
                {{ $task -> title }}     
                
                <!--メモありタスクマーク-->
                @if(strlen($task -> memo) > 0)
                <a href="/tasks/{{ $task -> id }}/memo_view" class="modalBtn"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" id="my-button"></span></a>
                @endif
                
                <a href="#" class="open_toggle" style="float: right;">edit</a>                
                <div class="contents_toggle" style="display:none;float: right;">
                
                <!--編集アイコン-->
                <a href="/tasks/{{ $task -> id }}/edit" class="modalBtn"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                
                <!--開始日変更ラベル-->
                  <a href="/changedate/{{ $task -> id }}/1" class="modalBtn"><span class="label label-info" id="plus1">＋1</span></a>
                  <a href="/changedate/{{ $task -> id }}/2" class="modalBtn"><span class="label label-info" id="plus2">＋2</span></a>
                  <a href="/changedate/{{ $task -> id }}/7" class="modalBtn"><span class="label label-info" id="plus7">＋7</span></a>
                
                <!--削除アイコン-->
                <a href="/tasks/{{ $task -> id }}/destroy" class="modalBtn destroy"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a>
                
                </div>

            </td>
        </tr>

    </table>
</li>
