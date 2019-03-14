<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SolicitudServicio;
use App\audit;



class SolicitudServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Servicios = DB::table('solicitud_servicios')
        ->select('solicitud_servicios.*')
        ->get();
        return view('solicitud.indexServicio', compact('Servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Sedes = DB::table('solicitud_servicios')
            ->join('sedes','sedes.ID_Sede', 'solicitud_servicios.Fk_SolSerTransportador')
            ->select('solicitud_servicios.*', 'sedes.*')
            // ->where('')
            ->get();

            return view('solicitud.createServicio', compact('Sedes'));                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = $request->input('Estado');
        $Servicio->SolSerTipo = $request->input('Tipo');

        if($request->input('auditable') == 'on'){
            $Servicio->SolSerAuditable = '1';
        }else{
            $Servicio->SolSerAuditable = '0';
        }

        $Servicio->SolSerFrecuencia = $request->input('Frecuencia');
        $Servicio->SolSerConducExter = $request->input('conductor');
        $Servicio->SolSerVehicExter = $request->input('placa');
        $Servicio->Fk_SolSerTransportador = 2;
        $Servicio->FK_SolSerGenerSede = 1;
        //Revisar slug
        $Servicio->SolSerSlug = 'user'. $Servicio->SolSerVehicExter;
        
        $Servicio->save();

        $log = new audit();
        $log->AuditTabla="solicitud_servicios";
        $log->AuditType="Creado";
        $log->AuditRegistro=$Servicio->ID_SolSer;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->all();
        $log->save();
        // return view('solicitud.indexServicio', compact('Servicios'));
        return redirect()->route('solicitud-servicio.index');
        // return redirect()->route('solicitud.indexServicio',  compact('Servicios'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
