@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Your Books List</h1>
@stop

@section('content')
    @livewire('admin.books-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop