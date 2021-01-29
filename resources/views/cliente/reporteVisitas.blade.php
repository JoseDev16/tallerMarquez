@extends('basePdf')
@section('titulo_reporte')
REPORTE DE CLIENTES Y VISITAS
@endsection
@section('content')
<table class=" table">
   <thead class="thead-dark">
      <tr>
         <th scope="col">#</th>
         <th scope="col">Nombre Cliente</th>
         <th scope="col">Direccion</th>
         <th scope="col">Telefono</th>
         <th scope="col">Cantidad de visitas</th>
       
         
      </tr>
   </thead>
   <tbody>
      <?php $i = 0 ?>
      @foreach ($clientes as $cliente)

      <?php $i++ ?>
      <tr>
         <td>{{$i}}</td>
         <td>{{$cliente->nombre_cliente}}</td>
         <td>{{$cliente->direccion}}</td>
         <td>{{$cliente->numero_cliente}}</td>
         <td>{{$cliente->visitas}}</td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection