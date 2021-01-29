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
            Comprobante de herramientas Orden #{{ $cliente->codigo_orden}}
            <small>
                Entregadas el: {{ $cliente->fecha_entrega }}
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
  
        
    </table>

    <hr />

    <table class="items">
        <thead>
            <tr>
                <th class="text-left">Herramienta</th>
                <th class="text-right" style="width:100px;">Cantidad</th>
              
            </tr>
        </thead>
        <tbody>
            {{ $total=0 }}
            {{ $iva=0 }}
            {{ $subtotal=0 }}
        @foreach ($productos as $producto)
                    
            <tr>
                <td>{{ $producto->nombre_material }}</td>
                <td class="text-right">{{ $producto->cantidad }}</td>
               
            </tr>

        @endforeach
    
    </table>
    </body>
</html>