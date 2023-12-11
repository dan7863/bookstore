<x-app-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <div>
                <h1 class = "bg-gray-900 rounded-md p-2 text-white text-center text-2xl font-bold text-white">
                    Books by {{$item->name}} {{$title}}</h1>
            </div>
            @livewire('book-filter-search', ['item' => $item, 'input_placeholder' => $input_placeholder])

            @if(get_class($item) == "App\Models\Author" )
                <div class = "mt-16">
                    <h1 class = "bg-gray-900 rounded-md p-2 text-white text-center text-2xl font-bold text-white">
                        {{$item->name}}'s Biography</h1>
                    <p class = "mt-8"><strong>{{$item->name}}</strong> {{$item->description->description}}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
