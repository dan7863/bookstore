@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>{{$book->title}}</h1>
@stop

@section('content')
    <div class = "card">
        <div class = "card-body">
            @livewire('book-reader', ['book' => $book])
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Define el número máximo de columnas que deseas mostrar
            var maxColumns = 2;

            // Oculta las columnas adicionales
            $('div.column:gt(' + (maxColumns - 1) + ')').hide();
        });
    </script>

@endsection
