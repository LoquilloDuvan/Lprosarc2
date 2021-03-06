<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\audit;
use App\Sede;
use App\Activo;
use App\SubcategoriaActivo;
use App\CategoriaActivo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Activos = DB::table('subcategoria_activos')
            ->rightJoin('Activos', 'Activos.FK_ActSub', '=', 'subcategoria_activos.ID_SubCat')
            ->leftJoin('categoria_activos', 'subcategoria_activos.FK_SubCat', '=', 'categoria_activos.ID_CatAct')
            ->select('subcategoria_activos.*', 'categoria_activos.*', 'Activos.*')
            ->get();

        return view('activos.index', compact('Activos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $SubActivos = SubcategoriaActivo::all();

        $Categorias = CategoriaActivo::all();

        $Sedes = DB::table('sedes')
            ->select('sedes.ID_Sede', 'sedes.SedeName')
            ->get();

        return view('activos.create', compact('SubActivos', 'Categorias', 'Sedes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Activo = new Activo();
        $Activo->ActName = $request->input('ActName');
        $Activo->ActUnid = $request->input('ActUnid');
        $Activo->ActCant = $request->input('ActCant');
        $Activo->ActSerialProsarc = $request->input('ActSerialProsarc');
        $Activo->ActModel = $request->input('ActModel');
        $Activo->ActTalla = $request->input('ActTalla');
        $Activo->ActObserv = $request->input('ActObserv');
        $Activo->ActSerialProveed = $request->input('ActSerialProveed');
        $Activo->FK_ActSub = $request->input('FK_ActSub');
        $Activo->FK_ActSede = $request->input('FK_ActSede');
        $Activo->ActDelete = 0;
        $Activo->save();

        return redirect()->route('activos.index');
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
        $Activos = Activo::where('ID_Act', $id)->first();

        $SubActivo = SubcategoriaActivo::where('ID_SubCat', $Activos->FK_ActSub)->first();
        $SubActivos = SubcategoriaActivo::where('ID_SubCat','<>', $Activos->FK_ActSub)->get();
        
        $Categoria = CategoriaActivo::where('ID_CatAct', $SubActivo->FK_SubCat)->first();
        $Categorias = CategoriaActivo::where('ID_CatAct','<>', $SubActivo->FK_SubCat)->get();
        
        $Sede = Sede::where('ID_Sede', $Activos->FK_ActSede)->first();
        $Sedes = Sede::where('ID_Sede', '<>', $Activos->FK_ActSede)->get();

        return view('activos.edit',  compact('Activos', 'SubActivos','Sedes', 'Categorias', 'SubActivo','Sede', 'Categoria'));
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
        $Activo = Activo::where('ID_Act', $id)->first();
        $Activo->fill($request->all());
        $Activo->ActModel = $request->input('ActModel');
        $Activo->save();

        $log = new audit();
        $log->AuditTabla = "activos";
        $log->AuditType = "Modificado";
        $log->AuditRegistro = $Activo->ID_Act;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $request->all();
        $log->save();

        return redirect()->route('activos.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Activos = Activo::where('ID_Act', $id)->first();
        if ($Activos->ActDelete == 0){
            $Activos->ActDelete = 1;
        }
        else{
            $Activos->ActDelete = 0;
        }
        $Activos->save();

        $log = new audit();
        $log->AuditTabla = "activos";
        $log->AuditType = "Eliminado";
        $log->AuditRegistro = $Activos->ID_Act;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $Activos->ActDelete;
        $log->save();

        return redirect()->route('activos.index');
    }
}
