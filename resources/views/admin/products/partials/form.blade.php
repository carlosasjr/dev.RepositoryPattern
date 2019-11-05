@if( isset($product) )
    {!! Form::model($product, ['route' => ['products.update', $product->id], 'class' => 'form', 'method' => 'put' ]) !!}
@else
    {!! Form::open(['route' => 'products.store', 'class' => 'form']) !!}
@endif

<div class="form-group">
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome']) !!}
</div>

<div class="form-group">
    @php
        $categories->prepend('Selecione', '');
    @endphp

    {!! Form::label('category_id', 'Categoria', ['class' => 'control-label']); !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('url', 'URL', ['class' => 'control-label']); !!}
    {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'URL']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descrição', ['class' => 'control-label']); !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descrição']) !!}
</div>

<div class="form-group">
    {!! Form::label('price', 'Preço', ['class' => 'control-label']); !!}
    {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Preço']) !!}
</div>

{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

