<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignRecorsolserToRecorridosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recorridos', function (Blueprint $table) {
            $table->unsignedInteger('FK_RecorSolSer')->nullable();
            $table->unsignedInteger('FK_RecorProgveh')->nullable();
            $table->foreign('FK_RecorSolSer')->references('ID_SolSer')->on('solicitud_servicios')->onDelete('cascade'); 
            $table->foreign('FK_RecorProgveh')->references('ID_ProgVeh')->on('progvehiculos')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recorridos', function (Blueprint $table) {
            $table->dropForeign('recorridos_FK_RecorSolSer_foreign');
            $table->dropForeign('recorridos_FK_RecorProgveh_foreign');
            $table->dropColumn('FK_RecorSolSer');
            $table->dropColumn('FK_RecorProgveh');
        });
    }
}
