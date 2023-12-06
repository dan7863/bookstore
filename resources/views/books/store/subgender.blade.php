<x-app-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h1 class = "uppercase text-center text-3xl font-bold">Subgender: {{$subgender->name}}</h1>
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($books as $book)
                    @include('partials.books.book', ['book' => $book])
                @endforeach
            </div>

            <div>
                {{$books->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
