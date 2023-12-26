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

@include('books.store.general-filter')

@if(count($most_purchases_per_month) > 0)
  @include('partials.books.block', ['title' => 'Most Purchases per Month', 'books' => $most_purchases_per_month])
@endif

@if(count($books_release) > 0)
  @include('partials.books.block', ['title' => 'New Book Releases', 'books' => $books_release])
@endif


  
</x-app-layout>
