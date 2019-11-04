<div class="box box-danger">
    <div class="box-body">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Url</th>
                <th scope="col">Categoria</th>
                <th scope="col">Preço</th>
                <th width="150px" scope="col">Ações</th>
            </tr>
            </thead>

            <tbody>
            @forelse($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->url}}</td>
                    <td>{{$product->category->title}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                        <a href="{{route('products.edit', $product->id)}}" class="badge bg-yellow">Editar</a>
                        <a href="{{route('products.show', $product->id)}}" class="badge bg-dark">Detalhes</a>
                    </td>
                </tr>

            @empty
                <tr>
                    Nenhum Registro nesta tabela
                </tr>
            @endforelse
            </tbody>
        </table>

        @if( isset($dataForm) )
            {!! $products->appends($dataForm)->links() !!}
        @else
            {!! $products->links() !!}
        @endif
    </div>
</div>


