<!-- Rates and Opinions -->

@php
    $sum = $book->comments->count();
    $stars_percentage = [];

    for ($i = 1; $i <= 5; $i++) {
        $stars_percentage[$i] = $sum != 0 ?
        number_format($book->comments()->where('stars', $i)->count() / $sum * 100, 2, '.', '')
        : 0;
    }
@endphp

<div class = "mt-16">
    <h2 class = "text-2xl font-bold text-gray mr-6 mt-2">Ratings and Opinions</h2>
    <div class ="flex mt-8 justify-between">
      <div class = "flex flex-col justify-center w-80">
        <h2 class = "text-5xl text-gray mr-6 text-center ml-auto mr-auto">
            {{number_format($book->comments->avg('stars'), 2, '.', '')}}
        </h2>
        @include('partials.starts', ['margin_top' => 'mt-4', 'justify_content' => 'justify-center',
        'rate' => floor(intVal($book->comments->avg('stars'))) ?? 0])
      </div>
      <div class = "w-full">
        <div class="flex items-center mt-4">
            <a class="text-sm font-medium
            text-blue-600 dark:text-blue-500 hover:underline">
            5 Star
            </a>
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-blue-300 rounded"
                style="width: {{$stars_percentage[5]}}%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$stars_percentage[5]}}%</span>
        </div>
        <div class="flex items-center mt-4">
            <a class="text-sm font-medium
            text-blue-600 dark:text-blue-500 hover:underline">4 star</a>
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-blue-300 rounded"
                style="width: {{$stars_percentage[4]}}%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$stars_percentage[4]}}%</span>
        </div>
        <div class="flex items-center mt-4">
            <a class="text-sm font-medium
            text-blue-600 dark:text-blue-500 hover:underline">3 star</a>
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-blue-300 rounded" style="width: {{$stars_percentage[3]}}%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$stars_percentage[3]}}%</span>
        </div>
        <div class="flex items-center mt-4">
            <a class="text-sm font-medium
            text-blue-600 dark:text-blue-500 hover:underline">2 star</a>
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-blue-300 rounded" style="width: {{$stars_percentage[2]}}%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$stars_percentage[2]}}%</span>
        </div>
        <div class="flex items-center mt-4">
            <a class="text-sm font-medium
            text-blue-600 dark:text-blue-500 hover:underline">1 star</a>
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-blue-300 rounded" style="width: {{$stars_percentage[1]}}%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$stars_percentage[1]}}%</span>
        </div>
      </div>
    </div>
  </div>

  @if($sum > 0)
    @foreach($book->comments->sortByDesc('id')->take(3) as $comment)
        @include('partials.comments', ['comment' => $comment])
    @endforeach

    <div x-data="{ 'showModal': false}">
        <div class = "mt-10 text-center">
            <a class = "text-blue-500 cursor-pointer" x-on:click="showModal = true">See All Opinions</a>
        </div>
        <div class="relative z-10" x-show="showModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left
                    shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg max-h-screen overflow-y-auto">
                        <!-- Set a maximum height equal to the screen height and enable overflow-y -->
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">
                                        All Opinions from this Book</h3>
                                    <div class="mt-2">
                                        @foreach($book->comments->sortByDesc('id') as $comment)
                                            @include('partials.comments', ['comment' => $comment])
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="button" class="mt-3 inline-flex w-full justify-center
                            rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1
                            ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                    x-on:click="showModal = false">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
  @endif

  

  @if($buyed_book)
    @include('partials.rate-element', ['book' => $book])
  @endif
