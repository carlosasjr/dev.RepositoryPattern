@extends('adminlte::page')

@section('title', 'Cadastrar Nova Categoria')

@section('content_header')
    <h1>Gestão de Categoria: {{ $category->title ?? 'Novo' }}</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}">Dashboard</a></li>
        <li><a href="{{ route('categories.index') }}" class="active">Categorias</a></li>

        @if (isset($category))
            <li><a href="{{ route('categories.edit' , $category->id) }}" class="active">Editar</a></li>
        @else
            <li><a href="{{ route('categories.create' ) }}" class="active">Cadastrar</a></li>
        @endif
    </ol>
@stop


@section('content')
    @include('admin.includes.alerts')

    <div class="box box-success">
        <div class="box-body">
            @include('admin.categories.partials.form')
        </div>
    </div>
@stop


