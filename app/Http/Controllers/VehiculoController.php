<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    //

    public function create ($id)
    {
        $clientes = Cliente::find($id);
        return view ('vehiculo.create', compact("clientes"));
    }

    public function store (Request $request)
    {
      $validated = $request->validate([
        
        'placa' => 'required|unique:vehiculos,placa,',

    ]);
      //dd($request);
      $vehiculo = new Vehiculo;
      $vehiculo->placa = $request->placa;
      $vehiculo->anio = $request->anio;
      $vehiculo->color= $request->color;
      $vehiculo->marca_id = $request->marca;
      $vehiculo->modelo = $request->modelo;
      $vehiculo->tipo = $request->tipo;
      $vehiculo->cliente_id = $request->cliente_id;
      $vehiculo->save();

      return back()->with('exito', 'vehiculo asignado');



    }
}
