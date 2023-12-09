<div class = "mt-16" x-data="{ 'showModal': false }">
    <h2 class = "text-2xl font-bold text-gray mr-6 mt-2">Rate This Element</h2>
    <div class = "flex justify-between">
        @include('partials.starts', ['items_width' => 'w-10', 'items_height' => 'h-10',
        'rate' => floor(intVal($book->comments->avg('stars'))) ?? 0])
        <button
        class="bg-blue-400 mt-4 hover:bg-blue-500
        text-white font-bold py-2 px-4 border rounded"
        x-on:click="showModal = true">
        Write an Opinion
        </button>
        @include('partials.rating-modal', ['book' => $book])
    </div>
</div>
