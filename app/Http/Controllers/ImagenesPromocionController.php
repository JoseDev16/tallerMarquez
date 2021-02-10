<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImagenesPromocion;

class ImagenesPromocionController extends Controller
{
    //
    public function inicioClientes()
    {
        $imagen = ImagenesPromocion::all()->first();
        return view('inicioClientes',compact("imagen"));
        
    }

    public function index()
    {
        $imagenes = ImagenesPromocion::paginate(10);
        return view('adimg.index',compact("imagenes"));
    }

    public function store(Request $request)
    {
       

        $validated = $request->validate([
            'imagen1g' => 'mimes:jpg,bmp,png',
            'imagen2g' => 'mimes:jpg,bmp,png',
            'imagen1c' => 'mimes:jpg,bmp,png',
            'imagen2c' => 'mimes:jpg,bmp,png',
            'imagen3c' => 'mimes:jpg,bmp,png',
            'imagen4c' => 'mimes:jpg,bmp,png',
            'imagen5c' => 'mimes:jpg,bmp,png',
            'imagen6c' => 'mimes:jpg,bmp,png',

        ]);
        $imagen = new ImagenesPromocion;
        if($request->hasFile('imagen1g'));
        {
            $file = $request->file('imagen1g');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen1g = $nombre_archivo;

        }

        if($request->hasFile('imagen2g'));
        {
            $file = $request->file('imagen2g');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen2g = $nombre_archivo;

        }
             
        if($request->hasFile('imagen1c'));
        {
            $file = $request->file('imagen1c');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen1c = $nombre_archivo;

        }
        if($request->hasFile('imagen2c'));
        {
            $file = $request->file('imagen2c');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen2c = $nombre_archivo;

        }

        if($request->hasFile('imagen3c'));
        {
            $file = $request->file('imagen3c');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen3c = $nombre_archivo;

        }

        if($request->hasFile('imagen4c'));
        {
            $file = $request->file('imagen4c');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen4c = $nombre_archivo;

        }

        if($request->hasFile('imagen5c'));
        {
            $file = $request->file('imagen5c');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen5c = $nombre_archivo;

        }

        if($request->hasFile('imagen6c'));
        {
            $file = $request->file('imagen6c');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen6c = $nombre_archivo;

        }

        $imagen->save();


    }

    public function edit_view()
    {
        $imagenes = ImagenesPromocion::all()->first();
        return response()->json($imagenes);
    }
}
