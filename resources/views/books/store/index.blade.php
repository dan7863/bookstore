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
      <h2 class="text-2xl font-bold tracking-tight text-gray-900">Books List</h2>
  
      <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        
        @foreach($books as $book)
        
        <div class="group relative">
            
          <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
            <img src="{{ url('storage/' . $book->image->url) }}" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h3 class="text-sm text-gray-700">
                <a href="{{route('books_store.show', $book)}}">
                  <span aria-hidden="true" class="absolute inset-0"></span>
                  
                  
                  {{$book->title}}
                </a>
              </h3>
              {{-- <p class="mt-1 text-sm text-gray-500">Black</p> --}}
               <p class="text-sm font-medium text-gray-900">
                @if($book->book_purchase_detail->price)
                    @money($book->book_purchase_detail->price)
                @else
                    @money(0)
                @endif
            </p>
            </div>
            
          </div>
        </div>
        
        @endforeach
  
        <!-- More products... -->
      </div>
    </div>
  </div>
  
    
</x-app-layout>