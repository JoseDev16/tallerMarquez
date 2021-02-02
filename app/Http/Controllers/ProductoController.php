<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Actividad;
use App\Models\Material;


class ProductoController extends Controller
{
    //
    public function index(Request $request)
    {
        //$posts = Material::where('codigo_material', 'LIKE', '%'.$prueba.'%')->pluck('codigo_material');
        $productos = Producto::where('nombre_producto', 'LIKE', '%'.$request->buscar.'%')
                    ->orWhere('codigo_producto', 'LIKE', '%'.$request->buscar.'%')
                    ->paginate(10);
       // $productos = Producto::orderBy('id','desc')->paginate(10);
        $categorias = Categoria::all();

        return \view('producto.index',compact('productos','categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo_producto' => 'required|unique:productos,codigo_producto|max:10',

        ]);
        //dd($request);
        $producto = new Producto;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->unidad_medida = $request->unidad_id;
        $producto->categoria_id = $request->categoria_id;
        $producto->precio = $request->precio;
        $producto->precio_compra = $request->precio_compra;
        $producto->proveedor = $request->proveedor;
        $producto->cantidad_producto = $request->cantidad_producto;

        $producto->codigo_producto = $request->codigo_producto;
        $producto->save();
            return back()->with('exito', 'Producto agregado con exito');


        


    }

    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $producto = Producto::find($id);
            return response()->json($producto);
        }
    }

    public function edit(Request $request)
    {

        $id = $request->edit_id;
       $producto = Producto::find($id);

        if (empty($id)) {
            return back();
        }

        $producto->nombre_producto = $request->nomb_producto;
        $producto->categoria_id = $request->cat_id;
        $producto->cantidad_producto = $request->cantidad_productoE;
        $producto->save();
        $logs = new Actividad();
        $logs->log($request->user,'edito el producto '.$request->nomb_producto);

        return back()->with('exito','El producto ha sido actualizada exitosamente');
    }

    public function addMaterial(Request $request)
    {
        //dd($request);
       if(!$request->edit)
     {
        if($request->activo)
        {
            DB::table('material_producto')->insert([
                'material_id' => $request->id_material,
                'producto_id' => $request->id_producto,
                'activo' => 1,
                'cantidad' => $request->cantidad_material

            ]);
            return back()->with('exito', 'Material agregado con exito');

        }else
        {
            DB::table('material_producto')->insert([
                'material_id' => $request->id_material,
                'producto_id' => $request->id_producto,
                'activo' => 0,
                'cantidad' => $request->cantidad_material

            ]);
            return back()->with('exito', 'Material agregado con exito');

        }

      }else
       {
        if($request->activo)
        {
            DB::table('material_producto')
            ->where('material_id',$request->id_material)
            ->where('producto_id',$request->id_producto)
            ->update(['activo' => 1, 'cantidad' =>$request->cantidad_material]);
            return back()->with('exito', 'Material agregado con exito');

        }else
        {
            DB::table('material_producto')
            ->where('material_id',$request->id_material)
            ->where('producto_id',$request->id_producto)
            ->update(['activo' => 0, 'cantidad' =>$request->cantidad_material]);
            return back()->with('exito', 'Material agregado con exito');

        }


       }



    }
//
    public function editRegistros($id)
    {
        $materiales = DB::table('material_producto')
        ->select('material_producto.*','materials.nombre_material','materials.unidad_medida','materials.codigo_material','materials.id as idMaterial')
        ->join('materials', 'materials.id', '=', 'material_producto.material_id')
        ->join('productos', 'productos.id', '=', 'material_producto.producto_id')
        ->where('material_producto.id','=',$id)->get();
        return response()->json($materiales);

    }


 //RECIBE ID DEL PRODUCTO
    public function setMaterial(Request $request,$id)
    {
        $prueba="00";
        $posts = Material::where('codigo_material', 'LIKE', '%'.$prueba.'%')->pluck('codigo_material');
        $p2=Material::where('codigo_material','RT001')->pluck('codigo_material');


        $producto= Producto::find($id);
       // $materiales=  $producto->materiales()->get();

        $materiales = DB::table('material_producto')
        ->select('material_producto.*','materials.nombre_material','materials.unidad_medida','materials.codigo_material','productos.nombre_producto')
        ->join('materials', 'materials.id', '=', 'material_producto.material_id')
        ->join('productos', 'productos.id', '=', 'material_producto.producto_id')
        ->where('material_producto.producto_id', $id)->get();

      // dd($materiales);

       //dd($materiales);

        return view('producto.addMaterial', compact('producto', 'materiales'));


    }
    //destroye producto asociado a un material
    public function destroyMaterial(Request $request)
    {

        DB::table('material_producto')
        ->where('id',$request->delete_id)
        ->delete();
        return back()->with('exito','La categoria ha sido eliminada exitosamente');
    }

    public function destroy(Request $request)
    {
        $producto = Producto::find($request->delete_id);
        //$conteo =0;
        $conteo = DB::table('orden_productos')
        ->join('productos','productos.id','=','orden_productos.producto_id')
        
        ->select(DB::raw('COUNT(orden_productos.id) as cantProductos'))
        ->where('producto_id',$request->delete_id)
        ->groupBy('productos.nombre_producto')
        
        ->get()
        ->toArray();
        
        $conteoNumero =array_values($conteo);
     //  dd(((int)$conteo));
        $conteoN = (int)($conteo);
        if($conteoN>0)
        {
          return back()->with('exito', 'NO se puede eliminar el producto ya que esta incluido en una factura');
        }else{
            $producto->delete();
            return back()->with('exito', 'El producto ha sido eliminado exitosamente');
        }
       /* $producto = Producto::find($request->delete_id);
        //dd($categoria);
        $logs = new Actividad();
        $logs->log($request->user,'elimino el material '.$producto->nombre_producto);

        $producto->delete();

        return back()->with('exito','EL producto ha sido eliminada exitosamente');*/
    }

      //Crea el reporte de Pedido de produccion
      public function reporteProductos(Request $request)
      {
        $productos = Producto::orderBy('id','desc')->get();
       
  
              $pdf = \PDF::loadView('producto.listadoProductos',compact("productos"));
              $pdf->output();
              $dom_pdf = $pdf->getDomPDF();
              $canvas = $dom_pdf ->get_canvas();
              $w = $canvas->get_width();
              $h = $canvas->get_height();
              $canvas->page_text(140, 20, date('d-m-Y'), null, 9, array(0, 0, 0));
              $canvas->page_text(190, 20, "| Sistema de Facturacion  | SF", null, 9, array(0, 0, 0));
              $canvas->page_text($w-55,$h-28, "{PAGE_NUM} / {PAGE_COUNT}", null, 9, array(0, 0, 0));
            return $pdf->stream('Reporte_productos.pdf');
  
    }


}
