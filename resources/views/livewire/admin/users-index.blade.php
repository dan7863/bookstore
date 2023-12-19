<div>
  <div class="card">
    <div class="card-header">
        <input wire:model.live = "search" class = "form-control" placeholder = "Type name or email from user...">
    </div>
    @if($users->count())
        <div class="card-body">
            <table class = "table table-striped">
                <caption>Users List</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a class = "btn btn-primary" href = "{{route('admin.users.edit', $user)}}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{$users->links()}}
        </div>
    @else
        <div class="card-body">
            <strong>No item matching by this criteria.</strong>
        </div>
    @endif
  </div>
</div>
