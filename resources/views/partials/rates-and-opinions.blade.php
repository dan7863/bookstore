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
  @endif

  <div class = "mt-10 text-center">
    <a href = "#" class = "text-blue-500">See All Opinions</a>
  </div>

  @if($buyed_book)
    @include('partials.rate-element', ['book' => $book])
  @endif
