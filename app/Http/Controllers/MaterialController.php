<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Actividad;
use App\Models\CategoriaMaterial;
use App\Models\SubCategoriaMaterial;
use App\Models\ComposicionMaterial;
use DB;

class MaterialController extends Controller
{
    public function index()
    {
        $materiales = Material::orderBy('id','desc')->paginate(10);


        $subcategorias = SubCategoriaMaterial::all();

        $composiciones = ComposicionMaterial::all();

        return \view('material.index',compact('materiales','subcategorias','composiciones'));
    }

    public function store (Request $request)
    {
        $validated = $request->validate([
            'codigo_material' => 'required|unique:materials,codigo_material|max:10',

        ]);
        $material = new Material;
        $material->nombre_material = $request->nombre_material;
        $material->codigo_material = $request->codigo_material;
        $material->subcategoria_material_id=$request->subcat_id;
        $material->unidad_medida= $request->unidad_id;
    //    $material->composicion_id= 1;

        $material->save();
        return back()->with('exito', 'Material registrado con exito');


    }
    public function search(Request $request)
    {
        $prueba="00";
        $posts2 = Material::where('codigo_material', 'LIKE', '%'.$prueba.'%')->pluck('codigo_material');
        $posts = Material::where('codigo_material', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('nombre_material', 'LIKE', '%'.$request->search.'%')
                            ->get();
        return \response()->json($posts);
    }

    public function cargarRegistros(Request $request, $id)
    {
        if($request->ajax()){
            $material = Material::where('codigo_material',$id)->get();
            return response()->json($material);
        }
    }

    public function edit_view(Request $request, $id)
    {

        if($request->ajax()){
            $material = Material::find($id);

            return response()->json($material);
        }
    }

    public function edit(Request $request)
    {
       
        $id = $request->edit_id;

       $material = Material::find($id);

        if (empty($id)) {

            return back();
        }

        $material->nombre_material = $request->nombre_material;
       // $material->codigo_material = $request->codigo_material;
        $material->subcategoria_material_id=$request->subcat_id;
        $material->unidad_medida= $request->unidad_id;
      // $material->composicion_id= 1;
        $material->update();

        return back()->with('exito','El material ha sido actualizada exitosamente');
    }

    public function destroy(Request $request)
    {
        $material = Material::find($request->delete_id);
        //$conteo =0;
        $conteo = DB::table('orden_materials')
        ->join('materials','materials.id','=','orden_materials.material_id')
        
        ->select(DB::raw('COUNT(orden_materials.id) as cantMaterial'))
        ->where('material_id',$request->delete_id)
        ->groupBy('materials.nombre_material')
        
        ->get()
        ->toArray();
        
        $conteoNumero =array_values($conteo);
     //  dd(((int)$conteo));
        $conteoN = (int)($conteo);
        if($conteoN>0)
        {
          return back()->with('exito', 'NO se puede eliminar la herramienta ya que hay una orden en la que esta asginada');
        }else{
          $material->delete();
        return back()->with('exito', 'El material ha sido eliminado exitosamente');
  
        }
        






       // $id = $request->delete_id;
        //$material = Material::find($id);

        if (empty($material)) {
            return back();
        }

        //$this->authorize('verify', $material);
        $material->delete();
        return back()->with('exito','La material ha sido eliminada exitosamente');
    }


}
