<div>
    Showing 

    @if($items->currentpage() == 1 && $items->count() == 0)
        0
    @else
        {{($items->currentpage()-1)*$items->perpage()+1}}
    @endif

    to 

    @if($items->currentpage() == 1 && $items->count() == 0)
        0
    @elseif($items->count() < $items->perpage())
        {{ $items->currentpage()*$items->perpage() + ($items->count() - $items->perpage()) }}
    @else
        {{ $items->currentpage()*$items->perpage() }}
    @endif

    of  

    {{$items->total()}} 

    entries
</div>