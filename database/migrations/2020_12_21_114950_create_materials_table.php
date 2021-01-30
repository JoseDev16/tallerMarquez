<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_material');
            $table->string('unidad_medida');
            $table->string('nombre_material');

            $table->unsignedBigInteger('subcategoria_material_id');
          //  $table->unsignedBigInteger('composicion_id');

            $table->foreign('subcategoria_material_id')->references('id')->on('sub_categoria_materials')->onDelete('cascade');
          //  $table->foreign('composicion_id')->references('id')->on('composicion_materials');
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
        Schema::dropIfExists('materials');
    }
}
