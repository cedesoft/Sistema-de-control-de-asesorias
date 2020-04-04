<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_docentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status', 45);
            $table->date('fechaSolicitud');
            $table->longText('tema');
            $table->string('unidad', 45);
            $table->string('situacion_academica', 95);
            $table->unsignedBigInteger('id_docente');
            $table->string('id_materia');
            $table->string('id_alumno');
            $table->foreign('id_docente')->references('id')->on('docentes');
            $table->foreign('id_materia')->references('id')->on('materias');
            $table->foreign('id_alumno')->references('id')->on('alumnos');
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
        Schema::dropIfExists('solicitud_docentes');
    }
}
