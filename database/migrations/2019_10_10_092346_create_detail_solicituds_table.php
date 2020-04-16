<?php

/*
 *  JFuentealba @itux
 *  created at October 11, 2019 - 04:02 pm
 *  updated at 
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_solicituds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('solicitud_id')->nullable(); //foreiing key de Solicituds
            $table->unsignedBigInteger('product_id')->nullable(); //foreing key de Products
            $table->integer('cantidad');
            $table->text('especificacion');
            $table->integer('valorUnitario');
            $table->string('obsActualizacion')->nullable();
            $table->unsignedBigInteger('ordenCompra_id')->nullable(); //foreing key de OrdeCompra(autoIncrement)
            $table->unsignedBigInteger('licitacion_id')->nullable(); //foreing key de Licitacion(autoIncrement)
            $table->unsignedBigInteger('factura_id')->nullable(); //foreing key Factura que FALTA AGREGAR
            $table->datetime('fechaRecepcion')->nullable(); //Fecha de la Recepción del Producto
            $table->unsignedBigInteger('userReceive_id')->nullable(); // Usuario Receptor
            $table->string('obsRecepcion')->nullable();
            $table->datetime('fechaEntrega')->nullable(); //Fecha de entrega de un Producto solicitado por Stock
            $table->integer('cantidadEntregada')->default('0');
            $table->unsignedBigInteger('userDeliver_id')->nullable(); // Usuario que Entrega Productos
            $table->string('obsEntrega')->nullable();

            $table->foreign('solicitud_id')->references('id')->on('solicituds')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');



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
        Schema::dropIfExists('detail_solicituds');
    }
}
