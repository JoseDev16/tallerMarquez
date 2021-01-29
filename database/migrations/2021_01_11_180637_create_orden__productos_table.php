<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_productos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('orden_id');
            $table->unsignedBigInteger('producto_id');
            
            $table->integer('cantidad');
            $table->boolean('prioridad');
            $table->foreign('orden_id')->references('id')->on('ordenreparacions');
            $table->foreign('producto_id')->references('id')->on('productos');
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
        Schema::dropIfExists('orden__productos');
    }
}
