@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Edit Author</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::model($author, ['route' => ['admin.authors.update', $author], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Type Author Name']) !!}

                    @error('name')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {!! Form::text('slug', null,
                    ['class' => 'form-control', 'placeholder' => 'Type Author Slug', 'readonly']) !!}

                    @error('slug')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

            {!! Form::submit('Update Author', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script src = "{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
    <script>
        $(document).ready( function() {
                $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
                });
        });
    </script>
@endsection

