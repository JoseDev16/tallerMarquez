@extends('baseCliente')
@section('titulo')
Servicios
@endsection
@section('content')
 <div class="row">
    <div class="col-md-12">
        
<!--Carousel Wrapper-->
<div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">

 

  <!--Indicators-->
  <ol class="carousel-indicators">
    <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
    <li data-target="#multi-item-example" data-slide-to="1"></li>
    
  </ol>
  <!--/.Indicators-->

  <!--Slides-->
  <div class="carousel-inner" role="listbox">

    <!--First slide-->
    <div class="carousel-item active">

      <div class="col-md-4" style="float:left">
       <div class="card mb-2">
          <img class="card-img-top"
            src="https://img.motoryracing.com/noticias/portada/25000/25615-n.jpg" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">Mecanica Automotriz</h4>
            <p class="card-text">
            El correcto funcionamiento de tu automóvil es nuestro compromiso. Contamos con una amplia diversidad de servicios en mecánica express, general y mayor que van desde alineación de ruedas hasta reparaciones de motor.
            </p>
            <a data-target="#waModal2" data-toggle="modal" class="btn btn-primary">Reserva tu cita</a>
          </div>
        </div>
      </div>

      <div class="col-md-4" style="float:left">
        <div class="card mb-2">
          <img class="card-img-top"
            src="https://herramientas.tv/wp-content/uploads/2019/11/Taller-de-electricidad-automotriz.jpg" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">Electricidad Automotriz</h4>
            <p class="card-text">
            Es de vital importancia que el sistema eléctrico de tu automóvil esté siempre en óptimas condiciones, por eso, en Taller Ramirez nos ocupamos de diagnosticar fallos y hacer remplazo de piezas necesarias para asegurar el buen funcionamiento del mismo
              .</p>
            <button data-target="#waModal2" data-toggle="modal" class="btn btn-primary">Reserva tu cita</button>
          </div>
        </div>
      </div>

      <div class="col-md-4" style="float:left">
        <div class="card mb-2">
          <img class="card-img-top"
            src="https://www.pruebaderuta.com/wp-content/uploads/2015/04/escaner-automovil-500x264.jpg" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">Escaner</h4>
            <p class="card-text">
            Si tu auto presenta una luz encendida en el tablero, podemos hacer un diagnóstico exacto de las fallas con el escáner, una herramienta que nos sirve para realizar una lectura del historial de errores de tu vehículo que nos permite realizar una correcta reparación

              </p>
            <a data-target="#waModal2" data-toggle="modal" class="btn btn-primary">Reserva tu cita</a>
          </div>
        </div>
      </div>
      
 

    </div>
    <!--/.First slide-->


   

  </div>
  <!--/.Slides-->

</div>
<!--/.Carousel Wrapper-->


    </div>
     
 </div>

@endsection