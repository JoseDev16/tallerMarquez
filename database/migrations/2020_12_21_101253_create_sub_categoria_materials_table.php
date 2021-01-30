<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriaMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categoria_materials', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_subcategoria_material');
            $table->unsignedBigInteger('categoriaMaterial_id')->onDelete('cascade');
            $table->foreign('categoriaMaterial_id')->references('id')->on('categoria_materials')->onDelete('cascade');;


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
        Schema::dropIfExists('sub_categoria_materials');
    }
}
