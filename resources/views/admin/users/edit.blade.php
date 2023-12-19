@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Assign a Role</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <p class = "h5">Name</p>
            <p class = "form-control">{{$user->name}}</p>
            <h2 class = "h5">Roles List</h2>
                {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}

                @foreach($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                            {{$role->name}}
                        </label>
                    </div>
                @endforeach
                {!! Form::submit("Asignar Rol", ['class' => 'btn btn-primary mt-2']) !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
