/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";


	/* ***************** */

	restaFechas = function(f1,f2)
	{
	var aFecha1 = f1.split('-'); 
	var aFecha2 = f2.split('-'); 
	var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
	var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
	var dif = fFecha2 - fFecha1;
	var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
	return dias+1;
	}


	$(".fechafinaldias").blur(function(){
		$( "#ic__datepicker-2" ).click(function() {
			var fechainicial = $(".fechainicialdias").val();
			var fechahasta = $(".fechafinaldias").val();

			$(".numerodias").val(restaFechas(fechainicial,fechahasta));
			

		  });
		});

		$(".editarfechafinaldias").blur(function(){
			$( "#ic__datepicker-4" ).click(function() {
				var fechainicial = $(".editarfechainicialdias").val();
				var fechahasta = $(".editarfechafinaldias").val();
	
				$("#editarnum_dias").val(restaFechas(fechainicial,fechahasta));
				
	
			  });
			});


	/* ***************** */

 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditardias_feriados", function(){

	
	var iddias_feriados = $(this).attr("iddias_feriados");
	
	var datos = new FormData();
	datos.append("iddias_feriados", iddias_feriados);

	$.ajax({

		url:"ajax/dias_feriados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarnum_dias").val(respuesta["num_dias"]);
			$("#editarfecha_desde").val(respuesta["fecha_desde"]);
			$("#editarfecha_hasta").val(respuesta["fecha_hasta"]);



		}

	});

})


/*=============================================
REVISAR SI  YA ESTÁ REGISTRADO
=============================================*/

$("#nuevonombre").change(function(){


	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarnombre", usuario);

	 $.ajax({
	    url:"ajax/dias_feriados.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevonombre").parent().after('<div class="alert alert-warning">Este registro ya existe en la base de datos</div>');

	    		$("#nuevonombre").val("");

	    	}

	    }

	})
})

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminardias_feriados", function(){

  var iddias_feriados = $(this).attr("iddias_feriados");
  var Codigo = $(this).attr("Codigo");

  swal({
    title: '¿Está seguro de borrar el registro?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=diasferiados&iddias_feriados="+iddias_feriados+"&Codigo="+Codigo;

    }

  })

})




