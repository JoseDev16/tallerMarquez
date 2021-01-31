<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Vehiculo;
use DB;
use App\Models\Actividad;

class ClienteController extends Controller
{
    //
    public function index(Request $request)
    {
        $clientes = Cliente::where('nombre_cliente', 'LIKE', '%'.$request->buscar.'%')
                    ->orWhere('apellido_cliente', 'LIKE', '%'.$request->buscar.'%')
                    ->orWhere('dni', 'LIKE', '%'.$request->buscar.'%')

                    ->paginate(10);
        return view('cliente.index', compact("clientes"));

    }

    public function destroy1(Request $request)
    {

      $cliente = Cliente::find($request->delete_id);
      //$conteo =0;
      $conteo = DB::table('ordenreparacions')
      ->join('vehiculos','vehiculos.id','=','ordenreparacions.vehiculo_id')
      ->join('clientes','clientes.id','=','vehiculos.cliente_id')
      ->select(DB::raw('COUNT(ordenreparacions.id) as visitas'))
      ->where('cliente_id',$request->delete_id)
      ->groupBy('clientes.nombre_cliente','clientes.direccion','clientes.numero_cliente')
      
      ->get()
      ->toArray();
      
     // $conteoNumero =array_values($conteo);
    //  dd(((int)$conteo));
      $conteoN = (int)($conteo);
      
      if($conteoN>0)
      {
        return back()->with('exito', 'NO se puede eliminar el cliente ya que hay una factura a su nombre');
      }else{
        $cliente->delete();
      return back()->with('exito', 'El cliente ha sido eliminado exitosamente');

      }
      


    }
    
    public function edit_view($id)
    {
      $cliente = Cliente::find($id);
      return response()->json($cliente);


    }

    public function edit (Request $request)
    {
      
     
      $id = $request->edit_id;
      $cliente = Cliente::find($id);
      $validated = $request->validate([
        
        'numero_cliente' => 'required|unique:clientes,numero_cliente,'.$cliente->id,

    ]);
      $cliente->nombre_cliente = $request->nombre_cliente;
      $cliente->apellido_cliente = $request->apellido_cliente;
      $cliente->direccion = $request->direccion;
      $cliente->numero_cliente = $request->numero_cliente;
     

     
       
       $cliente->update();
       $logs = new Actividad();
       $logs->log($request->user,'edito la informacion de '.$request->nombre_cliente);

       return back()->with('exito','La informacion del cliente ha sido actualizada exitosamente');

    }

    public function store(Request $request)
    {
      //dd($request);
      $validated = $request->validate([
        'dni' => 'required|unique:clientes,dni|max:10',
        'numero_cliente' => 'required|unique:clientes,numero_cliente',

    ]);
      $cliente = new Cliente;
      $cliente->nombre_cliente = $request->nombre_cliente;
      $cliente->apellido_cliente = $request->apellido_cliente;
      $cliente->dni = $request->dni;
      $cliente->direccion = $request->direccion;
      $cliente->numero_cliente = $request->numero_cliente;
      $cliente->save();

      return back()->with('exito', 'cliente registrado');


    }

         //Crea el reporte de visitas de clientes
         public function reporteVisitas(Request $request)
         {
          $clientes = DB::table('ordenreparacions')
          ->join('vehiculos','vehiculos.id','=','ordenreparacions.vehiculo_id')
          ->join('clientes','clientes.id','=','vehiculos.cliente_id')
          ->select( 'clientes.nombre_cliente','clientes.direccion','clientes.numero_cliente',DB::raw('COUNT(ordenreparacions.id) as visitas'))
          ->groupBy('clientes.nombre_cliente','clientes.direccion','clientes.numero_cliente')
          
          ->get();
 
                 $pdf = \PDF::loadView('cliente.reporteVisitas',compact("clientes"));
                 $pdf->output();
                 $dom_pdf = $pdf->getDomPDF();
                 $canvas = $dom_pdf ->get_canvas();
                 $w = $canvas->get_width();
                 $h = $canvas->get_height();
                 $canvas->page_text(140, 20, date('d-m-Y'), null, 9, array(0, 0, 0));
                 $canvas->page_text(190, 20, "| Sistema de Facturacion  | SF", null, 9, array(0, 0, 0));
                 $canvas->page_text($w-55,$h-28, "{PAGE_NUM} / {PAGE_COUNT}", null, 9, array(0, 0, 0));
               return $pdf->stream('Reporte_Visitas.pdf');
     
       }
   

}
