@if( $errors->any() )
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-exclamation"></i> Atenção!</h4>

        @foreach( $errors->all() as $error )
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if(session('success'))
     <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
        {{ session('success') }}
    </div>
@endif


