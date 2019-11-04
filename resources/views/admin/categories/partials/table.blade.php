<div class="box box-danger">
    <div class="box-body">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Url</th>
                <th width="150px" scope="col">Ações</th>
            </tr>
            </thead>

            <tbody>
            @forelse($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{$category->title}}</td>
                    <td>{{$category->url}}</td>
                    <td>
                        <a href="{{route('categories.edit', $category->id)}}" class="badge bg-yellow">Editar</a>
                        <a href="{{route('categories.show', $category->id)}}" class="badge bg-dark">Detalhes</a>
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
            {!! $categories->appends($dataForm)->links() !!}
        @else
            {!! $categories->links() !!}
        @endif
    </div>
</div>


