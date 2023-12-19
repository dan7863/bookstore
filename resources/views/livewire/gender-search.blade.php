<div x-data="{ openTab: 0 }">
    <div class = "flex flex-wrap flex-row justify-center mt-8">
        @foreach($alphabet as $char_alphabet)
            <div @if(in_array($char_alphabet, $gender_alphabet)) wire:click="$set('char', '{{ $char_alphabet }}')"
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
        
        <div x-cloak>
            @if(count($genders) > 0)
                @foreach($genders as $index => $gender)
                <div>
                    <div  x-on:click="openTab = (openTab === {{$index+1}}) ? 0 : 1"
                    @if(count($gender->subgenders) > 0)
                        :class="openTab ? 'bg-gray-900 rounded-t-md rounded-b-none p-1 text-white text-left text-2xl font-bold text-white flex flex-wrap flex-row p-2 justify-between cursor-pointer' : 'bg-gray-900 rounded-md p-1 text-white text-left text-2xl font-bold text-white flex flex-wrap flex-row p-2 justify-between cursor-pointer'"
                    @else
                        class = "bg-gray-400 rounded-md p-1 text-white text-left
                        text-2xl font-bold text-white flex flex-wrap
                        flex-row p-2 justify-between"
                    @endif
                    >
                        <div>
                            <h1>{{$gender->name}}</h1>
                        </div>
                        <div>
                            <p></p>
                        </div>
                    </div>
                    @if(count($gender->subgenders) > 0)
                        <div x-show="openTab === {{$index+1}}"
                        class = "border-solid border-t-0 border p-1">
                                <ul class = "flex flex-wrap flex-row mt-4 m-8">
                                    @foreach($gender->subgenders as $subgender)
                                        <li class = "w-40">
                                            <a href = "{{route('books_store.subgender', $subgender)}}"
                                            class = "text-blue-500">{{$subgender->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                        </div>
                    @endif
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
