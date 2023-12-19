<div>
    <div class = "flex flex-wrap flex-row justify-center mt-8">
        @foreach($alphabet as $char_alphabet)
            <div @if(in_array($char_alphabet, $author_alphabet)) wire:click="$set('char', '{{ $char_alphabet }}')"
                    @if($char_alphabet == $char)
                        class = "w-20 text-center m-2 p-2 bg-gray-500
                        hover:bg-gray-700"
                    @else
                        class = "w-20 text-center m-2 p-2 bg-gray-300
                        hover:bg-gray-500 hover:text-white cursor-pointer"
                    @endif
                @else
                    class = "w-20 text-center m-2 p-2 bg-gray-100 text-gray-400"
                @endif">
                <label>{{$char_alphabet}}</label>
            </div>
        @endforeach
    </div>
    <div class = "mt-8">
        <div>
            <h1 class = "bg-gray-900 rounded-t-md p-1
            text-white text-center text-2xl font-bold text-white">{{$char}}</h1>
            <div class = "border-solid border">
                <ul class = "flex flex-wrap flex-row mt-4 m-8">
                    @if(count($authors) > 0)
                        @foreach($authors as $author)
                            <li class = "w-40">
                                <a href = "{{route('books_store.author-show', $author)}}"
                                class = "text-blue-500">{{$author->name}}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
