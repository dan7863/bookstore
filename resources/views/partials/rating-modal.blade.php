<form action = "{{route('books_store.rate-book', $book)}}" method = "POST">
    @csrf
    <div x-show="showModal" class="relative z-10" aria-labelledby="modal-title"
    role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left
            shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h3 class="text-base font-semibold leading-6 text-gray-900"
                    id="modal-title">Rate and Comment</h3>
                    <div class="mt-2">
                        <label class = "mt-4">Rate</label>
                        <div style ="margin-bottom: 4%;">
                            @include('partials.starts',
                            ['items_width' => 'w-10', 'items_height' => 'h-10', 'interactuable' => true])
                        </div>
                        <label>Comment</label>
                        <div class="relative mb-3 mt-2" data-te-input-wrapper-init>
                            <textarea name = "message"
                              class="w-100 peer block min-h-[auto] w-full rounded border-0
                              bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all
                              duration-200 ease-linear focus:placeholder:opacity-100
                              data-[te-input-state-active]:placeholder:opacity-100
                              motion-reduce:transition-none dark:text-neutral-200
                              dark:placeholder:text-neutral-200
                              [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                              id="exampleFormControlTextarea1"
                              rows="3"
                              placeholder="Your message"></textarea>
                            <label
                              for="exampleFormControlTextarea1"
                              class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%]
                              origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500
                              transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem]
                              peer-focus:scale-[0.8] peer-focus:text-primary
                              peer-data-[te-input-state-active]:-translate-y-[0.9rem]
                              peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none
                              dark:text-neutral-200 dark:peer-focus:text-primary"
                              >Write your Comment</label>
                          </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="submit" class="inline-flex w-full justify-center
                rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white
                shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Rate</button>
                <button type="button" class="mt-3 inline-flex w-full justify-center
                rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900
                shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                x-on:click="showModal = false">Cancel</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</form>

