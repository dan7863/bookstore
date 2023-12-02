@if(!isset($book))
    @php $book = []; @endphp
@endif

@if(!isset($height_aspect))
    @php $height_aspect = 'lg:h-80'; @endphp
@endif

@if(!isset($group_classes))
    @php $group_classes = ''; @endphp
@endif

<div class="group relative {{$group_classes}}">     
  <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 {{ $height_aspect }}">
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
        @if(isset($book->book_purchase_detail->price))
            @money($book->book_purchase_detail->price)
        @endif
    </p>
    </div>
  </div>
</div>