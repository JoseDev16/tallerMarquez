<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class ReservaController extends Controller
{
  
    public function index(Request $request)
    {
        $fechaInicio = $request->fechaInicio;
        $fechaFin= $request->fechaFin;
        if(!($fechaFin || $fechaInicio))
        {
            $reservas= Reserva::paginate(10);
            return view('reserva.index',compact("reservas"));

        }else{
            $reservas = Reserva::whereBetween('fecha',[$fechaInicio,$fechaFin])->paginate(10);

            return view('reserva.index',compact("reservas"));

        }
       
    }

    public function store(Request $request)
    {
        $validacionFecha = Reserva::where('fecha',$request->fecha)
                                ->where('hora',$request->hora)
                                ->count();
       /// Maximo de citas por hora
        if($validacionFecha >= 3 )
        {
            return back()->with('advertencia','Esta hora ya esta reservada, favor intente en otro horario');
        }else
        {
          //  dd($request);
            $reserva = new Reserva;
            $reserva->fecha = $request->fecha;
            $reserva->hora = $request->hora;
            $reserva->cliente = $request->cliente;
            $reserva->telefono = $request->telefono;
            $reserva->nota = $request->nota;
            $reserva->estado = "Activa";
            $reserva->razon= $request->razon;
            $reserva->mecanico= $request->mecanico;
            $reserva->save();
            return back()->with('exito','reserva registrada con exito');
        }
    }

    public function edit(Request $request)
    {
        $validacionFecha = Reserva::where('fecha',$request->fecha2)
                                ->where('hora',$request->hora2)
                                ->count();
      // Maximo de citas por hora
        if($validacionFecha >= 3)
        {
            return back()->with('advertencia','Esta hora ya esta reservada, favor intente en otro horario');
        }else
        {
          //  dd($request);
            $reserva = Reserva::find($request->edit_id);
            $reserva->fecha = $request->fecha2;
            $reserva->hora = $request->hora2;
          
            $reserva->nota = $request->nota2;
            $reserva->estado = $request->estado;
         
            $reserva->mecanico= $request->mecanico;
            $reserva->update();
            return back()->with('exito','reserva actualizada con exito');
        }

    }

    public function edit_view($id)
    {
        $reserva = Reserva::find($id);
        return response()->json($reserva);

    }

    public function destroy(Request $request)
    {
        $reserva = Reserva::find($request->delete_id);
       

        $reserva->delete();

        return back()->with('exito','La reserva ha sido eliminada exitosamente');
    }


    
}

