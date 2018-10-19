<li id="{{ $task -> id }}" class="future-list">
<div class="item">
    
    
    
  
    <div class="title">     
@if($task -> fix_start != null)
@php
$fix_start=substr($task -> fix_start, 0, 5)
@endphp
<span style="font-weight:bold;background-color: coral;">{{ $fix_start }}</span>
@endif

        
        {{ $task -> title }}({{ $task -> id }})
<sapn class="edit"><a href="/tasks/{{ $task -> id }}/edit" class="modalBtn" style="display: inherit;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></span>
@if($task -> type == "repeat")        
<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>

@endif
@if(strlen($task -> memo) > 0)
<a data-target="modal{{ $task -> id }}" class="modal-open"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" id="my-button"></span></a>
<div id="modal{{ $task -> id }}" class="modal-content">{{ $task -> memo }}</div>

@endif
        </div>

    <div class="ok"><a href="/tasks/{{ $task -> id }}/destroy" class="modalBtn destroy"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a></div>
    
<!--    
    <div class="check"><input type="checkbox" name="taskid-{{ $task -> id }}"></div>
-->
    
    
</div>    
    
</li>