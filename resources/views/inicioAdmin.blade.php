@extends('base')
@section('titulo')
Home
@endsection

@section('content')
@if (auth()->check())
<div class="col-md-12">
  <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
      @auth
      <a href="{{ url('/home') }}"></a>
      @else
      <a href="{{ route('login') }}">Login</a>

      @if (Route::has('register'))
      <a href="{{ route('register') }}">Register</a>
      @endif
      @endauth
    </div>
    @endif
    <div class="title m-b-md text-center">
      <h3 class="text-center text-primary"><b>Bienvenido a SATR</b></h3>
      <h5>
        Platafoma para la Administración General del Taller Ramirez
      </h5>
      <br>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="">
          <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text font-weight-bold text-primary text-uppercase mb-1 text-center">Módulo Seguridad
                  </div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800 text-center">
                    Gestionar el control de los permisos de usuarios, la gestión de los mismos y todo lo relacionado
                    al acceso del sistema.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-shield-alt fa-3x  text-gray-200"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="">
          <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text font-weight-bold text-primary text-uppercase mb-1 text-center">Módulo Clientes
                  </div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800 text-center">
                    Gestionar la informacion de todos los clientes que visitan el taller.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-box fa-3x  text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
      </div>
      <div class="col-md-4">
        <div class="">
          <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text font-weight-bold text-primary text-uppercase mb-1 text-center">Productos
                  </div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800 text-center">
                    Registro de los productos con los que contamos en nuestro taller.
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-hand-holding-medical fa-3x  text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="">
          <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text font-weight-bold text-primary text-uppercase mb-1 text-center">Módulo Orden Reparacion
                  </div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800 text-center">
                    Gestionar las ordenes de reparacion creadas en el sistema para un mejor flujo de trabajo
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar-check fa-3x  text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
      </div>
      <div class="col-md-4">
        <div class="">
          <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text font-weight-bold text-primary text-uppercase mb-1 text-center">
                    Modulo Facturacion
                  </div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800 text-center">
                    Genera una factura a partir de la orden de reparacion asignada a un vehiculo incluyendo todos sus gastos e impuesos
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-chart-area fa-3x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="">
          <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text font-weight-bold text-primary text-uppercase mb-1 text-center">Cátologo
                  </div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800 text-center">
                    Gestionar los catalogos para funcionamiento del sistema
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-columns fa-3x  text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
@else
<!-- Pantalla que se mostrará antes del inicio  -->
<div class="col-md-12">
  <h3 class="text-center"><b>SISTEMA DE CONTROL DE ACTIVOS FIJOS DE LA EISI-FIA-UES</b></h3>
  <br><br>
  <div class="row">
    <div class="col-md-4">
      <br><br><br><br>
      <div class="">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-primary text-uppercase mb-1 text-center">Seguridad</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">Nuestro sistema cuenta con protección
                  de datos de tus activos en cualquier lugar.</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-shield-alt fa-3x  text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="text-center">
        <img src="{{ asset('img/LOGO.jpeg') }}" alt="" width="300px">
      </div>
    </div>
    <div class="col-md-4">
      <br><br><br><br>
      <div class="">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-lg font-weight-bold text-primary text-uppercase mb-1 text-center">Rapidez</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">Rendimiento óptimo ante la carga de
                  los datos de ordenes de reparacion, sentiras que vuelas.</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-tachometer-alt fa-3x  text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
</div>
@endif
@endsection