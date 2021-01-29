<html>
    <head>
        <style>
            .header{background:#eee;color:#444;border-bottom:1px solid #ddd;padding:10px;}
            .client-detail{background:#ddd;padding:10px;}
            .client-detail th{text-align:left;}
            .items{border-spacing:0;}
            .items thead{background:#ddd;}
            .items tbody{background:#eee;}
            .items tfoot{background:#ddd;}
            .items th{padding:10px;}
            .items td{padding:10px;}
            h1 small{display:block;font-size:16px;color:#888;}
            table{width:100%;}
            .text-right{text-align:right;}
        </style>
    </head>
    <body>

    <div class="header">
        <h1>
            Comprobante #{{ $cliente->codigo_orden}}
            <small>
                Emitido el {{ $cliente->fecha_entrega }}
            </small>
        </h1>
    </div>
    <table class="client-detail">
        <tr>
            <th style="width:100px;">
                Cliente
            </th>
            <td>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</td>
        </tr>
     
        <tr>
            <th>Direccion</th>
            <td>{{ $cliente->direccion }}</td>
        </tr>
        <tr>
            <th>Identificacion</th>
            <td>{{ $cliente->dni }}</td>
        </tr>

    </table>
    <table class="taller-detail">
        <tr>
            <th style="width:100px;">
               Registrado por
            </th>
            <td>{{ $cliente->hecho_por }} </td>
        </tr>
          <tr>
            <th style="width:100px;">
               Mecanico encargado
            </th>
            <td>{{ $cliente->mecanico }} </td>
        </tr>
     
        <tr>
            <th>Razon de ingreso</th>
            <td>{{ $cliente->motivo_ingreso }}</td>
        </tr>
        <tr>
            <th>Solucion</th>
            <td>{{ $cliente->trabajo_realizado }}</td>
        </tr>
        
    </table>

    <hr />

    <table class="items">
        <thead>
            <tr>
                <th class="text-left">Producto</th>
                <th class="text-right" style="width:100px;">Cantidad</th>
                <th class="text-right" style="width:100px;">P.U</th>
                <th class="text-right" style="width:100px;">Total</th>
            </tr>
        </thead>
        <tbody>
            {{ $total=0 }}
            {{ $iva=0 }}
            {{ $subtotal=0 }}
        @foreach ($productos as $producto)
                    
            <tr>
                <td>{{ $producto->nombre_producto }}</td>
                <td class="text-right">{{ $producto->cantidad }}</td>
                <td class="text-right">{{ $producto->precio }}</td>
                <td class="text-right">{{ $total = $total + $producto->cantidad * $producto->precio }}</td>
            </tr>

        @endforeach
        </tbody>
        <tfoot>
         <tr>
            <td colspan="3" class="text-right"><b>Mano de obra</b></td>
            <td class="text-right">{{ $cliente->mano_obra }}</td>
        </tr>

        <tr>
            <td colspan="3" class="text-right"><b>Sub Total</b></td>
            <td class="text-right">{{ $subtotal=$total+$cliente->mano_obra }}</td>
        </tr>

        <tr>
            <td colspan="3" class="text-right"><b>IVA</b></td>
            <td class="text-right">{{ $iva=($total+$cliente->mano_obra)*0.13 }}</td>
        </tr>
      
       
        <tr>
            <td colspan="3" class="text-right"><b>Total</b></td>
            <td class="text-right">{{ $subtotal+$iva}}</td>
        </tr>
        </tfoot>
    </table>
    </body>
</html>