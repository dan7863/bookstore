<x-app-layout>
    <div class="bg-white">
        <div class="mx-auto grid max-w-2xl grid-cols-1 items-center gap-x-8 gap-y-16 px-4 py-24 sm:px-6 sm:py-32 lg:max-w-7xl lg:grid-cols-2 lg:px-8 ">
          <div>
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{$book->title}}</h2>
            <h4 class = "text-blue-500 my-4"><a href = "#">{{$book->author->name}}</a></h4>
            <p class = "my-4 text-gray-700">Launched on <span class = "font-bold text-gray-900">{{date('d-M-y', strtotime($book->created_at))}}</span> • Published by <span class = "text-blue-500 my-4"><a href = "">{{$book->publisher->name}}</a></span></p>
            
      
            <dl class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
              <div class="border-t border-gray-200 pt-4 text-center">
                <dt class="font-medium text-gray-900">4.5 ★</dt>
                <dd class="mt-2 text-sm text-gray-500">187 Opinions</dd>
              </div>
              <div class="border-t border-gray-200 pt-4 flex flex-col items-center">
                <dt class="font-medium text-gray-900"><img src = "{{ url('storage/project_images/book.png')}}" class = "w-6"></dt>
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
            <p class = "text-center mt-10 text-blue-500"><a href = "#">Change to Audiobook (check if exists)</a></p>
          </div>
        <div>
          <div class="flex flex-col justify-center items-center">
            <img src="{{ url('storage/' . $book->image->url) }}" alt="Walnut card tray with white powder coated steel divider and 3 punchout holes." class="rounded-lg bg-gray-100 w-80 h-80 shadow-sm">
            <button class="mt-6 bg-blue-400 mt-4 hover:bg-blue-500 text-white font-bold py-2 px-4 border rounded">Buy for @money($book->book_purchase_detail->price)</button>
          </div>
        </div>
        <div>
            <div class = "flex flex-row">
                <h2 class = "text-2xl font-bold text-gray mr-6">About This</h2>
                <div class="inline-block hover:bg-gray-200 rounded-full p-2 cursor-pointer">
                    <img src="{{ url('storage/project_images/right_arrow.png')}}" class="w-6">
                </div>
            </div>
            <p class="mt-8 text-gray-500">{{\Illuminate\Support\Str::limit($book->description->description, 500, $end='...') }}</p>
            
            <div class = "mt-6 flex">
                @foreach($book->subgenders as $subgender)
                    <div class = "inline-block rounded-full bg-gray-200 hover:bg-gray-300 rounded-full p-2 cursor-pointer">
                      <a href = "#">{{$subgender->name}}</a>
                    </div>
                @endforeach
            </div>
            
            <div class = "mt-16">
              <h2 class = "text-2xl font-bold text-gray mr-6 mt-2">Ratings and Opinions</h2>
              <div class ="flex mt-8 justify-between">
                <div class = "flex flex-col justify-center w-80">
                  <h2 class = "text-5xl text-gray mr-6 text-center ml-auto mr-auto">4.5</h2>
                  @include('partials.starts', ['margin_top' => 'mt-4', 'justify_content' => 'justify-center'])
                </div>
                <div class = "w-full">
                  <div class="flex items-center mt-4">
                      <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">5 star</a>
                      <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                          <div class="h-5 bg-blue-300 rounded" style="width: 70%"></div>
                      </div>
                      <span class="text-sm font-medium text-gray-500 dark:text-gray-400">70%</span>
                  </div>
                  <div class="flex items-center mt-4">
                      <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">4 star</a>
                      <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                          <div class="h-5 bg-blue-300 rounded" style="width: 17%"></div>
                      </div>
                      <span class="text-sm font-medium text-gray-500 dark:text-gray-400">17%</span>
                  </div>
                  <div class="flex items-center mt-4">
                      <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">3 star</a>
                      <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                          <div class="h-5 bg-blue-300 rounded" style="width: 8%"></div>
                      </div>
                      <span class="text-sm font-medium text-gray-500 dark:text-gray-400">8%</span>
                  </div>
                  <div class="flex items-center mt-4">
                      <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">2 star</a>
                      <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                          <div class="h-5 bg-blue-300 rounded" style="width: 4%"></div>
                      </div>
                      <span class="text-sm font-medium text-gray-500 dark:text-gray-400">4%</span>
                  </div>
                  <div class="flex items-center mt-4">
                      <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">1 star</a>
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
            <div class = "mt-16">
              <h2 class = "text-2xl font-bold text-gray mr-6 mt-2">Rate This Element</h2>
              <div class = "flex justify-between">
                @include('partials.starts', ['items_width' => 'w-10', 'items_height' => 'h-10'])
                <button class="bg-blue-400 mt-4 hover:bg-blue-500 text-white font-bold py-2 px-4 border rounded">Write an Opinion</button>
              </div>
            </div>
        </div>
      </div>
    </div>
</x-app-layout>