<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTramitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellidos');
            $table->string('dni');
            $table->string('email');
            $table->text('descriptcion_padre');
            $table->string('tramite_nombre');
            $table->string('telefono');
            $table->string('archivo_padre')->nullable();
            $table->timestamp('fecha')->default(today());

            //? archivo no visible para el padre en en la solitud

            $table->enum('tramite_estado', ['pendiente', 'rechazado', 'aceptado', 'proceso'])->default('pendiente');
            $table->string('archivo_descargar_admin')->nullable();
            $table->boolean('visto')->default(false);
            $table->text('descriptcion_recepcionista')->nullable();

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
        Schema::dropIfExists('tramites');
    }
}
