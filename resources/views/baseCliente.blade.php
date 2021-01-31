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
  <a class="navbar-brand" href="">Taller Ramirez</a>
  <button data-target="#waModal2" data-toggle="modal" class="btn btn-dark text-white">Agendar cita</button>
 
</nav>
  


<div class="container-fluid">
    <header class="h1 text-center pt-5">
        Bienvenidos a Taller Ramirez

    </header>

    @yield('content')

 
</div>

<!-- Editar Modal -->

  <!-- Wasap Modal -->
<div class="modal fade" id="waModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
      <div class="modal-header" style="background-color:#F2F2F2 !important;">
         <h5 class="modal-title" id="exampleModalLongTitle">
            <i class="fab fa-whatsapp"></i>
            Agendar cita
         </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         
            <div class="form-group required">
             <label for="" class="control-label">Seleccione fecha y hora: </label>
             <input  type="datetime-local" name="fecha" id="fecha"
                class="form-control" required  autofocus>
              <br>
              <label for="" class="control-label">Razon </label>
              <input  type="text" name="razon" id="razon"
                 class="form-control"   required autofocus>
               <br>
            
           
       
            <div class="modal-footer d-flex justify-content-center">
              <button class="form-control btn btn-success " onclick="ShowSelected2()"><i class="fab fa-whatsapp "></i> Agendar cita</i></button>

              
              
               <a href="" class="btn btn-primary" data-dismiss="modal">
                  <i class='fa fa-times'></i>
                  Cancelar
               </a>
            </div>
        
      </div>
   </div>
</div>
</div>


</body>
</html>