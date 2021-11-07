@extends('layouts.admin')
@section('content')

{{-- @include('paises.create') --}}
<div class="right_col" role="main">
  <div class="">
      <div>

	  </div>      
      <h3>Listado de Paises</h3>
      <div align="left">

		
		<a href="{{route('ortopedia.paises.create')}}">
  		   <button class="btn btn-success">Nuevo</button>
        </a>
		<hr>
          @if ($errors->any())
                  <div class="alert alert-danger alert-dismissable">
                      <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;
                      </button>
                      <strong>¡Atención!</strong> 
                      <p> Error al cargar los datos </p>
                      <p><h4>Presione el boton Nuevo para verificar el error</h4></p>                    
                  </div>
           @endif


              		{{-- <button class="btn btn-primary btn-sm"  type="button"id="nuevopais"name="nuevo">Nuevo</button> --}}
       </div>

            <div class="row">  
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">                
                  <div class="x_content"> 

              @if(session('flash'))
                <div class="alert alert-success" role="alert">
                <strong>Aviso</strong>>{{session('flash')}}
                <button type ="button" class="close" data-dismiss="alert" alert-label="Close">
                <span aria-hidden ="true">&times;</span>
                </button>
                </div>
               @endif

                    <table id="tablaPaises" class="table table-dark">
                      <thead>
                        <tr>
                          <th align="center">Paises</th>     
                          <th align="center">Accion</th>
                        </tr>
                      </thead>
                      <tbody>

	                     @foreach($paises as  $pa)
	                     
	   						<tr>
                
                            <td align="center">{{$pa->nombre_pais}}</td>      
	                          <td align="center">

	                           <a href="{{route('ortopedia.paises.show',$pa->id_pais)}}" class="btn btn-success btn-sm"><i class="fas fa-eye" aria-hidden="true"></i></a>
	                          </td>
	                        </tr>
	                     @endforeach                                
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                </div>
           
          </div>
        </div> 
        </div> 
@endsection

@section('scrypts')
	$(document).ready( function () {
    $('#tablaPaises').DataTable();
} );
@endsection



