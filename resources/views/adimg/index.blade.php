@extends('base')
@section('titulo')
imagenes
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listado de imagenes</li>
    </ol>
</nav>

<!-- Boton agregar imagen modal -->
@if($imagenes->count() == 0)
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <button type="button" class="btn btn-primary" onclick="limpiarCampos()" data-toggle="modal" data-target="#addModal">
        Agregar imagen
    </button>
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
<!-- Mensaje Exito -->
@if(session('exito'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('exito') }}
</div>
@endif
<!-- Fin Mensaje Exito -->

<!-- Fin Boton agregar imagen modal -->
<!-- Agregar Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fw fa-plus-circle"></i>
                    Agregar imagen
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('imagen.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
            
                    <div class="form-group">
                        <label for="ruta2">Imagen Banner 1</label>
                        <input class="form-control"  type="file" name="imagen1g" id="ruta2" required>
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Banner 2</label>
                        <input class="form-control"  type="file" name="imagen2g" id="ruta" required>
                    </div>
                    <div class="form-group">
                     <label for="ruta">Imagen Carrusel 1</label>
                        <input class="form-control"  type="file" name="imagen1c" id="ruta" required>
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Carrusel 2</label>
                        <input class="form-control"  type="file" name="imagen2c" id="ruta" required>
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Carrusel 3</label>
                        <input class="form-control"  type="file" name="imagen3c" id="ruta" required>
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Carrusel 4</label>
                        <input class="form-control"  type="file" name="imagen4c" id="ruta" required>
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Carrusel 5</label>
                        <input class="form-control"  type="file" name="imagen5c" id="ruta" required>
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Carrusel 6</label>
                        <input class="form-control"  type="file" name="imagen6c" id="ruta" required>
                    </div>
                    
                    <button class="btn btn-primary" type="submit">Guardar</button>






                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin Agregar Modal -->

@if(count($imagenes) > 0)
<!-- Table -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Imagen banner 1</th>
            <th scope="col">Imagen banner 2</th>
            <th scope="col">Imagen carrusel 1</th>
            <th scope="col">Imagen carrusel 2</th>
             <th scope="col">Imagen carrusel 3</th>
              <th scope="col">Imagen carrusel 4</th>
               <th scope="col">Imagen carrusel 5</th>
                <th scope="col">Imagen carrusel 6</th>

            
      
            <th scope="col">Acciones</th>
        </tr>
        <?php $i = 0 ?>
        @foreach ($imagenes as $imagen )
        <?php $i++ ?>
        <tr>
            <td> {{ $i}} </td>
            <td> 
               <a href="{{ asset('img').'/'.$imagen->imagen1g }}" target="_blank"> <img src="{{ asset('img').'/'.$imagen->imagen1g }}" width="50"> </a>
             </td>
            <td> 
                           <a href="{{ asset('img').'/'.$imagen->imagen2g }}" target="_blank"> <img src="{{ asset('img').'/'.$imagen->imagen2g }}" width="50"> </a>

             </td>
            <td> 
                           <a href="{{ asset('img').'/'.$imagen->imagen1c }}" target="_blank"> <img src="{{ asset('img').'/'.$imagen->imagen1c }}" width="50"> </a>

            </td>
            <td> 
                                       <a href="{{ asset('img').'/'.$imagen->imagen2c }}" target="_blank"> <img src="{{ asset('img').'/'.$imagen->imagen2c }}" width="50"> </a>

             </td>
            <td> 
                                       <a href="{{ asset('img').'/'.$imagen->imagen3c }}" target="_blank"> <img src="{{ asset('img').'/'.$imagen->imagen3c }}" width="50"> </a>

             </td>
            <td> 
                                       <a href="{{ asset('img').'/'.$imagen->imagen4c }}" target="_blank"> <img src="{{ asset('img').'/'.$imagen->imagen4c }}" width="50"> </a>

             </td>
            <td> 
                                       <a href="{{ asset('img').'/'.$imagen->imagen5c }}" target="_blank"> <img src="{{ asset('img').'/'.$imagen->imagen5c }}" width="50"> </a>

            </td>
            <td> 
                                       <a href="{{ asset('img').'/'.$imagen->imagen6c }}" target="_blank"> <img src="{{ asset('img').'/'.$imagen->imagen6c }}" width="50"> </a>

            </td>
            <td style="display: flex">
             
                <button type="button" title="Editar" data-toggle="modal" data-target="#editModal"
                    class="fas fa-w fa-edit"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$imagen->id}}')"></button>
      
             
             
            </td>
        </tr>
        @endforeach
    </thead>
</table>
<!-- Fin Table -->
<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
    {{ $imagenes->links() }}
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
                    Editar imagen
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('imagen.edit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                       <div class="form-group">
                        <label for="ruta2">Imagen Banner 1</label>
                        <input class="form-control"  type="file" name="imagen1ge" id="ruta2" >
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Banner 2</label>
                        <input class="form-control"  type="file" name="imagen2ge" id="ruta" >
                    </div>
                    <div class="form-group">
                     <label for="ruta">Imagen Carrusel 1</label>
                        <input class="form-control"  type="file" name="imagen1ce" id="ruta" >
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Carrusel 2</label>
                        <input class="form-control"  type="file" name="imagen2ce" id="ruta">
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Carrusel 3</label>
                        <input class="form-control"  type="file" name="imagen3ce" id="ruta">
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Carrusel 4</label>
                        <input class="form-control"  type="file" name="imagen4ce" id="ruta" >
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Carrusel 5</label>
                        <input class="form-control"  type="file" name="imagen5ce" id="ruta" >
                    </div>
                    <div class="form-group">
                        <label for="ruta">Imagen Carrusel 6</label>
                        <input class="form-control"  type="file" name="imagen6ce" id="ruta" >
                    </div>
                    
                





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

@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ninguna imagen registrada.</strong>
</div>
@endif
<script type="text/javascript">
    function fun_edit(id)
    {
        var view_url = '{{ route("imagen.edit_view", ":id") }}';
        view_url = view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                console.log(result.nombre_imagen);
                $("#edit_id").val(result.id);
                $('#nomb_imagen').val(result.nombre_imagen);
            }
        });
    }

    function fun_delete(id)
    {
        $("#delete_id").val(id);
    }
    //Limpiar los campos de la modal de traslados
    function limpiarCampos(){
        $('#nombre_imagen').val(''); //Limpiando el input
    }
</script>
@endsection
