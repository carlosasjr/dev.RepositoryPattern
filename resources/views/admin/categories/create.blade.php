@extends('adminlte::page')

@section('title', 'Cadastrar Nova Categoria')

@section('content_header')
    <h1>Gestão de Categoria: {{ $category->title ?? 'Novo' }}</h1>
@stop


@section('content')
    @include('admin.includes.alerts')

    <div class="box box-success">
        <div class="box-body">
            @include('admin.categories._partials.form')
        </div>
    </div>
@stop


