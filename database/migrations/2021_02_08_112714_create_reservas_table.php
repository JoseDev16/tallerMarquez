<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->string('telefono');
            $table->string('dni');
            $table->string('direccion');
            $table->string('estado');
            $table->string('razon');
            $table->date('fecha');
            $table->string('hora');
            $table->string('nota')->nullable();
            $table->string('mecanico')->nullable();

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
        Schema::dropIfExists('reservas');
    }
}
