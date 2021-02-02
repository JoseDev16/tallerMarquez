@extends('base')
@section('titulo')
Clientes
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <a href="{{route('cliente.index')}}"><li class="breadcrumb-item active" aria-current="page">Listado de Clientes</li></a>
        <li class="breadcrumb-item active" aria-current="page">/Asignar vehiculo </li>
    </ol>
</nav>
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

<!-- Boton agregar cliente modal -->


<!-- Fin Boton agregar cliente modal -->
<div class="h2">
  Asignar vehiculo a {{$clientes->nombre_cliente}}
</div>
@if(session('exito'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('exito') }}
</div>
@endif
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="d-flex justify-content-center">
        <form action="{{ route('vehiculo.store') }}" method="POST" name="miForm">
            @csrf
            <div class="form-group required">

                <label for="" class="control-label">Placa: </label>
                <input maxlength="20" type="text" name="placa" id="placa"
                    class="form-control"  placeholder="Numero de placa"  required
                    autofocus>

            </div>
            <div class="form-group required">

                <label for="" class="control-label">Marca: </label>
                <input maxlength="20" type="text" name="marca" id="marca"
                    class="form-control"  placeholder="Toyota"  required
                    autofocus>

            </div>
            <div class="form-group required">

                <label for="" class="control-label">Color: </label>
                <input maxlength="20" type="text" name="color" id="dni"
                    class="form-control"  placeholder="color"  required
                    autofocus>

            </div>
            <div class="form-group required">

                <label for="" class="control-label">Modelo: </label>
                <input maxlength="20" type="text" name="modelo" id="modelo"
                    class="form-control"  placeholder="Modelo..."  required
                    autofocus>

            </div>
            <div class="form-group required">

                <label for="" class="control-label">Anio: </label>
                <input maxlength="20" type="text" name="anio" id="anio"
                    class="form-control"  placeholder="anio"  required
                    autofocus>

            </div>
            <div class="form-group required">

                <label for="" class="control-label">Tipo: </label>
                <input maxlength="20" type="text" name="tipo" id="tipo"
                    class="form-control"  placeholder="direccion"  required
                    autofocus>

                    <input type="hidden"  name="cliente_id" value="{{$clientes->id}}">

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
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Placa</th>
            <th scope="col">Tipo</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">anio</th>
            <th scope="col">Color</th>
            <th scope="col">Acciones</th>

        </tr>
        <?php $i = 0 ?>
        @foreach ($clientes->vehiculos as $cliente )
        <?php $i++ ?>
        <tr>
            <td> {{ $i}} </td>
            <td> {{ $cliente->placa }} </td>
            <td> {{ $cliente->tipo }} </td>
            <td> {{ $cliente->marca_id }} </td>
            <td> {{ $cliente->modelo }} </td>
            <td> {{ $cliente->anio }} </td>
            <td> {{ $cliente->color }} </td>
            <td>  <a class="fas fa-car" href="{{route('orden.create', $cliente->id)}}"/> </td>

        </tr>
        @endforeach
    </thead>
</table>
<!-- Fin Agregar Modal -->
<!-- Mensaje Exito -->

<!-- Fin Mensaje Exito -->

<!-- Table -->

<!-- Fin Table -->
<!-- Paginacion de tabla -->

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
