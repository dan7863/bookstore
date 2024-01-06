@php
  $comments = $book->comments;
@endphp
<x-app-layout>
    <div class="bg-white">
        <div class="mx-auto grid max-w-2xl grid-cols-1
        items-center gap-x-8 gap-y-16 px-4 py-24 sm:px-6 sm:py-32 lg:max-w-7xl lg:px-8 ">
          <div>
            <!-- Primary Content -->
            <div class = "grid grid-cols-1 lg:grid-cols-4">
              <!-- Info Primary Content -->
              <div class = "lg:col-span-2">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{$book->title}}</h2>
                <h4 class = "text-blue-500 my-4"><a href = "{{route('books_store.author-show', $book->author)}}">
                  {{$book->author->name}}</a>
                </h4>
                <p class = "my-4 text-gray-700">
                  Launched on <span class = "font-bold text-gray-900">
                    {{date('d-M-y', strtotime($book->created_at))}}</span>
                    @if(isset($book->publisher))
                      • Published by
                      <span class = "text-blue-500 my-4">
                        <a href = "{{route('books_store.publisher-show', $book->publisher)}}">{{$book->publisher->name}}</a>
                      </span>
                    @endif
                  </p>
                <dl class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
                  <div class="border-t border-gray-200 pt-4 text-center">
                    <dt class="font-medium text-gray-900">
                      {{number_format($comments->avg('stars'), 2, '.', '')}} ★
                    </dt>
                    <dd class="mt-2 text-sm text-gray-500">{{$comments->count()}} Opinions</dd>
                  </div>
                  <div class="border-t border-gray-200 pt-4 flex flex-col items-center">
                    <dt class="font-medium text-gray-900">
                      <img src = "{{ url('storage/project_images/book.png')}}"
                      alt = "Ebook/AudioBook" class = "w-6">
                    </dt>
                    <dd class="mt-2 text-sm text-gray-500">Ebook</dd>
                  </div>
                  <div class="border-t border-gray-200 pt-4 text-center">
                    <dt class="font-medium text-gray-900">{{$book->page_count}}</dt>
                    <dd class="mt-2 text-sm text-gray-500">Pages</dd>
                  </div>
                  <div class="border-t border-gray-200 pt-4 text-center">
                    <dt class="font-medium text-gray-900">
                      @if(isset($book->book_purchase_detail->available_state))
                        @available_state($book->book_purchase_detail->available_state)
                      @endif
                    </dt>
                    <dd class="mt-2 text-sm text-gray-500">State</dd>
                  </div>
                </dl>
                {{-- <p class = "text-center mt-10 text-blue-500">
                  <a href = "#">Change to Audiobook (check if exists)</a></p> --}}
              </div>

               <!-- Image Content -->
              <div class="flex flex-col justify-center items-center lg:col-span-2">
                <img src="{{ url('storage/' . $book->image->url) }}"
                alt="{{$book->image->url}}"
                class="rounded-lg bg-gray-100 w-60 h-80 shadow-sm">
                @if($buying_status)
                  <a class="mt-6 bg-blue-400 mt-4 hover:bg-blue-500
                  text-white font-bold py-2 px-4 border rounded" href = "{{route('books_store.process-order', $book)}}">
                    @if(isset($book->book_purchase_detail->price))
                      Buy for @money($book->book_purchase_detail->price)
                    @endif
                  </a>
                @else
                  <a class="mt-6 bg-blue-400 mt-4 hover:bg-blue-500
                  text-white font-bold py-2 px-4 border rounded" href = "{{route('admin.books.read', $book)}}">
                    Read Book
                  </a>
                @endif
              </div>
            </div>
            
              <!-- About and Related Content -->
              <div class = "grid grid-cols-1 lg:grid-cols-4">
                <div class = "lg:col-span-2">
                  <!-- About This -->
                  <div class = "flex flex-row mt-12" x-cloak x-data="{ 'showModal': false}">
                    <h2 class = "text-2xl font-bold text-gray mr-6">About This Book</h2>
                    <div class="inline-block hover:bg-gray-200 rounded-full p-2 cursor-pointer" 
                    x-on:click="showModal = true">
                        <img src="{{ url('storage/project_images/right_arrow.png')}}" alt = "Right Arrow" class="w-4">
                    </div>
                      <div class="relative z-10" x-show="showModal"
                      aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4
                            text-center sm:items-center sm:p-0">
                                <div class="relative transform overflow-hidden rounded-lg bg-white text-left
                                shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg max-h-screen overflow-y-auto">
                                    <!-- Set a maximum height equal to the screen height and enable overflow-y -->
                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                <h3 class="text-base font-semibold
                                                leading-6 text-gray-900" id="modal-title">
                                                    About This Book</h3>
                                                <div class="mt-2">
                                                  <p class = "text-gray-500">
                                                    {{$book->description->description}}
                                                  </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                        <button type="button" class="mt-3 inline-flex w-full justify-center
                                        rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 
                                        shadow-sm ring-1
                                        ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                                x-on:click="showModal = false">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  @if(!empty($book->description))
                    <p class="mt-8 text-gray-500">
                      {{\Illuminate\Support\Str::limit($book->description->description, 500, $end='...') }}
                    </p>
                  @endif
                  @include('partials.books.book-subgenders', ['subgenders' => $book->subgenders])
                  @include('partials.rates-and-opinions', ['book' => $book])
                </div>
                <div class = "lg:col-span-2">
             
                  @if(count($related_books_by_author) > 0)
                    <div>
                      <div class = "flex flex-row mt-16 justify-center mb-6">
                        <h2 class = "text-2xl font-bold text-gray mr-6">More About {{$book->author->name}}</h2>
                        <a href = "{{route('books_store.author-show', $book->author)}}">
                          <div class="inline-block hover:bg-gray-200 rounded-full p-2 cursor-pointer">
                            <img src="{{ url('storage/project_images/right_arrow.png')}}"
                            alt = "Right Arrow" class="w-4">
                          </div>
                        </a>
                      </div>
                      
                      <div>
                        @foreach($related_books_by_author as $book_related)
                            @include('partials.books.book',
                            ['book' => $book_related, 'group_classes' => 'w-40 mr-auto ml-auto mb-4',
                            'height_aspect' => 'lg:h-50'])
                        @endforeach
                      </div>
                    </div>
                  @endif
                 
                  @if(count($related_books_by_subgenders) > 0)
                    <div>
                      <div class = "flex flex-row mt-16 justify-center mb-6">
                        <h2 class = "text-2xl font-bold text-gray mr-6 ">Similar Content</h2>
                        {{-- <div class="inline-block hover:bg-gray-200 rounded-full p-2 cursor-pointer">
                            <img src="{{ url('storage/project_images/right_arrow.png')}}"
                            alt = "Right Arrow" class="w-4">
                        </div> --}}
                      </div>
                      <div>
                        @foreach($related_books_by_subgenders as $book_related)
                            @include('partials.books.book',
                            ['book' => $book_related, 'group_classes' => 'w-40 mr-auto ml-auto mb-4',
                            'height_aspect' => 'lg:h-50'])
                        @endforeach
                      </div>
                    </div>
                  @endif
                </div>
            </div>
          </div>
      </div>
    </div>
</x-app-layout>
