@extends('adminlte::page')

@section('title', 'Listagem de Produtos')

@section('content_header')
    <h1>Produtos</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}">Dashboard</a></li>
        <li><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
    </ol>
@stop

@section('content')
    <div class="content row">
        <p>
            <a href="{{route('products.create')}}" class="btn btn-primary">
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
                {!! Form::open(['route' => ['products.search'], 'class' => 'form form-inline form-search']) !!}
                @php
                    $categories->prepend('Selecione', '');
                @endphp
                {!! Form::select('category_id', $categories, '', ['class' => 'form-control', 'id' => 'category_id']) !!}
                {!! Form::text('name', null, ['placeholder' => 'Nome', 'class' => 'form-control', 'id' => 'name']) !!}
                {!! Form::text('url', null, ['placeholder' => 'URL', 'class' => 'form-control', 'id' => 'url']) !!}


                {!! Form::submit('Filtrar', ['class' => 'btn btn-danger', 'id' => 'btnSearch']) !!}
                {!! Form::close() !!}

                <a id="search-true" style="display: none" href="{{ route('products.index') }}">(x) Limpar resultados da pesquisa</a>
            </div>
        </div>
        <!--FILTRO-->

    @include('admin.includes.alerts')

    <!--TABELA -->
        <div id="tabela">
            @include('admin.products.partials.table')
        </div>
        <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('js/admin/products/jsProductTable.js') }}"></script>
@stop


