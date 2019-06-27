<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\SolSerEmail;
use App\SolicitudServicio;
use App\Personal;

class EmailController extends Controller
{
    protected function sendemail($slug)
    {
        $SolSer = SolicitudServicio::where('SolSerSlug', $slug)->first();
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            $email = DB::table('solicitud_servicios')
                ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                ->join('sedes', 'sedesFK_SedeCli', '=' ,'clientes.ID_Cli')
                ->join('areas', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                ->join('cargos', 'cargos.CargArea', '=', 'areas.ID_Area')
                ->join('personals', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                ->join('users', 'users.FK_UserPers', 'personals.ID_Pers')
                ->select('users.email', 'clientes.CliName', 'solicitud_servicios.*')
                ->where('users.UsRol', 'JefeLogistica')
                ->first();
            Mail::to($email->email)->send(new SolSerEmail($email));
        }else{
            $email = DB::table('solicitud_servicios')
                ->join('progvehiculos', 'progvehiculos.FK_ProgVehiculo', '=', 'solicitud_servicios.ID_SolSer')
                ->join('personals', 'personals.ID_Pers', '=', 'solicitud_servicios.FK_SolSerPersona')
                ->select('personals.PersEmail', 'solicitud_servicios.*', 'progvehiculos.ProgVehFecha', 'progvehiculos.ProgVehSalida')
                ->where('solicitud_servicios.SolSerSlug', '=', $SolSer->SolSerSlug)
                ->where('progvehiculos.FK_ProgVehiculo', '=', $SolSer->ID_SolSer)
                ->first();
            Mail::to($email->PersEmail)->send(new SolSerEmail($email));
        }

        return back();
        // return redirect()->route('solicitud-servicio.show', ['id' => $SolSer->SolSerSlug]);
    }
}
