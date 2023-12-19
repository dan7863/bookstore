@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Create Role</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.roles.store']) !!}
                @include('partials.roles.form')
                {!! Form::submit('Create Role', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
