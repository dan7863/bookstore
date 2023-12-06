@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <div class = "row">
        <div class = "col-sm-6">
            <h1>Loaded Books</h1>
        </div>
        <div class = "col-sm-6 load-book text-right mt-2">
            <a data-toggle="modal" data-target="#modal" class = "btn btn-secondary">Load Book</a>
        </div>
    </div>
@stop

@section('content')
    @if(session('info'))
        <div class = "alert alert-success" id = "alert-info">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @if(session('error'))
        <div class = "alert alert-danger" id = "alert-error">
            <strong>{{session('error')}}</strong>
        </div>
    @endif
    @livewire('admin.books-index', ['type' => 'book'])
    <div class="modal" id = "modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Load Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action = "{{route('admin.books.upload.file')}}" method = "POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type = "file" name = "file" class="w-100 mw-100">
                        <div class = "mt-2">
                            @error('file')
                                <span class = "text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type = "submit" class = "btn btn-primary">
                            <i class = "fas fa-w fa-upload"></i> Upload
                        </button>
                        <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i> Close
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop


@section('js')
    <script>
        $("#alert-info").fadeIn('slow');
        $("#alert-info").delay(2000).fadeOut('slow');
        $("#alert-error").fadeIn('slow');
        $("#alert-error").delay(2000).fadeOut('slow');
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

    @if($errors->count() > 0)
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#modal").delay(2000).modal('show');
            }, 500);
        });
    </script>
    @endif

@endsection
