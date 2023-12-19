@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>Payment Methods List</h1>
@stop

@section('content')
    @if(session('info'))
        <div class = "alert alert-success" id = "alert-info">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class = "card">
        <div class = "card-header">
            <a class = "btn btn-secondary "href = "{{route('admin.payment-methods.create')}}">Add Payment Method</a>
        </div>
        <div class = "card-body">
            <table class = "table table-striped">
                <caption>Your Payment Methods List</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Active</th>
                        <th>Last Credit Numbers</th>
                        <th colspan = "2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($payment_methods))
                        @foreach($payment_methods as $payment_method)
                            <tr>
                                <td>{{$payment_method->method}}</td>
                                <td>@payment_method_state($payment_method->active)</td>
                                <td>
                                    {{$payment_method->last_credit_numbers}}
                                </td>
                                <td style = "width: 10px;">
                                    <form
                                    action = "{{route('admin.payment-methods.destroy', $payment_method->id)}}"
                                    method = "POST">
                                    @csrf
                                    @method('delete')
                                        <button type = "submit" class = "btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $("#alert-info").fadeIn('slow');
            $("#alert-info").delay(2000).fadeOut('slow');
        })
    </script>
@endsection
