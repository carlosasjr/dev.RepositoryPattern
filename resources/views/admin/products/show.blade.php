@extends('adminlte::page')

@section('title', 'Detalhes do Produto')

@section('content_header')
    <h1>Gestão de Produtos: {{ $product->title }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}">Dashboard</a></li>
        <li><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
        <li><a href="{{ route('products.show', $product->id) }}" class="active">Detalhes</a></li>
    </ol>
@stop


@section('content')
    @include('admin.includes.alerts')

    <div class="box box-success">
        <div class="box-body">
            <p><strong>ID: </strong>{{  $product->id }}</p>
            <p><strong>Nome: </strong>{{  $product->name }}</p>
            <p><strong>Categoria: </strong>{{  $product->category->title }}</p>
            <p><strong>URL: </strong>{{  $product->url }}</p>
            <p><strong>Descrição: </strong>{{  $product->description }}</p>
            <p><strong>Preço: </strong>{{  $product->price }}</p>
        </div>
    </div>

    {!! Form::model($product, ['route' => ['products.destroy', $product->id], 'class' => 'form', 'method' => 'delete' ]) !!}
    {!! Form::submit('Deletar', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop



