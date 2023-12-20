
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
                                  <label for="">Seleccione el tipo de reporte:</label>
                                  <select name="" id="tiporeporte" class="form-control">
                                    <option value="">Seleccione el tipo de reporte</option>
                                    <!-- REPORTE LISTADO DE ARMAS BOTON CON UBICACIÓN este es el reporte 62 -->
                                    <option value="repoindeemple">REPORTE DE INDEMNIZACION</option>
                                    <option value="repoaguiemple">REPORTE DE AGUINALDO</option>

                                   
                                    
                                  </select>
                                </div>
                              </div>
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="" method="post" target="_blank" id="formulario" >

                              <div class="col-md-4 ">
                                        <div class="form-group ">
                                            <label for="">Seleccionar Fecha</label>
                                            <input type="text" class="form-control calendario" name="fecha_desde" autocomplete="off">
                                        </div>
                                 </div>

                               



                              
                              <!-- <div class="col-md-12 oculta_equipo">
                                        <div class="form-group ocultar_factu">
                                            <label for="">Seleccionar Equipo</label>
                                            <select name="equipo" id="equipo" class="form-control  turnos mi-selector" >
                                                <option value="arma">Arma</option>
                                                <option value="radio">Radio</option>
                                                <option value="celular">Celular</option>
                                                <option value="bicicleta">Bicicleta</option>
                                                <option value="arma_radio">Arma y Radios</option>
                                                <option value="arma_radio_celular">Arma, Radios y Celulares</option>
                                             
                                            </select>
                                        </div>
                                 </div> -->


                               
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

$(".oculta_equipo").attr("style","display:none");

/* ***************** */
var tiporeporte = $('#tiporeporte');
tiporeporte.on('change', function() {
  /* $(".oculto").attr("style","display:none");
  $(".oculta_equipo").removeAttr("style"); */

  var valor=$(this).val();
  $("#formulario").attr("action",valor);

  
  if(valor=="relistadoequipoarmatran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }
  else if(valor=="relistadoequiporadiotran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }
  else if(valor=="relistadoequiporcelulartran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }
  else if(valor=="relistadoequiporbicitran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }

  else if(valor=="relistadoequiporarmaradiotran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }

  else if(valor=="relistadoequiporarmaradioceltran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }
  
  
  
});
/* ***************** */



var rubro = $('#rubro');
rubro.on('change', function() {
  $("#cliente").val("*").trigger('change.select2');
});


var cliente = $('#cliente');
cliente.on('change', function() {
  $("#rubro").val("*");
});

var depa = $('#departamento');
depa.on('change', function() {
      var selectedValue = $(this).val();
      if(selectedValue!="*"){
        /* $("#municipio").attr("idDpto").trigger('change.select2');*/
        var idDpto = selectedValue;
        $("#municipio").select2();
        $("#municipio").select2('destroy');
        $("#municipio option").each(function () {
            if ($(this).attr('idDpto') === idDpto) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
      }
      else{
        $("#municipio").select2();
      }      
});






  var selectElement = $('#tipodesituacion');
  // Agregar un evento 'change' al elemento <select>
  selectElement.on('change', function() {
      $(".ocultar_div").attr("style","display:none");
      
      // Capturar el valor seleccionado cuando cambia la selección
      var selectedValue = $(this).val();
      $("#formulario").attr("action",selectedValue);

      if(selectedValue=="reportesituacionusuarios"){
        $(".usuarios").removeAttr("style");
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