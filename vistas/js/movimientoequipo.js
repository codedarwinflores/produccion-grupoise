/* COLOCACION DE ICONOS */
$(document).ready(function(){



	/* CORRELATIVO PLANILLA */
			/* *********** */
			var dataString = 'accion01=correlativo';
			$.ajax({
				data: dataString,
				url: "ajax/extramovimientoequipo.ajax.php",
				type: 'post',
				success: function (response) {
					$("#nuevocorrelativo_movimiento").val(response);
				}
			});
			/* *********** */

		/* ****CAPTURO LA FECHA ACTUAL */
		const today = new Date();
		const yyyy = today.getFullYear();
		let mm = today.getMonth() + 1; // Months start at 0!
		let dd = today.getDate();
		if (dd < 10) dd = '0' + dd;
		if (mm < 10) mm = '0' + mm;
		const formattedToday = dd + '-' + mm + '-' + yyyy;
		const formatosql = yyyy + '-' + mm + '-' +dd ;
		/* **************** */
		$("#nuevofecha_ingreso_movimiento").val(formattedToday);
		  
		$(".input_codigo_equipo").attr("disabled","disabled");
 })

 $( ".input_codigo_equipo" ).change(function(){ 

	
	var codigo = $(this).val();
	var tipoequipo = $('option:selected', this).attr('tipoequipo');
	var marca = $('option:selected', this).attr('marca');
	var modelo = $('option:selected', this).attr('modelo');
	var serie = $('option:selected', this).attr('serie');
	$(".marca").val(marca);
	$(".modelo").val(modelo);
	$(".serie").val(serie);
	var diferencia_arma=$(".input_diferencia_armas_movimiento").val();
	var diferencia_radio=$(".input_diferencia_radios_movimiento").val();

	if(tipoequipo=="arma"){
		if(diferencia_arma==0){
			swal({
				title: 'Alerta',
				text: "Ubicación esta al limite de arma. Por favor cambiar ubicacion",
				type: 'warning'
			})
			$(".guardardata").attr("disabled","disabled");
			$(".guardarproducto").attr("style","display:none");
		}
		else{
			$(".guardardata").removeAttr("disabled");
			$(".guardarproducto").removeAttr("style");
		}
	}
	
	if(tipoequipo=="radio"){
		if(diferencia_radio==0){
			swal({
				title: 'Alerta',
				text: "Ubicación esta al limite de radio. Por favor cambiar ubicacion",
				type: 'warning'
			})
			$(".guardardata").attr("disabled","disabled");
			$(".guardarproducto").attr("style","display:none");
		}
		else{
			$(".guardardata").removeAttr("disabled");
			$(".guardarproducto").removeAttr("style");
		}
	}

	if(tipoequipo!="radio" && tipoequipo!="arma"){
		$(".guardardata").removeAttr("disabled");
		$(".guardarproducto").removeAttr("style");
	};
	/* *********** */
		var dataString = 'codigo='+codigo+
						 '&accion01=ubicacion';
		$.ajax({
			data: dataString,
			url: "ajax/extramovimientoequipo.ajax.php",
			type: 'post',
			success: function (response) {
				$(".ubicacion_actual").val(response)
			}
		});
		/* *********** */
});

$( ".input_id_ubicacion_movimiento" ).change(function(){ 

	$(".guardardata").removeAttr("disabled");
	$(".input_codigo_equipo").removeAttr("disabled");
	var id=$(this).val();
	var cantidad_armas = $('option:selected', this).attr('cantidad_armas');
	var cantidad_radios = $('option:selected', this).attr('cantidad_radios');
	

	
	$("#armasautorizadas").val(cantidad_armas);
	$("#radiosautorizadas").val(cantidad_radios);

	
		/* *********** */
		var dataString = 'idubicacion='+id+
						 '&accion01=cantidades';
		$.ajax({
			data: dataString,
			url: "ajax/extramovimientoequipo.ajax.php",
			type: 'post',
			success: function (response) {

				

				var arma = response.split(',')[0]; // armas
				var radio = response.split(',')[1]; // radio

				$(".input_armas_asig_movimiento").val(arma);
				$(".input_radios_asign_movimiento").val(radio);

				var diferencia_arma=parseFloat(cantidad_armas)-parseFloat(arma);
				var diferencia_radio=parseFloat(cantidad_radios)-parseFloat(radio);
				$(".input_diferencia_armas_movimiento").val(diferencia_arma);
				$(".input_diferencia_radios_movimiento").val(diferencia_radio);

				
			}
		});
		/* *********** */
		vaciar();

});
	

/* añadimos producto a la tabla */

var recuperar="";
$('.guardarproducto').on('click',function(){

    var input_codigo_equipo=$(".input_codigo_equipo").val();
    var capturar_data=$('option:selected', ".input_codigo_equipo").text();
    var nombre_equipo=capturar_data.split('-')[1]; // armas
    var cantidad_equipo="1";
    var precio_equipo=$('option:selected', ".input_codigo_equipo").attr('precio');
    var tipo=$('option:selected', ".input_codigo_equipo").attr('tipoequipo');
    var total_equipo=parseFloat(precio_equipo)*1;
    var ubicacion=$(".ubicacion_actual").val();

	var diferencia_arma=$(".input_diferencia_armas_movimiento").val();
	var diferencia_radio=$(".input_diferencia_radios_movimiento").val();


	var arma=$(".input_armas_asig_movimiento").val();
	var radio=$(".input_radios_asign_movimiento").val();
	
	if(tipo=="arma"){
		restar_diferencia=parseFloat(diferencia_arma)-1;
		$(".input_diferencia_armas_movimiento").val(restar_diferencia);
		$(".input_armas_asig_movimiento").val(parseFloat(arma)+1);

	}
	if(tipo=="radio"){
		restar_diferencia_radio=parseFloat(diferencia_radio)-1;
		$(".input_diferencia_radios_movimiento").val(restar_diferencia_radio);
		$(".input_radios_asign_movimiento").val(parseFloat(radio)+1);

	}

	var comparar=0;
if (recuperar.indexOf(input_codigo_equipo) !== -1) {
	comparar=1;
  } else {
	comparar=0;
  }
  var table="";
  if(comparar==1){
	swal({
		title: 'Alerta',
		text: "El arma ya esta agregada",
		type: 'warning'
	})
  }
  else{
    recuperar=recuperar+" , "+input_codigo_equipo;

	table="<tr class='datos'>"+
				"<td>"+input_codigo_equipo+"</td>"+
				"<td>"+nombre_equipo+"</td>"+
				"<td>"+cantidad_equipo+"</td>"+
				"<td>"+precio_equipo+"</td>"+
				"<td>"+total_equipo+"</td>"+
				"<td>"+tipo+"</td>"+
				"<td>"+ubicacion+"</td>"+
				"<td>"+"<div class='btn btn-danger quitarlista"+input_codigo_equipo+"'><i class='fa fa-times'></i></div>"+"</td>"+
				"</tr>";
	}
	if(nombre_equipo=="undefined"){

	}else{
		$("#añadirequipo").append(table);
	}
	/* ****** */

	$(".productos").on("click", ".quitarlista"+input_codigo_equipo+"", function(){

		var tipo= $(this).closest('tr').find('td').eq(5).html();
		var diferencia_arma=$(".input_diferencia_armas_movimiento").val();
		var diferencia_radio=$(".input_diferencia_radios_movimiento").val();
			
		var arma01=$(".input_armas_asig_movimiento").val();
		var radio01=$(".input_radios_asign_movimiento").val();

		if(tipo=="arma"){
			restar_diferencia=parseFloat(diferencia_arma)+1;
			$(".input_diferencia_armas_movimiento").val(restar_diferencia);
			var calculoarma=parseFloat(arma01)-1;
			if(calculoarma < 0){
				calculoarma=0;
			}
			$(".input_armas_asig_movimiento").val(calculoarma);
		}
		if(tipo=="radio"){
			restar_diferencia_radio=parseFloat(diferencia_radio)+1;
			$(".input_diferencia_radios_movimiento").val(restar_diferencia_radio);
			var calculoradio=parseFloat(radio01)-1;
			if(calculoradio < 0){
				calculoradio=0;
			}
			$(".input_radios_asign_movimiento").val(calculoradio);
		}

		$(this).closest('tr').remove();

	
	
	});
	/* ******* */
	vaciar();
	
});

 
function vaciar(){
	$(".input_codigo_equipo").val("");
	$(".input_codigo_equipo").val("").trigger('change.select2');;
    $(".marca").val("");
    $(".modelo").val("");
    $(".serie").val("");
    $(".ubicacion_actual").val("");
}

$('.guardardata').on('click',function(){
	agregar();

})

function agregar(){

	$('#añadirequipo tr').each(function () {
		var id=$("#id").val();
		var correlativo_movimiento=$("#nuevocorrelativo_movimiento").val();
		var fecha_ingreso_movimiento=$("#nuevofecha_ingreso_movimiento").val();
		var fecha_movimiento=$("#nuevofecha_movimiento").val();
		var id_transaccion_movimiento=$("#nuevoid_transaccion_movimiento").val();
		var id_ubicacion_movimiento=$("#nuevoid_ubicacion_movimiento").val();
		var armas_asig_movimiento=$("#nuevoarmas_asig_movimiento").val();
		var diferencia_armas_movimiento=$("#nuevodiferencia_armas_movimiento").val();
		var radios_asign_movimiento=$("#nuevoradios_asign_movimiento").val();
		var diferencia_radios_movimiento=$("#nuevodiferencia_radios_movimiento").val();
		var codigo_equipo= $(this).find('td').eq(0).html();
		var tipoequipo	 = $(this).find('td').eq(5).html();

		var dataString = 'id=' +$.trim(id) +
						 '&correlativo_movimiento=' +$.trim(correlativo_movimiento) +
						 '&fecha_ingreso_movimiento=' +$.trim(fecha_ingreso_movimiento) +
						 '&fecha_movimiento=' +$.trim(fecha_movimiento) +
						 '&id_transaccion_movimiento=' +$.trim(id_transaccion_movimiento) +
						 '&id_ubicacion_movimiento=' +$.trim(id_ubicacion_movimiento) +
						 '&armas_asig_movimiento=' +$.trim(armas_asig_movimiento) +
						 '&diferencia_armas_movimiento=' +$.trim(diferencia_armas_movimiento) +
						 '&radios_asign_movimiento=' +$.trim(radios_asign_movimiento) +
						 '&diferencia_radios_movimiento=' +$.trim(diferencia_radios_movimiento) +
						 '&codigo_equipo=' +$.trim(codigo_equipo)+
						 '&tipoequipo=' +$.trim(tipoequipo)+
						 '&accion01=insertar';

		$.ajax({
			data: dataString,
			url: "ajax/extramovimientoequipo.ajax.php",
		 	type: "POST",
			success: function (response) {
				console.log(response);
			
				/* *************** */
				swal({
					type: "success",
					title: "Guardado con Exito",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
		
				}).then(function (result) {
					if (result.value) {
						/* window.location = "situacion"; */
						location.reload();
					}
				});
				/* **************** */

			}
		});
	});

}

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarmovimientosequipos", function(){

	var idmovimientosequipos = $(this).attr("idmovimientosequipos");
	var datos = new FormData();
	datos.append("idmovimientosequipos", idmovimientosequipos);
	$.ajax({
		url:"ajax/movimientoequipo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

		$("#id").val(respuesta["id"]);
		$("#nuevocorrelativo_movimiento").val(respuesta["correlativo_movimiento"]);
		$("#nuevofecha_ingreso_movimiento").val(respuesta["fecha_ingreso_movimiento"]);
		$("#nuevofecha_movimiento").val(respuesta["fecha_movimiento"]);
		$("#nuevoid_transaccion_movimiento").val(respuesta["id_transaccion_movimiento"]);
		$("#nuevoid_ubicacion_movimiento").val(respuesta["id_ubicacion_movimiento"]);
		$("#nuevoarmas_asig_movimiento").val(respuesta["armas_asig_movimiento"]);
		$("#nuevodiferencia_armas_movimiento").val(respuesta["diferencia_armas_movimiento"]);
		$("#nuevoradios_asign_movimiento").val(respuesta["radios_asign_movimiento"]);
		$("#nuevodiferencia_radios_movimiento").val(respuesta["diferencia_radios_movimiento"]);

		


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
	    url:"ajax/movimientosequipos.ajax.php",
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
$(".tablas").on("click", ".btnEliminarmovimientosequipos", function(){

  var idmovimientosequipos = $(this).attr("idmovimientosequipos");
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

      window.location = "index.php?ruta=movimientoequipo&idmovimientosequipos="+idmovimientosequipos+"&Codigo="+Codigo;

    }

  })

})




