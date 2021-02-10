<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenesPromocionsTable extends Migration
{
    /**
     * Run the migrations.
     * 1g = IMAGENES PARA BANNER
     * 1c= IMAGENES PARA CARRUSEL
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes_promocions', function (Blueprint $table) {
            $table->id();
            $table->string('imagen1g');
            $table->string('imagen2g');
            $table->string('imagen1c');
            $table->string('imagen2c');
            $table->string('imagen3c');
            $table->string('imagen4c');
            $table->string('imagen5c');
            $table->string('imagen6c');

      

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
        Schema::dropIfExists('imagenes_promocions');
    }
}
