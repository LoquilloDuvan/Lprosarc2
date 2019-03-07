@extends('layouts.app')
@section('htmlheader_title')
Activos
@endsection
@section('contentheader_title')
Registros de Activos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/activos" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="col-md-6">
									<label for="activo">Categoria</label>
									<select class="form-control" id="activo" name="categoria" required="true">
										<option>Seleccione...</option>
										@foreach ($Categorias as $Categoria)
										
											<option value="{{$Categoria->ID_CatAct}}">{{$Categoria->CatName}}</option>																
										@endforeach
									</select>
								</div>
							{{-- </div> --}}
								<div class="col-md-6">
									<label for="activo1">SubCategoria</label>
									<select class="form-control" id="activo1" name="FK_ActSub" required="true">
										<option>Seleccione...</option>
										@foreach ($SubActivos as $SubActivo)
											 <option value="{{$SubActivo->ID_SubCat}}">{{$SubActivo->SubCatName}}</option>																
										@endforeach
									</select>
								</div>
							{{-- </div> --}}
								<div class="col-md-6">
									<label for="activoinputext1">Nombre del activo</label>
									<input type="text" class="form-control" id="activoinputext1" placeholder="Nombre del activo" name="ActName">
								</div>
								<div class="col-md-6">
									<label for="activo2">Forma del activo</label>
									<select class="form-control" id="activo2" name="ActUnid" required="true">
										<option>Seleccione...</option>
										<option value="0">Unidad</option>
										<option value="1">Peso</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="activo3">Sede</label>
									<select class="form-control" id="activo3" name="FK_ActSede" required="true">
										<option>Seleccione...</option>
										@foreach ($Sedes as $Sede)
											<option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>	
											
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="activoinputext2">Cantidad</label>
									<input type="number" class="form-control" id="activoinputext2" placeholder="988888" name="ActCant" max="999999">
								</div>
								<div class="col-md-6">
									<label for="activoinputext3">Serial de Prosarc</label>
									<input type="text" class="form-control" id="activoinputext3" placeholder="Serial de Prosarc" name="ActSerialProsarc">
								</div>
								<div class="col-md-6">
									<label for="activoinputext4">Modelo</label>
									<input type="text" class="form-control" id="activoinputext4" placeholder="modelo del activo" name="ActModel">
								</div>
								<div class="col-md-6">
									<label for="activoinputext5">Talla</label>
									<input type="text" class="form-control" id="activoinputext5" placeholder="talla de activo" name="ActTalla">
								</div>
								<div class="col-md-6">
									<label for="activoinputext6">Observaciones</label>
									<input type="text" class="form-control" id="activoinputext6" placeholder="Observaciones" name="ActObserv">
								</div>
								<div class="col-md-6">
									<label for="activoinputext7">Serial Proveedor</label>
									<input type="text" class="form-control" id="activoinputext7" placeholder="Serial del proveedor" name="ActSerialProveed">
								</div>
								
								<div class="container-fluid spark-screen">
									<div class="row">			
										<div class="box-footer" style="float:right; margin-right:5%">
											<button type="submit" class="btn btn-primary">Registrar</button>
										</div>	
									</div>
								</div>
							</form>
						</div>						
					</div>
				</div>
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection