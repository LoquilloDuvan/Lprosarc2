@foreach ($Requerimientos as $Requerimiento)
    
<div class=" requirements-component form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Adicionales</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="">
            <label>
                @if ($Requerimiento->ReqAuditoriaTipo == 'Presencial')
                    
                    <input class="AllowUncheck" type="radio" value="Presencial" name="ReqAuditoriaTipo" checked/> Auditoria Presencial
                @else
                    
                    <input class="AllowUncheck" type="radio" value="Presencial" name="ReqAuditoriaTipo"/> Auditoria Presencial
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimiento->ReqAuditoriaTipo == 'Virtual')
                    
                    <input class="AllowUncheck" type="radio" value="Virtual" name="ReqAuditoriaTipo" checked/> Auditoria Virtual
                @else
                    <input class="AllowUncheck" type="radio" value="Virtual" name="ReqAuditoriaTipo"/> Auditoria Virtual
                    
                @endif
            </label>
        </div>
            
        <div class="">
            <label>
                @if ($Requerimiento->ReqDevolucion == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqDevolucion" value="1" checked/> Devolucion de elementos
                @else
                    <input type="checkbox" class="testswitch" name="ReqDevolucion" value="1"/> Devolucion de elementos
                    
                @endif
            </label>
        </div>
        <div class="">
            <label>
                <input type="text" maxlength="64" class="" name="ReqDevolucionTipo" value="{{$Requerimiento->ReqDevolucionTipo}}" > tipo de elementos
            </label>
        </div>
            {{-- <div class="">
            <label>
                <input type="number" class="" min="1" pattern="^[0-9]+" name="ReqDevolucionCant"/> cantidad de elementos
            </label>
            </div> --}}
        <div class="">
            <label>
                @if ($Requerimiento->ReqDatosPersonal == 1)
                    <input type="checkbox" class="testswitch" name="ReqDatosPersonal" value="1" checked/> Datos del Personal 
                @else
                    <input type="checkbox" class="testswitch" name="ReqDatosPersonal" value="1"/> Datos del Personal 
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimiento->ReqPlanillas == 1)
                    <input type="checkbox" class="testswitch" name="ReqPlanillas" value="1" checked/> Planillas
                @else
                    <input type="checkbox" class="testswitch" name="ReqPlanillas" value="1"/> Planillas
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimiento->ReqAlistamiento == 1)
                    
                
                    <input type="checkbox" class="testswitch" name="ReqAlistamiento" value="1" checked/> Alistamiento de residuos
                @else
                    <input type="checkbox" class="testswitch" name="ReqAlistamiento" value="1"/> Alistamiento de residuos
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimiento->ReqCapacitacion == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqCapacitacion" value="1" checked/> personal con Capacitacion
                @else
                    <input type="checkbox" class="testswitch" name="ReqCapacitacion" value="1"/> personal con Capacitacion
                    
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimiento->ReqBascula == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqBascula" value="1" checked/> Bascula
                @else
                    
                    <input type="checkbox" class="testswitch" name="ReqBascula" value="1"/> Bascula
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimiento->ReqMasPerson == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqMasPerson" value="1" checked/> Mas Personal de cargue/descargue
                @else
                    
                    <input type="checkbox" class="testswitch" name="ReqMasPerson" value="1"/> Mas Personal de cargue/descargue
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimiento->ReqPlatform == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqPlatform" value="1" checked/> vehiculo con Plataforma
                @else
                    <input type="checkbox" class="testswitch" name="ReqPlatform" value="1"/> vehiculo con Plataforma
                    
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimiento->ReqCertiEspecial == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqCertiEspecial" value="1" checked/> Certificacion Especial
                @else
                    <input type="checkbox" class="testswitch" name="ReqCertiEspecial" value="1"/> Certificacion Especial
                    
                @endif
            </label>
        </div>
    </div>
</div>
@endforeach