
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
                                    <option value="vistas/modulos/relicenciaporarmacarnet.php">LICENCIA DE PORTACION DE ARMA</option>
                                  </select>
                                </div>
                              </div>
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="" method="post" target="_blank" id="formulario" >

                          
                                  <div class="col-md-12">
                                        <div class="form-group ocultar_factu">
                                            <label for="exampleInputEmail1">Seleccionar Empleado</label>
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

                                
                                <div class="col-md-2 ">
                                    <div class="form-group">
                                      <label for="">Fecha </label>
                                      <input type="text" class="form-control calendario fecha" name="fecha" value="" id="fecha">
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
  var valor=$(this).val();
  var fecha = $("#fecha").val();

  var valor_url="vistas/modulos/relicenciaporarmacarnet.php?id="+valor+"&fecha="+fecha;

  $("#formulario").attr("action",valor_url);
});



$('#fecha').blur(function(){
  $('#ic__datepicker-2').on('click', function () {
      var valor=$("#empleado").val();
			var fecha = $("#fecha").val();
      var valor_url="vistas/modulos/relicenciaporarmacarnet.php?id="+valor+"&fecha="+fecha;
      $("#formulario").attr("action",valor_url);

  })
})


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