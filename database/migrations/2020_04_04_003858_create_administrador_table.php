<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrador', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 95);
            $table->string('correo', 95);
            $table->string('contraseña', 95);
            $table->string('imagen', 250);
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
        Schema::dropIfExists('administrador');
    }
}
