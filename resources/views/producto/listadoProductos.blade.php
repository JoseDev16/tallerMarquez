@extends('basePdf')
@section('titulo_reporte')
REPORTE DE PRODUCTOS Y PROVEEDORES
@endsection
@section('content')
<table class=" table">
   <thead class="thead-dark">
      <tr>
         <th scope="col">#</th>
         <th scope="col">Codigo</th>
         <th scope="col">Producto</th>
         <th scope="col">Proveedor</th>
         <th scope="col">Precio Compra</th>
         <th scope="col">Precio Venta</th>
         <th scope="col">Stock</th>
         
      </tr>
   </thead>
   <tbody>
      <?php $i = 0 ?>
      @foreach ($productos as $producto)

      <?php $i++ ?>
      <tr>
         <td>{{$i}}</td>
         <td>{{$producto->codigo_producto}}</td>
         <td>{{$producto->nombre_producto}}</td>
         <td>{{$producto->proveedor}}</td>
         <td>{{$producto->precio_compra}}</td>
         <td>{{$producto->precio}}</td>
         <td>{{$producto->cantidad_producto}}</td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection