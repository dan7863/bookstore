@if(!isset($subgenders))
    @php $subgenders = []; @endphp
@endif

<div class = "mt-6 flex-wrap">
    @if(!empty($subgenders))
        @foreach($subgenders as $subgender)
        <a href = "{{route('books_store.subgender', $subgender)}}" rel="noopener" target="_blank">
            <div style = "display: inline-block; background-color: rgb(229 231 235);
            border-radius: 9999px;
            cursor: pointer; padding: 0.5em; color: black; margin-right: 1%;">
                <span>{{$subgender->name ?? $subgender}}</span>
            </div>
        </a>
        @endforeach
    @endif
</div>
