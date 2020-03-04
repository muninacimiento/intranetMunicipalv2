<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('categoria_id'); //FK CategoriaMedicamentos
            $table->unsignedBigInteger('user_id'); //FK Usuario Plataforma
            $table->string('medicamento');
            $table->string('principioActivo');
            $table->string('laboratorio');
            $table->string('lote');
            $table->date('fechaVencimiento');
            $table->integer('stock');
            $table->integer('precioComercio');
            $table->integer('precioInventario');
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categoria_medicamentos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicamentos');
    }
}
