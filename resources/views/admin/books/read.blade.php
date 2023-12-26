@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>{{$book->title}}</h1>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
    @vite(['resources/js/epub.js'])
@stop

@section('content')
    <div class = "card">
        <div class = "card-body">
            <div class = "d-flex justify-content-between align-items-center">
                
                <a id="prev" href="#prev" class="arrow" style="visibility: visible;">
                    <i class="fas fa-arrow-left text-dark"></i>
                </a>
                <div id="area" style = "overflow-x: auto; overflow-y: auto;"></div>
                <input id = "book-url" value = "{{'/storage/'.$book->types[0]->pivot->url}}" hidden>
               
                <a id="next" href="#next" class="arrow" style="visibility: visible;">
                    <i class="fas fa-arrow-right text-dark"></i>
                </a>
            </div>
        </div>
    </div>
@stop
