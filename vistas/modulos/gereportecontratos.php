
<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <a href="todosreportes" class="btn btn-danger">Volver</a>
      </div>

      <div class="box-body">
        <div class="row">
           
                <div class="col-md-12">
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="reportecontratos" method="post" target="_blank" id="form">


                             

                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Fecha Desde:</label>
                                  <input type="text" class="calendario form-control " name="fecha_desde" id=""    readonly placeholder="Fecha Desde">
                                </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Hasta:</label>
                                    <input type="text" class="calendario form-control " name="fecha_hasta" id=""    readonly placeholder="Fecha Hasta">
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Posee contrato:</label>
                                    <select name="contrato" class="form-control">
                                        <option value="*">Todos los contratos</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Con Ubicaciones:</label>
                                    <select name="ubicaciones" class="form-control ubicaciones">
                                        <option value="*">Seleccione opcion</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                  </div>
                              </div>


                                <br>
                                <div class="col-md-12">
                                  <input type="submit" value="Imprimir" class="btn btn-primary">
                                </div>
                              </form>
                            </div>
                            <!-- ********************* -->


                           
                                    
                </div>
                                
            </div>
                        
         </div>
       </div>
     </div>
   </div>
  </div>
 </section>
</div>

<script src="vistas/js/cargarplanillas.js"></script>

<script>
    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var hr2 = moment(primerDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var hr3 = moment(ultimoDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');



    $(".fechainicial").val(hr2);
    $(".fechaultimo").val(hr3);


    
    $( ".ubicaciones" ).on( "change", function() {
		var valor = $(this).val();
    if(valor=="Si"){
      $("#form").attr("action","reportecontratosubi");
    }
    else{
      $("#form").attr("action","reportecontratos");
    }
		/* var atributo = $(this).find("option:selected").attr("devengos");
		$(".devengos_table").val(atributo); */
	  
		})




</script>