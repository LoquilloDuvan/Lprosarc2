<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_activos', function (Blueprint $table) {
            $table->increments('ID_MovAct');
            $table->string('MovTipo',32); /*tipo de movimiento Entrada, asignacion, Salida*/
            $table->timestamps();
            $table->unsignedInteger('FK_ActPerson')->nullable();
            $table->unsignedInteger('FK_MovInv')->nullable();
            $table->foreign('FK_ActPerson')->references('ID_Pers')->on('personals')->onDelete('set null');
            $table->foreign('FK_MovInv')->references('ID_Act')->on('activos')->onDelete('cascade');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_activos');
    }
}
