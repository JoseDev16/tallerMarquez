@extends('base')
@section('titulo')
Listado de `reservas

@endsection
@section('content')

<div class="col-md-12">
@if(session('exito'))
   <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('exito') }}
   </div>
@endif
@if(session('advertencia'))
   <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('advertencia') }}
   </div>
@endif

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body align-self-center">
                <form action="{{ route('reserva.destroy') }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div style="text-align: center">
                        <br>
                        <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                        <br>
                        <br>
                        <strong>
                            <h3>¿Estás seguro que deseas eliminar la reserva?</h3>
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

<!-- Agregar Modal -->
<div class="modal fade" id="addModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fw fa-plus-circle"></i>
                    Agregar reserva
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('reserva.store') }}" method="POST" name="miForm">
                    @csrf
                    
                      <label for="" class="control-label">Nombre cliente: </label>
                       <input  type="text" name="cliente" id="cliente"
                       class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>
                  <br>
                     <label for="mecanico" class="control-label">Telefono: </label>
                      <input  type="text" name="telefono" id="telefono"
                         class="form-control"   required  autofocus>
                  <br>
                    <label for="mecanico" class="control-label">DNI: </label>
                     <input  type="text" name="dni" id="dni"
                class="form-control"   required  autofocus>
                <br>
                      <label for="mecanico" class="control-label">Direccion: </label>
                        <input  type="text" name="direccion" id="direccion"
                         class="form-control"   required  autofocus>
                <br>
                      <label for="codigo_material" class="control-label">Fecha: </label>
                           <input type="text" class="form-control" id="demo" name="fecha"/>
                  <br>
                           
                        <label for="hora" class="control-label">Hora: </label>
                           <select class="form-control"  name="hora" required>
                           
                              <option value="8-AM">8-AM</option>
                              <option value="9-AM">9-AM</option>
                              <option value="10-AM">10-AM</option>
                              <option value="11-AM">11-MD</option>
                              <option value="12-AM">12-MD</option>
                              <option value="1-PM">1-PM</option>
                              <option value="2-PM">2-PM</option>
                              <option value="3-PM">3-PM</option>
                              <option value="4-PM">4-PM</option>
                              <option value="5-PM">5-PM</option>
                           
                           </select>
                        <label for="" class="control-label">Razon: </label>
                        <input  type="text" name="razon" id="razon"
                           class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>
                        <br>
                        
                     
                        <label for="codigo_material" class="control-label">Nota(Opcional): </label>
                        <input  type="text" name="nota" id="nota"
                        class="form-control"  autofocus>
                        <br>

                        <label for="codigo_material" class="control-label">Mecanico(Opcional): </label>
                        <input  type="text" name="mecanico" id="mecanico"
                        class="form-control" placeholder="Nombre mecanico"   autofocus>
                        <br>

                      
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


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addModal2">
        Agregar reserva
    </button>
</div>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <form class="d-flex">
     <label for="fechaInicio" class="control-label me-2">Desde </label>
      <input class="form-control me-2" name="fechaInicio" type="date"  aria-label="Search">
      <label for="fechaFin" class="control-label">Hasta </label>
       <input class="form-control me-2" name="fechaFin" type="date"  aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
  </div>
</nav>

   <!-- INICIO DE recuadro de listar-->


   <table class="table">
      <thead class="thead-dark">
         <tr>
            <th scope="col">#</th>
            <th scope="col">Fecha </th>
             <th scope="col">Hora </th>

            <th scope="col">Cliente</th>
            <th scope="col">Telefono</th>

            <th scope="col">Razon</th>
            <th scope="col">Nota</th>
            <th scope="col">Mecanico</th>
            <th scope="col">Estado Reserva</th>
            <th scope="col"> Acciones </th>
            
         </tr>
         @foreach ($reservas as $reserva )
         <tr>
            <td class="text-dark"> {{ $reserva->id }} </td>

            <td class="text-dark"> {{ $reserva->fecha }} </td>
            <td class="text-dark"> {{ $reserva->hora }} </td>
            <td class="text-dark"> {{ $reserva->cliente }} </td>
            <td class="text-dark"> {{ $reserva->telefono}} </td>
             <td class="text-dark"> {{ $reserva->razon}} </td>
            <td class="text-dark"> {{ $reserva->nota }} </td>
            <td class="text-dark"> {{ $reserva->mecanico }} </td>
            <td class="text-dark"> {{ $reserva->estado}} </td>
            <td class="text-dark"> 
            <button type="button" title="Editar" data-toggle="modal" data-target="#editModal"
                    class="fas fa-w fa-edit"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$reserva->id}}')"></button>
                     <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                    class="fas fa-w fa-trash"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_delete('{{$reserva->id}}')"></button>
             
       </td>
          
                  
         </tr>
         @endforeach
      </thead>
    
   </table>
   <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle2"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle2">
                    <i class="fas fa-w fa-edit"></i>
               Editar reserva
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('reserva.edit') }}" method="POST">
               @csrf
               <div class="form-group required">
            
                <label for="fecha" class="control-label">Fecha: </label>
                  <input type="text" class="form-control" id="demo2" name="fecha2"/>
                                    
              
                <br>
                 <label for="hora" class="control-label">Hora: </label>
                   <select class="form-control"  name="hora2" id="hora" required>
                   
                     <option value="8-AM">8-AM</option>
                     <option value="9-AM">9-AM</option>
                     <option value="10-AM">10-AM</option>
                     <option value="11-AM">11-MD</option>
                     <option value="12-AM">12-MD</option>
                     <option value="1-PM">1-PM</option>
                     <option value="2-PM">2-PM</option>
                     <option value="3-PM">3-PM</option>
                     <option value="4-PM">4-PM</option>
                     <option value="5-PM">5-PM</option>
                    
                  </select>
                       
             
                <label for="codigo_material" class="control-label">Nota(Opcional): </label>
                <input  type="text" name="nota2" id="nota2"
                class="form-control"  autofocus>
                <br>
                 <label for="hora" class="control-label">Estado: </label>
                   <select class="form-control"  name="estado" id="hora" required>
                   
                     <option value="Activa">Activa</option>
                     <option value="Cancelada">Cancelada</option>
                 
                    
                  </select>
             

                <label for="codigo_material" class="control-label">Mecanico(Opcional): </label>
                <input  type="text" name="mecanico2" id="mecanico2"
                class="form-control" placeholder="Nombre mecanico"   autofocus>
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

<!-- Eliminar Modal -->



<script type="text/javascript">
   function fun_edit(id)
      {
         var view_url = "/Reserva/edit_view/"+id;
         $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
               $("#edit_id").val(result.id);
               $("#nota2").val(result.nota);
               $("#mecanico2").val(result.mecanico);
               $("#demo2").val(result.fecha);
               $("#hora2").val(result.hora);
             


               console.log(result.fecha);


            }
         });
           
      }

</script>



<script type="text/javascript">


    $(document).ready(function(){
        $("#demo").datepicker({
            dateFormat: 'yy-mm-dd',
          
                firstDay: 1,
               
                monthNames: ['Enero', 'Febrero', 'Marzo',
                'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
               minDate:0,
               maxDate: 7,
               beforeShowDay: function (day) { 
                                 var day = day.getDay(); 
                                  if (day == 0) { 
                                     return [false, "text-danger"] 
                                 } else { 
                                 return [true, "text-danger"] 
                                  } 
                              } 
              



                
        });
    });


    $(document).ready(function(){
        $("#demo2").datepicker({
            dateFormat: 'yy-mm-dd',
          
                firstDay: 1,
               
                monthNames: ['Enero', 'Febrero', 'Marzo',
                'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
               minDate:0,
               maxDate: 7,
               beforeShowDay: function (day) { 
                                 var day = day.getDay(); 
                                  if (day == 0) { 
                                     return [false, "text-danger"] 
                                 } else { 
                                 return [true, "text-danger"] 
                                  } 
                              } 
              



                
        });
    });


      function fun_delete(id)
    {
        $("#delete_id").val(id);
    }
</script>



</div>
@endsection
