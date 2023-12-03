@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Load a New Book</h1>
@stop

@section('content')
    <div class="card">
        <form action = "{{route('admin.books.upload.file')}}" method = "POST" enctype="multipart/form-data">
            @csrf
            <input type = "file" name = "file">
            <button type = "submit" class = "btn btn-sm">Upload</button>
        </form>

        <div class="card-body">
            {!! Form::open(['route' => 'admin.books.store']) !!}

                {{-- <div class="form-group">
                    {!! Form::label('file', 'File') !!}
                    {!! Form::file('file', ['readonly']) !!}

                    @error('file')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div> --}}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', $ebook['title'] ?? null, ['class' => 'form-control', 'readonly']) !!}

                    @error('title')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {!! Form::text('slug', $ebook['slug'] ?? null, ['class' => 'form-control', 'readonly']) !!}

                    @error('slug')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('author', 'Author') !!}
                    {!! Form::text('author', $ebook['author'] ?? null, ['class' => 'form-control', 'readonly']) !!}

                    @error('author')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('language', 'Language') !!}
                    {!! Form::text('language', $ebook['language'] ?? null, ['class' => 'form-control', 'readonly']) !!}

                    @error('language')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('page_count', 'Page Count') !!}
                    {!! Form::text('page_count', $ebook['page_count'] ?? null, ['class' => 'form-control', 'readonly']) !!}

                    @error('page_count')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group">
                    {!! Form::label('isbn', 'Isbn') !!}
                    {!! Form::text('isbn', $ebook['isbn'] ?? null, ['class' => 'form-control', 'readonly']) !!}

                    @error('isbn')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('publisher', 'Publisher') !!}
                    {!! Form::text('publisher', $ebook['publisher'] ?? null, ['class' => 'form-control', 'readonly']) !!}

                    @error('publisher')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                

            {!! Form::close() !!}
        </div>
    </div>
@stop

