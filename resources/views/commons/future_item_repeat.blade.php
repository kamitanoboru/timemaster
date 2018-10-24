<li id="{{ $task -> id }}" class="future-list list-{{ $task -> id }}">
    
    <table class="table-condensed" style="width:100%;">
        <tr>
            <td>
                
                @if($task -> type == "repeat")        
                    <span class="label label-info" style="font-size:1.2rem;">次回開始日:{{ $task -> start_date }}</span>
                @endif
                
                @if($task -> fix_start != null)
                    @php
                    $fix_start=substr($task -> fix_start, 0, 5)
                    @endphp
                    <span style="font-weight:bold;background-color: coral;">{{ $fix_start }}</span>
                @endif

                {{ $task -> title }}
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">
                

                
                <!--メモありタスクマーク-->
                @if(strlen($task -> memo) > 0)
                <a href="/tasks/{{ $task -> id }}/memo_view" class="modalBtn"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" id="my-button"></span></a>
                @endif

                <a href="/tasks/{{ $task -> id }}/edit" class="modalBtn"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                <a href="/tasks/{{ $task -> id }}/destroy" class="modalBtn destroy"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a>

            </td>
        </tr>
    </table>    
</li>


<!--

<li id="{{ $task -> id }}" class="future-list list-{{ $task -> id }}">
<div class="item">
    
    
    
  
    <div class="title">     
@if($task -> fix_start != null)
<span style="font-weight:bold;background-color: coral;">{{ $task -> fix_start }}</span>
@endif

        
        {{ $task -> title }}({{ $task -> id }})
<sapn class="edit"><a href="/tasks/{{ $task -> id }}/edit" class="modalBtn" style="display: inherit;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></span>
@if($task -> type == "repeat")        
<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
<span class="label label-info" style="font-size:1.2rem;">次回開始日:{{ $task -> start_date }}</span>
@endif
@if(strlen($task -> memo) > 0)
<a data-target="modal{{ $task -> id }}" class="modal-open"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" id="my-button"></span></a>
<div id="modal{{ $task -> id }}" class="modal-content">{{ $task -> memo }}</div>

@endif
        </div>

    <div class="ok"><a href="/tasks/{{ $task -> id }}/destroy" class="modalBtn destroy"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a></div>
   
    
    
</div>    
    
</li>

-->