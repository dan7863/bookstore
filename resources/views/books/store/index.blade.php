<x-app-layout>
   <!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->

<div class="bg-white">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    @include('partials.filter')
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Books List</h2>
    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        @if(!empty($books))
          @foreach($books as $book)
            @include('partials.books.book', ['book' => $book])
          @endforeach
        @endif
    </div>
  </div>
</div>

  
</x-app-layout>