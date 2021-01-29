@extends('base')
@section('titulo')
Listado de `ordenes
@endsection
@section('content')
<div class="col-md-12">
   @if(session('exito'))
   <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('exito') }}
   </div>
   @endif
   <!-- INICIO DE recuadro de listar-->


   <table class="table">
      <thead class="thead-dark">
         <tr>
            <th scope="col">#</th>
            <th scope="col">Fecha entrega</th>

            <th scope="col">Placa</th>

            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">Estado orden</th>
            <th scope="col">Mecanico Asignado</th>
            <th scope="col"> Imagen 1</th>
            <th scope="col"> Imagen 2</th>
            <th scope="col"> Acciones </th>
            <th scope="col"> Herramientas </th>
         </tr>
         @foreach ($ordenes as $orden )
         <tr>
            <td class="text-dark"> {{ $orden->id }} </td>

            <td class="text-dark"> {{ $orden->fecha_entrega }} </td>
            <td class="text-dark"> {{ $orden->vehiculo->placa }} </td>
            <td class="text-dark"> {{ $orden->vehiculo->marca_id}} </td>
            <td class="text-dark"> {{ $orden->vehiculo->modelo }} </td>
            <td class="text-dark"> {{ $orden->estado }} </td>
            <td class="text-dark"> {{ $orden->mecanico }} </td>
            <td class="text-center">
                 <a href="{{ asset('img').'/'.$orden->imagen1 }}" target="_blank"> <img src="{{ asset('img').'/'.$orden->imagen1 }}" width="50"> </a>
            </td>
            <td class="text-center">


                <a href="{{ asset('img').'/'.$orden->imagen2 }}" target="_blank"> <img src="{{ asset('img').'/'.$orden->imagen2 }}" width="50"> </a>
              </td>
               <form action="{{route('orden.reporte')}}" method="post" >
                               @csrf
           
                     <td>

                        <input type="hidden" name="orden_id" value="{{$orden->id}}">
                        @if($orden->estado == "Terminado" || $orden->estado =="Entregado")
                       
                        <button type="submmit" target="_blank" title="Generar reporte"
                           class="fas fa-w fa-file-pdf" style="color:gray !important; background-color:transparent; border: 0px solid;"
                           />
                     
                        @else
                        
                        <button type="button" data-toggle="modal" data-target="#editModal" class="fas fa-w fa-edit"
                        style="color:dark !important; background-color:transparent; border: 0px solid;"
                        onclick="fun_edit('{{$orden->id}}')"></button>

                         

                        <a type="button"  class="fas fa-w fa-clipboard-list"
                        style="color:dark !important; background-color:transparent; border: 0px solid;"
                        href="{{route('orden.asignarProducto', $orden->id)}}"></a>

                        
                        @endif

                     
                     </td>
                     </form>
                     <form action="{{route('orden.reporteHerramientas')}}" method="post" >
                               @csrf
                     <td>
                           <input type="hidden" name="orden_id" value="{{$orden->id}}">
                        @if($orden->estado == "Terminado" || $orden->estado =="Entregado")
                       
                        <button type="submmit" target="_blank" title="Generar reporte Herramientas" 
                           class="fas fa-w fa-file-pdf" style="color:gray !important; background-color:transparent; border: 0px solid;"
                           />
                        @else 
                           <a type="button"  class="fas fa-w fa-clipboard-list" tittle="Asignar herramienta"
                           style="color:dark !important; background-color:transparent; border: 0px solid;"
                           href="{{route('orden.asignarMaterial', $orden->id)}}"></a>
                        @endif

                     </td>
                     </form>
                  
         </tr>
         @endforeach
      </thead>
    
   </table>

<!-- Editar Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#F2F2F2 !important;">
            <h5 class="modal-title" id="exampleModalLongTitle">
               <i class="fas fa-w fa-edit"></i>
               Editar orden
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('orden.edit') }}" method="POST">
               @csrf
               <div class="form-group required">
                <label for="" class="control-label">Motivo: </label>
                <input  type="text" name="motivo_ingreso" id="motivo_ingreso"
                   class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>
                 <br>
                <label for="codigo_material" class="control-label">Trabajo realizado: </label>
                <input  type="text" name="trabajo_realizado" id="trabajo_realizado"
                class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>
                <br>
               <label for="mecanico" class="control-label">Mecanico: </label>
                <input  type="text" name="mecanico" id="mecanico"
                class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>
                <br>
                <label for="codigo_material" class="control-label">Costo mano de obra: </label>
                <input  type="number" name="mano_obra" id="mano_obra"
                class="form-control" required min="0.0" step="0.1" autofocus>
                <br>

                <label for="codigo_material" class="control-label">Nota: </label>
                <input  type="text" name="nota" id="nota"
                class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>
                <br>
                <label for="codigo_material" class="control-label">Fecha entrega: </label>
                <input  type="date" name="fecha_entrega" id="fecha_entrega"
                class="form-control"  required  autofocus>

                <br>
                <label for="" class="control-label">Estado: </label>
                <select name="estado" id="estado" class="form-control" required>
                   <option value="">Seleccione un estado</option>
                   <option value="Pendiente">Pendiente</option>
                   <option value="Trabajando">Trabajando</option>
                   <option value="Terminado">Terminado</option>
                   <option value="Entregado">Entregado</option>

                </select>
                <br>
          
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





<script type="text/javascript">
   function fun_edit(id)
      {
         var view_url = "/Orden/edit_view/"+id;
         $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
               $("#edit_id").val(result.id);
               $("#motivo_ingreso").val(result.motivo_ingreso);
               $("#trabajo_realizado").val(result.trabajo_realizado);
               $("#mano_obra").val(result.mano_obra);
               $("#mecanico").val(result.mecanico);
               $("#nota").val(result.nota);
               $("#fecha_entrega").val(result.fecha_entrega);

               console.log(result.id);


            }
         });
      }
   function fun_delete(id)
   {
      $("#delete_id").val(id);
      console.log(result.id);
   }
</script>


</div>
@endsection
