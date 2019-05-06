@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.edit') }}</h3>
				</div>
				<!-- general form elements -->
				<div class="box box-info">
					<!-- form start -->
					<form role="form" action="/clientes/{{$cliente->CliSlug}}" method="POST" enctype="multipart/form-data"  data-toggle="validator" class="form">
						@csrf
						@method('PUT')
						@if ($errors->any())
							<div class="alert alert-danger" role="alert">
								<ul>
									@foreach ($errors->all() as $error)
										<p>{{$error}}</p>
									@endforeach
								</ul>
							</div>
						@endif
						<div class="box-body">
							<div class="form-group col-md-12">
								<label for="ClienteInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="CliNit" class="form-control nit" id="ClienteInputNit" data-minlength="13" data-maxlength="13" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" required value="{{$cliente->CliNit}}">
							</div>
							<div class="col-md-12 form-group">
								<label for="ClienteInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="CliName" class="form-control" id="ClienteInputRazon"  minlength="5"  maxlength="100" required value="{{$cliente->CliName}}">
							</div>
							<div class="col-md-12 form-group">
								<label for="ClienteInputNombre">{{ trans('adminlte_lang::message.clientnombrecorto') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="CliShortname" class="form-control" id="ClienteInputNombre" minlength="2"  maxlength="100" required value="{{$cliente->CliShortname}}">
							</div>
							{{-- @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador'))
							<div class="col-md-6 form-group"><small class="help-block with-errors">*</small>
								<label for="categoria">{{ trans('adminlte_lang::message.clientcategoría') }}</label>
								<select class="form-control" id="categoria" name="CliCategoria" required>
									<option {{ $cliente->CliCategoria == 'Cliente' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clientcliente') }}</option>
									<option {{ $cliente->CliCategoria == 'Transportador' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clienttransportador') }}</option>
									<option {{ $cliente->CliCategoria == 'Proveedor' ? 'selected' : '' }}>{{ trans('adminlte_lang::message.clientproveedor') }}</option>
								</select>
							</div>
							@endif --}}
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.update') }}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
