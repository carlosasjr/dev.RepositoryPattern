@if( isset($category) )
    {!! Form::model($category, ['route' => ['categories.update', $category->id], 'class' => 'form', 'method' => 'put' ]) !!}
@else
    {!! Form::open(['route' => 'categories.store', 'class' => 'form']) !!}
@endif

<div class="form-group">
    {!! Form::label('title', 'Título', ['class' => 'control-label']); !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Título']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descrição', ['class' => 'control-label']); !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descrição']) !!}
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

