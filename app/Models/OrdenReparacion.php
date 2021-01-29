<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\Vehiculo;

class OrdenReparacion extends Model
{
    use HasFactory;

    protected $table = "ordenreparacions";

    public function productos (){
        return $this->belongsToMany(Producto::class, 'orden_productos', 'orden_id', 'producto_id');
    }

    public function materiales (){
        return $this->belongsToMany(Material::class, 'orden_materials', 'orden_id', 'material_id');
    }

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }
}
