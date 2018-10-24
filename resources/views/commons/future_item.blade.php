<li id="{{ $task -> id }}" class="future-list list-{{ $task -> id }}">
    
    <table class="table-condensed" style="width:100%;">
        <tr>
            <td>
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
                
                @if($task -> type == "repeat")        
                    <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
                @endif
                
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
