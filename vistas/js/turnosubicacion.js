/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$( ".t_1" ).blur(function() {
		var valor1 = $(this).val();
		if(valor1==""){
			$(this).val("0");
		}
		var valor2 = $(".t_2").val();
		var valor3 = $(".t_3").val();
		var valor4 = $(".t_4").val();
		var valor5 = $(".t_5").val();
		var valor6 = $(".t_6").val();
		var valor7 = $(".t_7").val();
		var valor8 = $(".t_8").val();
		var suma= parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3)+parseFloat(valor4)+parseFloat(valor5)+parseFloat(valor6)+parseFloat(valor7)+parseFloat(valor8);
		$(".t_9").val(suma);

		if(suma > $("#anterior_aumentar").val()){
			swal({
				type: "warning",
				title: "Turno Asignados excede numero de Hombres Autorizados",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
				}).then(function(result) { })


			$(this).val("0");
			$("#nuevoturnos_comodin").val("");

		}
		// tu codigo ajax va dentro de esta function...
	  });

	  $( ".t_2" ).blur(function() {
		var valor1 = $(this).val();
		if(valor1==""){
			$(this).val("0");
		}
		var valor2 = $(".t_1").val();
		var valor3 = $(".t_3").val();
		var valor4 = $(".t_4").val();
		var valor5 = $(".t_5").val();
		var valor6 = $(".t_6").val();
		var valor7 = $(".t_7").val();
		var valor8 = $(".t_8").val();
		var suma= parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3)+parseFloat(valor4)+parseFloat(valor5)+parseFloat(valor6)+parseFloat(valor7)+parseFloat(valor8);
		$(".t_9").val(suma);
		if(suma > $("#anterior_aumentar").val()){
			swal({
				type: "warning",
				title: "Turno Asignados excede numero de Hombres Autorizados",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
				}).then(function(result) { })
			$(this).val("0");
			$("#nuevoturnos_comodin").val("");

		}
		// tu codigo ajax va dentro de esta function...
	  });

	  $( ".t_3" ).blur(function() {
		var valor1 = $(this).val();
		if(valor1==""){
			$(this).val("0");
		}
		var valor2 = $(".t_1").val();
		var valor3 = $(".t_2").val();
		var valor4 = $(".t_4").val();
		var valor5 = $(".t_5").val();
		var valor6 = $(".t_6").val();
		var valor7 = $(".t_7").val();
		var valor8 = $(".t_8").val();
		var suma= parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3)+parseFloat(valor4)+parseFloat(valor5)+parseFloat(valor6)+parseFloat(valor7)+parseFloat(valor8);
		$(".t_9").val(suma);
		if(suma > $("#anterior_aumentar").val()){
			swal({
				type: "warning",
				title: "Turno Asignados excede numero de Hombres Autorizados",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
				}).then(function(result) { })
			$(this).val("0");
			$("#nuevoturnos_comodin").val("");

		}
		// tu codigo ajax va dentro de esta function...
	  });

	  $( ".t_4" ).blur(function() {
		var valor1 = $(this).val();
		if(valor1==""){
			$(this).val("0");
		}
		var valor2 = $(".t_1").val();
		var valor3 = $(".t_2").val();
		var valor4 = $(".t_3").val();
		var valor5 = $(".t_5").val();
		var valor6 = $(".t_6").val();
		var valor7 = $(".t_7").val();
		var valor8 = $(".t_8").val();
		var suma= parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3)+parseFloat(valor4)+parseFloat(valor5)+parseFloat(valor6)+parseFloat(valor7)+parseFloat(valor8);
		$(".t_9").val(suma);
		if(suma > $("#anterior_aumentar").val()){
			swal({
				type: "warning",
				title: "Turno Asignados excede numero de Hombres Autorizados",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
				}).then(function(result) { })
			$(this).val("0");
			$("#nuevoturnos_comodin").val("");

		}
		// tu codigo ajax va dentro de esta function...
	  });

	  $( ".t_5" ).blur(function() {
		var valor1 = $(this).val();
		if(valor1==""){
			$(this).val("0");
		}
		var valor2 = $(".t_1").val();
		var valor3 = $(".t_2").val();
		var valor4 = $(".t_3").val();
		var valor5 = $(".t_4").val();
		var valor6 = $(".t_6").val();
		var valor7 = $(".t_7").val();
		var valor8 = $(".t_8").val();
		var suma= parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3)+parseFloat(valor4)+parseFloat(valor5)+parseFloat(valor6)+parseFloat(valor7)+parseFloat(valor8);
		$(".t_9").val(suma);
		// tu codigo ajax va dentro de esta function...
		if(suma > $("#anterior_aumentar").val()){
			swal({
				type: "warning",
				title: "Turno Asignados excede numero de Hombres Autorizados",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
				}).then(function(result) { })
			$(this).val("0");
			$("#nuevoturnos_comodin").val("");

		}
	  });

	  $( ".t_6" ).blur(function() {
		var valor1 = $(this).val();
		if(valor1==""){
			$(this).val("0");
		}
		var valor2 = $(".t_1").val();
		var valor3 = $(".t_2").val();
		var valor4 = $(".t_3").val();
		var valor5 = $(".t_4").val();
		var valor6 = $(".t_5").val();
		var valor7 = $(".t_7").val();
		var valor8 = $(".t_8").val();
		var suma= parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3)+parseFloat(valor4)+parseFloat(valor5)+parseFloat(valor6)+parseFloat(valor7)+parseFloat(valor8);
		$(".t_9").val(suma);
		// tu codigo ajax va dentro de esta function...
		if(suma > $("#anterior_aumentar").val()){
			swal({
				type: "warning",
				title: "Turno Asignados excede numero de Hombres Autorizados",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
				}).then(function(result) { })
			$(this).val("0");
			$("#nuevoturnos_comodin").val("");

		}
	  });


	  $( ".t_7" ).blur(function() {
		var valor1 = $(this).val();
		if(valor1==""){
			$(this).val("0");
		}
		var valor2 = $(".t_1").val();
		var valor3 = $(".t_2").val();
		var valor4 = $(".t_3").val();
		var valor5 = $(".t_4").val();
		var valor6 = $(".t_5").val();
		var valor7 = $(".t_6").val();
		var valor8 = $(".t_8").val();
		var suma= parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3)+parseFloat(valor4)+parseFloat(valor5)+parseFloat(valor6)+parseFloat(valor7)+parseFloat(valor8);
		$(".t_9").val(suma);
		// tu codigo ajax va dentro de esta function...
		if(suma > $("#anterior_aumentar").val()){
			swal({
				type: "warning",
				title: "Turno Asignados excede numero de Hombres Autorizados",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
				}).then(function(result) { })
			$(this).val("0");
			$("#nuevoturnos_comodin").val("");

		}
	  });

	  $( ".t_8" ).blur(function() {
		var valor1 = $(this).val();
		if(valor1==""){
			$(this).val("0");
		}
		var valor2 = $(".t_1").val();
		var valor3 = $(".t_2").val();
		var valor4 = $(".t_3").val();
		var valor5 = $(".t_4").val();
		var valor6 = $(".t_5").val();
		var valor7 = $(".t_6").val();
		var valor8 = $(".t_7").val();
		var suma= parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3)+parseFloat(valor4)+parseFloat(valor5)+parseFloat(valor6)+parseFloat(valor7)+parseFloat(valor8);
		$(".t_9").val(suma);
		// tu codigo ajax va dentro de esta function...
		if(suma > $("#anterior_aumentar").val()){
			swal({
				type: "warning",
				title: "Turno Asignados excede numero de Hombres Autorizados",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
				}).then(function(result) { })
			$(this).val("0");
			$("#nuevoturnos_comodin").val("");
		}
	  });

 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartbl_ubicaciones_turnos", function(){

	
	var idtbl_ubicaciones_turnos = $(this).attr("idtbl_ubicaciones_turnos");
	
	var datos = new FormData();
	datos.append("idtbl_ubicaciones_turnos", idtbl_ubicaciones_turnos);

	$.ajax({

		url:"ajax/turnosubicacion.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editar24hr").val(respuesta["24hr"]);
			$("#editar12hde").val(respuesta["12hde"]);
			$("#editar12hd6").val(respuesta["12hd6"]);
			$("#editar12hn6").val(respuesta["12hn6"]);
			$("#editar12hd7").val(respuesta["12hd7"]);
			$("#editar12hn7").val(respuesta["12hn7"]);
			$("#editarextraordinario").val(respuesta["extraordinario"]);
			$("#editarseptimo").val(respuesta["septimo"]);
			$("#editarturnos_comodin").val(respuesta["turnos_comodin"]);
			$("#editarnotas").val(respuesta["notas"]);
			$("#editaridubicacion").val(respuesta["idubicacion"]);



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
	    url:"ajax/tbl_ubicaciones_turnos.ajax.php",
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
$(".tablas").on("click", ".btnEliminartbl_ubicaciones_turnos", function(){

  var idtbl_ubicaciones_turnos = $(this).attr("idtbl_ubicaciones_turnos");
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

      window.location = "index.php?ruta=tbl_ubicaciones_turnos&idtbl_ubicaciones_turnos="+idtbl_ubicaciones_turnos+"&Codigo="+Codigo;

    }

  })

})




