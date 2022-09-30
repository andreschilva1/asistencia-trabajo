<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajosAsignadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos_asignados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clientes_id');
            $table->unsignedBigInteger('tecnicos_id');
            $table->unsignedBigInteger('trabajos_id');
            $table->unsignedBigInteger('horas_id');
            $table->date('Fecha');
            $table->string('estado');
            $table->string('latitud');
            $table->string('longitud');
            $table->timestamps();
            $table->foreign('clientes_id')->on('users')->references('id');
            $table->foreign('tecnicos_id')->on('users')->references('id');
            $table->foreign('trabajos_id')->on('trabajos')->references('id');
            $table->foreign('horas_id')->on('horas')->references('id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajos_asignados');
    }
}
