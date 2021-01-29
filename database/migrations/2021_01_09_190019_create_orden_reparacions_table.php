<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenReparacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenreparacions', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_orden');
            $table->string('motivo_ingreso');
            $table->string('trabajo_realizado');
            $table->date('fecha_entrega');
            $table->string('hecho_por');
            $table->string('mecanico')->nullable();
            $table->string('nota')->nulleable();
            $table->integer('mano_obra')->nulleable();
            $table->string('estado');
            $table->string('imagen1')->nullable();
            $table->string('imagen2')->nullable();
            $table->unsignedBigInteger('vehiculo_id');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_reparacions');
    }
}

