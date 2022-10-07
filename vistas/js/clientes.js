/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");;



	$(".icono_fecha_apertura").addClass("fa fa-calendar");
	$(".input_fecha_apertura").addClass("calendario");
	$(".input_fecha_apertura").attr("placeholder", texto+" Fecha Apertura");
	$(".input_fecha_apertura").attr("name", "");

	

	



	
	$(".icono_codigo").addClass("fa  fa-qrcode");
	$(".input_codigo").attr("placeholder", texto+" Código");

	
	$(".icono_nombre").addClass("fa  fa-id-card");
	$(".input_nombre").attr("placeholder", texto+" Nombre");

	
	$(".icono_nit").addClass("fa fa-address-card");
	$(".input_nit").attr("placeholder", texto+" NIT");
	$(".input_nit").get(0).type = 'number';
	$("#editarnit").get(0).type = 'number';

	
	$(".icono_nrc").addClass("fa  fa-id-card");
	$(".input_nrc").attr("placeholder", texto+" NRC");
	$(".input_nrc").get(0).type = 'number';
	$("#editarnrc").get(0).type = 'number';

	
	$(".icono_nombre_registro").addClass("fa fa-id-card");
	$(".input_nombre_registro").attr("placeholder", texto+" Nombre Registro");

	
	$(".icono_giro").addClass("fa  fa-refresh");
	$(".input_giro").attr("placeholder", texto+" Giro");

	
	$(".icono_contribuyente").addClass("fa fa-id-card");
	$(".input_contribuyente").attr("placeholder","¿Es contribuyente?");

	$(".input_contribuyente").keydown(function(e){
        e.preventDefault();
    });

	$('.input_contribuyente').click(function(){
		$(".myDropdown_clientes_contribuyente").css("display", "block");
	});

	$('.select_contribuyente').click(function(){
		var contribuyente = $(this).attr("contribuyente");
		$(".input_contribuyente").val(contribuyente);
		$(".myDropdown_clientes_contribuyente").css("display", "none");
		
	});
	

	
	$(".icono_clasificacion").addClass("fa  fa-list-ol");
	$(".input_clasificacion").attr("placeholder", texto+" Clasificación");

	
	$(".input_clasificacion").keydown(function(e){
        e.preventDefault();
    });

	$('.input_clasificacion').click(function(){
		$(".myDropdown_clientes_clasificacion").css("display", "block");
	});

	$('.select_clasificacion').click(function(){
		var clasificacion = $(this).attr("clasificacion");
		$(".input_clasificacion").val(clasificacion);
		$(".myDropdown_clientes_clasificacion").css("display", "none");
		
	});

	
	$(".icono_tipo_cliente").addClass("fa fa-user");
	$(".input_tipo_cliente").attr("placeholder", texto+" Tipo Cliente");

	$(".input_tipo_cliente").keydown(function(e){
        e.preventDefault();
    });

	$('.input_tipo_cliente').click(function(){
		$(".myDropdown_tipo_cliente").css("display", "block");
	});

	$('.select_tipo_cliente').click(function(){
		var tipo_cliente = $(this).attr("tipo_cliente");
		$(".input_tipo_cliente").val(tipo_cliente);
		$(".myDropdown_tipo_cliente").css("display", "none");
		
	});

	
	$(".icono_correo_electronico").addClass("fa fa-envelope");
	$(".input_correo_electronico").attr("placeholder", texto+" Email");
	$(".input_correo_electronico").get(0).type = 'email';
	$("#editarcorreo_electronico").get(0).type = 'email';


	
	$(".icono_direccion").addClass("fa  fa-map-marker");
	$(".input_direccion").attr("placeholder", texto+" Dirección");

	
	$(".icono_telefono_1").addClass("fa fa-phone");
	$(".input_telefono_1").attr("placeholder", texto+" Telefono 1");
	$(".input_telefono_1").get(0).type = 'number';
	$("#editartelefono_1").get(0).type = 'number';
	

	
	$(".icono_telefono_2").addClass("fa fa-phone");
	$(".input_telefono_2").attr("placeholder", texto+" Telefono 2");
	$(".input_telefono_2").get(0).type = 'number';
	$("#editartelefono_2").get(0).type = 'number';

	
	$(".icono_fax").addClass("fa fa-fax");
	$(".input_fax").attr("placeholder", texto+" FAX");
	$(".input_fax").get(0).type = 'number';
	$("#editarfax").get(0).type = 'number';

	
	$(".icono_contacto").addClass("fa fa-mobile");
	$(".input_contacto").attr("placeholder", texto+" Contacto");

	
	$(".icono_id_pais").addClass("fa fa-globe");
	$(".input_id_pais").attr("placeholder", texto+" Pais");
	$(".input_id_pais").attr("name","");

	$(".input_id_pais").keydown(function(e){
        e.preventDefault();
    });

	$('.input_id_pais').click(function(){
		$(".myDropdown_pais").css("display", "block");
	});

	$('.select_pais').click(function(){
		var nombrepais = $(this).attr("nombrepais");
		var idpais = $(this).attr("idpais");

		$(".input_id_pais").val(nombrepais);
		$(".id_pais").val(idpais);

		$(".myDropdown_pais").css("display", "none");
		
	});


	
	$(".icono_id_departamento").addClass("fa  fa-map-marker");
	$(".input_id_departamento").attr("placeholder", texto+" Departamento");
	$(".input_id_departamento").attr("name","");

	$(".input_id_departamento").keydown(function(e){
        e.preventDefault();
    });

	$('.input_id_departamento').click(function(){
		$(".myDropdown_departamento").css("display", "block");
	});

	$('.select_departamento').click(function(){
		var nombredepartamento = $(this).attr("nombredepartamento");
		var iddepartamento = $(this).attr("iddepartamento");

		$(".input_id_departamento").val(nombredepartamento);
		$(".id_departamento").val(iddepartamento);

		$(".myDropdown_departamento").css("display", "none");

		/* LLENAR MUNICIPIO */
		var datos = new FormData();
	datos.append("idmunicipios", iddepartamento);

	$.ajax({

		url:"ajax/municipio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#municipio").html(respuesta);
			$("#municipio2").html(respuesta);
			pasar_muni();
			



		}

	});




		
	});

	
	$(".icono_id_municipio").addClass("fa  fa-map-marker");
	$(".input_id_municipio").attr("placeholder", texto+" Municipio");
	$(".input_id_municipio").attr("name","");

	$(".input_id_municipio").keydown(function(e){
        e.preventDefault();
    });

	$('.input_id_municipio').click(function(){
		$(".myDropdown_municipio").css("display", "block");
	});
	pasar_muni();
	
	
	$(".icono_limite_credito").addClass("fa  fa-times-circle-o");
	$(".input_limite_credito").attr("placeholder", texto+" Límite Crédito");
	$(".input_limite_credito").get(0).type = 'number';
	$("#editarlimite_credito").get(0).type = 'number';

	
	$(".icono_plazo").addClass("fa  fa-times-circle-o");
	$(".input_plazo").attr("placeholder", texto+" Plazo");
	$(".input_plazo").get(0).type = 'number';
	$("#editarplazo").get(0).type = 'number';


	
	$(".icono_observaciones").addClass("fa fa-search");
	$(".input_observaciones").attr("placeholder", texto+" Observaciones");

	
	$(".icono_cuenta_contable").addClass("fa  fa-pencil-square-o");
	$(".input_cuenta_contable").attr("placeholder", texto+" Cuenta Contable");

	

/* 	$(".icono_personal_asignado").addClass("fa fa-user");
	$(".input_personal_asignado").attr("placeholder", texto+" Personal Asignado");
	$(".input_personal_asignado").get(0).type = 'number';
 */

 })

 function pasar_muni(){
	$('.select_municipio').click(function(){

		var nombremunicipio = $(this).attr("nombremunicipio");
		var idmunicipio = $(this).attr("idmunicipio");

		$(".input_id_municipio").val(nombremunicipio);
		$(".id_municipio").val(idmunicipio);

		$(".myDropdown_municipio").css("display", "none");
		
	});
	}

 document.addEventListener("mouseup", function(event) {

    var obj = document.getElementById("contribuyente");
    if (!obj.contains(event.target)) {
		$(".myDropdown_clientes_contribuyente").css("display", "none");
    }
    else {
       
    }

	var obj = document.getElementById("clasificacion");
    if (!obj.contains(event.target)) {
		$(".myDropdown_clientes_clasificacion").css("display", "none");
    }
    else {
       
    }

	
	var obj = document.getElementById("tipo_cliente");
    if (!obj.contains(event.target)) {
		$(".myDropdown_tipo_cliente").css("display", "none");
    }
    else {
       
    }

	
	var obj = document.getElementById("pais");
    if (!obj.contains(event.target)) {
		$(".myDropdown_pais").css("display", "none");
    }
    else {
       
    }

		
	var obj = document.getElementById("departamento");
    if (!obj.contains(event.target)) {
		$(".myDropdown_departamento").css("display", "none");
    }
    else {
       
    }

	var obj = document.getElementById("municipio");
    if (!obj.contains(event.target)) {
		$(".myDropdown_municipio").css("display", "none");
    }
    else {
       
    }


	/* *****EDITAR****** */

	
    var obj = document.getElementById("contribuyente2");
    if (!obj.contains(event.target)) {
		$(".myDropdown_clientes_contribuyente").css("display", "none");
    }
    else {
       
    }

	var obj = document.getElementById("clasificacion2");
    if (!obj.contains(event.target)) {
		$(".myDropdown_clientes_clasificacion").css("display", "none");
    }
    else {
       
    }

	
	var obj = document.getElementById("tipo_cliente2");
    if (!obj.contains(event.target)) {
		$(".myDropdown_tipo_cliente").css("display", "none");
    }
    else {
       
    }

	
	var obj = document.getElementById("pais2");
    if (!obj.contains(event.target)) {
		$(".myDropdown_pais").css("display", "none");
    }
    else {
       
    }

		
	var obj = document.getElementById("departamento2");
    if (!obj.contains(event.target)) {
		$(".myDropdown_departamento").css("display", "none");
    }
    else {
       
    }

	var obj = document.getElementById("municipio2");
    if (!obj.contains(event.target)) {
		$(".myDropdown_municipio").css("display", "none");
    }
    else {
       
    }


});


/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarclientes", function(){

	
	var idclientes = $(this).attr("idclientes");
	
	var datos = new FormData();
	datos.append("idclientes", idclientes);

	$.ajax({

		url:"ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["clienteid"]);

			var dateNEW = respuesta["fecha_apertura"];
			var date = new Date(dateNEW);

			// Get year, month, and day part from the date
			var year = date.toLocaleString("default", { year: "numeric" });
			var month = date.toLocaleString("default", { month: "2-digit" });
			var day = date.toLocaleString("default", { day: "2-digit" });

			// Generate yyyy-mm-dd date string
			var formattedDate = day + "-" + month + "-" + year;

			$(".editarfecha_apertura2").val(respuesta["fecha_apertura"]);
			$("#editarfecha_apertura").val(formattedDate);


			$("#editarcodigo").val(respuesta["clientecodigo"]);
			$("#editarnombre").val(respuesta["clientenombre"]);
			$("#editarnit").val(respuesta["nit"]);
			$("#editarnrc").val(respuesta["nrc"]);
			$("#editarnombre_registro").val(respuesta["nombre_registro"]);
			$("#editargiro").val(respuesta["giro"]);
			$("#editarcontribuyente").val(respuesta["contribuyente"]);
			$("#editarclasificacion").val(respuesta["clasificacion"]);
			$("#editartipo_cliente").val(respuesta["tipo_cliente"]);
			$("#editarcorreo_electronico").val(respuesta["correo_electronico"]);
			$("#editardireccion").val(respuesta["direccion"]);
			$("#editartelefono_1").val(respuesta["telefono_1"]);
			$("#editartelefono_2").val(respuesta["telefono_2"]);
			$("#editarfax").val(respuesta["fax"]);
			$("#editarcontacto").val(respuesta["contacto"]);

			$("#idpais").val(respuesta["idpais"]);
			$("#iddepartamento").val(respuesta["departamentoid"]);
			$("#idmunicipio").val(respuesta["municipioid"]);


			
			$("#editarid_pais").val(respuesta["paisnombre"]);
			$("#editarid_departamento").val(respuesta["departamentonombre"]);
			$("#editarid_municipio").val(respuesta["Nombre_m"]);

			$("#editarlimite_credito").val(respuesta["limite_credito"]);
			$("#editarplazo").val(respuesta["plazo"]);
			$("#editarobservaciones").val(respuesta["observaciones"]);
			$("#editarcuenta_contable").val(respuesta["cuenta_contable"]);
			




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
	    url:"ajax/clientes.ajax.php",
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
$(".tablas").on("click", ".btnEliminarclientes", function(){

  var idclientes = $(this).attr("idclientes");
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

      window.location = "index.php?ruta=clientes&idclientes="+idclientes+"&Codigo="+Codigo;

    }

  })

})




