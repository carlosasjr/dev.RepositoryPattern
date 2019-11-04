@extends('adminlte::page')

@section('title', 'Cadastrar Nova Categoria')

@section('content_header')
    <h1>Gestão de Categoria: {{ $category->title }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}">Dashboard</a></li>
        <li><a href="{{ route('categories.index') }}" class="active">Categorias</a></li>
        <li><a href="{{ route('categories.show', $category->id) }}" class="active">Detalhes</a></li>
    </ol>
@stop


@section('content')
    @include('admin.includes.alerts')

    <div class="box box-success">
        <div class="box-body">
            <p><strong>ID: </strong>{{  $category->id }}</p>
            <p><strong>Título: </strong>{{  $category->title }}</p>
            <p><strong>URL: </strong>{{  $category->url }}</p>
            <p><strong>Descrição: </strong>{{  $category->description }}</p>
        </div>
    </div>

    {!! Form::model($category, ['route' => ['categories.destroy', $category->id], 'class' => 'form', 'method' => 'delete' ]) !!}
    {!! Form::submit('Deletar', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop



