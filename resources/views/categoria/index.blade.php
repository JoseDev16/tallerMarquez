@extends('base')
@section('titulo')
Categorías
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listado de categorías</li>
    </ol>
</nav>

<!-- Boton agregar categoria modal -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <button type="button" class="btn btn-primary" onclick="limpiarCampos()" data-toggle="modal" data-target="#addModal">
        Agregar categoría
    </button>
</div>

<!-- Fin Boton agregar categoria modal -->
<!-- Agregar Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fw fa-plus-circle"></i>
                    Agregar categoría
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categoria.store') }}" method="POST" name="miForm">
                    @csrf
                    <div class="form-group required">

                        <label for="" class="control-label">Nombre de categoría: </label>
                        <input maxlength="20" type="text" name="nombre_categoria" id="nombre_categoria"
                            class="form-control{{ $errors->has('nombre_categoria') ? ' is-invalid' : '' }}"
                            placeholder="Ingrese nombre de categoria" value="{{ old('nombre_categoria') }}" required
                            autofocus>
                        @if($errors->has('nombre_categoria'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nombre_categoria') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <input type="hidden" name="user" value="{{auth()->user()->name}}">
                        <button type="submit" class="btn btn-primary">
                            <i class='fas fa-check-circle'></i>
                            Guardar
                        </button>
                        <a href="" class="btn btn-primary" data-dismiss="modal">
                            <i class='fa fa-times'></i>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin Agregar Modal -->
<!-- Mensaje Exito -->
@if(session('exito'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('exito') }}
</div>
@endif
<!-- Fin Mensaje Exito -->
@if(count($categorias) > 0)
<!-- Table -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Acciones</th>
        </tr>
        <?php $i = 0 ?>
        @foreach ($categorias as $categoria )
        <?php $i++ ?>
        <tr>
            <td> {{ $i}} </td>
            <td> {{ $categoria->nombre_categoria }} </td>
            <td style="display: flex">
             
                <button type="button" title="Editar" data-toggle="modal" data-target="#editModal"
                    class="fas fa-w fa-edit"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$categoria->id}}')"></button>
      
                <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                    class="fas fa-w fa-trash"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_delete('{{$categoria->id}}')"></button>
             
            </td>
        </tr>
        @endforeach
    </thead>
</table>
<!-- Fin Table -->
<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
    {{ $categorias->links() }}
</div>
<!-- Fin Paginacion de tabla-->
<!-- Editar Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fa-w fa-edit"></i>
                    Editar categoría
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categoria.edit') }}" method="POST">
                    @csrf
                    <div class="form-group required">
                        <label for="" class="control-label">Nombre de categoría: </label>
                        <input maxlength="20" type="text" name="nomb_categoria" id="nomb_categoria"
                            class="form-control{{ $errors->has('nomb_categoria') ? ' is-invalid' : '' }}" required
                            autofocus>
                        @if($errors->has('nomb_categoria'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nomb_categoria') }}</strong>
                        </span>
                        @endif
                    </div>
                    <input type="hidden" name="user" value="{{auth()->user()->name}}">
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">
                            <i class='fas fa-check-circle'></i>
                            Editar
                        </button>
                        <input type="hidden" id="edit_id" name="edit_id">
                        <a href="" class="btn btn-primary" data-dismiss="modal">
                            <i class='fa fa-times'></i>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin Editar Modal-->
<!-- Eliminar Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body align-self-center">
                <form action="{{ route('categoria.destroy') }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div style="text-align: center">
                        <br>
                        <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                        <br>
                        <br>
                        <strong>
                            <h3>¿Estás seguro que deseas eliminar la categoría?</h3>
                        </strong>
                        <strong>Recuerda que NO podrás revertir esta acción</strong>
                        <input type="hidden" id="delete_id" name="delete_id">
                        <input type="hidden" name="user" value="{{auth()->user()->name}}">
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">
                            <i class='fas fa-check-circle'></i>
                            Eliminar
                        </button>
                        <a href="" class="btn btn-primary" data-dismiss="modal">
                            <i class='fa fa-times'></i>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ninguna categoría registrada.</strong>
</div>
@endif
<script type="text/javascript">
    function fun_edit(id)
    {
        var view_url = '{{ route("categoria.edit_view", ":id") }}';
        view_url = view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                console.log(result.nombre_categoria);
                $("#edit_id").val(result.id);
                $('#nomb_categoria').val(result.nombre_categoria);
            }
        });
    }

    function fun_delete(id)
    {
        $("#delete_id").val(id);
    }
    //Limpiar los campos de la modal de traslados
    function limpiarCampos(){
        $('#nombre_categoria').val(''); //Limpiando el input
    }
</script>
@endsection
