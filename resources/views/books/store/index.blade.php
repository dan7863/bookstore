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
@include('partials.books.block', ['title' => 'Most Purchases per Month', 'books' => $most_purchases_per_month])
@include('partials.books.block', ['title' => 'New Book Releases', 'books' => $books_release])
  
</x-app-layout>
