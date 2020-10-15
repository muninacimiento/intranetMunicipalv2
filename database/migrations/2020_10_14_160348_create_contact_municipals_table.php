<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactMunicipalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_municipals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dependency_id');//Dirección o Departamento
            $table->string('unidad');
            $table->string('telefono');
            $table->timestamps();

            //Relations
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dependency_id')->references('id')->on('dependencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_municipals');
    }
}
