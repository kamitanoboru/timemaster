<li id="{{ $task -> id }}-{{ $list_i }}">
<div class="item">
    <div class="time"> {{ $item_start }}-{{ $item_end }} ( {{ $task -> task_time }}min )</div>
    
    
    
    
    <div class="edit"><a href="/tasks/{{ $task -> id }}/edit" class="modalBtn"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></div>
    <div class="title">
@if($task -> start_date < date('Y-m-d'))        
      <span class="label label-default">{{ $task -> start_date }}</span>  
@endif
        
        {{ $task -> title }}({{ $task -> id }})
@if($task -> type == "repeat")        
<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>        
@endif
        </div>
    <div class="dd"><a href="#"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span></a></div>
    <div class="ok"><a href="/tasks/{{ $task -> id }}/destroy" class="modalBtn"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a></div>
    
<!--    
    <div class="check"><input type="checkbox" name="taskid-{{ $task -> id }}"></div>
-->
    
    
</div>    
    
</li>