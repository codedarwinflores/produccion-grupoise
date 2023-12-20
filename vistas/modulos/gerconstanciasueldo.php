
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
                                    <option value="*">FORMATO CONSTANCIA DE SUELDO</option>
                                  </select>
                                </div>
                              </div>
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="" method="post" target="_blank" id="formulario" >


                              <div class="col-md-12">
                                        <div class="form-group ocultar_factu">
                                            <label for="">Seleccionar Banco</label>
                                            <select name="banco" id="banco" class="form-control  mi-selector" >
                                              <option value="*">Seleccionar Banco</option>
                                              <?php
                                                
                                                function banco() {
                                                  $query = "SELECT*FROM bancos";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = banco();
                                                  foreach($data as $value) {
                                                                       
                                                  echo "<option value='".$value["id"]."'>".$value["nombre"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                        </div>
                                </div>


                          
                                  <div class="col-md-12">
                                        <div class="form-group ocultar_factu">
                                            <label for="">Seleccionar Empleado</label>
                                            <select name="empleado" id="empleado" class="form-control  empleado mi-selector" >
                                              <option value="*">Seleccionar Empleado</option>
                                              <?php
                                                
                                                function empleado() {
                                                  $query = "SELECT*FROM tbl_empleados";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = empleado();
                                                  foreach($data as $value) {
                                                                                  
                                                    $nombre_cargo=trim(trim($value["primer_nombre"])." ".trim($value["segundo_nombre"]).' '.trim($value["tercer_nombre"]).' '.trim($value["primer_apellido"]).' '.trim($value["segundo_apellido"]).' '.trim($value["apellido_casada"]));
                                                    $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);

                                                  echo "<option value='".$value["id"]."'>".$nombre_cargo."</option>";
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


  
var banco = $('#banco');
banco.on('change', function() {
  var banco=$(this).val();
  var empleado=$("#empleado").val();

  var url_form="vistas/modulos/reconstanciasueldo.php?idbanco="+banco+"&idemple="+empleado;

  $("#formulario").attr("action",url_form);

});



var empleado = $('#empleado');
empleado.on('change', function() {
  var banco=$("#banco").val();
  var empleado=$(this).val();

  var url_form="vistas/modulos/reconstanciasueldo.php?idbanco="+banco+"&idemple="+empleado;
  $("#formulario").attr("action",url_form);

});



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