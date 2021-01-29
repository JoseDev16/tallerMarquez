<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehiculo;

class Cliente extends Model
{
  

    public function vehiculos(){
        return $this->hasMany(Vehiculo::class);
    }
}
