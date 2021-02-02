@extends('base')
@section('titulo')
productoes
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="{{route('orden.index')}}">Listado de ordens</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear orden</li>
    </ol>
</nav>
<div class="h2 text-center pb-5">
    Orden Reparacion {{$orden->codigo_orden}} <br>
    <strong class="pb-2 h5">Fecha de entrega: {{$orden->fecha_entrega}}</strong>

    <br>

</div>


<!--can('producto.store')--->
<!-- Boton agregar producto modal -->

<!--endcan-->
<!-- Fin Boton agregar producto modal -->

<!-- Mensaje Exito -->
@if(session('exito'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('exito') }}
</div>
@endif


<!-- Fin Mensaje Exito -->
<div class="row col-md-7 pl-3">
    <label for="producto" class="col-form-label">Codigo Producto</label>
    <div class="col-md-5">
      <input type="text" class="form-control" id="autocomplete-search">
</div>

    <div class="col-md-2">
        <button type="submit" class="btn btn-primary" onclick="fun_load()"> Cargar </button>
    </div>
</div>
<br>
<form action="{{ route('orden.addProducto') }}" method="POST">
    @csrf
    <div class="form-row col-md-12 pb-3">
        <div class="col-md-2">
            <label for="codigo_producto" class="col-form-label">Codigo</label>
            <input type="text" class="form-control" disabled name="codigo_producto" id="codigo_producto">
          </div>
      <div class="col-md-3">
        <label for="nombre_producto" class="col-form-label">Nombre Producto</label>
        <input type="text" class="form-control" disabled name="nombre_producto" id="nombre_producto">
      </div>
   
      <div class="col-md-2">
        <label for="nombre_producto" class="col-form-label">Precio</label>
        <input type="text" class="form-control" disabled name="precio" id="precio">
      </div>
         <div class="col-md-2">
        <label for="nombre_producto" class="col-form-label">Stock</label>
        <input type="text" class="form-control" disabled name="cant" id="cant">
      </div>
      <input type="hidden" class="form-control" name="cant2" id="cant2">
 
      <div class="col-md-2">
        <label for="cantidad" class="col-form-label">Cantidad</label>
        <input type="number" class="form-control" name="cantidad_producto" id="cantidad_producto" step="any" required>
      </div>
      <div class="col-md-1 text-center">
        <label for="prioridad" class="col-form-label ">Prioridad</label>
        <input type="checkbox" class="form-control" name="prioridad" id="prioridad">
      </div>
      <div class="col-md-2">
          <br>
          <input type="hidden" name="id_orden" value="{{$orden->id}}">
          <input type="hidden" name="id_producto" id="id_producto">
          <input type="hidden" name="edit" id="edit">
        <button type="submit" class="btn btn-primary form-control">Agregar</button>
      </div>

    </div>
  </form>
<br>
<br>
<!-- Table -->
<table class="table">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Codigo</th>
            <th scope="col">Nombre</th>
            <th scope="col"> Cantidad </th>
            <th scope="col"> Precio </th>
            <th scope="col"> Total </th>
            <th scope="col"> prioridad</th>
            <th scope="col"> Acciones </th>

        </tr>
    </thead>
    <tbody>
        <?php $i = 0 ?>
        @foreach ($productos as $producto )
        <?php $i++ ?>
        <tr class="text-center">
            <td> {{ $i}} </td>
            <td> {{ $producto->codigo_producto }} </td>
            <td> {{ $producto->nombre_producto }} </td>
            <td> {{$producto->cantidad}} </td>
            <td> {{$producto->precio}} </td>
            <td> {{ ($producto->cantidad)*($producto->precio)}} </td>
            @if($producto->prioridad)
            <td  class=" text-success">Prioridad</td>
            @else
            <td class="text-warning"></td>
            @endif
        <td >
          <input type="hidden" name="producto_id" value="{{$producto->id}}">
          <input type="hidden" name="id_orden2" value="{{$orden->id}}">
                <!--can('producto.edit_view')-->
                
                <a type="button" title="Editar"  class="fas fa-w fa-plus-circle"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$producto->id}}')"> </a>

                    
                <!--endcan-->
               <!-- can('producto.destroy')-->

               <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                    class="fas fa-w fa-trash"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_delete('{{$producto->id}}')">
                </button>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Fin Table -->
<!-- Paginacion de tabla -->

<!-- Fin Paginacion de tabla-->
<!-- Eliminar Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body align-self-center">
                <form action="{{route('orden.destroyProducto')}}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div style="text-align: center">
                        <br>
                        <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                        <br>
                        <br>
                        <strong>
                            <h3>¿Estás seguro que deseas eliminar este producto?</h3>
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
//Llena los input con el producto buscado
    function fun_load()
    {
        var idNombre = document.getElementById("autocomplete-search").value;
        var idn = idNombre.split("-");
        var id = idn[0];
        console.log(id);

        var view_url = "/Orden/load/"+id;;

        view_url =
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){

                $("#codigo_producto").val(result[0].codigo_producto);
                $('#nombre_producto').val(result[0].nombre_producto);
                $('#unidad_medida').val(result[0].unidad_medida);
                $('#precio').val(result[0].precio);
                $('#cant').val(result[0].cantidad_producto);
                $('#cant2').val(result[0].cantidad_producto);
                $('#proveedor').val(result[0].proveedor);
                console.log(result[0].id);
                $('#id_producto').val(result[0].id);


            }
        });
    }

    function fun_edit(id)
    {
      ///  var id = document.getElementById("autocomplete-search").value;
       // var view_url = '{{ route("producto.editload", ":id") }}';
        console.log(id);
        view_url = "/Orden/editload/"+id;///view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result)
            {
                console.log(result[0].nombre_producto);
                console.log(result.nombre_producto);
                $("#codigo_producto").val(result[0].codigo_producto);
                $('#nombre_producto').val(result[0].nombre_producto);
                $('#unidad_medida').val(result[0].unidad_medida);
                $('#cantidad_producto').val(result[0].cantidad);
                  $('#cant').val(result[0].cantidad_producto);
                $('#cant2').val(result[0].cantidad_producto);
                $('#precio').val(result[0].precio);

                if(result[0].prioridad)
                {
                    $('#prioridad').prop('checked', true);
                }else{
                    $('#prioridad').prop('checked', false);
                }
                $('#id_producto').val(result[0].producto_id);
                $('#edit').val(1);


            }
        });
    }


    function fun_delete(id)
    {
        $("#delete_id").val(id);
    }
    //Limpiar los campos de la modal de traslados
    function limpiarCampos(){
        $('#nombre_producto').val(''); //Limpiando el input
    }
</script>

@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>

<script type="text/javascript">

    $("#autocomplete-search").easyAutocomplete({
        url: function(search) {
            return "/searchProducto?search=" + search;

        },

        //setValue: "codigo_producto",
        getValue: "producto"

       // disabled:true

     } );

     var path = "{{ route('posts.search') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });

    function fun_delete(id)
    {
        $("#delete_id").val(id);
    }

</script>

@endsection
@endsection
