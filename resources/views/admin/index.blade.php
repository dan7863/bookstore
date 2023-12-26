@extends('adminlte::page')

@section('title', 'BookStore')

@section('content_header')
    <h1>BookStore</h1>
@stop

@section('content')
    @if(auth()->user()->hasRole('Admin'))
        <h2>Administrator</h2>
        <x-adminlte-info-box title="Genders" text="{{$gendersCount}}" icon="fas fa-lg fa-tags" icon-theme="gradient-blue"/>
        <x-adminlte-info-box title="Subgenders" text="{{$subgendersCount}}" icon="fab fa-lg fa-buffer text-white"
        icon-theme="gradient-red"/>
        <x-adminlte-info-box title="Authors" text="{{$authorsCount}}" icon="fas fa-lg fa-pen text-white"
        icon-theme="gradient-secondary"/>
        <x-adminlte-info-box title="Publishers" text="{{$publishersCount}}"
        icon="fas fa-lg fa-building" icon-theme="gradient-info"/>
    @endif
    <h2>Your Books List</h2>
    <x-adminlte-info-box title="Uploads" text="{{$uploadsCount}}" icon="fas fa-lg fa-upload" icon-theme="purple"/>
    <x-adminlte-info-box title="Purchases" text="{{$purchaseDetailsCount}}" icon="fas fa-lg fa-shopping-cart text-white"
    icon-theme="gradient-yellow"/>
    <x-adminlte-info-box title="Selling" text="{{$purchaseOrdersCount}}"
    icon="fas fa-lg fa-dollar-sign" icon-theme="gradient-teal"/>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
