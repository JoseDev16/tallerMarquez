<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\OrdenReparacion;
use App\Models\Producto;
use App\Models\Material;
use DB;
use PDF;

class OrdenReparacionController extends Controller
{
    //
    public function index ()
    {
        $ordenes = OrdenReparacion::with('vehiculo')->get();
        //dd($ordenes);
        return view('orden.index', compact("ordenes"));

    }

    public function create ($id)
    {
      $vehiculo = Vehiculo::find($id);
    //  return view
        return view('orden.create', compact("vehiculo"));

    }

    public function store(Request $request)
    {
        $cantidadordenreparacions = (OrdenReparacion::all()->count())+1;
       $codigoPedido ="PP00".$cantidadordenreparacions;
      $orden = new OrdenReparacion;



            $orden->codigo_orden = $codigoPedido;
            $orden->motivo_ingreso = $request->motivo_ingreso;
            $orden->trabajo_realizado = $request->trabajo;
            $orden->fecha_entrega = $request->fecha_entrega;
            $orden->mano_obra = $request->mano_obra;
            $orden->vehiculo_id = $request->vehiculo_id;
            $orden->estado = $request->estado;
            $orden->nota = $request->nota;
            $orden->mecanico = $request->mecanico;
            $orden->hecho_por = $request->hecho_por;
            //codigo para imagen publicitaria
            if($request->hasFile('ruta2'));
            {
                $file = $request->file('ruta2');
                $nombre_archivo = $file->getClientOriginalName();
                $file->move(public_path("img"),$nombre_archivo);
                $orden->imagen1 = $nombre_archivo;

            }



                if($request->hasFile('ruta'))
                {
                    $file = $request->file('ruta');
                    $nombre_archivo = $file->getClientOriginalName();
                    $file->move(public_path("img"),$nombre_archivo);
                    $orden->imagen2 = $nombre_archivo;


                }

                $orden->save();




        return back()->with('exito','La orden ha sido agregada exitosamente');
    }
    //Recibe le ID de la orden de produccion y devuelve los productos y cantidades de la orden.
     public function asignarProducto($id)
     {
             $orden= OrdenReparacion::find($id);


         $productos = DB::table('orden_productos')
         ->select('orden_productos.*','productos.nombre_producto','productos.precio','productos.codigo_producto','ordenreparacions.codigo_orden','ordenreparacions.fecha_entrega')
         ->join('ordenreparacions', 'ordenreparacions.id', '=', 'orden_productos.orden_id')
         ->join('productos', 'productos.id', '=', 'orden_productos.producto_id')
         ->where('orden_productos.orden_id', $id)->get();

         return view('orden.asignarProducto', compact('productos', 'orden'));


     }

     //Recibe cambio del onchange para buscador de productos por codigo y nombre
     public function search(Request $request)
     {
         $posts = Producto::select(DB::raw("CONCAT(productos.codigo_producto,'-',productos.nombre_producto) as producto"))
                             ->where('codigo_producto', 'LIKE', '%'.$request->search.'%')
                             ->orWhere('nombre_producto', 'LIKE', '%'.$request->search.'%')
 
                             ->get();
 
         return \response()->json($posts);
     }

     //Envia la informacion del producto que se ha solicitado
    public function cargarRegistros(Request $request,$id)
    {
        if($request->ajax()){
            $producto = Producto::where('codigo_producto',$id)->get();
            return response()->json($producto);
        }
    }

    //Agrega/edita un producto a una orden de produccion
    public function addProducto(Request $request)
    {
    //  Para crear
        if(!($request->edit))
        {
            if($request->prioridad)
            {  if($request->cant2 >= $request->cantidad_producto)
                    {
                        DB::table('orden_productos')->insert([
                            'orden_id' => $request->id_orden,
                            'producto_id' => $request->id_producto,
                            'prioridad' => 1,
                            'cantidad' => $request->cantidad_producto,
                            

                        ]);
                        $nuevoStock = $request->cant2 - $request->cantidad_producto;
                
                        $producto = Producto::find($request->id_producto);
                        $producto->cantidad_producto = $nuevoStock;
                        $producto->update();
                        return back()->with('exito', 'Producto editado de la orden con exito');
                    }else
                    {
                        return back()->with('exito', 'Stock insuficiente');

                    }

           }else
           {    
                if($request->cant2 >= $request->cantidad_producto)
                {
                    DB::table('orden_productos')->insert([
                        'orden_id' => $request->id_orden,
                        'producto_id' => $request->id_producto,
                        'prioridad' => 0,
                        'cantidad' => $request->cantidad_producto,
                      
     
                    ]);
                    $nuevoStock = $request->cant2 - $request->cantidad_producto;
     
                    $producto = Producto::find($request->id_producto);
                    $producto->cantidad_producto = $nuevoStock;
                    $producto->update();
                    return back()->with('exito', 'Producto agregado a la exito');

                }else{
                    return back()->with('exito', 'Stock insuficiente');

                }
              
               
               
               

           }
            //Para editar
         }else
          {
            $producto=Producto::find($request->id_producto);
            $cantidadAnterior = DB::table('orden_productos')
            
            ->where('orden_id', $request->id_orden)
            ->where('producto_id', $request->id_producto)
            ->pluck('cantidad')->first();
            
           if ($request->prioridad) 
           {
             

               if ($request->cant2 >= $request->cantidad_producto) {
                   if ($cantidadAnterior > $request->cantidad_producto) {
                       $descuento =  $cantidadAnterior -  $request->cantidad_producto;
                       $cantidadActual = $producto->cantidad_producto;
                       $producto->cantidad_producto = $cantidadActual + $descuento;
                       $producto->update();
                   } else {
                       $descuento =  $request->cantidad_producto - $cantidadAnterior;
                       $cantidadActual = $producto->cantidad_producto;
                       $producto->cantidad_producto = $cantidadActual - $descuento;
                       $producto->update();
                   }
                   DB::table('orden_productos')
                    ->where('orden_id', $request->id_orden)
                    ->where('producto_id', $request->id_producto)
                    ->update(['prioridad' => 1, 'cantidad' =>$request->cantidad_producto]);
                   return back()->with('exito', 'Producto editado de orden con exito');
               } else {
                   return back()->with('exito', 'Stock insuficiente');
               }
           }else
            if ($request->cant2 >= $request->cantidad_producto) {
                if ($cantidadAnterior > $request->cantidad_producto) {
                    $descuento =  $cantidadAnterior -  $request->cantidad_producto;
                    $cantidadActual = $producto->cantidad_producto;
                    $producto->cantidad_producto = $cantidadActual + $descuento;
                    $producto->update();
                } else {
                    $descuento =  $request->cantidad_producto - $cantidadAnterior;
                    $cantidadActual = $producto->cantidad_producto;
                    $producto->cantidad_producto = $cantidadActual - $descuento;
                    $producto->update();
                }
                DB::table('orden_productos')
                    ->where('orden_id',$request->id_orden)
                    ->where('producto_id',$request->id_producto)
                    ->update(['prioridad' => 0, 'cantidad' =>$request->cantidad_producto]);
                    return back()->with('exito', 'Producto editado de orden con exito');
                } else {
                    return back()->with('exito', 'Stock insuficiente');
                }


        }

    }
    //Envia la informacion de un producto especifico de una orden de produccion para editarlo
    public function editLoad(Request $request,$id)
    {
      $producto = DB::table('orden_productos')
          ->select('orden_productos.*','productos.nombre_producto','productos.unidad_medida','productos.precio',
          'productos.codigo_producto','productos.cantidad_producto','ordenreparacions.codigo_orden','ordenreparacions.fecha_entrega')
          ->join('ordenreparacions', 'ordenreparacions.id', '=', 'orden_productos.orden_id')
          ->join('productos', 'productos.id', '=', 'orden_productos.producto_id')
          ->where('orden_productos.id',$id)->get();

      return response()->json($producto);
    }

    //Destruye un producto asociado a una oorden de reparacion
    public function destroyProducto(Request $request)
    {

        DB::table('orden_productos')
        ->where('id',$request->delete_id)
        ->delete();
        return back()->with('exito','Producto retirado de la orden');
    }

    //Crea el reporte de Pedido de produccion
    public function reporteOrden(Request $request)
    {
                //Obteniendo Informacion cliente
        $cliente= DB::table('ordenreparacions')
                ->select('ordenreparacions.codigo_orden','ordenreparacions.mecanico','ordenreparacions.fecha_entrega',
                          'clientes.nombre_cliente','clientes.apellido_cliente',
                          'clientes.direccion','clientes.dni','ordenreparacions.mano_obra' ,
                          'ordenreparacions.hecho_por','ordenreparacions.motivo_ingreso','ordenreparacions.trabajo_realizado')
                ->join('vehiculos','vehiculos.id','=','ordenreparacions.vehiculo_id')
                ->join('clientes','clientes.id','=','vehiculos.cliente_id')
                ->where('ordenreparacions.id',$request->orden_id)
                ->first();
            $productos = DB::table('orden_productos')
                ->select('orden_productos.*','productos.nombre_producto','productos.precio','productos.codigo_producto','ordenreparacions.codigo_orden','ordenreparacions.fecha_entrega')
                ->join('ordenreparacions', 'ordenreparacions.id', '=', 'orden_productos.orden_id')
                ->join('productos', 'productos.id', '=', 'orden_productos.producto_id')
                ->where('orden_productos.orden_id', $request->orden_id)->get();
               // dd($productos);
            //dd($productos);

        //Obteniendo informacion orden reparacion
                
     

            $pdf = \PDF::loadView('orden.factura',compact("cliente","productos"));
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
            $canvas = $dom_pdf ->get_canvas();
            $w = $canvas->get_width();
            $h = $canvas->get_height();
            $canvas->page_text(140, 20, date('d-m-Y'), null, 9, array(0, 0, 0));
            $canvas->page_text(190, 20, "| Sistema de Facturacion  | SF", null, 9, array(0, 0, 0));
            $canvas->page_text($w-55,$h-28, "{PAGE_NUM} / {PAGE_COUNT}", null, 9, array(0, 0, 0));
            $canvas->page_text($w-560,$h-28,"Factura Por reparacion", null, 9, array(0, 0, 0));
          return $pdf->stream('Factura_Reparacion.pdf');

  }

  public function reporteHerramientas(Request $request)
  {
              //Obteniendo Informacion cliente
      $cliente= DB::table('ordenreparacions')
              ->select('ordenreparacions.codigo_orden','ordenreparacions.mecanico','ordenreparacions.fecha_entrega',
                        'clientes.nombre_cliente','clientes.apellido_cliente',
                        'clientes.direccion','clientes.dni','ordenreparacions.mano_obra' ,
                        'ordenreparacions.hecho_por','ordenreparacions.motivo_ingreso','ordenreparacions.trabajo_realizado')
              ->join('vehiculos','vehiculos.id','=','ordenreparacions.vehiculo_id')
              ->join('clientes','clientes.id','=','vehiculos.cliente_id')
              ->where('ordenreparacions.id',$request->orden_id)
              ->first();
          $productos = DB::table('orden_materials')
              ->select('orden_materials.*','materials.nombre_material','ordenreparacions.codigo_orden','ordenreparacions.fecha_entrega')
              ->join('ordenreparacions', 'ordenreparacions.id', '=', 'orden_materials.orden_id')
              ->join('materials', 'materials.id', '=', 'orden_materials.material_id')
              ->where('orden_materials.orden_id', $request->orden_id)->get();
        //    $prueba = DB::table('orden_materials')->where('orden_id',$request->orden_id)->get();
        //  dd($productos);

      //Obteniendo informacion orden reparacion
              
   

          $pdf = \PDF::loadView('orden.reporteHerramientas',compact("cliente","productos"));
          $pdf->output();
          $dom_pdf = $pdf->getDomPDF();
          $canvas = $dom_pdf ->get_canvas();
          $w = $canvas->get_width();
          $h = $canvas->get_height();
          $canvas->page_text(140, 20, date('d-m-Y'), null, 9, array(0, 0, 0));
          $canvas->page_text(190, 20, "| Auditoria de herramientas  | SF", null, 9, array(0, 0, 0));
          $canvas->page_text($w-55,$h-28, "{PAGE_NUM} / {PAGE_COUNT}", null, 9, array(0, 0, 0));
          $canvas->page_text($w-560,$h-28,"Control de herramientas", null, 9, array(0, 0, 0));
        return $pdf->stream('Reporte_Herramientas.pdf');

}
  public function asignarMaterial($id)
  {
          $orden= OrdenReparacion::find($id);


          $materiales = DB::table('orden_materials')
          ->select('orden_materials.*','materials.nombre_material','materials.unidad_medida','materials.codigo_material','ordenreparacions.codigo_orden','ordenreparacions.fecha_entrega')
          ->join('ordenreparacions', 'ordenreparacions.id', '=', 'orden_materials.orden_id')
          ->join('materials', 'materials.id', '=', 'orden_materials.material_id')
          ->where('orden_materials.orden_id', $id)->get();

      return view('orden.asignarMaterial', compact('materiales', 'orden'));


  }
  public function searchMaterial(Request $request)
  {
      $posts = Material::select(DB::raw("CONCAT(materials.codigo_material,'-',materials.nombre_material) as material"))
                          ->where('codigo_material', 'LIKE', '%'.$request->search.'%')
                          ->orWhere('nombre_material', 'LIKE', '%'.$request->search.'%')

                          ->get();

      return \response()->json($posts);
  }
  public function cargarRegistrosMaterial(Request $request,$id)
  {
      if($request->ajax()){
          $material = Material::where('codigo_material',$id)->get();
          return response()->json($material);
      }
  }

   //Agrega/edita un producto a una orden de produccion
        public function addMaterial(Request $request)
        {
        //  Para crear
            if(!($request->edit))
            {
              
                //dd($request);
                    DB::table('orden_materials')->insert([
                        'orden_id' => $request->id_orden,
                        'material_id' => $request->id_material,
                        
                        'cantidad' => $request->cantidad_material,
                        

                    ]);
                    return back()->with('exito', 'Material agregado de la orden con exito');

                //Para editar
                }else
                {
           
                    DB::table('orden_materials')
                    ->where('orden_id',$request->id_orden)
                    ->where('material_id',$request->id_material)
                    ->update(['cantidad' =>$request->cantidad_material]);
                    return back()->with('exito', 'Material editado de orden con exito');

              }

        }

        public function editLoadMaterial(Request $request,$id)
        {
          $material = DB::table('orden_materials')
              ->select('orden_materials.*','materials.nombre_material','materials.unidad_medida',
              'materials.codigo_material','ordenreparacions.codigo_orden','ordenreparacions.fecha_entrega')
              ->join('ordenreparacions', 'ordenreparacions.id', '=', 'orden_materials.orden_id')
              ->join('materials', 'materials.id', '=', 'orden_materials.material_id')
              ->where('orden_materials.id',$id)->get();
    
          return response()->json($material);
        }

        public function destroyMaterial(Request $request)
    {

        DB::table('orden_materials')
        ->where('id',$request->delete_id)
        ->delete();
        return back()->with('exito','Herramienta retirado de la orden');
    }

    public function edit_view($id)
    {
        $orden = OrdenReparacion::find($id);

        return response()->json($orden);


    }

    public function edit(Request $request)
    {
        //dd($request);
        $orden = OrdenReparacion::find($request->edit_id);
        
        $orden->motivo_ingreso = $request->motivo_ingreso;
        $orden->trabajo_realizado = $request->trabajo_realizado;
        $orden->nota = $request->nota;
        $orden->fecha_entrega = $request->fecha_entrega;
        $orden->mano_obra = $request->mano_obra;
        $orden->mecanico = $request->mecanico;
        $orden->estado = $request->estado;
        $orden->update();
        return back()->with('exito','Orden editada con exito');
    }

}
