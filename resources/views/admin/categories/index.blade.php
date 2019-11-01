@extends('adminlte::page')

@section('title', 'Listagem de Categorias')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    <div class="content row">
        <p>
            <a href="{{route('categories.create')}}" class="btn btn-success">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>


        <div class="box box-success">
            <div class="box-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Url</th>
                        <th>Descricao</th>
                        <th>Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$category->title}}</td>
                            <td>{{$category->url}}</td>
                            <td>{{$category->description}}</td>
                            <td>
                                <a href="{{route('categories.edit', $category->id)}}" class="badge bg-yellow">Editar</a>
                                <a href="{{route('categories.destroy', $category->id)}}" class="badge bg-dark">Excluir</a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            Nenhum Registro nesta tabela
                        </tr>
                    @endforelse



                    </tbody>

                </table>
            </div>
        </div>
    </div>
@stop


