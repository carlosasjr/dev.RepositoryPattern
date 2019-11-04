@extends('adminlte::page')

@section('title', 'Cadastrar Novo Produto')

@section('content_header')
    <h1>Gestão de Produtos: {{ $product->name ?? 'Novo' }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}">Dashboard</a></li>
        <li><a href="{{ route('products.index') }}" class="active">Produtos</a></li>

        @if (isset($product))
            <li><a href="{{ route('products.edit' , $product->id) }}" class="active">Editar</a></li>
        @else
            <li><a href="{{ route('products.create' ) }}" class="active">Cadastrar</a></li>
        @endif
    </ol>
@stop


@section('content')
    @include('admin.includes.alerts')

    <div class="box box-success">
        <div class="box-body">
            @include('admin.products.partials.form')
        </div>
    </div>
@stop


