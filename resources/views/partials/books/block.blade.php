<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{$title}}</h2>
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @if(count($books) > 0)
                @foreach($books as $book)
                    @include('partials.books.book', ['book' => $book])
                @endforeach
            @endif
        </div>
    </div>
</div>
