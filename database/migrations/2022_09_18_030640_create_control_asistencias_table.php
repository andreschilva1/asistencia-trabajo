<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_asistencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trabajos_asignados_id');
            $table->time('horaInicio');
            $table->time('horaFin')->default('00:00:00');
            $table->string('latitud');
            $table->string('longitud');
            $table->timestamps();
            $table->foreign('trabajos_asignados_id')->on('trabajos_asignados')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('control_asistencias');
    }
}
