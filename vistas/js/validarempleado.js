/* COLOCACION DE ICONOS */
$(document).ready(function(){


	$( ".numerodui" ).blur(function() {
		
		var nombres= $(".nombre1").val()+" "+$(".nombre2").val()+" "+$(".nombre3").val();
		var apellido1=$(".apellido1").val();
		var apellido2=$(".apellido2").val();
		var duis=$(this).val();

		 /*  ******** */
		 var parametros = {
			"nombres" : nombres,
			"apellido1" : apellido1,
			"apellido2" : apellido2,
			"duis" : duis

		};
		$.ajax({
				data:  parametros,
				url:"ajax/verificarempleado.ajax.php",
				type:  'post',
				success:  function (response) {
			
					if(response=="1"){
						alert("ERROR: POR FAVOR VERIFIQUE EN LISTA DE PERSONAL NO CONTRATABLE");
						$(".numerodui").val("");
						$(".nombre1").val("");
						$(".nombre2").val("");
						$(".nombre3").val("");
						$(".apellido1").val("");
						$(".apellido2").val("");

						
					}
					
				}
		});
	/* ********* */

	  });
		  
 })

 

