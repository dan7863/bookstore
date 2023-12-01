@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Create Subgender</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.subgenders.store']) !!}
                @include('admin.partials.form')
                {!! Form::submit('Create Subgender', ['class' => 'btn btn-primary']) !!}
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