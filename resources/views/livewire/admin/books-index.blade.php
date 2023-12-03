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
                <div class="container mt-5">
                    <img class = "rounded w-100 object-fit object-cover" style = "height: 18rem;" src="{{ url('storage/' . $book->image->url) }}" alt="Front of men&#039;s Basic Tee in black." role="button">
                </div>
                <div class = "container mt-2">
                    <div style = "display: flex;">
                        <div style = "width: 90%;">
                            <span aria-hidden="true" class="absolute inset-0">{{$book->title}}</span>  
                        </div>
                        <div class = "position-relative" style = "width: 10%; text-align: right;">
                            <i class="fas fa-ellipsis-v icon-menu" id = "icon-menu" book-id = "{{$book->id}}" role="button"></i>
                            <div class="dropdown-menu position-absolute" id = "dropdown-menu-{{$book->id}}" aria-labelledby="icon-menu" style = "margin-top: -2.2rem; margin-left: -10rem;">
                                <a class="dropdown-item"><i class="fas fa-w fa-book-open"></i> Read</a>
                                <a class="dropdown-item"><i class="fas fa-w fa-info-circle"></i> About This</a>
                                <a class="dropdown-item"><i class="fas fa-w fa-check"></i> Marked as Finished</a>
                                <a class="dropdown-item"><i class="fas fa-w fa-file-export"></i> Export</a>
                                <a class="dropdown-item">
                                    <form action = "{{route('admin.books.destroy', $book)}}" method = "POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-plain no-margin w-100 p-0 text-left" type = "submit"><i class="fas fa-w fa-trash"></i> Delete Book</button>
                                    </form>
                                </a>                                
                              </div>
                        </div>
                    </div>
                    <span class = "text-gray">{{$book->author->name}}</span>
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


