@extends('adminlte::page')

@section('title', 'Listagem de Categorias')

@section('content_header')
    <h1>Categorias</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}">Dashboard</a></li>
        <li><a href="{{ route('categories.index') }}" class="active">Categorias</a></li>
    </ol>
@stop

@section('content')
    <div class="content row">
        <p>
            <a href="{{route('categories.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>

        <!--FILTRO-->
        <div class="box box-solid box-danger collapsed-box" data-widget="box-widget">
            <div class="box-header">
                <h3 class="box-title">Filtrar</h3>
                <div class="box-tools">
                    <!-- This will cause the box to be removed when clicked -->
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remover"><i
                            class="fa fa-times"></i></button>
                    <!-- This will cause the box to collapse when clicked -->
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i
                            class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['route' => ['categories.search'], 'class' => 'form form-inline form-search']) !!}

                {!! Form::text('title', null, ['placeholder' => 'Título', 'class' => 'form-control', 'id' => 'title']) !!}
                {!! Form::text('url', null, ['placeholder' => 'URL', 'class' => 'form-control', 'id' => 'url']) !!}
                {!! Form::text('description', null, ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'description']) !!}

                {!! Form::submit('Filtrar', ['class' => 'btn btn-danger', 'id' => 'btnSearch']) !!}
                {!! Form::close() !!}

                <a id="search-true" style="display: none" href="{{ route('categories.index') }}">(x) Limpar Resultados da pesquisa</a>
            </div>
        </div>
        <!--FILTRO-->

    @include('admin.includes.alerts')

    <!--TABELA -->
        <div id="tabela">
            @include('admin.categories.partials.table')
        </div>
        <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('js/admin/categories/jsCategoryTable.js') }}"></script>
@stop
