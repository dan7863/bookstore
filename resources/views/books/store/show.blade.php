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
                <h4 class = "text-blue-500 my-4"><a href = "#">{{$book->author->name}}</a></h4>
                <p class = "my-4 text-gray-700">
                  Launched on <span class = "font-bold text-gray-900">
                    {{date('d-M-y', strtotime($book->created_at))}}</span>
                    @if(isset($book->publisher))
                      • Published by
                      <span class = "text-blue-500 my-4">
                        <a href = "">{{$book->publisher->name}}</a>
                      </span>
                    @endif
                  </p>
                <dl class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
                  <div class="border-t border-gray-200 pt-4 text-center">
                    <dt class="font-medium text-gray-900">4.5 ★</dt>
                    <dd class="mt-2 text-sm text-gray-500">187 Opinions</dd>
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
                    <dt class="font-medium text-gray-900">Finish</dt>
                    <dd class="mt-2 text-sm text-gray-500">Hand sanded</dd>
                  </div>
                </dl>
                {{-- <p class = "text-center mt-10 text-blue-500">
                  <a href = "#">Change to Audiobook (check if exists)</a></p> --}}
              </div>

               <!-- Image Content -->
              <div class="flex flex-col justify-center items-center lg:col-span-2">
                <img src="{{ url('storage/' . $book->image->url) }}"
                alt="Walnut card tray with white powder coated steel divider and 3 punchout holes."
                class="rounded-lg bg-gray-100 w-80 h-80 shadow-sm">
                @if($buying_status)
                  <a class="mt-6 bg-blue-400 mt-4 hover:bg-blue-500
                  text-white font-bold py-2 px-4 border rounded" href = "{{route('books_store.process-order', $book)}}">
                    Buy for @money($book->book_purchase_detail->price)
                  </a>
                @else
                  <a class="mt-6 bg-blue-400 mt-4 hover:bg-blue-500
                  text-white font-bold py-2 px-4 border rounded" href = "#">
                    Read Book
                  </a>
                @endif
              </div>
            </div>
            
              <!-- About and Related Content -->
              <div class = "grid grid-cols-1 lg:grid-cols-4">
                <div class = "lg:col-span-2">
                  <!-- About This -->
                  <div class = "flex flex-row mt-12">
                    <h2 class = "text-2xl font-bold text-gray mr-6">About This Book</h2>
                    <div class="inline-block hover:bg-gray-200 rounded-full p-2 cursor-pointer">
                        <img src="{{ url('storage/project_images/right_arrow.png')}}" alt = "Right Arrow" class="w-4">
                    </div>
                  </div>
                  @if(!empty($book->description))
                    <p class="mt-8 text-gray-500">
                      {{\Illuminate\Support\Str::limit($book->description->description, 500, $end='...') }}
                    </p>
                  @endif

                  @include('partials.books.book-subgenders', ['subgenders' => $book->subgenders])

                  <!-- Rates and Opinions -->
                  <div class = "mt-16">
                    <h2 class = "text-2xl font-bold text-gray mr-6 mt-2">Ratings and Opinions</h2>
                    <div class ="flex mt-8 justify-between">
                      <div class = "flex flex-col justify-center w-80">
                        <h2 class = "text-5xl text-gray mr-6 text-center ml-auto mr-auto">4.5</h2>
                        @include('partials.starts', ['margin_top' => 'mt-4', 'justify_content' => 'justify-center'])
                      </div>
                      <div class = "w-full">
                        <div class="flex items-center mt-4">
                            <a href="#" class="text-sm font-medium
                            text-blue-600 dark:text-blue-500 hover:underline">5 star</a>
                            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                                <div class="h-5 bg-blue-300 rounded" style="width: 70%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">70%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <a href="#" class="text-sm font-medium
                            text-blue-600 dark:text-blue-500 hover:underline">4 star</a>
                            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                                <div class="h-5 bg-blue-300 rounded" style="width: 17%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">17%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <a href="#" class="text-sm font-medium
                            text-blue-600 dark:text-blue-500 hover:underline">3 star</a>
                            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                                <div class="h-5 bg-blue-300 rounded" style="width: 8%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">8%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <a href="#" class="text-sm font-medium
                            text-blue-600 dark:text-blue-500 hover:underline">2 star</a>
                            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                                <div class="h-5 bg-blue-300 rounded" style="width: 4%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">4%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <a href="#" class="text-sm font-medium
                            text-blue-600 dark:text-blue-500 hover:underline">1 star</a>
                            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                                <div class="h-5 bg-blue-300 rounded" style="width: 1%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">1%</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  @include('partials.comments')
                  @include('partials.comments')
                  @include('partials.comments')
                  <div class = "mt-10 text-center">
                    <a href = "#" class = "text-blue-500">See All Opinions</a>
                  </div>
                  @if($buyed_book)
                  <div class = "mt-16">
                    <h2 class = "text-2xl font-bold text-gray mr-6 mt-2">Rate This Element</h2>
                    <div class = "flex justify-between">
                      @include('partials.starts', ['items_width' => 'w-10', 'items_height' => 'h-10'])
                      <button
                      class="bg-blue-400 mt-4 hover:bg-blue-500
                      text-white font-bold py-2 px-4 border rounded">Write an Opinion</button>
                    </div>
                  </div>
                  @endif
                </div>
                <div class = "lg:col-span-2">
             
                  @if(count($related_books_by_author) > 0)
                    <div>
                      <div class = "flex flex-row mt-16 justify-center">
                        <h2 class = "text-2xl font-bold text-gray mr-6 mb-6">More About {{$book->author->name}}</h2>
                        <div class="inline-block hover:bg-gray-200 rounded-full p-2 cursor-pointer">
                            <img src="{{ url('storage/project_images/right_arrow.png')}}"
                            alt = "Right Arrow" class="w-4">
                        </div>
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
                      <div class = "flex flex-row mt-16 justify-center">
                        <h2 class = "text-2xl font-bold text-gray mr-6 mb-6">Similar Content</h2>
                        <div class="inline-block hover:bg-gray-200 rounded-full p-2 cursor-pointer">
                            <img src="{{ url('storage/project_images/right_arrow.png')}}"
                            alt = "Right Arrow" class="w-4">
                        </div>
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
