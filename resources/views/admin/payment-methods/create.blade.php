<!-- USING LARAVEL COLLECTIVE TO MAKE FORMS -->

@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Create New Author</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.payment-methods.store']) !!}

                <div class="form-group">
                    {!! Form::label('card_number', 'Card Number') !!}
                    {!! Form::text('card_number', null,
                    ['class' => 'form-control', 'placeholder' => 'Type Card Number']) !!}

                    @error('card_number')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('exp_month', 'Expiration Month') !!}
                    {!! Form::text('exp_month', null,
                    ['class' => 'form-control', 'placeholder' => 'Type Expiration Month']) !!}

                    @error('exp_month')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group">
                    {!! Form::label('exp_year', 'Expiration Year') !!}
                    {!! Form::text('exp_year', null,
                    ['class' => 'form-control', 'placeholder' => 'Type Expiration Year']) !!}

                    @error('exp_year')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('cvc', 'CVC') !!}
                    {!! Form::text('cvc', null,
                    ['class' => 'form-control', 'placeholder' => 'Type CVC']) !!}

                    @error('cvc')
                        <span class = "text-danger">{{$message}}</span>
                    @enderror
                </div>

            {!! Form::submit('Create Type Method', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
