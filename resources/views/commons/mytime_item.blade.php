<li id="{{ $task -> id }}-{{ $list_i }}" class="fix-{{ $fix_flag }} mytimelist list-{{ $task -> id }}">
<div class="item">
    <div class="time"> {{ $item_start }}-{{ $item_end }} ( {{ $task -> task_time }}min )</div>
    
    
    
    
    <div class="edit"><a href="/tasks/{{ $task -> id }}/edit" class="modalBtn" style="display: inherit;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></div>
    <div class="title">
@if($task -> start_date < date('Y-m-d'))        
      <span class="label label-default">{{ $task -> start_date }}</span>  
@endif
@if($fix_flag == "on")        
      <i class="fas fa-skull-crossbones fa-2x"></i>
@endif
@if($task -> fix_start)
[{{ $task -> fix_start }}]
@endif

@if($before_flag == "newlist")
<span class="glyphicon glyphicon-leaf" aria-hidden="true" id="my-button"></span>
@endif
        
        {{ $task -> title }}({{ $task -> task_order }})
@if($task -> type == "repeat")        
<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>        
                <!--メモありタスクマーク-->
                @if(strlen($task -> memo) > 0)
                <a href="/tasks/{{ $task -> id }}/memo_view" class="modalBtn"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" id="my-button"></span></a>
                @endif
        </div>
        

        
        
    <div class="dd"><a href="#"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span></a></div>
    <div class="ok"><a href="/tasks/{{ $task -> id }}/destroy" class="modalBtn destroy"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a></div>
    
<!--    
    <div class="check"><input type="checkbox" name="taskid-{{ $task -> id }}"></div>
-->
    
    
</div>    
    
</li>