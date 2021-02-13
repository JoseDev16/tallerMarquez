<!DOCTYPE html>
<html lang="en">
<head>
  <title>Taller Ramirez</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
      <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />

  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>
</head>
<body>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a href="{{route('homeCliente')}}" class="navbar-brand" href="">Taller Ramirez</a>
  <a data-target="#waModal2" data-toggle="modal" class="btn btn-dark text-white">Agendar cita</a>
    <a href="{{route('servicios')}}" class="navbar-brand" href="">Servicios</a>
        <a href="{{route('nosotros')}}" class="navbar-brand" href="">Nosotros</a>


 
</nav>
  


<div class="container-fluid">
    <header class="h1 text-center pb-5 pt-5">
    @yield('titulo')
        

    </header>
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
    @yield('content')

    

 
</div>
<footer class="container-fluid bg-grey py-5">
<div class="container">
   <div class="row">
      <div class="col-md-6">
         <div class="row">
            <div class="col-md-6 ">
               <div class="logo-part">
                  <img src="https://i.pinimg.com/originals/7e/12/68/7e126834415d452a80fb8b357e4a15c3.jpg" class="w-50 logo-footer" >
                  <p>Taller Ramirez,Bolivia</p>
                  <p>El mejor taller de la region, siempre con las mejores ofertas y precios</p>
               </div>
            </div>
            <div class="col-md-6 px-4">
               <h6> Sobre nosotros</h6>
               <p>Taller de servicios de mecanica y electricidad automotriz</p>
                 <ul><strong> Especialistas en:</strong>
                        <li> Caja de transmision</li>
                        <li> Frenos  </li>
                        <li> Reparacion radiadores </li>
                        <li> Respuestos de motor </li>
                    
                     </ul>
            
            </div>
         </div>
      </div>
      <div class="col-md-6">
      <h4> Siguenos en nuestras redes sociales </h4>
        <ul>
                        <li>  <i class="fab fa-facebook"></i></li>
                        <li> <i class="fab fa-twitter" aria-hidden="true"></i>  </li>
                        <li> <i class="fab fa-instagram" aria-hidden="true"></i> </li>
                       
                    
                     </ul>
       

         
      </div>
   </div>
</div>
</div>


<!-- Editar Modal -->
<div class="modal fade" id="waModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#F2F2F2 !important;">
            <h5 class="modal-title" id="exampleModalLongTitle">
               <i class="fas fa-w fa-edit"></i>
               Nueva reserva
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('reserva.store') }}" method="POST">
               @csrf
               <div class="form-group required">
                <label for="" class="control-label">Ingrese su nombre completo: </label>
                <input  type="text" name="cliente" id="cliente"
                   class="form-control" placeholder="Nombre completo"  required  autofocus>
                 <br>
                  <label for="mecanico" class="control-label">Telefono: </label>
                <input  type="text" name="telefono" id="telefono"
                class="form-control"   required  autofocus>
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
                <label for="codigo_material" class="control-label">Fecha de reserva: </label>
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
         
       
               <div class="modal-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">
                     <i class='fas fa-check-circle'></i>
                     Guardar reserva
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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
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
</script>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

</body>
</html>