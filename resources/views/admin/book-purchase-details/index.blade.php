@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <div class = "row">
        <div class = "col-sm-6">
            <h1>Selling Books</h1>
        </div>
    </div>
@stop

@section('content')
    @if(session('info'))
        <div class = "alert alert-success" id = "alert-info">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('admin.books-index', ['type' => 'book-purchase-details'])
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
                        <input type = "file" name = "file">
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
