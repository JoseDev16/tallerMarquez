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
        return back()->with('exito','Stack de imagenes ingresadas con exito');


    }

    public function edit(Request $request)
    {

       /* $validated = $request->validate([
            'imagen1ge' => 'nullable|mimes:jpg,bmp,png',
            'imagen2ge' => 'nullable|mimes:jpg,bmp,png',
            'imagen1ce' => 'nullable|mimes:jpg,bmp,png',
            'imagen2ce' => 'nullable|mimes:jpg,bmp,png',
            'imagen3ce' => 'nullable|mimes:jpg,bmp,png',
            'imagen4ce' => 'nullable|mimes:jpg,bmp,png',
            'imagen5ce' => 'nullable|mimes:jpg,bmp,png',
            'imagen6ce' => 'nullable|mimes:jpg,bmp,png',

        ]);*/

        $imagen =ImagenesPromocion::find(1);
       // dd($request->imagen1ge);
    //  dd($request->hasFile('imagen1ge'));
        if($request->imagen1ge)
        {

            $file = $request->file('imagen1ge');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen1g = $nombre_archivo;
           // dd($imagen->imagen1g);

        }

        if($request->hasFile('imagen2ge'))
        {
            $file = $request->file('imagen2ge');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen2g = $nombre_archivo;

        }
             
        if($request->hasFile('imagen1ce'))
        {
            $file = $request->file('imagen1ce');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen1c = $nombre_archivo;

        }
        if($request->hasFile('imagen2ce'))
        {
            $file = $request->file('imagen2ce');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen2c = $nombre_archivo;

        }

        if($request->hasFile('imagen3ce'))
        {
            $file = $request->file('imagen3ce');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen3c = $nombre_archivo;

        }

        if($request->hasFile('imagen4ce'))
        {
            $file = $request->file('imagen4ce');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen4c = $nombre_archivo;

        }

        if($request->hasFile('imagen5ce'))
        {
            $file = $request->file('imagen5ce');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen5c = $nombre_archivo;

        }

        if($request->hasFile('imagen6ce'))
        {
            $file = $request->file('imagen6ce');
            $nombre_archivo = $file->getClientOriginalName();
            $file->move(public_path("img"),$nombre_archivo);
            $imagen->imagen6c = $nombre_archivo;

        }

        $imagen->update();
        return back()->with('exito','Edicion realizada con exito');

    }

    public function edit_view()
    {
        $imagenes = ImagenesPromocion::all()->first();
        return response()->json($imagenes);
    }
}
