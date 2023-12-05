@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Book Detail</h1>
@stop

@section('content')
    <div class="card">
        <div class = "card-header" style = "display: flex;">
            <div class = "w-100">
                <h2>{{$book['title'] ?? null}}</h2>
            </div>
            <div class = "text-right w-100">
                <a class = "btn btn-secondary" href = "{{route('admin.books.index')}}">Volver</a>
            </div>
        </div>
        <div class="card-body">
            <div class = "text-center col-sm-4 mr-auto ml-auto" style = "margin-bottom: 4%;">
                <img class = "rounded w-100 object-fit object-cover"
                src = "{{ isset($book->image->url) ? url('storage/' . $book->image->url) : null }}"
                alt = "{{$book['title']}}">
            </div>

            <div class="form-group">
                <label>Author</label>
                <p>{{$book->author->name ?? null}}</p>
            </div>

            <div class="form-group">
                <label>Description</label>
                <p>{{$book->description->description ?? null}}</p>
            </div>

            <div class="form-group">
                <label>Language</label>
                <p>{{$book->language->language ?? null}}</p>
            </div>

            <div class="form-group">
                <label>Page Count</label>
                <p>{{$book->page_count ?? null}}</p>
            </div>

            <div class = "form-group">
                <label>Subgenders</label>
                @include('partials.books.book-subgenders', ['subgenders' => $book->subgenders])
            </div>

            <div class="form-group">
                <label>Types</label>
                @if(!empty($book->types))
                    @foreach($book->types as $type)
                        <p>{{$type->type}} ({{$type->format->format}})</p>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@stop

