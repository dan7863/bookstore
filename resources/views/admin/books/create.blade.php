@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Book Preview</h1>
@stop

@section('content')
    <div class="card">
        
        <div class="card-body">
            <div class = "text-center col-sm-4 mr-auto ml-auto" style = "margin-bottom: 4%;">
                <img class = "rounded w-100 object-fit object-cover" src="data:image/png;base64,{{$ebook['cover']}}" alt = "{{$ebook['title']}}">
            </div>
            
            {!! Form::open(['route' => 'admin.books.store']) !!}

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
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', $ebook['description'] ?? null, ['class' => 'form-control', 'readonly']) !!}

                    @error('description')
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

                <div class = "form-group">
                    {!! Form::label('subgender', 'Subgenders') !!}
                    @include('partials.books.book-subgenders', ['subgenders' => $ebook['tags']])
                    {!! Form::text('subgenders', implode("/", $ebook['tags']) ?? null, ['class' => 'form-control d-none', 'readonly']) !!}
                   
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

                <div class="form-group">
                    {!! Form::label('type', 'Type') !!}
                    {!! Form::text('type', $ebook['extension'] ?? null, ['class' => 'form-control', 'readonly']) !!}

                    @error('type')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::text('file_name', $ebook['file_name'] ?? null, ['class' => 'form-control d-none', 'readonly']) !!}

                    @error('file_name')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::text('image', $ebook['cover'] ?? null, ['class' => 'form-control d-none', 'readonly']) !!}

                    @error('image')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                {!! Form::submit('Load Book', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

