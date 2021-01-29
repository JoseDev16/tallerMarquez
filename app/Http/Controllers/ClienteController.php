<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Vehiculo;
use DB;

class ClienteController extends Controller
{
    //
    public function index()
    {
        $clientes = Cliente::paginate(10);
        return view('cliente.index', compact("clientes"));

    }

    public function destroy()
    {

    }

    public function store(Request $request)
    {
      //dd($request);
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
