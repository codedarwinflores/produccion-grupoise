/* COLOCACION DE ICONOS */
$(document).ready(function(){

	 
	$(".cgrupo_fax").attr("style","visibility:hidden; height:0;");
	$(".clientes_input_fax").removeAttr("required");

	/* ************************ */

			$(".input_denominacion_cliente").removeAttr("required");
			$(".input_denominacion_cliente").attr("readonly","readonly");

			$(".input_nombre_representante_cliente").removeAttr("required");
			$(".input_nombre_representante_cliente").attr("readonly","readonly");

			$(".input_profecion_cliente").removeAttr("required");
			$(".input_profecion_cliente").attr("readonly","readonly");

			$(".input_domicilio_cliente").removeAttr("required");
			$(".input_domicilio_cliente").attr("readonly","readonly");

			$("#nuevodepartamento_representante_cliente").removeAttr("required");
			$("#nuevodepartamento_representante_cliente").attr("disabled","disabled");

			$(".input_dui_cliente").removeAttr("required");
			$(".input_dui_cliente").attr("readonly","readonly");

			$(".input_cargo_cliente").removeAttr("required");
			$(".input_cargo_cliente").attr("readonly","readonly");

			$(".input_vigencia_contrato").removeAttr("required");
			$(".input_vigencia_contrato").attr("readonly","readonly");


	/* ************************ */
	$(".cgrupo_departamento_representante_cliente").empty();
	$(".cgrupo_departamento_representante_cliente").append($(".departamento_legal_cliente"));

	$(".ecgrupo_departamento_representante_cliente").empty();
	$(".ecgrupo_departamento_representante_cliente").append($(".edepartamento_legal_cliente"));


	$(".clientes_input_vigencia_contrato").attr("readonly","readonly");

	$('#nuevoposee_contrato').on('change', function() {
		var valor = $(this).val();
		if(valor=="Si"){
			$(".clientes_input_vigencia_contrato").removeAttr("readonly");
		}
		else{
			$(".clientes_input_vigencia_contrato").attr("readonly","readonly");
		}
	  });

	  $('#editarposee_contrato').on('change', function() {
		var valor = $(this).val();
		if(valor=="Si"){
			$("#editarvigencia_contrato").removeAttr("readonly");
		}
		else{
			$("#editarvigencia_contrato").attr("readonly","readonly");
		}
	  });



	$(".input_estado_cliente").attr("type","hidden");
	$(".input_estado_cliente").val("Activo");
	$("#editarestado_cliente").val("Activo");

	$( ".input_nombre" ).blur(function() {

		var letra = $(this).val().charAt(0);

		var obtenercodigo = letra;
                   
		/* *** */
		
			 var datos = "obtenercodigo="+obtenercodigo;

			 $.ajax({
			   url:"ajax/generar_codigo_cliente.ajax.php",
			   method:"POST",
			   data: datos,
			   success:function(respuesta){
			   
				 /* alert(respuesta.replace(/["']/g, "")); */
				 /* alert(respuesta); */
			
				 $(".clientes_input_codigo").val(letra+respuesta);
				
			   }

			 })
	  /* *** */
	
		
	  });

	  	$(".cgrupo_vendedor").empty();
		$(".cgrupo_vendedor").append($(".empleadovendedor"));

		
		$(".ecgrupo_vendedor").empty();
		$(".ecgrupo_vendedor").append($(".updateempleadovendedor"));

		$(".vendedorselector").change(function () {	 
			var valor=$(this).val();
			
		});


		$(".cgrupo_dia_entrega_facturacion_cliente").empty();
		$(".cgrupo_dia_entrega_facturacion_cliente").append($(".diaentrega"));

		$(".ecgrupo_dia_entrega_facturacion_cliente").empty();
		$(".ecgrupo_dia_entrega_facturacion_cliente").append($(".editardiaentrega"));



		$(".cgrupo_dia_quedan_cliente").empty();
		$(".cgrupo_dia_quedan_cliente").append($(".diaquedan0"));

		$(".ecgrupo_dia_quedan_cliente").empty();
		$(".ecgrupo_dia_quedan_cliente").append($(".ediaquedan0"));



		/* ************* */
		$(".cgrupo_dia_cobro_cliente").empty();
		$(".cgrupo_dia_cobro_cliente").append($(".diacobro"));

		$(".ecgrupo_dia_cobro_cliente").empty();
		$(".ecgrupo_dia_cobro_cliente").append($(".ediacobro"));
		/* ************* */

		
	  	/* *********LABEL*********** */
		/*   $(".icono_dia_quedan_cliente").addClass("fa fa-file-excel-o");
		  $(".input_dia_quedan_cliente").addClass("calendario");
		  $(".input_dia_quedan_cliente").attr("placeholder","Ingresar Dia Quedan");
		  var input_dia_quedan_cliente  = $(".input_dia_quedan_cliente").attr("placeholder");
		  $(".clabel_dia_quedan_cliente").text(input_dia_quedan_cliente);
 */

		  	
	  	/* *********LABEL*********** */
		  $(".icono_dia_quedan_observacion_cliente").addClass("fa fa-file-excel-o");
		  $(".input_dia_quedan_observacion_cliente").attr("placeholder","Ingresar Dia quedan Observación");
		  var input_dia_quedan_observacion_cliente  = $(".input_dia_quedan_observacion_cliente").attr("placeholder");
		  $(".clabel_dia_quedan_observacion_cliente").text(input_dia_quedan_observacion_cliente);

		  /* *********LABEL*********** */
		/*   $(".icono_dia_cobro_cliente").addClass("fa fa-file-excel-o");
		  $(".input_dia_cobro_cliente").addClass("calendario");
		  $(".input_dia_cobro_cliente").attr("placeholder","Ingresar Dia Cobro");
		  var input_dia_cobro_cliente  = $(".input_dia_cobro_cliente").attr("placeholder");
		  $(".clabel_dia_cobro_cliente").text(input_dia_cobro_cliente); */




	  	/* *********LABEL*********** */
		  $(".icono_nombre_representante_cliente").addClass("fa fa-file-excel-o")
		  $(".input_nombre_representante_cliente").attr("placeholder","Ingresar Nombre Representante Legal");
		  var input_nombre_representante_cliente  = $(".input_nombre_representante_cliente").attr("placeholder");
		  $(".clabel_nombre_representante_cliente").text(input_nombre_representante_cliente);


		/* *********LABEL*********** */
		$(".icono_profecion_cliente").addClass("fa fa-file-excel-o")
		$(".input_profecion_cliente").attr("placeholder","Ingresar profesión de representante legal");
		var input_profecion_cliente  = $(".input_profecion_cliente").attr("placeholder");
		$(".clabel_profecion_cliente").text(input_profecion_cliente);


	
		/* *********LABEL*********** */
		$(".icono_domicilio_cliente").addClass("fa fa-file-excel-o")
		$(".input_domicilio_cliente").attr("placeholder","Ingresar domicilio de representante legal ");
		var input_domicilio_cliente  = $(".input_domicilio_cliente").attr("placeholder");
		$(".clabel_domicilio_cliente").text(input_domicilio_cliente);


			/* *********LABEL*********** */
		$(".icono_departamento_representante_cliente").addClass("fa fa-file-excel-o")
		$(".input_departamento_representante_cliente").attr("placeholder","Ingresar Departamento Representante Legal");
		var input_departamento_representante_cliente  = $(".input_departamento_representante_cliente").attr("placeholder");
		$(".clabel_departamento_representante_cliente").text(input_departamento_representante_cliente);
	
		/* *********LABEL*********** */
		$(".icono_dui_cliente").addClass("fa fa-file-excel-o");
		$(".input_dui_cliente").attr("placeholder","Ingresar DUI de representante legal");
		$(".input_dui_cliente").addClass("duis");
		var input_dui_cliente  = $(".input_dui_cliente").attr("placeholder");
		$(".clabel_dui_cliente").text(input_dui_cliente);

	/* *********LABEL*********** */
	$(".icono_cargo_cliente").addClass("fa fa-file-excel-o")
	$(".input_cargo_cliente").attr("placeholder","Ingresar cargo de representante legal");
	var input_cargo_cliente  = $(".input_cargo_cliente").attr("placeholder");
	$(".clabel_cargo_cliente").text(input_cargo_cliente);


	/* *********LABEL*********** */
	$(".icono_denominacion_cliente").addClass("fa fa-file-excel-o")
	$(".input_denominacion_cliente").attr("placeholder","Ingresar Denominación Cliente");
	var input_denominacion_cliente  = $(".input_denominacion_cliente").attr("placeholder");
	$(".clabel_denominacion_cliente").text(input_denominacion_cliente);






	
	$("#nuevoposee_contrato").change(function(){
		var posse_contrato =$(this).val();

		if(posse_contrato=="Si"){

			$(".input_denominacion_cliente").removeAttr("readonly");
			$(".input_denominacion_cliente").attr("required","required");

			$(".input_nombre_representante_cliente").removeAttr("readonly");
			$(".input_nombre_representante_cliente").attr("required","required");

			$(".input_profecion_cliente").removeAttr("readonly");
			$(".input_profecion_cliente").attr("required","required");

			$(".input_domicilio_cliente").removeAttr("readonly");
			$(".input_domicilio_cliente").attr("required","required");

			$("#nuevodepartamento_representante_cliente").removeAttr("disabled");
			$("#nuevodepartamento_representante_cliente").attr("required","required");

			$(".input_dui_cliente").removeAttr("readonly");
			$(".input_dui_cliente").attr("required","required");

			$(".input_cargo_cliente").removeAttr("readonly");
			$(".input_cargo_cliente").attr("required","required");



		}
		else{
			$(".input_denominacion_cliente").removeAttr("required");
			$(".input_denominacion_cliente").attr("readonly","readonly");

			$(".input_nombre_representante_cliente").removeAttr("required");
			$(".input_nombre_representante_cliente").attr("readonly","readonly");

			$(".input_profecion_cliente").removeAttr("required");
			$(".input_profecion_cliente").attr("readonly","readonly");

			$(".input_domicilio_cliente").removeAttr("required");
			$(".input_domicilio_cliente").attr("readonly","readonly");

			$("#nuevodepartamento_representante_cliente").removeAttr("required");
			$("#nuevodepartamento_representante_cliente").attr("disabled","disabled");

			$(".input_dui_cliente").removeAttr("required");
			$(".input_dui_cliente").attr("readonly","readonly");

			$(".input_cargo_cliente").removeAttr("required");
			$(".input_cargo_cliente").attr("readonly","readonly");
		}
	});





	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");;


	$(".input_limite_credito").attr("step","any");


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
	$(".input_nit").addClass("nits");
	$("#editarnit").addClass("nits");

	
	$(".icono_nrc").addClass("fa  fa-id-card");
	$(".input_nrc").attr("placeholder", texto+" NRC");
	$(".input_nrc").get(0).type = 'text';
	$("#editarnrc").get(0).type = 'text';

	
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

		if(contribuyente=="Si"){
			$(".input_nrc").attr("required","required");
			$(".input_nrc").removeAttr("readonly");

			$(".input_nombre_registro").attr("required","required");
			$(".input_nombre_registro").removeAttr("readonly");

			$(".input_giro").attr("required","required");
			$(".input_giro").removeAttr("readonly");

		}
		else{
			$(".input_nrc").removeAttr("required");
			$(".input_nrc").attr("readonly","readonly");

			$(".input_nombre_registro").removeAttr("required");
			$(".input_nombre_registro").attr("readonly","readonly");

			$(".input_giro").removeAttr("required");
			$(".input_giro").attr("readonly","readonly");
		}
		
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
	$(".input_telefono_1").addClass("telefono");
	$("#editartelefono_1").addClass("telefono");
	

	
	$(".icono_telefono_2").addClass("fa fa-phone");
	$(".input_telefono_2").attr("placeholder", texto+" Telefono 2");
	$(".input_telefono_2").addClass("telefono");
	$("#editartelefono_2").addClass("telefono");

	
	$(".icono_fax").addClass("fa fa-fax");
	$(".input_fax").attr("placeholder", texto+" FAX");
	$(".input_fax").get(0).type = 'number';
	$("#editarfax").get(0).type = 'number';

	
	$(".icono_contacto").addClass("fa fa-mobile");
	$(".input_contacto").attr("placeholder", texto+" contacto de operaciones");

	
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

	$(".input_vendedor").attr("placeholder", texto+" Vendedor");
	$(".input_dui").attr("placeholder", texto+" DUI");
	$(".input_categoria_cliente").attr("placeholder", texto+" Categoria Cliente");
	$(".input_tipo_servicio").attr("placeholder", texto+" Tipo Servicio");
	$(".input_posee_contrato").attr("placeholder", texto+" ¿Posee Contrato?");
	$(".input_vigencia_contrato").attr("placeholder", texto+" Vigencia Contrato");
	$(".input_porcentaje_comision").attr("placeholder", texto+" Porcentaje Comisión");
	$(".input_porcentaje_comision").attr("step","0.01");

	$(".input_dui").addClass("duis");

	
	/* ******NUVOS CAMPOS******** */

	$(".icono_contacto_contable").addClass("fa  fa-pencil-square-o");
	$(".input_contacto_contable").attr("placeholder", texto+" Contacto Contable");


	$(".icono_telefono_contacto_contable").addClass("fa  fa-phone");
	$(".input_telefono_contacto_contable").attr("placeholder", texto+" Teléfono Contacto Contable");

	$(".icono_correo_contacto_contable").addClass("fa  fa-envelope");
	$(".input_correo_contacto_contable").attr("placeholder", texto+" Correo Contacto Contable");

	$("#editartelefono_contacto_contable").addClass("telefono");
	$(".input_telefono_contacto_contable").addClass("telefono");

	$(".input_correo_contacto_contable").get(0).type = 'email';
	$("#editarcorreo_contacto_contable").get(0).type = 'email';


/* 	$(".icono_personal_asignado").addClass("fa fa-user");
	$(".input_personal_asignado").attr("placeholder", texto+" Personal Asignado");
	$(".input_personal_asignado").get(0).type = 'number';
 */

	       
              /* *********clabel*********** */


			  var input_codigo = $(".input_codigo").attr("placeholder");
              $(".clabel_codigo").text("Código Correlativo");
			  $(".input_codigo").attr("readonly","readonly");

			  var input_nombre = $(".input_nombre").attr("placeholder");
              $(".clabel_nombre").text(input_nombre);
             

              var input_fecha_apertura = $(".input_fecha_apertura").attr("placeholder");
              $(".clabel_fecha_apertura").text(input_fecha_apertura);
             
                     
              /* *********clabel*********** */
              var input_nit = $(".input_nit").attr("placeholder");
              $(".clabel_nit").text(input_nit);
             
              /* *********clabel*********** */
              var input_nrc = $(".input_nrc").attr("placeholder");
              $(".clabel_nrc").text(input_nrc);
             
              /* *********clabel*********** */
              var input_nombre_registro = $(".input_nombre_registro").attr("placeholder");
              $(".clabel_nombre_registro").text(input_nombre_registro);
             
              /* *********clabel*********** */
              var input_giro = $(".input_giro").attr("placeholder");
              $(".clabel_giro").text(input_giro);
             
              /* *********clabel*********** */
              var input_contribuyente = $(".input_contribuyente").attr("placeholder");
              $(".clabel_contribuyente").text(input_contribuyente);
             
              /* *********clabel*********** */
              var input_clasificacion = $(".input_clasificacion").attr("placeholder");
              $(".clabel_clasificacion").text(input_clasificacion);
             
              /* *********clabel*********** */
              var input_tipo_cliente = $(".input_tipo_cliente").attr("placeholder");
              $(".clabel_tipo_cliente").text(input_tipo_cliente);
             
              /* *********clabel*********** */
              var input_correo_electronico = $(".input_correo_electronico").attr("placeholder");
              $(".clabel_correo_electronico").text(input_correo_electronico);
             
              /* *********clabel*********** */
              var input_direccion = $(".input_direccion").attr("placeholder");
              $(".clabel_direccion").text(input_direccion);
             
              /* *********clabel*********** */
              var input_telefono_1 = $(".input_telefono_1").attr("placeholder");
              $(".clabel_telefono_1").text(input_telefono_1);
             
              /* *********clabel*********** */
              var input_telefono_2 = $(".input_telefono_2").attr("placeholder");
              $(".clabel_telefono_2").text(input_telefono_2);
             
              /* *********clabel*********** */
              var input_fax = $(".input_fax").attr("placeholder");
              $(".clabel_fax").text(input_fax);
             
              /* *********clabel*********** */
              var input_contacto = $(".input_contacto").attr("placeholder");
              $(".clabel_contacto").text(input_contacto);
             
              /* *********clabel*********** */
              var input_id_pais = $(".input_id_pais").attr("placeholder");
              $(".clabel_id_pais").text(input_id_pais);
             
              /* *********clabel*********** */
              var input_id_departamento = $(".input_id_departamento").attr("placeholder");
              $(".clabel_id_departamento").text(input_id_departamento);
             
              /* *********clabel*********** */
              var input_id_municipio = $(".input_id_municipio").attr("placeholder");
              $(".clabel_id_municipio").text(input_id_municipio);
             
              /* *********clabel*********** */
              var input_limite_credito = $(".input_limite_credito").attr("placeholder");
              $(".clabel_limite_credito").text(input_limite_credito);
             
              /* *********clabel*********** */
              var input_plazo = $(".input_plazo").attr("placeholder");
              $(".clabel_plazo").text(input_plazo);
             
              /* *********clabel*********** */
              var input_observaciones = $(".input_observaciones").attr("placeholder");
              $(".clabel_observaciones").text(input_observaciones);
             
              /* *********clabel*********** */
              var input_cuenta_contable = $(".input_cuenta_contable").attr("placeholder");
              $(".clabel_cuenta_contable").text(input_cuenta_contable);
             
              
              /* *********LABEL*********** */
			  var input_vendedor = $(".input_vendedor").attr("placeholder");
			  $(".label_vendedor").text(input_vendedor);

		  
              /* *********LABEL*********** */
			  var input_porcentaje_comision = $(".input_porcentaje_comision").attr("placeholder");
			  $(".label_porcentaje_comision").text(input_porcentaje_comision);

		  
          
              /* *********LABEL*********** */
			  var input_vendedor = $(".input_vendedor").attr("placeholder");
			  $(".clabel_vendedor").text(input_vendedor);

              /* *********LABEL*********** */
                var input_porcentaje_comision = $(".input_porcentaje_comision").attr("placeholder");
                $(".clabel_porcentaje_comision").text(input_porcentaje_comision);

            
              /* *********LABEL*********** */
			  var input_vigencia_contrato = $(".input_vigencia_contrato").attr("placeholder");
			  $(".clabel_vigencia_contrato").text(input_vigencia_contrato);

		  
              /* *********LABEL*********** */
			  var input_posee_contrato = $(".input_posee_contrato").attr("placeholder");
			  $(".clabel_posee_contrato").text(input_posee_contrato);

		  
              /* *********LABEL*********** */
			  var input_tipo_servicio = $(".input_tipo_servicio").attr("placeholder");
			  $(".clabel_tipo_servicio").text(input_tipo_servicio);

		  
              /* *********LABEL*********** */
			  var input_categoria_cliente = $(".input_categoria_cliente").attr("placeholder");
			  $(".clabel_categoria_cliente").text(input_categoria_cliente);

		  
              /* *********LABEL*********** */
			  var input_dui = $(".input_dui").attr("placeholder");
			  $(".clabel_dui").text(input_dui);

			  
              /* *********LABEL*********** */
			  var input_contacto_contable = $(".input_contacto_contable").attr("placeholder");
			  $(".clabel_contacto_contable").text(input_contacto_contable);

		  
              /* *********LABEL*********** */
			  var input_telefono_contacto_contable = $(".input_telefono_contacto_contable").attr("placeholder");
			  $(".clabel_telefono_contacto_contable").text(input_telefono_contacto_contable);

		  
              /* *********LABEL*********** */
			  var input_correo_contacto_contable = $(".input_correo_contacto_contable").attr("placeholder");
			  $(".clabel_correo_contacto_contable").text(input_correo_contacto_contable);

		  


			  $(".cgrupo_posee_contrato").empty();
			  $(".cgrupo_posee_contrato").append($('#nposee_contrato'));
			  
			  $(".cgrupo_tipo_servicio").empty();
			  $(".cgrupo_tipo_servicio").append($('.c_servicio'));

			  
			  $(".cgrupo_categoria_cliente").empty();
			  $(".cgrupo_categoria_cliente").append($('#nc_categoria'));
		  
			  /* ***EDITAR */
			  $(".ecgrupo_posee_contrato").empty();
			  $(".ecgrupo_posee_contrato").append($('#enposee_contrato'));
			  
			  $(".ecgrupo_tipo_servicio").empty();
			  $(".ecgrupo_tipo_servicio").append($('.ec_servicio'));

			  
			  $(".ecgrupo_categoria_cliente").empty();
			  $(".ecgrupo_categoria_cliente").append($('#enc_categoria'));

		  







			  $("#editarposee_contrato").change(function(){
		
				var posse_contrato=$(this).val();
			
				if(posse_contrato=="Si"){
		
					$(".input_denominacion_cliente").removeAttr("readonly");
					$(".input_denominacion_cliente").attr("required","required");
		
					$(".input_nombre_representante_cliente").removeAttr("readonly");
					$(".input_nombre_representante_cliente").attr("required","required");
		
					$(".input_profecion_cliente").removeAttr("readonly");
					$(".input_profecion_cliente").attr("required","required");
		
					$(".input_domicilio_cliente").removeAttr("readonly");
					$(".input_domicilio_cliente").attr("required","required");
		
					$("#editardepartamento_representante_cliente").removeAttr("disabled");
					$("#editardepartamento_representante_cliente").attr("required","required");
		
					$(".input_dui_cliente").removeAttr("readonly");
					$(".input_dui_cliente").attr("required","required");
		
					$(".input_cargo_cliente").removeAttr("readonly");
					$(".input_cargo_cliente").attr("required","required");

					$(".input_vigencia_contrato").removeAttr("readonly");
				
		
		
				}
				else{

					$(".input_vigencia_contrato").removeAttr("required");
					$(".input_vigencia_contrato").attr("readonly","readonly");


					$(".input_denominacion_cliente").removeAttr("required");
					$(".input_denominacion_cliente").attr("readonly","readonly");
		
					$(".input_nombre_representante_cliente").removeAttr("required");
					$(".input_nombre_representante_cliente").attr("readonly","readonly");
		
					$(".input_profecion_cliente").removeAttr("required");
					$(".input_profecion_cliente").attr("readonly","readonly");
		
					$(".input_domicilio_cliente").removeAttr("required");
					$(".input_domicilio_cliente").attr("readonly","readonly");
		
					$("#editardepartamento_representante_cliente").removeAttr("required");
					$("#editardepartamento_representante_cliente").attr("disabled","disabled");
		
					$(".input_dui_cliente").removeAttr("required");
					$(".input_dui_cliente").attr("readonly","readonly");
		
					$(".input_cargo_cliente").removeAttr("required");
					$(".input_cargo_cliente").attr("readonly","readonly");
				}
			});


            






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


		
$(".tablas").on("click", ".desactivarcliente", function(){
	var id = $(this).attr("idcontenido");
	var estado = $(this).attr("estado");

	 /*  ******** */
	 var parametros = {
		"id" : id,
		"estado" : estado
	};
	$.ajax({
			data:  parametros,
			url:"ajax/desactivarcliente.ajax.php",
			type:  'post',
			success:  function (response) {
			
				location.reload();
			}
	});
	/* ********* */


});


$(".tablas").on("click", ".activarcliente", function(){
	var id = $(this).attr("idcontenido");
	var estado = $(this).attr("estado");


	 /*  ******** */
	 var parametros = {
		"id" : id,
		"estado" : estado
	};
	$.ajax({
			data:  parametros,
			url:"ajax/desactivarcliente.ajax.php",
			type:  'post',
			success:  function (response) {
				
				location.reload();
			}
	});
	/* ********* */

});

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarclientes", function(){

	
	$(".ecgrupo_fax").attr("style","visibility:hidden; height:0;");
	$(".clientes_input_fax").removeAttr("required");


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
			
			if(respuesta["posee_contrato"]=="Si"){
					$("#editarvigencia_contrato").removeAttr("readonly");
				}
				else{
					$("#editarvigencia_contrato").attr("readonly","readonly");
				}


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



			
			if(respuesta["contribuyente"]=="No"){
				$(".input_nrc").removeAttr("required");
				$(".input_nrc").attr("readonly","readonly");

				$(".input_nombre_registro").removeAttr("required");
				$(".input_nombre_registro").attr("readonly","readonly");

				$(".input_giro").removeAttr("required");
				$(".input_giro").attr("readonly","readonly");
			}



			$("#editardia_quedan_cliente").val(respuesta["dia_quedan_cliente"]);
			$("#editardia_quedan_observacion_cliente").val(respuesta["dia_quedan_observacion_cliente"]);
			$("#editardia_cobro_cliente").val(respuesta["dia_cobro_cliente"]);
			$("#editardia_entrega_facturacion_cliente").val(respuesta["dia_entrega_facturacion_cliente"]);





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

			$("#seleccionarvendedor").val(respuesta["vendedor"]);
			$("#select2-editarvendedor-container").text(respuesta["vendedor"]);





			$("#editarporcentaje_comision").val(respuesta["porcentaje_comision"]);
			$("#editarvigencia_contrato").val(respuesta["vigencia_contrato"]);
			$("#editarposee_contrato").val(respuesta["posee_contrato"]);
			$("#editartipo_servicio").val(respuesta["tipo_servicio"]);
			$("#editarcategoria_cliente").val(respuesta["categoria_cliente"]);
			$("#editardui").val(respuesta["dui"]);

			/* NUEVOS */
			$("#editarcontacto_contable").val(respuesta["contacto_contable"]);
			$("#editartelefono_contacto_contable").val(respuesta["telefono_contacto_contable"]);
			$("#editarcorreo_contacto_contable").val(respuesta["correo_contacto_contable"]);


			$("#editarnombre_representante_cliente").val(respuesta["nombre_representante_cliente"]);
			$("#editarprofecion_cliente").val(respuesta["profecion_cliente"]);
			$("#editardomicilio_cliente").val(respuesta["domicilio_cliente"]);
			$("#editardepartamento_representante_cliente").val(respuesta["departamento_representante_cliente"]);
			$("#editardui_cliente").val(respuesta["dui_cliente"]);
			$("#editarcargo_cliente").val(respuesta["cargo_cliente"]);
			$("#editardenominacion_cliente").val(respuesta["denominacion_cliente"]);


			if(respuesta["posee_contrato"]=="No"){
				$(".input_denominacion_cliente").removeAttr("required");
				$(".input_denominacion_cliente").attr("readonly","readonly");

				$(".input_nombre_representante_cliente").removeAttr("required");
				$(".input_nombre_representante_cliente").attr("readonly","readonly");

				$(".input_profecion_cliente").removeAttr("required");
				$(".input_profecion_cliente").attr("readonly","readonly");

				$(".input_domicilio_cliente").removeAttr("required");
				$(".input_domicilio_cliente").attr("readonly","readonly");

				$("#editardepartamento_representante_cliente").removeAttr("required");
				$("#editardepartamento_representante_cliente").attr("disabled","disabled");

				$(".input_dui_cliente").removeAttr("required");
				$(".input_dui_cliente").attr("readonly","readonly");

				$(".input_cargo_cliente").removeAttr("required");
				$(".input_cargo_cliente").attr("readonly","readonly");
			}
			else{

				$(".input_denominacion_cliente").removeAttr("readonly");
				$(".input_denominacion_cliente").attr("required","required");
	
				$(".input_nombre_representante_cliente").removeAttr("readonly");
				$(".input_nombre_representante_cliente").attr("required","required");
	
				$(".input_profecion_cliente").removeAttr("readonly");
				$(".input_profecion_cliente").attr("required","required");
	
				$(".input_domicilio_cliente").removeAttr("readonly");
				$(".input_domicilio_cliente").attr("required","required");
	
				$("#editardepartamento_representante_cliente").removeAttr("disabled");
				$("#editardepartamento_representante_cliente").attr("required","required");
	
				$(".input_dui_cliente").removeAttr("readonly");
				$(".input_dui_cliente").attr("required","required");
	
				$(".input_cargo_cliente").removeAttr("readonly");
				$(".input_cargo_cliente").attr("required","required");

				$(".input_vigencia_contrato").removeAttr("readonly");

			}
			

			



		}

	});

})


/*=============================================
REVISAR SI  YA ESTÁ REGISTRADO
=============================================*/

$("#nuevocodigo").change(function(){


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

	    		$("body").parent().after('<div class="alert alert-warning">Este registro ya existe en la base de datos</div>');

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




