<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventarioTechnology extends Model{
 protected $table='inventario_technologies';
    protected $fillable = ['TecnBrand','TecnModel','TecnSerial','TecnNumber','TecnOs','TecnRam','TecnScreen','TecnAccessory1','TecnAccessory2','Tecnobserv','FK_TecnPerson'];
    protected $primaryKey = 'ID_Tecn';

    public function personals(){
    	return $this>belongsTo('FK_TecnPerson','ID_Pers');
    }
}
