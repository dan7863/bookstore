<div class = "card">
    <div class="card-header">
        <input wire:model.live = "search" type="text" class="form-control mt-2" placeholder = "Type Book Title">
    </div>
    @if($books->count())
    <div class="card-body">
        <div class="row">
            @if(!empty($books))
                @foreach($books as $book)
                <div class="col-sm-4 mt-4">
                    <div class="container mt-5 text-center">
                        <img class = "rounded object-fit object-cover"
                        style = "height: 20rem;
                            width: 85%;
                            box-shadow:
                            rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;"
                        src="
                            {{ isset($book->image->url) ? url('storage/' . $book->image->url) : null }}"
                        alt="{{$book->title}} role="button">
                    </div>
                    <div class = "container mt-2" style = "width: 85%;">
                        <div style = "display: flex;">
                            <div style = "width: 90%;">
                                <span aria-hidden="true" class="absolute inset-0">{{$book->title}}</span>
                            </div>
                            
                            <div class = "position-relative" style = "width: 10%; text-align: right;">
                                <i class="fas fa-ellipsis-v icon-menu"
                                    id = "icon-menu" book-id = "{{$book->id}}" role="button">
                                </i>
                                <div class="dropdown-menu position-absolute"
                                id = "dropdown-menu-{{$book->id}}" aria-labelledby="icon-menu"
                                style = "margin-top: -2.2rem; margin-left: -10rem;">
                                    <a class="dropdown-item" href = "{{route('admin.books.read', $book)}}">
                                        <i class="fas fa-w fa-book-open"></i> Read
                                    </a>
                                    <a class="dropdown-item"
                                        href = "{{ route('admin.books.show', ['book' => $book, 'type' => $type]) }}">
                                        <i class="fas fa-w fa-info-circle"></i> About This
                                    </a>
                                    @if($type == 'books')
                                        <a class="dropdown-item">
                                            <i class="fas fa-w fa-check"></i> Marked as Finished
                                        </a>
                                    @endif
                                    @if($type != 'purchase-orders')
                                        <a class="dropdown-item"
                                            href = "{{route('admin.books.edit', $book)}}">
                                            <i class="fas fa-w fa-dollar-sign"></i>
                                            {{$type == 'book-purchase-details' ? 'Edit Purchase Detail' 
                                            : 'Place for Sale'}}
                                        </a>
                                    @endif
                                    <a class="dropdown-item">
                                        <i class="fas fa-w fa-file-export"></i> Export
                                    </a>
                                    @if($type != 'purchase-orders')
                                        <a class="dropdown-item">
                                            <form action = "{{route('admin.books.destroy', $book)}}" method = "POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-plain no-margin w-100 p-0 text-left"
                                                type = "submit">
                                                    <i class="fas fa-w fa-trash"></i> Delete Book
                                                </button>
                                            </form>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class = "text-gray">{{$book->author->name}}</span>
                            @if($type == 'book-purchase-details')
                                <span aria-hidden="true" class = "text-gray d-block">
                                    @money($book->book_purchase_detail->price)
                                </span>
                                <span aria-hidden="true" class = "text-gray d-block">
                                    @available_state($book->book_purchase_detail->available_state)
                                </span>
                            @endif
                        </div>
                       
                    </div>
            </div>
            @endforeach
        @endif
        </div>
    </div>
    <div class="card-footer">
        {{$books->links()}}
    </div>
    @else
        <div class="card-body">
            <strong>There is no record that match with the filter value.</strong>
        </div>
    @endif
</div>


