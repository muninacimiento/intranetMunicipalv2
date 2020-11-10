<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('factura_id');
            $table->unsignedBigInteger('user_id'); //foreing key users
            $table->bigInteger('iddoc');
            $table->string('tipoDocumento'); //Boleta - Factura - Recibo
            $table->unsignedBigInteger('proveedor_id'); //FK Proveedores
            $table->unsignedBigInteger('ordenCompra_id'); //FK Proveedores
            $table->bigInteger('totalFactura');
            $table->unsignedBigInteger('estado_id'); //foreing key estadoFactura
            $table->string('obsAnulacion')->nullable(); //OBS Anulacion Factura
            $table->string('comentario')->nullable(); //Comentario que permitirá controlar iregularidades
            $table->datetime('fechaOficinaParte');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
            //$table->foreign('ordenCompra_id')->references('id')->on('orden_compras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
