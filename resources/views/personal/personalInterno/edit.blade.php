@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.personaltitleedit') }}</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" action="/personalInterno/{{$Persona->PersSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
					@method('PATCH')
					@csrf
					@if ($errors->any())
						<div class="alert alert-danger" role="alert">
							<ul>
								@foreach ($errors->all() as $error)
									<p>{{$error}}</p>
								@endforeach
							</ul>
						</div>
					@endif
					@include('layouts.partials.spinner')
					<div class="box box-info">
						<div class="box-body" hidden onload="renderTable()" id="readyTable">
							<div class="tab-pane" id="addRowWizz">
								<p>{{ trans('adminlte_lang::message.smartwizzardtitle') }}</p>
								<div class="smartwizard">
									<ul>
										<li><a href="#step-1"><b>{{ trans('adminlte_lang::message.Paso 1') }}</b><br /><small>{{ trans('adminlte_lang::message.personalpaso1smart-wizzard') }}</small></a></li>
										<li><a href="#step-2"><b>{{ trans('adminlte_lang::message.Paso 2') }}</b><br /><small>{{ trans('adminlte_lang::message.personalpaso2smart-wizzard') }}</small></a></li>
										<li><a href="#step-3"><b>{{ trans('adminlte_lang::message.Paso 3') }}</b><br /><small>{{ trans('adminlte_lang::message.personalpaso3smart-wizzard') }}</small></a></li>
										<input name="PersType" id="PersType" type="text" hidden value="0">
									</ul>
									<div>
										<div id="step-1" class="">
											<div class="col-md-12">
												<div id="form-step-0" role="form" data-toggle="validator">
													<div class="form-group col-md-6">
														<label for="Sede">{{ trans('adminlte_lang::message.sclientsede') }}</label><small class="help-block with-errors">*</small>
														<select name="Sede" id="Sede" class="form-control select" required>
															<option value="{{$Cargo[0]->ID_Sede}}">{{$Cargo[0]->SedeName}}</option>
															@foreach($Sedes as $Sede)
																<option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
															@endforeach
														</select>
													</div>
													<div class="form-group col-md-6">
														<label for="CargArea">{{ trans('adminlte_lang::message.areaname') }}</label><small class="help-block with-errors">*</small>
														<select name="CargArea" id="CargArea" class="form-control" required>
															<option onclick="HiddenNewInputA()" value="{{$Cargo[0]->ID_Area}}">{{$Cargo[0]->AreaName}}</option>
															@foreach($Areas as $Area)
																<option value="{{$Area->ID_Area}}" onclick="HiddenNewInputA()">{{$Area->AreaName}}</option>
															@endforeach
															<option onclick="NewInputA()" value="NewArea">{{ trans('adminlte_lang::message.newarea') }}
														</select>
													</div>
													<div class="form-group col-md-6" id="divFK_PersCargo" >
														<label for="FK_PersCargo">{{ trans('adminlte_lang::message.cargoname') }}</label><small class="help-block with-errors">*</small>
														<select name="FK_PersCargo" id="FK_PersCargo" class="form-control" required>
															<option onclick="HiddenNewInputC()" value="{{$Cargo[0]->ID_Carg}}">{{$Cargo[0]->CargName}}</option>
															@foreach($Cargos as $Cargo)
																<option value="{{$Cargo->ID_Carg}}" onclick="HiddenNewInputC()">{{$Cargo->CargName}}</option>
															@endforeach
															<option onclick="NewInputC()" value="NewCargo">{{ trans('adminlte_lang::message.newcargo') }}
														</select>
													</div>
													<div class="form-group col-md-6" id="NewArea" style="display: none;">
														<label for="NewInputA">{{ trans('adminlte_lang::message.namenewarea') }}</label><small class="help-block with-errors">*</small>
														<input data-minlength="8" data-error="{{ trans('adminlte_lang::message.data-error-minlength4') }}" name="NewArea" type="text" id="NewInputA" class="form-control inputText" placeholder="{{ trans('adminlte_lang::message.newarea') }}">
													</div>
													<div class="form-group col-md-6" id="NewCargo" style="display: none;">
														<label for="NewInputC">{{ trans('adminlte_lang::message.namenewcargo') }}</label><small class="help-block with-errors">*</small>
														<input data-minlength="8" data-error="{{ trans('adminlte_lang::message.data-error-minlength4') }}" name="NewCargo" type="text" id="NewInputC" class="form-control inputText" placeholder="{{ trans('adminlte_lang::message.newcargo') }}">
													</div>
												</div>
											</div>
										</div>
										<div id="step-2" class="">
											<div class="col-md-12">
												<div id="form-step-1" role="form" data-toggle="validator">
													<div class="form-group col-md-6">
														<label for="PersDocType">Tipo de Documento</label><small class="help-block with-errors">*</small>
														<select name="PersDocType" id="PersDocType" class="form-control" required>
															<option {{$Persona->PersDocType == 'CC' ? 'select' : ''}} value="CC">Cedula de Ciudadania</option>
															<option {{$Persona->PersDocType == 'CE' ? 'select' : ''}} value="CE">Cedula Extranjera</option>
															<option {{$Persona->PersDocType == 'NIT' ? 'select' : ''}} value="NIT">Nit</option>
															<option {{$Persona->PersDocType == 'RUT' ? 'select' : ''}} value="RUT">Rut</option>
														</select>
													</div>
													<div class="form-group col-md-6">
														<label for="PersDocNumber">{{ trans('adminlte_lang::message.persdocument') }}</label><small class="help-block with-errors errorsdoc">*</small>
														<input data-minlength="6" maxlength="11" required name="PersDocNumber" data-error="{{ trans('adminlte_lang::message.data-error-minlength6') }}" type="text" class="form-control document" id="PersDocNumber" value="{{$Persona->PersDocNumber}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersFirstName">{{ trans('adminlte_lang::message.persfirstname') }}</label><small class="help-block with-errors">*</small>
														<input  required name="PersFirstName" autofocus="true" type="text" class="form-control nombres" id="PersFirstName" value="{{$Persona->PersFirstName}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersSecondName">{{ trans('adminlte_lang::message.perssecondtname') }}</label>
														<input name="PersSecondName" autofocus="true" type="text" class="form-control nombres" id="PersSecondName" value="{{$Persona->PersSecondName}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersLastName">{{ trans('adminlte_lang::message.perslastname') }}</label><small class="help-block with-errors">*</small>
														<input  required name="PersLastName" autofocus="true" type="text" class="form-control nombres" id="PersLastName" value="{{$Persona->PersLastName}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersEmail">{{ trans('adminlte_lang::message.emailaddress') }}</label><small class="help-block with-errors">*</small>
														<input type="email" name="PersEmail" id="PersEmail" class="form-control" required placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" value="{{$Persona->PersEmail}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersCellphone">{{ trans('adminlte_lang::message.mobile') }}</label><small class="help-block with-errors">*</small>
														<input data-minlength="12" required name="PersCellphone" autofocus="true" type="text" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" class="form-control mobile" id="PersCellphone" placeholder="{{ trans('adminlte_lang::message.mobileplaceholder') }}" value="{{$Persona->PersCellphone}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersAddress">{{ trans('adminlte_lang::message.address') }}</label>
														<input name="PersAddress" autofocus="true" type="text" class="form-control" id="PersAddress" placeholder="{{ trans('adminlte_lang::message.addressplaceholder') }}" value="{{$Persona->PersAddress}}">
													</div>
												</div>
											</div>
										</div>
										<div id="step-3" class="">
											<div class="col-md-12">
												<div id="form-step-2" role="form" data-toggle="validator">
													<div class="form-group col-md-6">
														<label for="PersBirthday">{{ trans('adminlte_lang::message.persbirthday') }}</label>
														<input name="PersBirthday" autofocus="true" type="text" class="form-control fechas" id="PersBirthday" value="{{$Persona->PersBirthday}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersPhoneNumber">{{ trans('adminlte_lang::message.persphone') }}</label>
														<input name="PersPhoneNumber" autofocus="true" type="text" class="form-control phone" id="PersPhoneNumber" value="{{$Persona->PersPhoneNumber}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersEPS">{{ trans('adminlte_lang::message.perseps') }}</label><small class="help-block with-errors dir">*</small>
														<input data-minlength="5" name="PersEPS"  autofocus="true" data-error="{{ trans('adminlte_lang::message.data-error-minlength5') }}" type="text" class="form-control" id="PersEPS" required value="{{$Persona->PersEPS}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersARL">{{ trans('adminlte_lang::message.persarl') }}</label><small class="help-block with-errors dir">*</small>
														<input data-minlength="5" name="PersARL" autofocus="true" data-error="{{ trans('adminlte_lang::message.data-error-minlength5') }}" type="text" class="form-control" id="PersARL" required value="{{$Persona->PersARL}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersLibreta">{{ trans('adminlte_lang::message.perslibreta') }}</label>
														<input name="PersLibreta" autofocus="true" type="text" class="form-control" id="PersLibreta" value="{{$Persona->PersLibreta}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersPase">{{ trans('adminlte_lang::message.perspase') }}</label>
														<input name="PersPase" autofocus="true" type="text" class="form-control" id="PersPase" value="{{$Persona->PersPase}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersBank">{{ trans('adminlte_lang::message.persbank') }}</label>
														<input name="PersBank" autofocus="true" type="text" class="form-control" id="PersBank" value="{{$Persona->PersBank}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersBankAccaunt">{{ trans('adminlte_lang::message.persbankaccaunt') }}</label><small class="help-block with-errors"></small>
														<input data-minlength="19" name="PersBankAccaunt" data-error="{{ trans('adminlte_lang::message.data-error-minlength16') }}" autofocus="true" type="text" class="form-control bank" id="PersBankAccaunt" value="{{$Persona->PersBankAccaunt}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersIngreso">{{ trans('adminlte_lang::message.persingreso') }}</label><small class="help-block with-errors dir">*</small>
														<input name="PersIngreso" autofocus="true" type="text" class="form-control fechas" id="PersIngreso" required value="{{$Persona->PersIngreso}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersSalida">{{ trans('adminlte_lang::message.perssalida') }}</label><small class="help-block with-errors dir">*</small>
														<input name="PersSalida" autofocus="true" type="text" class="form-control fechas" id="PersSalida" required value="{{$Persona->PersSalida}}">
													</div>
												</div>
												<div class="box-footer">
													<button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.update') }}</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
				</form>
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection
@section('NewScript')
	<script>
		$(document).ready(function(){
			$('#Sede').on('change', function() { 
				var id = $('#Sede').val();
				if(id != 0){
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
						}
					});
					$.ajax({
						url: "{{url('/area-sede')}}/"+id,
						method: 'GET',
						data:{},
						success: function(res){
							if(res != ''){
								$("#CargArea").empty();
								var areas = new Array();
								$("#CargArea").append(`<option onclick="HiddenNewInputA()" value="">Seleccione...</option>`);
								for(var i = res.length -1; i >= 0; i--){
									if ($.inArray(res[i].ID_Area, areas) < 0) {
										$("#CargArea").append(`<option onclick="HiddenNewInputA()" value="${res[i].ID_Area}">${res[i].AreaName}</option>`);
										areas.push(res[i].ID_Area);
									}
								}
								$("#CargArea").append(`<option onclick="NewInputA()" value="NewArea">Nuevo Area</option>`);
							}
							else{
								$("#CargArea").empty();
								$("#CargArea").append(`<option onclick="NewInputA()" value="NewArea">Nueva Area</option>`);
								document.getElementById("NewArea").style.display = 'block';
								document.getElementById("NewInputA").required = true;
								$("#FK_PersCargo").empty();
								$("#FK_PersCargo").append(`<option onclick="NewInputC()" value="NewCargo">Nuevo Cargo</option>`);
								document.getElementById("NewCargo").style.display = 'block';
								document.getElementById("NewInputC").required = true;
							}
						}
					})
				}
			});

			$('#CargArea').on('change', function() { 
				var id = $('#CargArea').val();
				if(id != 0){
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
						}
					});
					$.ajax({
						url: "{{url('/cargo-area')}}/"+id,
						method: 'GET',
						data:{},
						success: function(res){
							if(res != ''){
								$("#FK_PersCargo").empty();
								var cargos = new Array();
								$("#FK_PersCargo").append(`<option onclick="HiddenNewInputA()" value="">Seleccione...</option>`);
								for(var i = res.length -1; i >= 0; i--){
									if ($.inArray(res[i].ID_Carg, cargos) < 0) {
										$("#FK_PersCargo").append(`<option onclick="HiddenNewInputC()" value="${res[i].ID_Carg}">${res[i].CargName}</option>`);
										cargos.push(res[i].ID_Carg);
									}
								}
								$("#FK_PersCargo").append(`<option onclick="NewInputC()" value="NewCargo">Nuevo Cargo</option>`);
							}
							else{
								$("#FK_PersCargo").empty();
								$("#FK_PersCargo").append(`<option onclick="NewInputC()" value="NewCargo">Nuevo Cargo</option>`);
								document.getElementById("NewCargo").style.display = 'block';
								document.getElementById("NewInputC").required = true;
							}
						}
					})
				}
			});

		});
		function NewInputA(){
			document.getElementById("NewArea").style.display = 'block';
			document.getElementById("NewInputA").required = true;
			document.getElementById("divFK_PersCargo").style.display = 'none';
			document.getElementById("FK_PersCargo").required = false;
			document.getElementById("NewCargo").style.display = 'block';
			document.getElementById("NewInputC").required = true;
		}
		function HiddenNewInputA(){
			document.getElementById("NewArea").style.display = 'none';
			document.getElementById("NewInputA").required = false;
			document.getElementById("divFK_PersCargo").style.display = 'block';
			document.getElementById("FK_PersCargo").required = true;
			document.getElementById("NewCargo").style.display = 'none';
			document.getElementById("NewInputC").required = false;
		}
		function NewInputC(){
			document.getElementById("NewCargo").style.display = 'block';
			document.getElementById("NewInputC").required = true;
		}
		function HiddenNewInputC(){
			document.getElementById("NewCargo").style.display = 'none';
			document.getElementById("NewInputC").required = false;
		}

		$(document).ready(function(){
			var type = $("#PersType").val();
			if(type == 0){
				$("#PersAddress").prop('required', true);
				$("#PersAddress").before('<small class="help-block with-errors dir">*</small>');
			}
		});
	</script>
@endsection