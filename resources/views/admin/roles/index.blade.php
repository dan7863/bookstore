@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Roles List</h1>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

    <div class = "card">
       <div class="card-header">
        <a class = "btn btn-secondary btn-sm" href = "{{route('admin.roles.create')}}">Add Role</a>
       </div>
        <div class="card-body">
            <table class="table table-striped">
                <caption>Roles List</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td style = "width: 10px;">
                                <a href = "{{route('admin.roles.edit', $role)}}" class = "btn btn-sm btn-primary">Edit</a>
                            </td>
                            <td style = "width: 10px;">
                                <form action = "{{route('admin.roles.destroy', $role)}}" method = "POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type = "submit" class = "btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

