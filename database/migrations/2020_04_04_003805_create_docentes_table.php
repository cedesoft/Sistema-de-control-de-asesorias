<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 95);
            $table->string('correo', 95);
            $table->string('contraseña', 95);
            $table->string('imagen', 250);
            $table->string('id_carrera');
            $table->foreign('id_carrera')->references('id')->on('carreras');
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
        Schema::dropIfExists('docentes');
    }
}
