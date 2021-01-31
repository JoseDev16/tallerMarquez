@extends('base')
@section('titulo')
Clientes
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listado de Clientes</li>
    </ol>
</nav>

<!-- Boton agregar cliente modal -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <button type="button" class="btn btn-primary" onclick="limpiarCampos()" data-toggle="modal" data-target="#addModal">
        Agregar Cliente
    </button>
    <a href="{{route('cliente.reporteVisitas')}}"> <i class="fas fa-file-pdf" tittle="reporte"></i>Reporte Visitas</i></a>
</div>


<!-- Fin Boton agregar cliente modal -->
<!-- Agregar Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fw fa-plus-circle"></i>
                    Agregar Cliente
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cliente.store') }}" method="POST" name="miForm">
                    @csrf
                    <div class="form-group required">

                        <label for="" class="control-label">Nombre de Cliente: </label>
                        <input maxlength="20" type="text" name="nombre_cliente" id="nombre_cliente"
                            class="form-control"  placeholder="Ingrese nombre de cliente"  required
                            autofocus>

                    </div>
                    <div class="form-group required">

                        <label for="" class="control-label">Apellido de Cliente: </label>
                        <input maxlength="20" type="text" name="apellido_cliente" id="apellido_cliente"
                            class="form-control"  placeholder="Ingrese apellido"  required
                            autofocus>

                    </div>
                    <div class="form-group required">

                        <label for="" class="control-label">DNI: </label>
                        <input maxlength="20" type="text" name="dni" id="dni"
                            class="form-control"  placeholder="dni"  required
                            autofocus>

                    </div>
                    <div class="form-group required">

                        <label for="" class="control-label">Telefono: </label>
                        <input maxlength="20" type="text" name="numero_cliente" id="numero_cliente"
                            class="form-control"  placeholder="Ingrese Telefono"  required
                            autofocus>

                    </div>
                    <div class="form-group required">

                        <label for="" class="control-label">Direccion: </label>
                        <input maxlength="20" type="text" name="direccion" id="direccion"
                            class="form-control"  placeholder="direccion"  required
                            autofocus>

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
<!-- Editar  Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fw fa-plus-circle"></i>
                    Editar cliente
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cliente.edit') }}" method="POST" name="miForm">
                    @csrf
                    <div class="form-group required">
                        

                        <label for="" class="control-label">Nombre de Cliente: </label>
                        <input maxlength="20" type="text" name="nombre_cliente" id="nombre_clienteE"
                            class="form-control"  placeholder="Ingrese nombre de cliente"  required
                            autofocus>

                    </div>
                    <div class="form-group required">

                        <label for="" class="control-label">Apellido de Cliente: </label>
                        <input maxlength="20" type="text" name="apellido_cliente" id="apellido_clienteE"
                            class="form-control"  placeholder="Ingrese apellido"  required
                            autofocus>

                    </div>
              
                    <div class="form-group required">

                        <label for="" class="control-label">Telefono: </label>
                        <input maxlength="20" type="text" name="numero_cliente" id="numero_clienteE"
                            class="form-control"  placeholder="Ingrese Telefono"  required
                            autofocus>

                    </div>
                    <div class="form-group required">

                        <label for="" class="control-label">Direccion: </label>
                        <input maxlength="20" type="text" name="direccion" id="direccionE"
                            class="form-control"  placeholder="direccion"  required
                            autofocus>

                    </div>
                    <input class="form-control" type="hidden" name="edit_id" id="edit_id">
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
@if ($errors->any())
    <div class="errors">
        <p class="alert alert-warning" role="alert">Por favor corrige los siguientes errores</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- Fin Mensaje Exito -->
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <form class="d-flex">
      <input class="form-control me-2" name="buscar" type="search" placeholder="Buscar Cliente.." aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
  </div>
</nav>

<!-- Table -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">DNI</th>
            <th scope="col">Telefono</th>
            <th scope="col">Direccion</th>
            <th scope="col">Acciones</th>
        </tr>
        <?php $i = 0 ?>
        @foreach ($clientes as $cliente )
        <?php $i++ ?>
        <tr>
            <td> {{ $i}} </td>
            <td> {{ $cliente->nombre_cliente }} </td>
            <td> {{ $cliente->apellido_cliente }} </td>
            <td> {{ $cliente->dni }} </td>
            <td> {{ $cliente->numero_cliente }} </td>
            <td> {{ $cliente->direccion }} </td>
            <td style="display: flex">

                <button type="button" title="Editar" data-toggle="modal" data-target="#editModal"
                    class="fas fa-w fa-edit"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$cliente->id}}')"></button>


                <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                    class="fas fa-w fa-trash"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_delete('{{$cliente->id}}')"></button>

                    <a class="fas fa-car" href="{{route('vehiculo.create', $cliente->id)}}"/>


            </td>
        </tr>
        @endforeach
    </thead>
</table>
<!-- Fin Table -->
<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
    {{ $clientes->links() }}
</div>
<!-- Fin Paginacion de tabla-->
<!-- Editar Modal -->

<!-- Eliminar Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body align-self-center">
                <form action="{{ route('cliente.destroy') }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div style="text-align: center">
                        <br>
                        <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                        <br>
                        <br>
                        <strong>
                            <h3>¿Estás seguro que deseas eliminar la Cliente?</h3>
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

<script type="text/javascript">
  function fun_edit(id)
   {
      var view_url = "/Cliente/edit/"+id;
      $.ajax({
         url: view_url,
         type:"GET",
         data: {"id":id},
         success: function(result){
            $("#edit_id").val(result.id);
            $("#nombre_clienteE").val(result.nombre_cliente);
            $('#apellido_clienteE').val(result.apellido_cliente );
            $('#numero_clienteE').val(result.numero_cliente);
           
            $('#direccionE').val(result.direccion)
            
            console.log(result);
         }
      });
   }

    function fun_delete(id)
    {
        $("#delete_id").val(id);
    }
    //Limpiar los campos de la modal de traslados
    function limpiarCampos(){
        $('#nombre_cliente').val(''); //Limpiando el input
    }
</script>
@endsection
