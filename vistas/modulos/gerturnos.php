
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
                                    <option value="returnos">REPORTE POR TURNOS</option>
                                    
                                  </select>
                                </div>
                              </div>
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="" method="post" target="_blank" id="formulario" >


                              
                              <div class="col-md-12 oculta_equipo">
                                        <div class="form-group ocultar_factu">
                                            <label for="">Seleccionar Ubicación</label>
                                            <select name="ubicacion" id="ubicacion" class="form-control  turnos mi-selector" >
                                              <option value="*">Todas las Ubicación</option>
                                              <?php
                                                
                                                function ubi() {
                                                  $query = "SELECT*FROM tbl_clientes_ubicaciones";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = ubi();
                                                  foreach($data as $value) {
                                                    echo "<option value='".$value["codigo_ubicacion"]."'>".$value["nombre_ubicacion"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                        </div>
                                 </div>


                                

                                  <div class="col-md-12 oculta_equipo">
                                        <div class="form-group ocultar_factu">
                                            <label for="">Seleccionar Turno</label>
                                            <select name="turnos" id="turnos" class="form-control  turnos mi-selector" >
                                              <option value="*">Todos  Turno</option>
                                              <?php
                                                
                                                function turnos() {
                                                  $query = "SELECT*FROM transacciones_agente
                                                            group by turno_transacciones_agente";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = turnos();
                                                  foreach($data as $value) {
                                                    echo "<option value='".$value["turno_transacciones_agente"]."'>".$value["turno_transacciones_agente"]."</option>";
                                                  }
                                              ?>
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

$(".oculto").attr("style","display:none");

/* ***************** */
var tiporeporte = $('#tiporeporte');
tiporeporte.on('change', function() {
  $(".oculto").attr("style","display:none");
  $(".oculta_equipo").removeAttr("style");

  var valor=$(this).val();
  $("#formulario").attr("action",valor);

  if(valor=="rekardexempleado"){
   $(".oculto").removeAttr("style");
   $(".oculta_equipo").attr("style","display:none");
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