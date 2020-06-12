<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status', 45);
            $table->date('fechaSolicitud');
            $table->date('fechaRealizacion');
            $table->date('fechaTerminacion');
            $table->string('lugar', 95);
            $table->string('unidad', 45);
            $table->longText('tema');

            $table->unsignedBigInteger('id_docente');
            $table->string('id_materia');
            $table->string('id_alumno');
            $table->foreign('id_docente')->references('id')->on('docentes');
            $table->foreign('id_materia')->references('id')->on('materias');
            $table->foreign('id_alumno')->references('id')->on('alumnos');
            $table->longText('observaciones');
            
            $table->timestamps();
            $table->string('state')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asesorias');
    }
}
