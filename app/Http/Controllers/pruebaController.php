<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ProgramacionVehiculo;

class pruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = DB::table('progvehiculos')
            ->select('*')
            ->get();
        $personal = DB::table('personals')
            ->select('ID_Pers', 'PersFirstName', 'PersLastName')
            ->get();
        $vehiculos = DB::table('vehiculos')
            ->select('*')
            ->get();
        // return $eventos;
        return view('PruebaFullCalendar.index', compact('eventos', 'personal', 'vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('textHoraLlega') >= 12){
            $turno = "0";
        }
        else{
            $turno = "1";
        }
        $reguistro = new ProgramacionVehiculo();
        $reguistro->ProgVehFecha = $request->input('textFecha');
        $reguistro->progVehKm = $request->input('textkm');
        $reguistro->ProgVehTurno = $turno;
        $reguistro->ProgVehtipo = "1";
        if($request->input('textHoraLlega')){
            $reguistro->ProgVehEntrada = $request->input('textFecha').' '.$request->input('textHoraLlega');
        }
        else{
            $reguistro->ProgVehEntrada = null;
        }
        $reguistro->ProgVehSalida = $request->input('textFecha').' '.$request->input('textHoraSali');
        $reguistro->FK_ProgVehiculo = $request->input('textVehiculo');
        $reguistro->FK_ProgMan = "1";
        $reguistro->FK_ProgConductor = $request->input('textConductor');
        $reguistro->FK_ProgAyudante = $request->input('textAyudante');
        $reguistro->save();
        return redirect()->route('prueba.index');
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
