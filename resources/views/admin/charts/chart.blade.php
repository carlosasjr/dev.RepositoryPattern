@extends('adminlte::page')

@section('title', 'Relatório mensal de vendas')

@section('content_header')

    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}">Dashboard</a></li>
        <li><a href="#" class="active">Gráficos</a></li>
    </ol>
@stop

@section('content')
    <div class="content row">
        <div class="box box-success" data-widget="box-widget">
            <div class="box-body">

                {!! $chart->container() !!}

            </div>
        </div>
    </div>
@stop

@push('js')
     {!! $chart->script()  !!}
@endpush




