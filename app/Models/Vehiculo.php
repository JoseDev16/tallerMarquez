<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\OrdenReparacion;

class Vehiculo extends Model
{
    use HasFactory;
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function ordenes(){
        return $this->hasMany(OrdenReparacion::class);
    }


}
