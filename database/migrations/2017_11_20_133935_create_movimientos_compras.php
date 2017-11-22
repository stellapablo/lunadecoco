<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosCompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos_compras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('direccion');
            $table->text('email');
            $table->text('telefono');
            $table->text('cantidad');
            $table->integer('producto_id')->index();
            $table->string('pedido_id')->index()->nullable();
            $table->string('entregaInicio')->nullable();
            $table->string('entregaFinal')->nullable();
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
        //
    }
}
