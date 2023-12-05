@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Book Purchase Detail</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => ['admin.books.update', $book], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('signatory', 'Signatory') !!}
                    {!! Form::text('signatory', $book->book_purchase_detail->signatory ?? null,
                    ['class' => 'form-control', 'placeholder' => 'Type Book signatory']) !!}

                    @error('signatory')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('price', 'Price') !!}
                    {!! Form::number('price', $book->book_purchase_detail->price ?? null,
                    ['class' => 'form-control', 'placeholder' => 'Type Book Price']) !!}

                    @error('price')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <p class = "font-weight-bold">State</p>
                        <label>
                            {!! Form::radio('available_state', 1,
                            (optional($book->book_purchase_detail)->signatory ? true : false) ?? true) !!}
                            Available
                        </label>

                        <label>
                            {!! Form::radio('available_state', 0,
                            (optional($book->book_purchase_detail)->signatory ? false : true) ?? false) !!}
                            Not Available
                        </label>

                    @error('available_state')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

            {!! Form::submit('Place for Sale', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
