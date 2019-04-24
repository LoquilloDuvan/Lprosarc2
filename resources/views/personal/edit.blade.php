@extends('layouts.app')
@section('htmlheader_title','Personal')
@section('contentheader_title', 'Edicion de Personal')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				<div class="box-header">
					@component('layouts.partials.modal')
					{{$Persona->ID_Pers}}
					@endcomponent
					<h3 class="box-title">Datos de la persona</h3>
					@if($Persona->PersDelete == 0)
					<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Persona->ID_Pers}}'  class='btn btn-danger' style="float: right;">Eliminar</a>
					<form action='/personal/{{$Persona->PersSlug}}' method='POST'>
						@method('DELETE')
						@csrf
						<input  type="submit" id="Eliminar{{$Persona->ID_Pers}}" style="display: none;">
					</form>
					@else
					<form action='/personal/{{$Persona->PersSlug}}' method='POST' style="float: right;">
						@method('DELETE')
						@csrf
						<input type="submit" class='btn btn-success btn-block' value="Añadir">
					</form>
					@endif
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" action="/personal/{{$Persona->PersSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
					@method('PATCH')
					@csrf
					{{-- <h1 id="loadingTable">LOADING...</h1> --}}
					@include('layouts.partials.spinner')
					<div class="box-body" hidden onload="renderTable()" id="readyTable">
						<div class="tab-pane" id="addRowWizz">
							<p>Ingrese la informacion necesara completando todos los campos requeridos segun la informacion del residuo que desea registrar en cada paso</p>
							<div class="smartwizard">
								<ul>
									<li><a href="#step-1"><b>Paso 1</b><br /><small>Area y cargo de la persona</small></a></li>
									<li><a href="#step-2"><b>Paso 2</b><br /><small>Datos basicos de contacto</small></a></li>
									@if(Auth::user()->UsRol == 'Programador' || Auth::user()->UsRol == 'Administrador')
										<input name="PersType" id="PersType" type="text" hidden value="1">
										<li><a href="#step-3"><b>Paso 3</b><br /><small>Complemento de datos de la personal</small></a></li>
									@else
										<input name="PersType" id="PersType" type="text" hidden value="0">
									@endif
								</ul>
								<div>
									<div id="step-1" class="">
										<div class="col-md-12">
											<div id="form-step-0" role="form" data-toggle="validator">
												<div class="form-group col-md-6">
													<label for="CargArea">Area</label><small class="help-block with-errors">*</small>
													<select name="CargArea" id="CargArea" class="form-control" required>
														<option onclick="HiddenNewInputA()" value="{{$Cargos[0]->ID_Area}}">{{$Cargos[0]->AreaName}}</option>
														@foreach($Areas as $Area)
															<option onclick="HiddenNewInputA()" value="{{$Area->ID_Area}}">{{$Area->AreaName}}</option>
														@endforeach
														<option onclick="NewInputA()" value="0">Nueva Area</option>
													</select>
												</div>
												<div class="form-group col-md-6" id="divFK_PersCargo" >
													<label for="FK_PersCargo">Cargo del Personal</label><small class="help-block with-errors">*</small>
													<select name="FK_PersCargo" id="FK_PersCargo" class="form-control" required>
														<option value="{{$Cargos[0]->ID_Carg}}">{{$Cargos[0]->CargName}}</option>
													</select>
												</div>
												<div class="form-group col-md-6" id="NewArea" style="display: none;">
													<label for="NewInputA">¿Cuál Area?</label><small class="help-block with-errors">*</small>
													<input name="NewArea" type="text" id="NewInputA" class="form-control inputText">
												</div>
												<div class="form-group col-md-6" id="NewCargo" style="display: none;">
													<label for="NewInputC">¿Cuál Cargo?</label><small class="help-block with-errors">*</small>
													<input name="NewCargo" type="text" id="NewInputC" class="form-control inputText">
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
													<label for="PersDocNumber">Numero del Documento</label><small class="help-block with-errors">*</small>
													<input data-minlength="6" maxlength="11" required name="PersDocNumber" data-error="Use minimo 6 caracteres" type="text" class="form-control document" id="PersDocNumber" value="{{$Persona->PersDocNumber}}">
												</div>
												<div class="form-group col-md-6">
													<label for="PersFirstName">Primer Nombre</label><small class="help-block with-errors">*</small>
													<input  required name="PersFirstName" autofocus="true" type="text" class="form-control nombres" id="PersFirstName" value="{{$Persona->PersFirstName}}">
												</div>
												<div class="form-group col-md-6">
													<label for="PersSecondName">Segundo Nombre</label>
													<input name="PersSecondName" autofocus="true" type="text" class="form-control nombres" id="PersSecondName" value="{{$Persona->PersSecondName}}">
												</div>
												<div class="form-group col-md-6">
													<label for="PersLastName">Apellidos</label><small class="help-block with-errors">*</small>
													<input  required name="PersLastName" autofocus="true" type="text" class="form-control nombres" id="PersLastName" value="{{$Persona->PersLastName}}">
												</div>
												<div class="form-group col-md-6">
													<label for="PersEmail">Correo Electrónico</label><small class="help-block with-errors">*</small>
													<input type="email" name="PersEmail" id="PersEmail" class="form-control" required value="{{$Persona->PersEmail}}">
												</div>
												<div class="form-group col-md-6">
													<label for="PersCellphone">Numero de Celular</label><small class="help-block with-errors">*</small>
													<input data-minlength="12" required name="PersCellphone" autofocus="true" type="text" data-error="Use minimo 10 caracteres" class="form-control mobile" id="PersCellphone" value="{{$Persona->PersCellphone}}">
												</div>
												<div class="form-group col-md-6">
													<label for="PersAddress">Direccion</label>
													<input name="PersAddress" autofocus="true" type="text" class="form-control" id="PersAddress" value="{{$Persona->PersAddress}}">
												</div>
											</div>
											@if(Auth::user()->UsRol == 'Cliente')
												<div class="box-footer" style="float:right; margin-right:5%;">
													<button type="submit" class="btn btn-primary">Actualizar</button>
												</div>
											@endif
										</div>
									</div>
									@if(Auth::user()->UsRol == 'Programador' || Auth::user()->UsRol == 'Administrador')
										<div id="step-3" class="">
											<div class="col-md-12">
												<div id="form-step-2" role="form" data-toggle="validator">
													<div class="form-group col-md-6">
														<label for="PersBirthday">Fecha de Nacimiento</label>
														<input name="PersBirthday" autofocus="true" type="text" class="form-control fechas" id="PersBirthday" value="{{$Persona->PersBirthday}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersPhoneNumber">Numero de Telefono Local</label>
														<input name="PersPhoneNumber" autofocus="true" type="text" class="form-control phone" id="PersPhoneNumber" value="{{$Persona->PersPhoneNumber}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersEPS">EPS</label><small class="help-block with-errors dir">*</small>
														<input name="PersEPS" autofocus="true" type="text" class="form-control" id="PersEPS" required value="{{$Persona->PersEPS}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersARL">ARL</label><small class="help-block with-errors dir">*</small>
														<input name="PersARL" autofocus="true" type="text" class="form-control" id="PersARL" required value="{{$Persona->PersARL}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersLibreta">Numero de Libreta</label>
														<input name="PersLibreta" autofocus="true" type="text" class="form-control" id="PersLibreta" value="{{$Persona->PersLibreta}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersPase">Numero del Pase</label>
														<input name="PersPase" autofocus="true" type="text" class="form-control" id="PersPase" value="{{$Persona->PersPase}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersBank">Banco</label>
														<input name="PersBank" autofocus="true" type="text" class="form-control" id="PersBank" value="{{$Persona->PersBank}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersBankAccaunt">Numero de Cuenta</label><small class="help-block with-errors"></small>
														<input data-minlength="19" name="PersBankAccaunt" data-error="Use minimo 16 caracteres" autofocus="true" type="text" class="form-control bank" id="PersBankAccaunt" value="{{$Persona->PersBankAccaunt}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersIngreso">Fecha de Entrada</label><small class="help-block with-errors dir">*</small>
														<input name="PersIngreso" autofocus="true" type="text" class="form-control fechas" id="PersIngreso" required value="{{$Persona->PersIngreso}}">
													</div>
													<div class="form-group col-md-6">
														<label for="PersSalida">Fecha de Salida</label><small class="help-block with-errors dir">*</small>
														<input name="PersSalida" autofocus="true" type="text" class="form-control fechas" id="PersSalida" required value="{{$Persona->PersSalida}}">
													</div>
												</div>
												<div class="box-footer" style="float:right; margin-right:5%;">
													<button type="submit" class="btn btn-primary">Actualizar</button>
												</div>
											</div>
										</div>
									@endif
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
								for(var i = res.length -1; i >= 0; i--){
									if ($.inArray(res[i].ID_Mun, cargos) < 0) {
										$("#FK_PersCargo").append(`<option onclick="HiddenNewInputC()" value="${res[i].ID_Carg}">${res[i].CargName}</option>`);
										cargos.push(res[i].ID_Mun);
									}
								}
								$("#FK_PersCargo").append(`<option onclick="NewInputC()" value="0">Nuevo Cargo</option>`);
							}
							else{
								$("#FK_PersCargo").empty();
								$("#FK_PersCargo").append(`<option onclick="NewInputC()" value="0">Nuevo Cargo</option>`);
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
			if(type == 1){
				$("#PersAddress").prop('required', true);
				$("#PersAddress").before('<small class="help-block with-errors dir">*</small>');
			}
		});
	</script>
@endsection