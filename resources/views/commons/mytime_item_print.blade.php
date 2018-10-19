<li id="{{ $task -> id }}-{{ $list_i }}" class="fix-{{ $fix_flag }} mytimelist print-font">
<div class="item">
    <div class="time"> {{ $item_start }}-{{ $item_end }} ( {{ $task -> task_time }}min )</div>
    
    
    
    
   <div class="title">
       <i class="far fa-square fa-3x for-print"></i>
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
        
        {{ $task -> title }}
@if($task -> type == "repeat")        
<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>        
@endif
@if(strlen($task -> memo) > 0)
@php
$memo=$task -> memo;
@endphp
<a data-target="modal{{ $task -> id }}" class="modal-open"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" id="my-button"></span></a>
<div id="modal{{ $task -> id }}" class="modal-content">{!! nl2br(e($memo)) !!}</div>

@endif
        </div>
    <div class="dd"></div>
<!--    
    <div class="check"><input type="checkbox" name="taskid-{{ $task -> id }}"></div>
-->
    
    
</div>    
    
</li>