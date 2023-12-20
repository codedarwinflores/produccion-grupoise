
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
                                    <option value="">Seleccione el tipo de reporte</option>
                                    <option value="reportepersonalmunicipio">REPORTE DE PERSONAL BOTON X MUNICIPIO</option>
                                   
                                  </select>
                                </div>
                              </div>
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="" method="post" target="_blank" id="formulario" >


                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Supervisor</label>
                                            <select name="empleado" id="empleado" class="form-control mi-selector empleado" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                
                                                function empleado_supervisor() {
                                                  $query = "SELECT tbl_empleados.id as idempleado, tbl_empleados.* FROM tbl_empleados
                                                  INNER JOIN cargos_desempenados 
                                                  WHERE tbl_empleados.nivel_cargo = cargos_desempenados.id AND  cargos_desempenados.descripcion='COORDINADOR DE ZONA' ";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = empleado_supervisor();
                                                  foreach($data as $value) {
                                                  echo "<option banco=".$value["id_banco"]."  value=".$value["id"].">".$value["codigo_empleado"].'-'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                            <input type="hidden" name="banco" class="banco">
                                        </div>
                                </div>

                                <div class="col-md-12 ocultar_depa">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar departamento</label>
                                            <select name="departamento" id="departamento" class="form-control mi-selector empleado" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                function depa() {
                                                  $query = "SELECT * FROM cat_departamento";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = depa();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["id"].">".$value["Nombre"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                            <input type="hidden" name="banco" class="banco">
                                        </div>
                                </div>

                                <div class="col-md-12 ocultar_depa">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar municipio</label>
                                            <select name="municipio" id="municipio" class="form-control mi-selector" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                function muni() {
                                                  $query = "SELECT * FROM cat_municipios order by idDpto desc";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = muni();
                                                  foreach($data as $value) {
                                                  echo "<option idDpto=".$value["idDpto"]." value=".$value["id"].">".$value["Nombre_m"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                            <input type="hidden" name="banco" class="banco">
                                        </div>
                                </div>



                                <div class="ocultar_div" style="display:none">
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Fecha Desde:</label>
                                      <input type="text" class="calendario form-control " name="fecha_desde"     readonly placeholder="Fecha Desde">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
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


var empleado = $('#empleado');
empleado.on('change', function() {
      var selectedValue = $(this).val();
      if(selectedValue!="*"){
        $(".ocultar_depa").attr("style","display:none");
        $("#municipio").val("*").trigger('change.select2');
        $("#departamento").val("*").trigger('change.select2');

      }
      else{
        $(".ocultar_depa").removeAttr("style");
      }      
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