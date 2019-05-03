<li id="{{ $task -> id }}-{{ $list_i }}" class="fix-{{ $fix_flag }} mytimelist list-{{ $task -> id }}">
    <table class="table-condensed" style="width:100%;">
        <tr>
            <td style="width:15rem;">
                <span class="time"><span class="stime">{{ $item_start }}</span>-<span class="etime">{{ $item_end }}</span> ( {{ $task -> task_time }}min )</span>
            </td>
            <td style="width:10rem;">
            
                <!--開始時間遅れ　ドクロマークと指定開始時間表示 -->
                @if($fix_flag == "on")        
                  <span class="timeover"></span>
                @endif
                @if($task -> fix_start)
                    @php
                    $fix_start_view=substr($task -> fix_start, 0, 5)
                    @endphp
                    [{{ $fix_start_view }}]
                @endif
                
                <!--開始日時が今日より前に日付を表示-->
                @if($task -> start_date < date('Y-m-d'))
                <!--
                  <span class="label label-default date-list">{{ $task -> start_date }}</span>
                 --> 
                @endif
                
                <!--新着タスク　若葉マーク-->
                @if($before_flag == "newlist")
                <span class="newlist"></span>
                @endif


                
                    <!--繰り返しタスクマーク-->
                    @if($task -> type == "repeat")        
                        <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>        
                    @endif
                </td>
                <td>
                <span class="task_title">{{ mb_strimwidth( $task -> title , 0, 70, "...", "UTF-8" ) }}</span>

                     
                
                <!--メモありタスクマーク-->
                @if(strlen($task -> memo) > 0)
                <a href="/tasks/{{ $task -> id }}/memo_view" class="modalBtn"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" id="my-button"></span></a>
                @endif

　              <a href="/changedate/{{ $task -> id }}/1" class="modalBtn"><span class="label label-info front-plus1" id="plus1" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(1) }}">＋1D</span></a>
                <!--削除アイコン-->
                <a href="/tasks/{{ $task -> id }}/destroy" class="modalBtn destroy front-destroy"><i class="fas fa-trash-alt fa-2x"></i></a>              
                <a class="open_toggle" style="float: right;"><i class="fas fa-edit fa-2x"></i></a>       
                


         
                <div class="contents_toggle" style="display:none;float: right;">
                

                    <div class="mb-3">
                    <!--編集アイコン-->
                    <a href="/tasks/{{ $task -> id }}/edit" class="modalBtn"><i class="fas fa-external-link-alt fa-2x"></i></a>
                    <!--削除アイコン-->
                    <a href="/tasks/{{ $task -> id }}/destroy" class="modalBtn destroy"><i class="fas fa-trash-alt fa-2x"></i></a><br>
                    </div>
                    <div class="mb-3">
                    <!--開始日変更ラベル-->
                    @if($tm == null)
                      <a href="/changedate/{{ $task -> id }}/1" class="modalBtn"><span class="label label-info" id="plus1" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(1) }}">＋1D</span></a>
                      <a href="/changedate/{{ $task -> id }}/2" class="modalBtn"><span class="label label-info" id="plus2" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(2) }}">＋2D</span></a>
                      <a href="/changedate/{{ $task -> id }}/3" class="modalBtn"><span class="label label-info" id="plus3" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(3) }}">＋3D</span></a>
                      <a href="/changedate/{{ $task -> id }}/4" class="modalBtn"><span class="label label-info" id="plus4" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(4) }}">＋4D</span></a>
                     </div>
                     <div class="mb-3">
                      <a href="/changedate/{{ $task -> id }}/5" class="modalBtn"><span class="label label-info" id="plus5" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(5) }}">＋5D</span></a>
                      <a href="/changedate/{{ $task -> id }}/6" class="modalBtn"><span class="label label-info" id="plus6" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(6) }}">＋6D</span></a>
                      <a href="/changedate/{{ $task -> id }}/7" class="modalBtn"><span class="label label-info" id="plus7" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(7) }}">＋7D</span></a>
                      <a href="/changedate/{{ $task -> id }}/8" class="modalBtn"><span class="label label-info" id="plus8" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(8) }}">＋8D</span></a>
                     </div>
                     <div class="mb-3">
                      <a href="/changedate/{{ $task -> id }}/14" class="modalBtn"><span class="label label-info" id="plus14" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(14) }}">＋2W</span></a>
                      <a href="/changedate/{{ $task -> id }}/30" class="modalBtn"><span class="label label-info" id="plus30" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(30) }}">＋1M</span></a>
                      <a href="/changedate/{{ $task -> id }}/180" class="modalBtn"><span class="label label-info" id="plus180" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(180) }}">＋6M</span></a>
                      <a href="/changedate/{{ $task -> id }}/365" class="modalBtn"><span class="label label-info" id="plus365" data-toggle="tooltip" data-placement="down" title="{{ get_date_and_week(365) }}">＋1Y</span></a>
                    @else
                      <a href="/changedate/{{ $task -> id }}/2" class="modalBtn"><span class="label label-info" id="plus1">＋1</span></a>
                      <a href="/changedate/{{ $task -> id }}/3" class="modalBtn"><span class="label label-info" id="plus2">＋2</span></a>
                      <a href="/changedate/{{ $task -> id }}/8" class="modalBtn"><span class="label label-info" id="plus7">＋7</span></a>
                    @endif
                    </div>

                
                </div>

                @if($list_i <= 3)
                <!-- push通知-->
                <!--
                　<a href="#" style="float: right;margin-right:20px;"><span class="push">Alerm</span></a>
                -->　
                @endif
 


            </td>
        </tr>

    </table>
</li>
