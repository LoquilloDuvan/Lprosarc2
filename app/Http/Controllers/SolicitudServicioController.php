<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SolicitudServicio;
use App\SolicitudResiduo;
use App\audit;
use App\Sede;
use App\GenerSede;
use App\Respel;
use App\ResiduosGener;
use App\Cliente;
use App\Generador;
use App\Personal;


class SolicitudServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->UsRol === "Programador"){
        // $Servicios = DB::table('solicitud_servicios')
            // ->join('sedes', 'sedes.ID_Sede', '=', 'solicitud_servicios.Fk_SolSerTransportador')
            // ->leftjoin('gener_sedes', 'gener_sedes.ID_GSede', '=', 'solicitud_servicios.FK_SolSerGenerSede')
            // ->leftjoin('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
            // ->join('residuos_geners', 'residuos_geners.FK_SolSer', '=', 'solicitud_servicios.ID_SolSer')
            // ->leftjoin('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            // ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            // ->select('solicitud_servicios.*', 'clientes.CliShortname', 'generadors.GenerName', 'respels.RespelName')
            // ->get();/*, compact('Servicios')*/, compact('Respel')

        return view('solicitud-serv.index');
        }
        $Servicios = DB::table('solicitud_servicios')
            ->join('sedes', 'sedes.ID_Sede', '=', 'solicitud_servicios.Fk_SolSerTransportador')
            ->leftjoin('gener_sedes', 'gener_sedes.ID_GSede', '=', 'solicitud_servicios.FK_SolSerGenerSede')
            ->leftjoin('generadors', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
            ->join('residuos_geners', 'residuos_geners.FK_SolSer', '=', 'solicitud_servicios.ID_SolSer')
            ->leftjoin('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
            ->select('solicitud_servicios.*', 'clientes.CliShortname', 'generadors.GenerName', 'respels.RespelName')
            ->where('solicitud_servicios.SolSerDelete', 0)
            ->get();


        return view('solicitud-serv.index', compact('Servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Sedes = Sede::all();
        $Clientes = Cliente::all();
        $Respels = DB::table('respels')
            ->select('ID_Respel', 'RespelName')
            ->get();
        $Generadors = DB::table('generadors')
            ->select('ID_Gener', 'GenerName')
            ->get();
        $Personals = Personal::all();
        return view('solicitud-serv.create', compact( 'Respels','Sedes','Personals','Clientes', 'Generadors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $SolicitudServicio = new SolicitudServicio();
        $SolicitudServicio->SolSerStatus = 'Pendiente';
        $SolicitudServicio->SolSerTipo = $request->input('SolSerTipo');
        $SolicitudServicio->SolSerAuditable = $request->input('SolSerAuditable');
        $SolicitudServicio->SolSerFrecuencia = $request->input('SolSerFrecuencia');
        $SolicitudServicio->SolSerConducExter = $request->input('SolSerConducExter');
        $SolicitudServicio->SolSerVehicExter = $request->input('SolSerVehicExter');
        $SolicitudServicio->Fk_SolSerTransportador = $request->input('Fk_SolSerTransportador');
        $SolicitudServicio->SolSerSlug = now().'solicitud'.$request->input('FK_SolSerCliente').'deservicio';
        $SolicitudServicio->SolSerDelete = 0;
        $SolicitudServicio->FK_SolSerPersona = $request->input('FK_SolSerPersona');
        $SolicitudServicio->FK_SolSerCliente = $request->input('FK_SolSerCliente');
        // $SolicitudServicio->save();
        return $SolicitudServicio;


$request->input('SolResAuditoriaTipo');
$request->input('ReqAuditoriaTipo');
        $Prueba = '0) ';
        $Generador = count($request['Generador']);
        for ($i=0; $i < $Generador; $i++) { 
            
        }
        return $Prueba;
        // return $Generador;
        // return $request['desRespel'][0];
        $data = $request->input('Respel');
        $prueba = json_encode($data);
        return $data;



        $auditable = $request->input('SolSerAuditable');
        $Servicio = new SolicitudServicio();
        $Servicio->SolSerStatus = "Pendiente";
        $Servicio->SolSerTipo = $request->input('SolSerTipo');
        if($auditable){
            $Servicio->SolSerAuditable = 1;
        }
        else{
            $Servicio->SolSerAuditable = 0;
        }
        $Servicio->SolSerFrecuencia = $request->input('SolSerFrecuencia');
        $Servicio->SolSerConducExter = $request->input('SolSerConducExter');
        $Servicio->SolSerVehicExter = $request->input('SolSerVehicExter');
        $Servicio->Fk_SolSerTransportador = $request->input('Fk_SolSerTransportador');
        $Servicio->SolSerSlug = 'Slug'.date('YmdHis').$request->input('FK_SolSerCliente');
        $Servicio->SolSerDelete = 0;
        $Servicio->FK_SolSerPersona = $request->input('FK_SolSerPersona');
        $Servicio->FK_SolSerCliente = $request->input('FK_SolSerCliente');
        $Servicio->save();
        return redirect()->route('solicitud-residuo.create')->compact('$Servicio->ID_SolSer');
        // return $Servicio;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Servicio = SolicitudServicio::where('SolSerSlug', $id)->first();
        $SedePro = Sede::where('ID_Sede', $Servicio->Fk_SolSerTransportador)->first();
        $ClientePro = Cliente::where('ID_Cli',$SedePro->FK_SedeCli)->first();
        // Datos del cliente
        $GSede = GenerSede::where('ID_GSede', $Servicio->FK_SolSerGenerSede)->first();
        $Generador = Generador::where('ID_Gener', $GSede->FK_GSede)->first();
        $Sede = Sede::where('ID_Sede', $Generador->FK_GenerCli)->first();
        $Cliente = Cliente::where('ID_Cli', $Sede->FK_SedeCli)->first();
        //Datos del residuo
        $ServicioResiduos = SolicitudResiduo::where('FK_SolResSolSer', $Servicio->ID_SolSer)->first();
        $ResiduosGener = ResiduosGener::where('ID_SGenerRes', $ServicioResiduos->FK_SolResRg)->first();
        $Residuos = Respel::where('ID_Respel',$ResiduosGener->FK_Respel)->first();
        // return $Servicio;
        return view('solicitud-serv.show', compact('Servicio','SedePro','ClientePro','GSede','Generador','Sede','Cliente','ResiduosGener','Residuos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Servicios = SolicitudServicio::where('SolSerSlug', $id)->first();

        $SGenerRes = ResiduosGener::where('FK_SolSer', $Servicios->ID_SolSer)->first();
        $Sedes = Sede::all();
        $GSedes = GenerSede::all();
        $Respels = Respel::all();


        return view('solicitud-serv.edit', compact('Servicios', 'GSedes', 'Sedes', 'Respels', 'SGenerRes'));
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
        // return $request;
        $Servicios = SolicitudServicio::where('ID_SolSer', $id)->first();
        $Servicios->fill($request->all());
        $Servicios->SolSerAuditable =$request->input('SolSerAuditable');
        $Servicios->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes = ResiduosGener::where('FK_SolSer', $Servicios->ID_SolSer)->first();
        $SGenerRes->FK_SGener = $request->input('FK_SolSerGenerSede');
        $SGenerRes->FK_Respel = $request->input('FK_Respel');
        $SGenerRes->save();

        $log = new audit();
        $log->AuditTabla="residuos_geners";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$SGenerRes->ID_SGenerRes;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();
        
        $log = new audit();
        $log->AuditTabla="solicitud_servicios";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Servicios->ID_SolSer;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        return redirect()->route('solicitud-servicio.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Servicios = SolicitudServicio::where('SolSerSlug', $id)->first();
        if ($Servicios->SolSerDelete == 0) {
            $Servicios->SolSerDelete = 1;
        }
        else{
            $Servicios->SolSerDelete = 0;
        }
        $Servicios->save();

        $log = new audit();
        $log->AuditTabla="solicitud_serviciosrespels";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$Servicios->ID_SolSer;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$Servicios->SolSerDelete;
        $log->save();
        
        return redirect()->route('solicitud-servicio.index');
    }
}
