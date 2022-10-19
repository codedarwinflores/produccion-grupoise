/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".ubicacioninput_id").removeAttr("required");

	$(".eubicacioncgrupo_id_cliente").css("visibility","hidden");

	/* if($(".ubicacioninput_email_contacto").val().indexOf('@', 0) == -1 || $(".ubicacioninput_email_contacto").val().indexOf('.', 0) == -1) {
		alert('El correo electrónico introducido no es correcto.');
		return false;
	} */
	modificacioninicial();
	
	$(".icono_codigo_cliente").addClass("fa fa-qrcode");
   $(".ubicacioninput_codigo_cliente").attr("placeholder", texto+" Código Cliente");

   $(".icono_id_coordinador_zona").addClass("fa  fa-user-circle-o   ");
   $(".ubicacioninput_id_coordinador_zona").attr("placeholder", texto+" ID Coordinador Zona");

   $(".icono_nombre_ubicacion").addClass("fa fa-map-marker");
   $(".ubicacioninput_nombre_ubicacion").attr("placeholder", texto+" Nombre Ubicacion");

   $(".icono_latitude").addClass("fa fa-map");
   $(".ubicacioninput_latitude").attr("placeholder", texto+" Latitud ");

   $(".icono_longitude").addClass("fa fa-map-o");
   $(".ubicacioninput_longitude").attr("placeholder", texto+" Longitud");

   $(".icono_direccion").addClass("fa fa-map-marker");
   $(".ubicacioninput_direccion").attr("placeholder", texto+" Dirección");

   $(".icono_persona_contacto").addClass("fa fa-male");
   $(".ubicacioninput_persona_contacto").attr("placeholder", texto+" Persona Contacto");

   $(".icono_telefono_contacto").addClass("fa fa-mobile");
   $(".ubicacioninput_telefono_contacto").attr("placeholder", texto+" Teléfono Contacto");

   $(".icono_email_contacto").addClass("fa fa-envelope");
   $(".ubicacioninput_email_contacto").attr("placeholder", texto+" Email");

   $(".icono_cantidad_armas").addClass("fa fa-list-ol");
   $(".ubicacioninput_cantidad_armas").attr("placeholder", texto+" Cantidad de Armas");

   $(".icono_cantidad_radios").addClass("fa fa-list-ol");
   $(".ubicacioninput_cantidad_radios").attr("placeholder", texto+" Cantidad de Radios");

   $(".icono_cantidad_celulares").addClass("fa fa-list-ol");
   $(".ubicacioninput_cantidad_celulares").attr("placeholder", texto+" Cantidad de Celulares");

   $(".icono_bonos").addClass("fa fa-money");
   $(".ubicacioninput_bonos").attr("placeholder", texto+" Bonos");

   $(".icono_visitas").addClass("fa fa-plane");
   $(".ubicacioninput_visitas").attr("placeholder", texto+" Visitas");

   $(".icono_zona").addClass("fa fa-map-marker");
   $(".ubicacioninput_zona").attr("placeholder", texto+" Zona");

   $(".icono_rubro").addClass("fa fa-bars");
   $(".ubicacioninput_rubro").attr("placeholder", texto+" Rubro");

   $(".icono_fecha_inicio").addClass("fa fa-calendar");
   $(".ubicacioninput_fecha_inicio").attr("placeholder", texto+" Fecha de Inicio");

   $(".icono_fecha_fin").addClass("fa fa-calendar");
   $(".ubicacioninput_fecha_fin").attr("placeholder", texto+" Fecha de Fin");

   $(".icono_horas_permitidas").addClass("fa fa-clock-o");
   $(".ubicacioninput_horas_permitidas").attr("placeholder", texto+" Horas Permitidas");

   $(".icono_observaciones_generales").addClass("fa fa-eye");
   $(".ubicacioninput_observaciones_generales").attr("placeholder", texto+" Observaciones");

   $(".icono_fecha_ultimo_inventario").addClass("fa fa-calendar");
   $(".ubicacioninput_fecha_ultimo_inventario").attr("placeholder", texto+" Fecha de Ultimo Inventario");

   $(".icono_hombres_autorizados").addClass("fa fa-male");
   $(".ubicacioninput_hombres_autorizados").attr("placeholder", texto+" Hombres Autorizados");
	
   


 })

 function modificacioninicial(){
	
	$(".ubicacioninput_email_contacto").get(0).type = 'email';
	$(".ubicacioninput_id_coordinador_zona").get(0).type = 'number';
	$(".ubicacioninput_cantidad_armas").get(0).type = 'number';
	$(".ubicacioninput_cantidad_celulares").get(0).type = 'number';
	$(".ubicacioninput_hombres_autorizados").get(0).type = 'number';
	

	$("#editaremail_contacto").get(0).type = 'email';
	$("#editarid_coordinador_zona").get(0).type = 'number';
	$("#editarcantidad_armas").get(0).type = 'number';
	$("#editarcantidad_celulares").get(0).type = 'number';
	$("#editarhombres_autorizados").get(0).type = 'number';
	


	$(".ubicacioncgrupo_id_cliente").empty();
	$('.ubicacioncgrupo_id_cliente').append($('.ubicacionc_s_cliente'));

	$(".ubicacioncgrupo_id_departamento").empty();
	$('.ubicacioncgrupo_id_departamento').append($('.ubicacionc_s_depa'));

	$(".ubicacioncgrupo_id_municipio").empty();
	$('.ubicacioncgrupo_id_municipio').append($('.ubicacionc_s_muni'));


	/* editar */
	$(".eubicacioncgrupo_id_cliente").empty();
	$('.eubicacioncgrupo_id_cliente').append($('.eubicacionc_s_cliente'));

	$(".eubicacioncgrupo_id_departamento").empty();
	$('.eubicacioncgrupo_id_departamento').append($('.eubicacionc_s_depa'));

	$(".eubicacioncgrupo_id_municipio").empty();
	$('.eubicacioncgrupo_id_municipio').append($('.eubicacionc_s_muni'));


	
	
	/* QUITAR NAME A INPUT */
	$(".nuevoubicacioninput_fecha_inicio").attr("name","");
	$(".nuevoubicacioninput_fecha_fin").attr("name", "");
	$(".nuevoubicacioninput_fecha_ultimo_inventario").attr("name", "");

	
	/* AÑADIR CALENDARIO INPUT */
	$(".nuevoubicacioninput_fecha_inicio").addClass("calendario");
	$(".nuevoubicacioninput_fecha_fin").addClass("calendario");
	$(".nuevoubicacioninput_fecha_ultimo_inventario").addClass("calendario");

	
	/* QUITAR NAME A INPUT */
	$(".ubicacioninput_fecha_inicio").attr("name","");
	$(".ubicacioninput_fecha_fin").attr("name", "");
	$(".ubicacioninput_fecha_ultimo_inventario").attr("name", "");

	
	/* AÑADIR CALENDARIO INPUT */
	$(".ubicacioninput_fecha_inicio").addClass("calendario");
	$(".ubicacioninput_fecha_fin").addClass("calendario");
	$(".ubicacioninput_fecha_ultimo_inventario").addClass("calendario");
	
	
	/* AÑADIR ATRIBUTO FECHA A INPUT */
	$(".nuevoubicacioninput_fecha_inicio").attr("fecha","nuevofechainicio");
	$(".nuevoubicacioninput_fecha_fin").attr("fecha", "nuevofechafin");
	$(".nuevoubicacioninput_fecha_ultimo_inventario").attr("fecha", "nuevofechaultimo");

	
	/* AÑADIR ATRIBUTO FECHA A INPUT EDITAR */
	$("#editarfecha_inicio").attr("fecha","fechainicio");
	$("#editarfecha_fin").attr("fecha", "fechafin");
	$("#editarfecha_ultimo_inventario").attr("fecha", "fechaultimo");

	
	$(document).on('change', '.ubicacioncid_cliente', function(event) {
	
		cliente=$(".ubicacioncid_cliente option:selected").attr("codigo");
		
		$(".ubicacioninput_codigo_cliente").val(cliente);
	})

	
	/* LLENAR MUNICIPIO DEPENDE DEL DEPARTAMENTO */

	$(document).on('change', '.opciondepartamento', function(event) {
		/* $('#servicioSelecionado').val($("#servicio option:selected").text()); */
		var iddepartamento = $(".opciondepartamento option:selected").val();

		/* LLENAR MUNICIPIO */
		var datos = new FormData();
		datos.append("idmunicipios", iddepartamento);

		$.ajax({

			url:"ajax/municipio2.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){
				
				$("#nuevoid_municipio").html(respuesta);
				$("#editarid_municipio").empty();
				$("#editarid_municipio").html(respuesta);
			
				



			}

		});

   });

   
	$(document).on('change', '.eopciondepartamento', function(event) {
		/* $('#servicioSelecionado').val($("#servicio option:selected").text()); */
		var iddepartamento = $(".eopciondepartamento option:selected").val();

		/* LLENAR MUNICIPIO */
		var datos = new FormData();
		datos.append("idmunicipios", iddepartamento);

		$.ajax({

			url:"ajax/municipio2.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){
				
				$("#nuevoid_municipio").html(respuesta);
				$("#editarid_municipio").empty();
				$("#editarid_municipio").html(respuesta);
			
				



			}

		});

   });


 }

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarubicacionc", function(){

		/* modificacioninicial(); */
	var idubicacionc = $(this).attr("idubicacionc");
	
	var datos = new FormData();
	datos.append("idubicacionc", idubicacionc);

	$.ajax({

		url:"ajax/ubicacionc.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){


			
	/* ********** */

	
	/* ********** */
	
	var dateNEW = respuesta["fecha_inicio"];
	var date = new Date(dateNEW);
	var year = date.toLocaleString("default", { year: "numeric" });
	var month = date.toLocaleString("default", { month: "2-digit" });
	var day = date.toLocaleString("default", { day: "2-digit" });
	var formattedDate = day + "-" + month + "-" + year;

	
	var dateNEW2 = respuesta["fecha_fin"];
	var date2 = new Date(dateNEW2);
	var year2 = date2.toLocaleString("default", { year: "numeric" });
	var month2 = date2.toLocaleString("default", { month: "2-digit" });
	var day2 = date2.toLocaleString("default", { day: "2-digit" });
	var formattedDate2 = day2 + "-" + month2 + "-" + year2;

	
	var dateNEW3 = respuesta["fecha_ultimo_inventario"];
	var date3 = new Date(dateNEW3);
	var year3 = date3.toLocaleString("default", { year: "numeric" });
	var month3 = date3.toLocaleString("default", { month: "2-digit" });
	var day3 = date3.toLocaleString("default", { day: "2-digit" });
	var formattedDate3 = day3 + "-" + month3 + "-" + year3;

	
	$("#editarfecha_inicio").val(formattedDate);
	$("#editarfecha_fin").val(formattedDate2);
	$("#editarfecha_ultimo_inventario").val(formattedDate3);

	$("#inputeditarfecha_inicio").val(respuesta["fecha_inicio"]);
	$("#inputeditarfecha_fin").val(respuesta["fecha_fin"]);
	$("#inputeditarfecha_ultimo_inventario").val(respuesta["fecha_ultimo_inventario"]);





			$("#editarid").val(respuesta["idubicacionc"]);
			$("#editarid_cliente").val(respuesta["id_cliente"]);
			$("#editarcodigo_cliente").val(respuesta["codigo_cliente"]);
			$("#editarid_coordinador_zona").val(respuesta["id_coordinador_zona"]);
			$("#editarnombre_ubicacion").val(respuesta["nombre_ubicacion"]);
			$("#editarlatitude").val(respuesta["latitude"]);
			$("#editarlongitude").val(respuesta["longitude"]);
			$("#editardireccion").val(respuesta["direccion"]);
			$("#editarpersona_contacto").val(respuesta["persona_contacto"]);
			$("#editartelefono_contacto").val(respuesta["telefono_contacto"]);
			$("#editaremail_contacto").val(respuesta["email_contacto"]);
			$("#editarcantidad_armas").val(respuesta["cantidad_armas"]);
			$("#editarcantidad_radios").val(respuesta["cantidad_radios"]);
			$("#editarcantidad_celulares").val(respuesta["cantidad_celulares"]);
			$("#editarbonos").val(respuesta["bonos"]);
			$("#editarvisitas").val(respuesta["visitas"]);
			$("#editarzona").val(respuesta["zona"]);
			$("#editarrubro").val(respuesta["rubro"]);
			$("#editarhoras_permitidas").val(respuesta["horas_permitidas"]);
			$("#editarid_departamento").val(respuesta["iddepartamento"]);
			$("#editarid_municipio").val(respuesta["id_municipio"]);

			$("#editarobservaciones_generales").val(respuesta["observaciones_generales"]);
			$("#editarhombres_autorizados").val(respuesta["hombres_autorizados"]);



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
	    url:"ajax/ubicacionc.ajax.php",
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
$(".tablas").on("click", ".btnEliminarubicacionc", function(){

  var idubicacionc = $(this).attr("idubicacionc");
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

      window.location = "index.php?ruta=ubicacionc&idubicacionc="+idubicacionc+"&Codigo="+Codigo;

    }

  })

})




