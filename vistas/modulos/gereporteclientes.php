
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
                                    <option value="reporteclientefactu">REPORTE DE FACTURACION X CLIENTE</option>
                                   
                                  </select>
                                </div>
                              </div>
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="" method="post" target="_blank" id="formulario" >


                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Planilla desde</label>
                                            <select name="planilla_desde" id="planilla_desde" class="form-control mi-selector planilla_desde" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                
                                                function planilla() {
                                                  $query = "SELECT*FROM planilladevengo_admin  
                                                  group by numero_planilladevengo_admin
                                                  order by id asc";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = planilla();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["numero_planilladevengo_admin"].">".$value["numero_planilladevengo_admin"].'-'.$value["descripcion_planilladevengo_admin"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Planilla hasta</label>
                                            <select name="planilla_hasta" id="planilla_hasta" class="form-control mi-selector planilla_hasta" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                  $data = planilla();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["numero_planilladevengo_admin"].">".$value["numero_planilladevengo_admin"].'-'.$value["descripcion_planilladevengo_admin"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar clasificación</label>
                                            <select name="clisificacion" id="clisificacion" class="form-control clisificacion" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                
                                                function ubica() {
                                                  $query = "SELECT*FROM clientes  
                                                  group by clasificacion
                                                  order by clasificacion desc ";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = ubica();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["clasificacion"].">".$value["clasificacion"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                        </div>
                                </div>

                                
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar cliente</label>
                                            <select name="cliente" id="cliente" class="form-control mi-selector cliente" >
                                              <option value="*">Todos los clientes</option>
                                              <?php
                                                
                                                function cliente() {
                                                  $query = "SELECT*FROM clientes";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = cliente();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["id"].">".$value["nombre"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                        </div>
                                </div>

                                
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Con Empleados?</label>
                                            <select name="conempleado" id="" class="form-control mi-selector " >
                                              <option value="Si"> Si</option>
                                              <option value="No"> No</option>
                                              
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


var clisificacion = $('#clisificacion');
clisificacion.on('change', function() {
  $("#cliente").val("*").trigger('change.select2');
});


var cliente = $('#cliente');
cliente.on('change', function() {
  $("#clisificacion").val("*");
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