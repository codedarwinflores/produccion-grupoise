/* COLOCACION DE ICONOS */
$(document).ready(function(){



var validar = $(".datos_vacios").val();

/* alert(validar);
 */
var nuevo="nuevo";
var editar="editar";

if(validar=="1"){

	$(".formulario_nuevo").attr("style","display:none");
	$(".formulario_editar").attr("style","display:block");
	var idconfiguracion = $(".id_conf").val();
	var datos = new FormData();
	datos.append("idconfiguracion", idconfiguracion);
	$.ajax({

		url:"ajax/configuracion.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			

			$("#editarid").val(respuesta["id"]);
			$("#editarconf_empresa").val(respuesta["conf_empresa"]);
			$("#editarextra_diurna").val(respuesta["extra_diurna"]);
			$("#editarextra_nocturna").val(respuesta["extra_nocturna"]);
			$("#editarextra_dominical_diurna").val(respuesta["extra_dominical_diurna"]);
			$("#editarextra_dominical_nocturna").val(respuesta["extra_dominical_nocturna"]);
			$("#editarperiodo_de_pago").val(respuesta["periodo_de_pago"]);
			$("#editarporcentaje_isss").val(respuesta["porcentaje_isss"]);
			$("#editartope_isss").val(respuesta["tope_isss"]);
			$("#editarsalario_minimo").val(respuesta["salario_minimo"]);
			if(respuesta["ultimo_empreado"]==""){}
			else{
				$("#editarultimo_empreado").val(respuesta["ultimo_empreado"]);
			}
			if(respuesta["ultimo_proveedor"]==""){}
			else{
				$("#editarultimo_proveedor").val(respuesta["ultimo_proveedor"]);
			}
			$("#editarnum_registro").val(respuesta["num_registro"]);
			$("#editariva").val(respuesta["iva"]);

			$(".previsualizar1").attr("src",respuesta["firma_representante"]);
			$("#editarfirma_representante1").val(respuesta["firma_representante"]);

			$(".previsualizar2").attr("src",respuesta["firma_sello_notario"]);
			$("#editarfirma_sello_notario1").val(respuesta["firma_sello_notario"]);


			$("#editarrepresentante_legal").val(respuesta["representante_legal"]);
			$("#editarcargo").val(respuesta["cargo"]);
			$("#editardireccion").val(respuesta["direccion"]);
			$("#editartelefono").val(respuesta["telefono"]);
			$("#editaractividad_economica").val(respuesta["actividad_economica"]);
			$("#editarnit").val(respuesta["nit"]);
			$("#editarnum_patronal").val(respuesta["num_patronal"]);
			$("#editarregistro").val(respuesta["registro"]);
			$("#editarpais").val(respuesta["pais"]);
			$("#editarh_extra").val(respuesta["h_extra"]);

			$("#editarlimite").val(respuesta["limite"]);
			$("#editarclave").val(respuesta["clave"]);
			$("#editaranticipo").val(respuesta["anticipo"]);
			$("#editarentrega").val(respuesta["entrega"]);
			$("#editardui").val(respuesta["dui"]);
			$("#editarimpresion").val(respuesta["impresion"]);
			$("#editardoctor").val(respuesta["doctor"]);
			$("#editarpsicologo").val(respuesta["psicologo"]);








		}

	});


}
else{

	var parametros = {
		"id" : ""
	};
	$.ajax({

		url:"ajax/insert_configuracion.ajax.php",
		datos:parametros,
		success: function(respuesta){
			/* alert(respuesta); */
			location.reload();
			$(".formulario_nuevo").attr("style","display:block");
			$(".formulario_editar").attr("style","display:none");
		
			
		}
	})


	/* location.reload(); */
}






 })

 
 /*=============================================
SUBIENDO FIRMA REPRESENTANTE
=============================================*/
$(".editarfirma_representante").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".editarfirma_representante").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".editarfirma_representante").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

		var filename = $('.editarfirma_representante').val();
		if (filename.substring(3,11) == 'fakepath') {
			filename = filename.substring(12);
			$(".editarfirma_representante1").val('vistas/img/configuracion/'+filename);
		} 

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar1").attr("src", rutaImagen);

  		})

  	}
})


 /*=============================================
SUBIENDO FIRMA Y SELLO NOTARIO
=============================================*/
$(".editarfirma_sello_notario").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".editarfirma_sello_notario").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".editarfirma_sello_notario").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

		var filename = $('.editarfirma_sello_notario').val();
		if (filename.substring(3,11) == 'fakepath') {
			filename = filename.substring(12);
			$(".editarfirma_sello_notario1").val('vistas/img/configuracion/'+filename);
		} 

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar2").attr("src", rutaImagen);

  		})

  	}
})


/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarconfiguracion", function(){

	
	var idconfiguracion = $(this).attr("idconfiguracion");
	
	var datos = new FormData();
	datos.append("idconfiguracion", idconfiguracion);

	$.ajax({

		url:"ajax/configuracion.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editaroperador").val(respuesta["operador"]);
			$("#editarconfiguracion").val(respuesta["configuracion"]);
			$("#editarIMEI").val(respuesta["IMEI"]);
			$("#editarconfiguracion_card").val(respuesta["configuracion_card"]);



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
	    url:"ajax/configuracion.ajax.php",
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
$(".tablas").on("click", ".btnEliminarconfiguracion", function(){

  var idconfiguracion = $(this).attr("idconfiguracion");
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

      window.location = "index.php?ruta=configuracion&idconfiguracion="+idconfiguracion+"&Codigo="+Codigo;

    }

  })

})




