<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->string('id', 15);
            $table->primary('id');
            $table->string('nombre', 95);
            $table->longText('descripcion');
            $table->string('creditos', 45);
            $table->string('horas', 45);
            $table->string('semestre', 15);
            $table->string('id_carrera', 15);
            $table->integer('id_docente');
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
        Schema::dropIfExists('materias');
    }
}
