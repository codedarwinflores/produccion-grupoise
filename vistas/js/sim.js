/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	$(".gruposim_operador").empty();
	$('.gruposim_operador').append($('#nuevooperador'));

	$(".egruposim_operador").empty();
	$('.egruposim_operador').append($('#editaroperadordiv'));


	
	$(".icono_operador").addClass("fa fa-server");
	$(".input_operador").attr("placeholder", texto+" Operador");


	
	$(".icono_sim").addClass("fa fa-newspaper-o");
	$(".input_sim").attr("placeholder", texto+" SIM");


	
	$(".icono_IMEI").addClass("fa fa-puzzle-piece");
	$(".input_IMEI").attr("placeholder", texto+" IMEI");

	
	$(".icono_sim_card").addClass("fa fa-print");
	$(".input_sim_card").attr("placeholder", texto+" SIM CARD");


              /* *********LABEL*********** */
			  var input_operador = $(".input_operador").attr("placeholder");
			  $(".label_operador").text(input_operador);

		  
              /* *********LABEL*********** */
			  var input_sim = $(".input_sim").attr("placeholder");
			  $(".label_sim").text(input_sim);

		  
              /* *********LABEL*********** */
			  var input_IMEI = $(".input_IMEI").attr("placeholder");
			  $(".label_IMEI").text(input_IMEI);

		  
              /* *********LABEL*********** */
			  var input_sim_card = $(".input_sim_card").attr("placeholder");
			  $(".label_sim_card").text(input_sim_card);

		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarsim", function(){

	
	var idsim = $(this).attr("idsim");
	
	var datos = new FormData();
	datos.append("idsim", idsim);

	$.ajax({

		url:"ajax/sim.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editaroperador").val(respuesta["operador"]);
			$("#editarsim").val(respuesta["sim"]);
			$("#editarIMEI").val(respuesta["IMEI"]);
			$("#editarsim_card").val(respuesta["sim_card"]);



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
	    url:"ajax/sim.ajax.php",
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
$(".tablas").on("click", ".btnEliminarsim", function(){

  var idsim = $(this).attr("idsim");
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

      window.location = "index.php?ruta=sim&idsim="+idsim+"&Codigo="+Codigo;

    }

  })

})




