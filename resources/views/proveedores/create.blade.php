@extends('layouts.admin')

@section('content')


	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3><b>Nuevo Proveedor</b></h3>
		</div>		
	</div>
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

		<form method="POST" autocomplete="off"  action="{{route('ortopedia.proveedores.store')}}" enctype="multipart/form-data" id="form-personas-create">


  	{{-- {!!Form::token()!!} --}}
 	{{ csrf_field() }}
  			   
  			 <div class="form-row">

          <div class="form-group col-md-6"> 
          <label for="cuit">CUIT:</label>
          <input type="text" name="cuit" id='cuit' class="form-control" placeholder="">
          <span class="input-group-text" for="cuit"></span>
          <span class="col-1" hidden class="col-sm" id="errorCuit" style="color: red;">CUIT no válido </span>
              
                </div>
            </div>

					<div class="form-group col-md-6">
							<label for="razon_social">Razón Social:</label>
					<input type="text" name="razon_social" id='razon_social' class="form-control" placeholder="" required >
							
					</div>

            <div class="form-row">
    				<div class="form-group col-md-4">				
              			<label for="id_localidad">Localidad:</label>
						 <select name="id_localidad" class="form-control selectpicker" id="id_localidad"  data-live-search="true" >
						 <option value="--Seleccionar--">--Seleccionar--</option>

						@foreach ($localidades as $localidades)
							<option value="{{$localidades->id_localidad}}">{{$localidades->nombre_localidad}}</option>
						@endforeach
								
							</select>	
						</div>

          <div class="form-group col-md-8">
              <label for="domicilio">Domicilio:</label>
              <input type="text" name="domicilio" id="domicilio" class="form-control" placeholder="" required>
            </div>

						<div class="form-group col-md-6">
              
							<label for="email">Email:*<span class="text-danger"></span></label>
							<input type="email" name="email" id= "email" class="form-control" placeholder="" required>
						</div>
							</div>
							<div class="form-group col-md-6">
							<label for="telefono">Telefono: (*con caracteristica)</label>
							<input type="number" name="telefono" data-mask="9999-999999"class="form-control" placeholder="" required>
						</div>
</div>

					
						</div>
					<div class="form-group col-md-6">
							<button class="btn btn-warning" type="submit">Guardar</button>
							<a href="{{route('ortopedia.proveedores.index')}}" class="btn btn-default">Cancelar</a>

						</div>
				

					{{--  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">        
            			<div class="content">         
            				<img src="{{ asset('./img/grafico.jpg') }}" style="width: 200px; height: 200px; border: 2px solid black">
      					</div>
      				</div>--}}
		</form>
@endsection


@section('js')

<script>


   $("#razon_social").on("keypress", function ()
       {
       $input=$(this);
       setTimeout(function () {
        $input.val($input.val().toUpperCase());
       },50);
      });

  $("#apellidos").on("keypress", function ()
       {
       $input=$(this);
       setTimeout(function () {
        $input.val($input.val().toUpperCase());
       },50);
      });

  $("#domicilio").on("keypress", function ()
       {
       $input=$(this);
       setTimeout(function () {
        $input.val($input.val().toUpperCase());
       },50);
      });

$("#cuit").on('focusout', function (e) {
    console.log($('input[name="cuit"]').val());
    var check = isValidCuit($('input[name="cuit"]').val());
    if (check == false) {
        //$('#btnAdd').attr("disabled",true)
        $('#errorCuit').attr("hidden",false);
        $("#cuit").focus();
    } else {
        $('#btnAdd').attr("disabled",false)
        $('#errorCuit').attr("hidden",true);
    }
});

function isValidCuit(cuit) {
    //si el largo del cuit es incorrecto salir de la funcion
    if (cuit.length != 11) return 0;
    var rv = false;
    var resultado = 0;
    var cuit_nro = cuit.replace("-", "");
    var codes = "6789456789";
    var cuit_long = parseInt(cuit_nro);
    var verificador = parseInt(cuit_nro[cuit_nro.length - 1]);
    var x = 0;
    while (x < 10) {
        var digitoValidador = parseInt(codes.substring(x, x + 1));
        if (isNaN(digitoValidador)) digitoValidador = 0;
        var digito = parseInt(cuit_nro.substring(x, x + 1));
        if (isNaN(digito)) digito = 0;
        var digitoValidacion = digitoValidador * digito;
        resultado += digitoValidacion;
        x++;
    }
    resultado = resultado % 11;
    rv = (resultado == verificador);
    return rv;
}
</script>

@endsection



