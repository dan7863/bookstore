@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Publishers List</h1>
@stop

@section('content')
    @if(session('info'))
        <div class = "alert alert-success" id = "alert-info">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class = "card">
        <div class = "card-header">
            <a class = "btn btn-secondary "href = "{{route('admin.publishers.create')}}">Add Publisher</a>
        </div>
        <div class = "card-body">
            <table class = "table table-striped">
                <caption>Publishers List</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan = "2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($publishers))
                        @foreach($publishers as $author)
                            <tr>
                                <td>{{$author->id}}</td>
                                <td>{{$author->name}}</td>
                                <td width="10px"><a class = "btn btn-primary btn-sm" href = "{{route('admin.publishers.edit', $author)}}">Edit</a></td>
                                <td width = "10px"><form action = "{{route('admin.publishers.destroy', $author)}}" method = "POST">
                                    @csrf
                                    @method('delete')
                                    <button type = "submit" class = "btn btn-danger btn-sm">Delete</button>
                                </form></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $("#alert-info").fadeIn('slow');
            $("#alert-info").delay(2000).fadeOut('slow');
        })
    </script>
@endsection