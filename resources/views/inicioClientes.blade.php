@extends('baseCliente')
@section('content')
<div class="row">



    <article class="col-md-12">
 
       <!--carrusel-->
       <header  class="text-center pt-1 pb-4">
         <img src="{{ asset('/img/inicio.png') }}" alt="" class="img-fluid">
     </header>
       <section >
          <!--Carousel Wrapper-->
          <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
             <!--Indicators-->
             <ol class="carousel-indicators">
                <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-2" data-slide-to="1"></li>
                <li data-target="#carousel-example-2" data-slide-to="2"></li>
             </ol>
             <!--/.Indicators-->
             <!--Slides-->
             <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                   <div class="view">
                      <img class="d-block w-100"
                       src="{{ asset('img').'/'.$imagen->imagen1g }}"
                         alt="First slide">
                      <div class="mask rgba-black-light"></div>
                   </div>
                   <div class="carousel-caption">
                      
                   </div>
                </div>
                <div class="carousel-item">
                   <!--Mask color-->
                   <div class="view">
                      <img class="d-block w-100" 
                      src="{{ asset('img').'/'.$imagen->imagen2g }}"
                         alt="Second slide">
                      <div class="mask rgba-black-strong"></div>
                   </div>
                   <div class="carousel-caption">
                     
                   </div>
                </div>

             <!--/.Slides-->
             <!--Controls-->
             <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
             <span class="sr-only">Previous</span>
             </a>
             <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
             <span class="carousel-control-next-icon" aria-hidden="true"></span>
             <span class="sr-only">Next</span>
             </a>
             <!--/.Controls-->
          </div>
          <!--/.Carousel Wrapper-->
       </section>
 
 
       <!---------------------------------------------mas populares------------------------------------>
       <section>
         <h2 class="text-center text-dark font-weight-bolder pt-4 pb-3">Nuestras mejores promociones</h2>
         <!--Carousel Wrapper-->
 <div id="multi-item-example" class="carousel slide carousel-multi-item text-center" data-ride="carousel">
 
   <!--Controls-->
   <div class="controls-top">
     <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
     <a class="btn-floating" href="#multi-item-example" data-slide="next"><i
         class="fas fa-chevron-right"></i></a>
   </div>
   <!--/.Controls-->
 
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
           src="{{ asset('img').'/'.$imagen->imagen1c }}">
           <div class="card-body">
             <h4 class="card-title"></h4>
             
             <button data-target="#waModal" data-toggle="modal"  class="btn btn-dark text-white">Obtener promocion </button>
           </div>
         </div>
       </div>
 
       <div class="col-md-4" style="float:left">
         <div class="card mb-2">
           <img class="card-img-top"
            src="{{ asset('img').'/'.$imagen->imagen2c }}">       
                 <div class="card-body">
             <a  data-target="#waModal" data-toggle="modal"  class="btn btn-dark text-white">Obtener promocion</a>
           </div>
         </div>
       </div>
 
       <div class="col-md-4" style="float:left">
         <div class="card mb-2">
           <img class="card-img-top"
              src="{{ asset('img').'/'.$imagen->imagen3c }}"> 
           <div class="card-body">
            <button data-target="#waModal" data-toggle="modal"  class="btn btn-dark text-white">Obten la promocion</button>
           </div>
         </div>
       </div>
 
 
 
     </div>
     <!--/.First slide-->
 
     <!--Second slide-->
     <div class="carousel-item">
 
       <div class="col-md-4" style="float:left">
         <div class="card mb-2">
           <img class="card-img-top"
            src="{{ asset('img').'/'.$imagen->imagen4c }}">
           <div class="card-body">
            <button data-target="#waModal" data-toggle="modal" class="btn btn-dark text-white">Obtener Promocion</button>
           </div>
         </div>
       </div>
 
       <div class="col-md-4" style="float:left">
         <div class="card mb-2">
           <img class="card-img-top"
           src="{{ asset('img').'/'.$imagen->imagen5c }}">
           <div class="card-body">
            <button data-target="#waModal" data-toggle="modal"  class="btn btn-dark text-white">Obtener promocion</button>
           </div>
         </div>
       </div>
 
       <div class="col-md-4" style="float:left">
         <div class="card mb-2">
           <img class="card-img-top"
             src="{{ asset('img').'/'.$imagen->imagen6c }}">
           <div class="card-body">
            <button data-target="#waModal" data-toggle="modal"   class="btn btn-dark text-white">Obtener promocion</button>
           </div>
         </div>
       </div>
 
 
 
     </div>
     <!--/.Second slide-->
 
 
 
   </div>
   <!--/.Slides-->
 
 </div>
 <!--/.Carousel Wrapper-->
 
       </section>
      
  </div>
  <!-- Wasap Modal -->
<div class="modal fade" id="waModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle2" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#F2F2F2 !important;">
            <h5 class="modal-title" id="exampleModalLongTitle">
               <i class="fab fa-whatsapp"></i>
               Obtener promocion
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
         
            <div class="form-group required">
             <label for="" class="control-label">Promocion en la que estas interesado: </label>
             <input  type="text" name="promo" id="promo"
                class="form-control" placeholder="Ej:Quiero la promocion de lubricantes"  required  autofocus>
              <br>
              <label for="" class="control-label">Cantidad de promociones </label>
              <input  type="number" name="cant" id="cant"
                 class="form-control"   required  min="0" autofocus>
               <br>
            
           
       
         <div class="modal-footer d-flex justify-content-center">
              <button class="form-control btn btn-success " onclick="ShowSelected()"><i class="fab fa-whatsapp "></i> Realiza tu encargo!</i></button>
           
              
               <a href="" class="btn btn-primary" data-dismiss="modal">
                  <i class='fa fa-times'></i>
                  Cancelar
               </a>
            </div>
        
         </div>
      </div>
  </div>
</div>




<!-- Fin Editar Modal-->
<script type="text/javascript">
  function ShowSelected()
  {

          
      var promo = document.getElementById("promo").value;
      var cant = document.getElementById("cant").value;
      console.log(promo);
    
    
      var url = "https://api.whatsapp.com/send?phone=50374847182&text=Quisiera%20hacer%20un%20encargo%20de%20"+cant+"%20promociones%20de%20"+promo;
      window.open(url,'_blank');
                                  
  
  }
</script>

<script type="text/javascript">
  function ShowSelected2()
  {

          
     
      
      var promo = document.getElementById("razon").value;
      var cant = document.getElementById("fecha").value;
      console.log(promo);
    
    
      var url = "https://api.whatsapp.com/send?phone=50374847182&text=Quisiera%20hacer%20una%20cita%20el%20"+cant+"%20con%20motivo%20%20de%20"+promo;
      window.open(url,'_blank');
                                  
  
  }
</script>
    
@endsection