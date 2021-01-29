@extends('base')
@section('titulo')
materiales
@endsection
@section('content')
<div class="col-md-12">
    <h1 class="text-center"> Orden reparacion </h2>
        @if(session('exito'))
        <div class="alert alert-success">
           <button type="button" class="close" data-dismiss="alert">×</button>
           {{ session('exito') }}
        </div>
        @endif
    <form action="{{ route('orden.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre_camisa"> Motivo ingreso*</label>
            <input class="form-control"  type="text" name="motivo_ingreso" id="motivo_ingreso" required>
        </div>
        <div class="form-group">
            <label for="nombre_camisa">Trabajo a realizar</label>
            <input class="form-control"   name="trabajo" id="trabajo" required>
            <input type="hidden" value="{{$vehiculo->id}}">
        </div>
             <div class="form-group">
            <label for="nombre_camisa"> Mecanico asignado*</label>
            <input class="form-control"  type="text" name="mecanico" id="mecanico" required>
        </div>
        <div class="form-group">
            <label for="descripcion"> Fecha entrega * </label>
            <input class="form-control" type="date" name="fecha_entrega" id="fecha_entrega" required></textarea>
        </div>
        <div class="form-group">
            <label for="precio"> Mano de obra *</label>
            <input class="form-control"  type="number" name="mano_obra" id="mano_obra" min="0" step="0.01" plahceholder="0.0" required>
        </div>
    
        <div class="form-group">
            <label for="nombre_camisa">Nota</label>
            <input class="form-control"   name="nota" id="nota" required>
            <input type="hidden" name="vehiculo_id" value="{{$vehiculo->id}}">
        </div>




        <div class="form-group">
            <label for="disponible"> Estado *</label>
            <select name="estado" id="estado" class="form-control" required>
                <option> Pendiente </option>
                <option> Trabajando </option>
                <option> Trabajo terminado </option>
                <option> Entregado </option>
            </select>

        </div>
        <div class="form-group">
            <label for="ruta2">Imagen 1</label>
            <input class="form-control"  type="file" name="ruta2" id="ruta2">
        </div>
        <div class="form-group">
            <label for="ruta">Imagen 2</label>
            <input class="form-control"  type="file" name="ruta" id="ruta">
        </div>
        <input class="form-control" type="hidden" name="hecho_por"  value="{{auth()->user()->name}}">
        <button class="btn btn-primary" type="submit">Guardar</button>






    </form>

</div>
@endsection
