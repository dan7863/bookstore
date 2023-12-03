@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <div class = "row">
        <div class = "col-sm-6">
            <h1>Loaded Books</h1>
        </div>
        <div class = "col-sm-6 load-book text-right mt-2">
            <a href = "{{route('admin.books.create')}}"class = "btn btn-secondary">Load Book</a>
        </div>
    </div>
@stop

@section('content')
    @if(session('info'))
        <div class = "alert alert-success" id = "alert-info">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('admin.books-index')
@stop


@section('js')
    <script>
         $(".dropdown-menu").hide();
         $(document).on("click", ".icon-menu", function () {
            $(".dropdown-menu").hide();
            $("#dropdown-menu-" + $(this).attr('book-id')).toggle();
            event.stopPropagation();
        });

        $(document).on("click", function(event){
            if(!$(event.target).closest('.icon-menu').length){
                $("[id^='dropdown-menu-']").hide();
            }
        });
    </script>
@endsection
