  @extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::LangUsers.usermenu') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">

				<!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ trans('adminlte_lang::LangUsers.userlist') }}</h3>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <div style="margin-right:2em; float: right; margin-bottom:1em;">
                <a class="btn btn-primary" href="#addRowWizz" data-toggle="tab"> persona Usuario</a>
                <!-- Button to trigger modal -->
                <button class="btn btn-success" data-toggle="modal" data-target="#modalForm">
                    añadir usuario 2
                </button>
              </div>
              <table id="UsersTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Rol 1</th> 
                  <th>Rol 2</th> 
                  <th>Propietario</th>
                  <th>tipo</th> 
                  <th>Mas...</th>
                  <th>Editar Rol</th>
                </tr>
                </thead>
                <tbody  hidden onload="renderTable()" id="readyTable">

              {{-- <h1 id="loadingTable">LOADING...</h1> --}}
                   <div class="fingerprint-spinner" id="loadingTable">
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">L</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">o</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">a</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">d</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">i</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">n</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">g</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
                   </div>
                	{{-- <div class="row">
							<div class="card text-center" style="width: 18rem; margin-top:3rem;">
								<img class="card-img-top rounded-circle mx-auto d-block" src="images/{{$trainer->avatar}}" onerror="this.src='images/default.jpg';" alt="" style="margin:2rem; background-color:#EFEFEF; width:8rem;height:8rem;">
								<div class="card-body">
									<h5 class="card-title">{{$user->CliShortname}}</h5>	
									<p class="card-text" style="overflow-y: scroll; max-height:3rem; min-height:3rem;">{{$user->CliNit}}</p>
									<a href="/clientes/{{$user->CliShortname}}" class="btn btn-primary">Ver mas...</a>
								</div>
							</div>
						</div> --}}
                @if(Auth::user()->UsRol == "Programador"||Auth::user()->UsRol == "admin")
                	@foreach($users as $usuario)
						        <tr>
		                  <td>{{$usuario->name}}</td>
		                  <td>{{$usuario->email}}</td>
                      <td>{{$usuario->UsStatus}}</td>
                      <td>{{$usuario->UsRolDesc}}</td>
                      <td>{{$usuario->UsRolDesc2}}</td>
                      <td>{{$usuario->PersFirstName}} {{$usuario->PersLastName}}</td>
                      <td>{{$usuario->UsType}}</td>
                      <th>{{$usuario->id}}</th>
                      <th>{{$usuario->id}}</th>
		                </tr>
					        @endforeach
                @else
                  @foreach($users as $usuario)
                    @if($usuario->UsRol !== "Programador" && $usuario->UsRol !== "admin" && $usuario->UsType !== "Interno")
                      <tr>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->UsStatus}}</td>
                        <td>{{$usuario->UsRolDesc}}</td>
                        <td>{{$usuario->UsRolDesc2}}</td>
                        <td>{{$usuario->UsType}}</td>
                        <th>{{$usuario->id}}</th>
                        <th>{{$usuario->id}}</th>
                      </tr>
                    @endif()
                  @endforeach
                @endif() 
            	</tbody>
                <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Rol 1</th> 
                  <th>Rol 2</th> 
                  <th>Propietario</th>
                  <th>tipo</th> 
                  <th>Mas...</th>
                  <th>Editar Rol</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

			</div>
		</div>
	</div>

  <!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edicion de usuario</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="inputName">Nombre</label>
                        <input value="{{$user->name}} "type="text" class="form-control" id="inputName" placeholder="Enter your name"/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input value="{{$user->email}}" type="email" class="form-control" id="inputEmail" placeholder="Enter your email"/>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Mensaje</label>
                        <textarea class="form-control" id="inputMessage" placeholder="Enter your message"></textarea>
                    </div>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">Enviar</button>
            </div>
        </div>
    </div>
</div>
@endsection