/* COLOCACION DE ICONOS */
$(document).ready(function(){

	
    $( ".tipo_planilla" ).on( "change", function() {
		var valor = $(this).val();
		var atributo = $(this).find("option:selected").attr("devengos");
		$(".devengos_table").val(atributo);


		var dataString = 'tipoplanilla='+valor;
				$.ajax({
					data: dataString,
					url: "ajax/cargarplantilla.ajax.php",
					type: 'post',
					success: function (response) {
						$(".cargardataplanilla").empty();
						$(".cargardataplanilla").append(response);
					}
				});
	  
		})
		  
 })

 




