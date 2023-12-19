@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Subgenders List</h1>
@stop

@section('content')
    @if(session('info'))
        <div class = "alert alert-success" id = "alert-info">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class = "card-header">
            <a class = "btn btn-secondary "href = "{{route('admin.subgenders.create')}}">Add Subgender</a>
        </div>
        <div class="card-body">
            <table class = "table table-striped">
                <caption>Genders List</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Refered Gender</th>
                        <th colspan = "2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($subgenders))
                        @foreach($subgenders as $subgender)
                            <tr>
                                <td>{{$subgender->id}}</td>
                                <td>{{$subgender->name}}</td>
                                <td>{{$subgender->gender->name ?? null}}</td>
                                <td style = "width: 10px">
                                    <a class = "btn btn-primary btn-sm"
                                    href = "{{route('admin.subgenders.edit', $subgender)}}">
                                    Edit</a>
                                </td>
                                <td style = "width: 10px">
                                    <form action = "{{route('admin.subgenders.destroy', $subgender)}}" method = "POST">
                                        @csrf
                                        @method('delete')

                                        <button class = "btn btn-danger btn-sm" type = "submit">Delete</button>
                                    </form>
                                </td>
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
