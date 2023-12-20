
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
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Seleccione el tipo de reporte:</label>
                                  <select name="" id="tipodesituacion" class="form-control">
                                    <option value="">Seleccione el tipo de situación</option>
                                    <option value="reubicacionesejecutaractivas">REPORTE UBICACIONES BOTON EJECUTAR ACTIVAS</option>
                                    <option value="reubicacionesejecutardesac">REPORTE UBICACIONES BOTON EJECUTAR INACTIVAS</option>
                                    <option value="reubicacionesgenerar">REPORTE UBICACIONES BOTON GENERAR</option>
                                    <option value="reubicacionesarmaradio">REPORTE UBICACIONES BOTON GENERAR CON ARMAS Y RADIOS</option>
                                    <option value="reubicacionesagentes">REPORTE UBICACIONES BOTON GENERAR CON AGENTES</option>
                                    <option value="reubicacionesagentesantigue">REPORTE UBICACIONES BOTON GENERAR CON AGENTES Y ANTIGUEDAD</option>
                                    <option value="reubicacionesvacante">REPORTE UBICACIONES BOTON GENERAR CON VACANTES</option>
                                    <option value="reubicacionesinspeccion">REPORTE UBICACIONES BOTON INSPECCION</option>
                                   
                                  </select>
                                </div>
                              </div>
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="" method="post" target="_blank" id="formulario" >

                              <div class="ocultar_div">
                                <div class="col-md-3"  style="display:none">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Desde:</label>
                                    <input type="text" class="calendario form-control " name="fecha_desde"     readonly placeholder="Fecha Desde">
                                  </div>
                                </div>
                                <div class="col-md-3 ocultar_div">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Fecha Hasta:</label>
                                      <input type="text" class="calendario form-control " name="fecha_hasta"     readonly placeholder="Fecha Hasta">
                                    </div>
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

$(".ocultar_div").attr("style","display:none");

var selectElement = $('#tipodesituacion');
  // Agregar un evento 'change' al elemento <select>
  selectElement.on('change', function() {
      $(".ocultar_div").attr("style","display:none");
      
      // Capturar el valor seleccionado cuando cambia la selección
      var selectedValue = $(this).val();
      $("#formulario").attr("action",selectedValue);

      if(selectedValue=="reubicacionesgenerar"){
        $(".ocultar_div").removeAttr("style");
      }
      else if(selectedValue=="reubicacionesarmaradio"){
        $(".ocultar_div").removeAttr("style");
      }
      else if(selectedValue=="reubicacionesagentes"){
        $(".ocultar_div").removeAttr("style");
      }
      else if(selectedValue=="reubicacionesagentesantigue"){
        $(".ocultar_div").removeAttr("style");
      }
      else if(selectedValue=="reubicacionesvacante"){
        $(".ocultar_div").removeAttr("style");
      }
      else if(selectedValue=="reubicacionesinspeccion"){
        $(".ocultar_div").removeAttr("style");
      }

      
  });

    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var hr2 = moment(primerDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var hr3 = moment(ultimoDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');



    $(".fechainicial").val(hr2);
    $(".fechaultimo").val(hr3);
</script>