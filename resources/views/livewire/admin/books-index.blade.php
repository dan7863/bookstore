<div class = "card">
    <div class="card-header">
        <input wire:model.live = "search" type="text" class="form-control" placeholder = "Type Book Title">
    </div>

    @if($books->count())

    <div class="card-body">
        <table class="table table-striped">
            <caption>Books List</caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($books))
                    @foreach($books as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td>{{$book->title}}</td>
                            <td width = "10px"><a class = "btn btn-primary btn-sm" href = "{{route('admin.books.edit', $book)}}">Edit</a></td>
                            <td width = "10px">
                                <form action = "{{route('admin.books.destroy', $book)}}" method = "POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" type = "submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
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
